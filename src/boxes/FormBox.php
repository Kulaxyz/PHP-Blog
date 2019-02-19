<?php

namespace Kulaxyz\Blog\boxes;

use Ig0rbm\HandyBox\HandyBoxInterface;
use Ig0rbm\HandyBox\HandyBoxContainer;

/**
 * 
 */

class FormBox implements HandyBoxInterface 
{
	public function register(HandyBoxContainer $container)
	{
		$container->factory('form', function($name, $request){
			$form = sprintf('Kulaxyz\\Blog\\forms\\%s', $name);
			return new $form($request);
		});
	}

}
