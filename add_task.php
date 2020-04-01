<?php

include_once "include/include.php";
include_once "controllers/task.php";

$Task = new Task();

if(isset($_POST['name'])){
	$Task->save_new_task();
}
else{
	$Task->add_task();
}

