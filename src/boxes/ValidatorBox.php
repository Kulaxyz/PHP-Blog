<?php

namespace Kulaxyz\Blog\boxes;

use Ig0rbm\HandyBox\HandyBoxInterface;
use Ig0rbm\HandyBox\HandyBoxContainer;
use Kulaxyz\Blog\core\Validator;

/**
 * 
 */

class ValidatorBox implements HandyBoxInterface 
{
	public function register(HandyBoxContainer $container)
	{
		$container->factory('validator', function(){
			return new Validator();
		});
	}

}
