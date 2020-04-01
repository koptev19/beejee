<?php


class MessageModel extends Model {

	public function add($message){
		$messages = $this->getAll();
		$messages[] = $message;
		$this->save($messages);
	}

	public function getAll(){
		return isset($_SESSION["messages"]) ? $_SESSION["messages"] : array();
	}

	public function save($messages){
		$_SESSION["messages"] = $messages;
	}

	public function removeAll(){
		$_SESSION["messages"] = array();
	}


}