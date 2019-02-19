<?php
namespace Kulaxyz\Blog\model;
use Kulaxyz\Blog\core\DBDriver;
use Kulaxyz\Blog\core\Validator;

class SessionsModel extends BaseModel
{
	const NEED_VALIDATION = false;
	const TABLE_TO_JOIN = 'Users';

	public function __construct(DBDriver $db, Validator $validator)
	{
		parent::__construct($db, 'Sessions', $validator);
	}

	public function setSid($sid, $user_id)
	{
		$session = $this->getBy(['user_id' => $user_id]);
		$params = ['sid' => $sid, 'user_id' => $user_id];
		if (!$session) {
			$this->addOne($params, self::NEED_VALIDATION);
		} else {
			$this->editOne(['sid' => $sid], ['user_id' => $user_id], self::NEED_VALIDATION);
		}
	}
	
	public function getBySid($sid)
	{
		$fields = ['id', 'login', 'password'];
		$join_on = ['user_id', 'id'];
		$where = ['sid' => $sid];

		return $this->db->selectAndJoin(self::TABLE_TO_JOIN, $this->table, $fields, $join_on, $where);
	}
}

?>