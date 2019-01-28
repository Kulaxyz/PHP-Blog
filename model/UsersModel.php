<?php
namespace model;
use core\DBDriver;
use core\Validator;

class UsersModel extends BaseModel
{
	private $scheme =
	[
		'id' => [
					'type' => 'integer',
					'primary' => true
				],
		'login' => [
						'type' => 'string',
						'length' => [2,150],
				 		'require' => true
				   ],
		'email' => [
						'type' => 'string',
						'length' => [3, 150],
						'require' => true
				    ],
		'password' => [
						'type' => 'string',
						'length' => [6, 4000],
						'require' => true
				     ]

	];


	public function __construct(DBDriver $db, Validator $validator)
	{
		parent::__construct($db, 'Users', $validator);
		$this->validator->setRules($this->scheme);
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