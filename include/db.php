<?php

class DB {

	private $mysqli;

	public function __construct($host, $login, $password, $name)
	{
		$this->mysqli = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

		if (mysqli_connect_errno()) {
			die('Ошибка подключения: ' . mysqli_connect_error()); 
		}
		$this->query("SET NAMES 'utf8'");	
	}

	public function autocommit($p){
		$this->mysqli->autocommit($p);
	}

	public function begin_transaction(){
		$this->mysqli->begin_transaction();
	}

	public function commit(){
		$this->mysqli->commit();
	}

	public function rollback(){
		$this->mysqli->rollback();
	}

	public function query($sql){
//		echo $sql."\n";
		$result = $this->mysqli->query($sql);
		return $result;
	}

	public function selectByQuery($sql){
		$result = $this->query($sql);
		if($result) {
			$out = array();
			while ($obj = $result->fetch_object()) {
				$out[] = $obj;
			}
			return $out;
		}
		else{
			return false;
		}
	}

	public function select($fields, $table, $params = array(), $order = '', $limit = '', $offset = ''){
		$sql = "SELECT ".$fields." FROM `".$table."`";
		if(count($params)) {
			$sql_params = array();
			foreach($params as $key => $val) {
				if(is_null($val)){
					$sql_params[] = $key." IS NULL";
				}
				else {
					$znak = in_array($key[strlen($key)-1], array('>', '<', '=')) ? "" : " ="; 
					$sql_params[] = $key.$znak." '".$this->mysqli->escape_string(strval($val))."'";
				}
			}
			$sql .= " WHERE ".implode(" and ", $sql_params);
		}
		if ($order) {
			$sql .= " ORDER BY ".$order;
		}
		if ($limit) {
			$sql .= " LIMIT ".$limit;
		}
		if ($offset) {
			$sql .= " OFFSET ".$offset;
		}
		return $this->selectByQuery($sql);
	}

	public function selectRow($fields, $table, $params = array(), $order = ''){
		$array = $this->select($fields, $table, $params, $order, 1);
		if(is_array($array)) {
			return reset($array);
		}
		else {
			return false;
		}
	}

	public function selectCount($table, $params = array()){
		$array = $this->select('count(*) c', $table, $params);
		if(is_array($array)) {
			$row = reset($array);
			return $row->c;
		}
		else {
			return false;
		}
	}


	public function selectSum($field, $table, $params = array(), $group_by = ''){
		$array = $this->select('sum('.$field.') sum', $table, $params, "", "", $group_by);
		if(is_array($array)) {
			$row = reset($array);
			return $row->c;
		}
		else {
			return false;
		}
	}


	public function insert($table, $params, $return_id = true){
		$fields_arr = array();
		$values_arr = array();
		foreach($params as $field => $value) {
			$fields_arr[] = "`".$field."`";
			$values_arr[] = "'".$this->mysqli->real_escape_string($value)."'";
		}
		$fields = implode(", ", $fields_arr);
		$values = implode(", ", $values_arr);
		$sql = "INSERT INTO `$table` ($fields) values($values)";
		$result = $this->query($sql);
		if($return_id) {
			return $this->mysqli->insert_id;
		}
		else {
			return $result;
		}
	}

	public function update($table, $params, $where = ''){
		$update_vars = array();
		foreach($params as $field => $value) {
			if(strtoupper($value) == 'NOW()'){
				$update_vars[] = "`".$field."` = NOW()";
			}
			else{
				$update_vars[] = "`".$field."` = '".$this->mysqli->real_escape_string($value)."'";
			}
		}
		$sql = "UPDATE `$table` set ".implode(", ", $update_vars)." ".($where ? "WHERE ".$where : "");
		$result = $this->query($sql);
		return $result;
	}





}