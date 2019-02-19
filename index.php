<?php
require_once __DIR__ . '/bootstrap.php';

use Kulaxyz\Blog\core\Request;
use Kulaxyz\Blog\core\Application;
use Kulaxyz\Blog\controller\Base;
use Kulaxyz\Blog\core\Container;
use Kulaxyz\Blog\boxes\ArticlesModelBox;
use Kulaxyz\Blog\boxes\UserHelpBox;

define('ROOT', '/');
//Работа с ЧПУ
$params = explode('/', $_GET['php1chpu']);
$application = new Application($params);
try {
	$vars = $application->run();
	$controller = $vars['controller'];
	$action = $vars['action'];
	$request = new Request($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES, $_SESSION);
	$usingController = new $controller($request, $container);
	$usingController->$action();
} catch (Exception $e) {
	$usingController = new Base();
	$usingController->error($e->getMessage(), $e->getCode());
}
//Выведение на экран основного шаблона, с вложенным шаблоном (например, add, edit, login). 

echo $usingController->render();
?>
