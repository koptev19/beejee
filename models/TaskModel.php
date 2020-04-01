<?php


class TaskModel extends Model {

	public function insert_task($name, $email, $text){
		$arr_insert = array(
			'user_name' => $name,
			'user_email' => $email,
			'text' => $text,
		);
		return $this->db->insert("task", $arr_insert);
	}

	public function update_task($id, $update_vars){
		return $this->db->update("task", $update_vars, "id=".$id);
	}

	public function modifyToView(&$task){
		$task->user_name = htmlspecialchars($task->user_name);
		$task->text = nl2br(htmlspecialchars($task->text));
	}

	public function getTasks($where = '', $order = '', $limit = '', $offset = ''){
		$rows = $this->db->select("*", "task", $where, $order, $limit, $offset);
		$tasks = array();
		foreach($rows as $row){
			$this->modifyToView($row);
			$tasks[] = $row;
		}
		return $tasks;
	}

	public function getAllQuantity(){
		return $this->db->selectCount("task");
	}

	public function getTask($id){
		$task = $this->db->selectRow("*", "task", array('id' => $id));
		return $task;
	}


}