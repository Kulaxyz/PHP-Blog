<?php
	namespace core\Exceptions;

	/**
	 * 
	 */
	class ValidationException extends \Exception
	{
		private $errors;

		public function __construct($errors, $code)
		{
			$this->errors = $errors;
			parent::__construct('');
		}

		public function getErrors()
		{
			return sprintf('<br>%s', implode('<br>', $this->errors));
		}
	}
?>