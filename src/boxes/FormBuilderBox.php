<?php

namespace Kulaxyz\Blog\boxes;

use Ig0rbm\HandyBox\HandyBoxInterface;
use Ig0rbm\HandyBox\HandyBoxContainer;
use Kulaxyz\Blog\core\Form\FormBuilder;

/**
 * 
 */

class FormBuilderBox implements HandyBoxInterface 
{
	public function register(HandyBoxContainer $container)
	{
		$container->factory('form-builder', function($name, $request) use ($container){
			$form = $container->fabricate('form', $name, $request);
					
			return new FormBuilder($form);
		});
	}

}
