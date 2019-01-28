<?php
namespace core;
use core\Exceptions\NotFoundException;

class Application
{
	private $params;

	public function __construct($params)
	{
		$this->params = $params;
	}

	public function run()
	{
		$last = count($this->params) - 1;
		if($this->params[$last] === '') {
			unset($this->params[$last]);
		}
		//Работа с контроллером через URI.

		$controller = isset($this->params[0]) && $this->params[0] != '' ? $this->params[0] : 'Articles';
		switch ($controller) {
			case 'Articles':
				$controller = 'Articles';
				break;
			case 'Users':
				$controller = 'Users';
				break;
			default:
				throw new NotFoundException();
				break;
		}

		//Работа с экшн через URI.
		if(!is_numeric($this->params[1] ?? null)) {
			$id = is_numeric($this->params[2] ?? null) ? $this->params[2] : null;
			$action = isset($this->params[1]) && $this->params[1] !== '' ? $this->params[1] : 'index';
		}
		else {
			$id = $this->params[1];
			$action = isset($controller) && $controller == 'Articles' ? 'article' : '';
		}	
		if ($controller == 'Articles') {
			switch ($action) {
				case 'index':
					$action = 'index';
					break;
				case 'article':
					$action = 'article';
					break;
				case 'add':
					$action = 'add';
					break;
				case 'edit':
					$action = 'edit';
					break;	
				case 'delete':
					$action = 'delete';
					break;
				
				default:
					throw new NotFoundException();
					break;
			}
		} elseif ($controller == 'Users') {
			switch ($action) {
				case 'sign-in':
					$action = 'signIn';
					break;
				case 'sign-up':
					$action = 'signUp';
					break;
				case 'exit':
					$action = 'exit';
					break;
				
				default:
					throw new NotFoundException();
					break;
			}
		}

		$_GET['id'] = $id;
		//Универсальное определение контроллера и экшна.
		$vars['controller'] = sprintf('controller\%s', $controller);
		$vars['action'] = sprintf('%sAction', $action);
		return $vars;
	}
}

?>