<?php 	
namespace Kulaxyz\Blog\forms;

use Kulaxyz\Blog\core\Form\Form;
use Kulaxyz\Blog\core\Request;
/**
 * 
 */
class Add extends Form
{
	
	public function __construct(Request $request)
	{
		$this->fields = [
			[
				'name' => 'title',
				'placeholder' => 'Введите название статьи',
				'type' => 'text',
				'class' => 'title-input'
			],
			[
				'name' => 'content',
				'type' => 'textarea',
				'placeholder' => 'Ваша статья',
				'class' => 'content-input'
			],
			[
				'name' => 'author',
				'type' => 'text',
				'placeholder' => 'Автор',
				'class' => 'author-input'
			],

			[
				'type' => 'submit',
				'value' => 'Добавить!'
			]
		];

		$this->request = $request;
		$this->formName = 'add';
		$this->method = 'POST';
		$this->class = 'add-class';
	}
}