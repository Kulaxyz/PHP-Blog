<?php
namespace Kulaxyz\Blog\controller;
use Kulaxyz\Blog\core\Request;
use Kulaxyz\Blog\model\UsersModel;
use Kulaxyz\Blog\model\SessionsModel;
use Kulaxyz\Blog\core\DB;
use Kulaxyz\Blog\core\DBDriver;
use Kulaxyz\Blog\core\Validator;
use Kulaxyz\Blog\core\UserHelp;
use Kulaxyz\Blog\core\Exceptions\ValidationException;
use Kulaxyz\Blog\forms\SignUp;
use Kulaxyz\Blog\forms\SignIn;
use Kulaxyz\Blog\core\Form\FormBuilder;
use Kulaxyz\Blog\core\Container;
use Ig0rbm\HandyBox\HandyBoxContainer;



class Users extends Base
{
	private $request;
	private $container;

	public function __construct(Request $request, HandyBoxContainer $container)
	{
		$this->request = $request;
		$this->container = $container;
	}

	public function signUpAction()
	{	
		$formBuilder = $this->container->fabricate('form-builder', 'SignUp', $this->request);

		if ($this->request->isPost()) {
			$help = $this->container->get('UserHelp');
			try {
				$help->signUp($formBuilder->handleRequest());
				header('Location:' . ROOT . 'Users/sign-in');
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		} else {
			$errors = '';
		}

		$this->content = $this->build('sign-up', [
													'form' => $formBuilder,
													'errors' => $errors
												 ]
									 );
	}

	public function signInAction()
	{
		$formBuilder = $this->container->fabricate('form-builder', 'SignIn', $this->request);

		if ($this->request->isPost()) {
			$help = $this->container->get('UserHelp');
			try {
				$help->signIn($formBuilder->handleRequest());
				header('Location:' . ROOT . 'Articles');
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		} else {
			$errors = '';
		}

		$this->content = $this->build('sign-in', 
												[
												'form' => $formBuilder,
												'errors' => $errors
												]
									  );	
	}

	public function exitAction()
	{
		$help = $this->container->get('UserHelp');
		$help->exit();
		header('Location:' . ROOT . 'Articles');

	}

}
?>