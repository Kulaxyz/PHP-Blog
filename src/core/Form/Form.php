<?php

namespace Kulaxyz\Blog\core\Form;

/**
 * 
 */
abstract class Form 
{
	protected $method;
	protected $fields;
	protected $action;
	protected $formName;
	protected $class;
	public $request;

	public function getMethod()
	{
		return $this->method;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function getFormName()
	{
		return $this->formName;
	}

	public function getClass()
	{
		return $this->class;
	}

	public function handleRequest()
	{
		$fields = [];
		foreach ($this->getFields() as $field) {
			if (!isset($field['name'])) {
				continue;
			}

			$name = $field['name'];

			if ($this->request->post($name) !== null) {
				$fields[$name] = $this->request->post($name);
			}
		}

		if ($this->request->post('sign') !== $this->getSign()) {
			throw new \Exception("Похоже, что вы попытались изменить форму", 1);
		}

		return $fields;
	}

	public function getSign()
	{
		$sign = '';

		foreach ($this->fields as $field) {
			$name = $field['name'] ?? null;
			if (!$name) {
				continue;	
			}
			
			$sign .= '@+@=@' . $name;
		}

		return md5($sign);
	}

}