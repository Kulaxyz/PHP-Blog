<?php
namespace Kulaxyz\Blog\core;
class DB
{
	public static function connect()
	{
		static $db; 
		if($db === null) {
			$db = new \PDO('mysql:host=localhost;dbname=main', 'root', '');
			$db->exec('SET NAMES UTF8');
		}

		return $db;
	}
}

?>