<?php


class AdminModel extends Model {

	public function checkLoginPassword($login, $password){
		return $login == ADMIN_LOGIN && $password == ADMIN_PASSWORD;
	}

	public function remember(){
		$_SESSION["admin_login"] = true;
	}

	public function is_login(){
		return isset($_SESSION["admin_login"]) && $_SESSION["admin_login"];
	}

	public function forget(){
		$_SESSION["admin_login"] = false;
	}


}