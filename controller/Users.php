<?php
namespace controller;
use core\Request;
use model\UsersModel;
use core\DB;
use core\DBDriver;
use core\Validator;
class Users extends Base
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function registerAction()
	{
		$model = new UsersModel(new DBDriver(DB::connect()), new Validator());
		if($this->request->isPost()) {
			$login = trim(sprintf('%s', $this->request->post('login')));
			$username = trim(sprintf('%s', $this->request->post('username')));
			$passwd = trim(sprintf('%s', $this->request->post('password')));
			$passwd2 = trim(sprintf('%s', $this->request->post('password2')));
			$user = $model->getOne($login);
			if($passwd2 != $passwd) {
				$msg = 'Пароли не совпадают';
			}
			elseif(!empty($user)) {
				$msg = 'Пользователь с таким логином уже существует.';
			}
			elseif(strlen($login) < 3) {
				$msg = 'Логин должен содержать хотя бы 3 символа.';
			}
			elseif(strlen($username) < 3) {
				$msg = 'Имя должен содержать хотя бы 3 символа.';
			}
			elseif(strlen($passwd) < 7) {
				$msg = 'Придумайте посложнее пароль.';
			}
			else {
				$password = hash('sha256', $passwd);
				$params =  [
					'login' => $login,
					'username' => $username,
					'password' => $password
					];
				$model->addOne($params);
				header('Location:' . ROOT . 'Users/login');
			}
		}
		else {
			$login = '';
			$username = '';
			$msg = '';
		}
		return $this->build('register', ['login' => $login, 'username' => $username, 'msg' => $msg]);
	}

	public function loginAction()
	{
		$model = new UsersModel(new DBDriver(DB::connect()), new Validator());
		if($this->request->isPost()) {
			$login = trim(sprintf('%s', $this->request->post('login')));
			$passwd = trim(sprintf('%s', $this->request->post('password')));
			$user = $model->getOne($login);
			if(empty($user)) {
				$msg = 'Пользователь с таким логином не найден.';
			}
			else {
				$password = hash('sha256', $passwd);
				if($password == $user['password']) {
					$_SESSION['isAuth'] = true;
					if($this->request->post('remember') !== null) {
						setcookie('login', $login, time() + 3600 * 24 * 365 * 10, '/');
						setcookie('password', $password, time() + 3600 * 24 * 365 * 10, '/');
					}
					header('Location:' . ROOT . 'Articles');
				}
				else {
					$msg = 'Неправильный пароль';
				}
			}
		}
		else {
			$login = '';
			$msg = '';
		}
		$this->content = $this->build('login', ['login' => $login, 'msg' => $msg]);	
	}

	public function exitAction()
	{
		$model = new UsersModel(new DBDriver(DB::connect()), new Validator());
		$_SESSION['isAuth'] = false;
		setcookie('login', $login, time() - 3600 * 24 * 365 * 10, '/');
		setcookie('password', $password, time() - 3600 * 24 * 365 * 10, '/');
		header('Location:' . ROOT . 'Articles');
	}

	// public function deleteAction()
	// {
	// 	$model = new UsersModel(new DBDriver(DB::connect()));
	// 	$id = $this->session('id') !== null && is_numeric($this->session('id')) ? $this->session('id') : null;
	// 	$model->deleteOne($id);
	// 	header('Location:' . ROOT . 'Articles');

	// }
}
?>