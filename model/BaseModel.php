<?php
namespace model;
use core\DBDriver;
use core\Validator;
use core\Exceptions\ValidationException;


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

	public function getById($id)
	{
		return $this->db->select($this->table, ['id' => $id], DBDriver::FETCH_ONE);
	}

	public function deleteOne($id)
	{
		$params = ['id' => $id];
		$this->db->delete($this->table, $params);
	}

	public function addOne($params)
	{
		$this->validator->execute($params);
		if(!$this->validator->success) {
			throw new ValidationException($this->validator->errors, 500);
		} else {
		return $this->db->insert($this->table, $params);
		}
	}

	public function editOne($params, $where)
	{
		$this->validator->execute($params);
		if(!$this->validator->success) {
			throw new ValidationException($this->validator->errors, 500);
		} else {
			$this->db->update($this->table, $params, $where);
		}
	}

}

?>