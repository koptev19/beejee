<?php

include_once "include/include.php";
include_once "controllers/admin.php";

$Admin = new Admin();


if(isset($_POST['login'])){
	$Admin->login();
}
else{
	$Admin->login_form();
}


