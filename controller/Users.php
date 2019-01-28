<?php
namespace controller;
use core\Request;
use model\UsersModel;
use core\DB;
use core\DBDriver;
use core\Validator;
use core\UserHelp;
use core\Exceptions\ValidationException;

class Users extends Base
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function signUpAction()
	{	
		$model = new UsersModel(new DBDriver(DB::connect()), new Validator());

		if (!$model) {
			throw new ModelException();	
		}

		$help = new UserHelp($model);

		if (!$help) {
			throw new ModelException();	
		}

		if ($this->request->isPost()) {
			$params = $this->request->post();
			try {
				$help->signUp($params);
				header('Location:' . ROOT . 'Users/sign-in');
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		} else {
			$errors = '';
			$params = [];
		}

		$this->content = $this->build('sign-up', [
										'params' => $params,
										'errors' => $errors
										]
							);
	}

	public function signInAction()
	{
		$model = new UsersModel(new DBDriver(DB::connect()), new Validator());

		if (!$model) {
			throw new ModelException();	
		}

		$help = new UserHelp($model);

		if (!$help) {
			throw new ModelException();	
		}

		if ($this->request->isPost()) {
			$params = $this->request->post();
			try {
				$help->signIn($params);
				header('Location:' . ROOT . 'Articles');
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
		else {
			$params = [];
			$errors = '';
		}

		$this->content = $this->build('sign-in', 
												[
												'params' => $params,
												'errors' => $errors
												]
									  );	
	}

	public function exitAction()
	{
		$_SESSION['isAuth'] = false;
		setcookie('login', '', time() - 3600 * 24 * 365 * 10, '/');
		setcookie('password', '', time() - 3600 * 24 * 365 * 10, '/');
		header('Location:' . ROOT . 'Articles');
	}
}
?>