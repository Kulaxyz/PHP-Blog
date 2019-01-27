<?php
namespace core;

class Validator
{
	private $rules;
	public $clean = [];
	public $errors = [];
	public $success = false;

	public function setRules(array $rules)
	{
		$this->rules = $rules;
	}

	public function execute($params)
	{
		if (!$this->rules) {
		//	throw new ValidationException("Rules were not set", 500);
		}

		foreach ($this->rules as $name => $rule) {
			if (!isset($params[$name]) && !isset($rule['require']))	{
				continue;
			}		
			if (!isset($params[$name]) && isset($rule['require']))	{
				$this->errors[$name] = sprintf('Необходимо заполнить поле %s', $name);
			} 
			elseif (isset($rule['type']) && !$this->typeMatch($params[$name], $rule['type'])) {
				$this->errors[$name] = sprintf('Поле %s должно быть типа %s', $name, $rule['type']);
			}
			elseif ($params[$name] === '' && isset($rule['require']))	{
				$this->errors[$name] = sprintf('Необходимо заполнить поле %s.', $name);
			}				
			elseif (isset($rule['length']) && !$this->lengthMatch($params[$name], $rule['length'])) {
				$this->errors[$name] = sprintf('Длина поля %s недопустима.', $name);
			}
			if (empty($this->errors)) {
				if (isset($rule['type'])) {
					if ($rule['type'] === 'string') {
						$this->clean[$name] = trim(htmlspecialchars($params[$name]));
					} elseif ($rule['type'] === 'integer') {
						$this->clean[$name] = intval($params[$name]);
					}
				} else {
					$this->clean[$name] = $params[$name];
				}
			}

		}

		if (empty($this->errors)) {
			$this->success = true;
		}
	}

	public function lengthMatch($value, $length)
	{
		if (is_array($length)) {
			$minLength = isset($length[0]) ? $length[0] : null;
			$maxLength = isset($length[1]) ? $length[1] : null;
			return mb_strlen($value) > $minLength && $value < $maxLength;
		} else {
			$maxLength = $length ?? null;
			return $value < $maxLength;
		}

	}

	public function typeMatch($value, $type)
	{
		switch ($type) {
			case 'string':
				return is_string($value);
				break;
			case 'integer':
				return is_numeric($value) || ctype_digit($value);
				break;
			
			default:
				//error.
				break;
		}
	}

}

?>