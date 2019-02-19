<?php

namespace Kulaxyz\Blog\boxes;
use Ig0rbm\HandyBox\HandyBoxInterface;
use Ig0rbm\HandyBox\HandyBoxContainer;
use Kulaxyz\Blog\model\ArticlesModel;
use core\DB;
use Kulaxyz\Blog\core\Validator;
use core\DBDriver;

/**
 * 
 */
class ModelBox implements HandyBoxInterface 
{
	public function register(HandyBoxContainer $container)
	{
		$container->factory('model', function($name) use($container){
			$driver = $container->get('db-driver');
			$validator = $container->fabricate('validator');
			
			$model = sprintf('Kulaxyz\\Blog\\model\\%sModel', $name);
			
			return new $model($driver, $validator);
		});
	}
}