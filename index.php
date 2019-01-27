<?php
use core\Request;
use core\Application;
use controller\Base;
session_start();
define('ROOT', '/');
//Автоподключение к файлам с классами.
try {
	function __autoload($classname) 
	{
		$file =  __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
		if(is_file($file)){
		include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
		}
		else{
			throw new Exception("Problems with an autoload", 500);	
		}
	}	
} catch (Exception $e) {
	exit($e->getMesage());
}

//Работа с ЧПУ
$params = explode('/', $_GET['php1chpu']);
$application = new Application($params);
try {
	$vars = $application->run();
	$controller = $vars['controller'];
	$action = $vars['action'];
	$request = new Request($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES, $_SESSION);
	$usingController = new $controller($request);
	$usingController->$action();
} catch (Exception $e) {
	$usingController = new Base();
	$usingController->error($e->getMessage(), $e->getCode());
}
//Выведение на экран основного шаблона, с вложенным шаблоном (например, add, edit, login). 

echo $usingController->render();
?>
