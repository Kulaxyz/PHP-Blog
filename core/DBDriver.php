<?php

namespace core;
use core\Exceptions\QueryException;

class DBDriver
{
	const FETCH_ALL = 'all';
	const FETCH_ONE = 'one';
	private $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function select($table, array $params = [], $fetch = self::FETCH_ALL)
	{	
		$masks = [];
		foreach ($params as $key => $value) {
			array_push($masks, sprintf('%s = :%s', $key, $key));
		}
		$where = sprintf('%s', implode(', ', $masks));
		if (empty($where)) {
			$where = 1;
		}
		$sql = sprintf("SELECT * FROM %s WHERE %s", $table, $where);
		$query = $this->db_query($sql, $params);

		if ($fetch == self::FETCH_ALL) {
			return $query->fetchAll();
		} elseif ($fetch == self::FETCH_ONE) {
			return $query->fetch();
		} else {
			///////////////////////$GLOBALS['err404'] = true;
		}
	}

	public function insert($table, array $params)
	{
		$columns = sprintf('(%s)', implode(', ', array_keys($params)));
		$masks = sprintf('(:%s)', implode(', :', array_keys($params)));
		$sql = sprintf('INSERT INTO %s %s VALUES %s', $table, $columns, $masks);
	
		$this->db_query($sql, $params);
		return $this->db->lastInsertID();
	}

	public function update($table, array $params, array $where)
	{
		$masks = [];
		$whereIs = [];
		foreach ($params as $key => $value) {
			array_push($masks, sprintf('%s = :%s', $key, $key));
		}
		$masks = sprintf('%s', implode(', ', $masks));

		foreach ($where as $key => $value) {
		array_push($whereIs, sprintf('%s = :%s', $key, $key));
		}
		$whereIs = sprintf('%s', implode(', ', $whereIs));
		$sql = sprintf('UPDATE %s SET %s WHERE %s', $table, $masks, $whereIs);
		$params = array_merge($params, $where);

		$this->db_query($sql, $params);
	}

	public function delete($table, array $params = [])
	{
		$masks = sprintf('%s = :%s', implode(', ', array_keys($params)), implode(', :', array_keys($params)));
		$sql = sprintf('DELETE FROM %s WHERE %s', $table, $masks);

		$this->db_query($sql, $params);

	}

	private function db_query($sql, $params = [])
	{
		$query = $this->db->prepare($sql);
		$query->execute($params);
		
		$this->db_check_error($query);
		
		return $query;
	}
	
	private function db_check_error($query){
		$info = $query->errorInfo();
	
		if ($info[0] != \PDO::ERR_NONE){
			throw new QueryException();
		}
	}

}