<?php

namespace Kulaxyz\Blog\boxes;

use Ig0rbm\HandyBox\HandyBoxInterface;
use Ig0rbm\HandyBox\HandyBoxContainer;
use Kulaxyz\Blog\core\DB;
use Kulaxyz\Blog\core\DBDriver;

/**
 * Uses service to create one class for work wirh DB.
 *
 *@param HandyBoxContainer $container
 */

class DBDriverBox implements HandyBoxInterface 
{
	public function register(HandyBoxContainer $container)
	{
		$container->service('db-driver', function(){
			return new DBDriver(DB::connect());
		});
	}

}