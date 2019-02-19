<?php 	
namespace Kulaxyz\Blog\forms;

use Kulaxyz\Blog\core\Form\Form;
use Kulaxyz\Blog\core\Request;
/**
 * 
 */
class SignUp extends Form
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
				'name' => 'email',
				'type' => 'email',
				'placeholder' => 'Введите email',
				'class' => 'email-input'
			],
			[
				'name' => 'password',
				'type' => 'password',
				'placeholder' => 'Введите пароль',
				'class' => 'password-input'
			],
			[
				'name' => 'password2',
				'type' => 'password',
				'placeholder' => 'Повторите пароль',
				'class' => 'password2-input'
			],
			[
				'type' => 'submit',
				'value' => 'Зарегистрироваться'
			]
		];

		$this->request = $request;
		$this->formName = 'sign-up';
		$this->method = 'POST';
		$this->class = 'sign-up-form';
	}
}