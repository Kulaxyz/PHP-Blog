<?php
namespace model;
use core\DBDriver;
use core\Validator;

class UsersModel extends BaseModel
{

	public function __construct(DBDriver $db, Validator $validator)
	{
		parent::__construct($db, 'Users', $validator);
	}

	public function getOne($login)
	{
		$params = ['login' => $login];
		return $this->db->select($this->table, $params, DBDriver::FETCH_ONE);
	}

	// public function editOne($id, $login, $username, $password)
	// {

	// 	$params = [
	// 			  'login' => $login,
	// 			   'password' =>hash("sha256", "$password"),
	// 			   'username' => $username
	// 			   ];
	// 	$where = ['login' => $login];
	// 	$this->db->update($this->table, $params, $where);
	// }
}


?>