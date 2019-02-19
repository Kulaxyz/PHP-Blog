<?php
namespace Kulaxyz\Blog\model;
use Kulaxyz\Blog\core\DBDriver;
use Kulaxyz\Blog\core\Validator;
use Kulaxyz\Blog\core\Exceptions\ValidationException;


class BaseModel
{
	protected $db;
	protected $table;

	public function __construct($db, $table, $validator)
	{
		$this->db = $db;
		$this->table = $table;
		$this->validator = $validator;
	}

	public function getAll()
	{
		return $this->db->select($this->table, $params = [], DBDriver::FETCH_ALL);
	}

	public function getBy($params)
	{
		return $this->db->select($this->table, $params, DBDriver::FETCH_ONE);
	}

	public function deleteOne($params)
	{
		$this->db->delete($this->table, $params);
	}

	public function addOne($params, $needValidation = true)
	{
		if ($needValidation) {
			$this->validate($params);
		}

		return $this->db->insert($this->table, $params);

	}

	public function editOne($params, $where, $needValidation = true)
	{
		$params_for_validation = array_merge($params, $where);
		
		if ($needValidation) {
			$this->validate($params_for_validation);
		}

		return $this->db->update($this->table, $params, $where);
	}

	private function validate($params)
	{
		$this->validator->execute($params);

		if (!$this->validator->success) {
			throw new ValidationException($this->validator->errors, 500);
		}
	}

}

?>
			