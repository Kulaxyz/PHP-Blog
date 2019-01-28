<?php
namespace core;
/**
 * 
 */
use core\Exceptions\ValidationException;

class UserHelp 
{
	private $model;
	const NEED_VALIDATION = false;
	
	public function __construct($model)
	{
		$this->model = $model;
	}

	public function signUp($params)
	{
		$user = $this->model->getOne($params['login']) ?? false;

		if (!$user) {
			$this->model->validator->execute($params);

			if (!$this->model->validator->success) {
				throw new ValidationException($this->model->validator->errors, 500);
			}
			
			if (!$this->passwordMatch($params)) {
				throw new ValidationException("Пароли не совпадают", 500);
			}

			$params['password'] = $this->getHash($params['password']);
			unset($params['password2']);

			$this->model->addOne($params, NEED_VALIDATION);

		} else {
			throw new ValidationException("Пользователь с таким логином уже существует", 1);
		}

	}

	public function signIn($params)
	{
		$user = $this->model->getOne($params['login']) ?? false;

		if (!$user) {
			throw new ValidationException("Пользователь с таким логином не найден", 500);
		} 

		$password = trim($this->getHash($params['password']));

		if ($password === $user['password']) {
			$_SESSION['isAuth'] = true;
			if ($params['remember']) {
				setcookie('login', $params['login'], time() + 3600 * 24 * 365 * 10, '/');
				setcookie('password', $params['password'], time() + 3600 * 24 * 365 * 10, '/');
			}
		} else {
			throw new ValidationException("Ввведён неверный пароль.", 1);
		}

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
}