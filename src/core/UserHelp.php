<?php
namespace Kulaxyz\Blog\core;
/**
 * 
 */
use Kulaxyz\Blog\core\Exceptions\ValidationException;
use Kulaxyz\Blog\model\UsersModel;
use Kulaxyz\Blog\model\SessionsModel;

class UserHelp 
{
	private $model;
	private $sessModel;
	const NEED_VALIDATION = false;
	const LENGTH_OF_SID = 10;

	public function __construct(UsersModel $model, SessionsModel $sessModel)
	{
		$this->model = $model;
		$this->sessModel = $sessModel;
	}

	public function signUp($params)
	{
		$user = $this->model->getBy(['login' => $params['login']]) ?? false;

		if ($user) {
			throw new ValidationException("Пользователь с таким логином уже существует", 1);

		} else {
			$this->model->validator->execute($params);

			if (!$this->model->validator->success) {
				throw new ValidationException($this->model->validator->errors, 500);
			}
			
			if (!$this->passwordMatch($params)) {
				throw new ValidationException("Пароли не совпадают", 500);
			}

			$params['password'] = $this->getHash($params['password']);
			unset($params['password2']);

			$this->model->signUp($params, self::NEED_VALIDATION);
		}

	}

	public function signIn($params)
	{
		if (empty($params['login']) || empty($params['password'])) {
			throw new ValidationException("Заполните все поля.", 1);
		}
		$login = $params['login'] ?? null;
		$user = $this->model->getBy(['login' => $login]) ?? null;

		if (!$user) {
			throw new ValidationException("Пользователь с таким логином не найден", 500);
		} 

		$password = trim($this->getHash($params['password']));

		if ($password !== $user['password']) {
			throw new ValidationException("Ввведён неверный пароль.", 1);
		} else {
			$this->setSession($user);

			if ($params['remember']) {
				$this->setCookie($params['login'], $password);
			}
		}

	}

	public function isAuth($session, $cookie)
	{
		if (!isset($session['sid'])) {
			if (!isset($cookie['login'])) {
				return false;
			} else {
				$user = $this->model->getBy(['login' => $cookie['login']]) ?? null;

				if (!$user) {
					return false;
				} else {
					if ($cookie['password'] === $user['password']) {
					 	$this->setSession($user);
					 	return true;
					} 
					return false;
				}
			}
		} else {
			$sid = $session['sid'];
			$dbSess = $this->sessModel->getBy(['sid' => $sid]) ?? null;
			if (!$dbSess) {
				return false;
			} else {
				$user = $this->sessModel->getBySid($sid) ?? null;

				return $user ? true : false;
			}
		}
	}

	public function exit()
	{
		$this->sessModel->deleteOne(['sid' => $_SESSION['sid']]);
		unset($_SESSION['sid']);
		$this->unsetCookie();
	}

	private function passwordMatch($params)
	{
		if ($params['password'] === $params['password2']) {
			return true;
		} else {
			return false;
		}
	}

	private function getHash($password)
	{
		return hash('sha256', $password);
	}

	private function generateSid()
	{	
		$sid = '';
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charsLength = mb_strlen($chars);
		for ($i = 0; $i < self::LENGTH_OF_SID; $i++) { 
			$sid .= $chars[random_int(0, $charsLength - 1)];
		}

		return $sid;
	}

	private function setCookie($login, $password)
	{
		setcookie('login', $login, time() + 3600 * 24 * 365 * 10, '/');
		setcookie('password', $password, time() + 3600 * 24 * 365 * 10, '/');	
	}

	private function unsetCookie()
	{
		setcookie('login', 'unset', time() - 3600 * 24 * 365 * 10, '/');
		setcookie('password', 'unset', time() - 3600 * 24 * 365 * 10, '/');	
	}

	private function setSession($user)
	{
		$sid = $this->generateSid();
		$_SESSION['sid'] = $sid;
		$this->sessModel->setSid($sid, $user['id']);
	}
}