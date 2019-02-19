<?php
namespace Kulaxyz\Blog\core\Form;

/**
 * 
 */
class FormBuilder
{
	private $form;

	public function __construct($form)
	{
		$this->form = $form;
	}

	public function fields()
	{
		$inputs = [];

		foreach ($this->form->getFields() as $field) {
			$inputs[] = $this->input($field);
		}

		return $inputs;
	}

	public function input(array $attributes)
	{
		if ($attributes['type'] === 'textarea') {
			$value = '';

			if ($this->form->request->isPost()) {
				$value = $this->getValue($attributes);
			}
				
			return sprintf('<textarea %s>%s</textarea>', $this->buildAttributes($attributes), $value);
		}

		return sprintf('<input %s>', $this->buildAttributes($attributes));
	}

	public function buildAttributes(array $attributes)
	{
		$array = [];
		$value = null;
		foreach ($attributes as $name => $attribute) {			
			if ($this->form->request->isPost()) {
				$value = isset($value) ? $value : $this->getValue($attribute);
			}

			$array[] = sprintf('%s="%s"', $name, $attribute);
		}

		 	return sprintf('%s value="%s"', implode(' ', $array), $value);

	}

	public function inputSign()
	{
		return $this->input(
			[
				'type' => 'hidden',
				'name' => 'sign',
				'value' => $this->form->getSign()
			]
		);
	}

	private function getValue($attributes)
	{
		$vallueArr = $this->form->handleRequest();
		
		if (is_array($attributes)) {
			foreach ($attributes as $name => $attribute) {	
				if (isset($vallueArr[$attribute])) {
					return $vallueArr[$attribute];
				}
			}		
			
		} else {
			if (isset($vallueArr[$attributes])) {
				return $vallueArr[$attributes];
			}
		}
	}

	public function handleRequest()
	{
		return $this->form->handleRequest();
	}
}

?>