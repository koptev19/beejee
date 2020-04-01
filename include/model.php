<?php


class Model {

	protected $db;

	public function __construct(){
		global $DB;
		$this->db = &$DB;
	}
}