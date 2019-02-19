<?php 	
namespace Kulaxyz\Blog\forms;

use Kulaxyz\Blog\core\Form\Form;
use Kulaxyz\Blog\core\Request;

/**
 * 
 */
class SignIn extends Form
{
	
	public function __construct(Request $request)
	{
		$this->fields = [
			[
				'name' => 'login',
				'placeholder' => 'Введите логин',
				'type' => 'text',
				'class' => 'login-input'
			],
			[
				'name' => 'password',
				'type' => 'password',
				'placeholder' => 'Введите пароль',
				'class' => 'password-input'
			],
			[
				'type' => 'submit',
				'value' => 'Войти'
			]
		];

		$this->request = $request;
		$this->formName = 'sign-in';
		$this->method = 'POST';
		$this->class = 'sign-in-form';
	}
}