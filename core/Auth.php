<?php
namespace core;
class Auth
{
	private $user;
	public function __construct($user)
	{
		$this->user = $user;
	}

	public function check()
	{
		if(isset($_SESSION['isAuth']) && $_SESSION['isAuth']) {
			return true;
		}
		elseif(isset($_COOKIE['login'])) {
			$currentUser = $this->user->getOne($_COOKIE['login']);
			if(isset($_COOKIE['password']) &&  $_COOKIE['password'] == $currentUser['password']) {
				$_SESSION['isAuth'] = true;
				return true;
			}
		}
		else {
			return false;
		}
	}
}

?>