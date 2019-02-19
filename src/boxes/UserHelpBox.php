<?php

namespace Kulaxyz\Blog\boxes;

use Ig0rbm\HandyBox\HandyBoxInterface;
use Ig0rbm\HandyBox\HandyBoxContainer;
use Kulaxyz\Blog\model\ArticlesModel;
use Kulaxyz\Blog\core\Validator;
use Kulaxyz\Blog\core\UserHelp;
/**
 * 
 */
class UserHelpBox implements HandyBoxInterface 
{
	public function register(HandyBoxContainer $container)
	{
		$container->service('UserHelp', function() use ($container){
			$model = $container->fabricate('model', 'Users');
			$sessModel = $container->fabricate('model', 'Sessions');
		
			return new UserHelp($model, $sessModel);
		});
	}
}