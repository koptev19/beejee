<?php

include_once "include/include.php";
include_once "controllers/task.php";

$Task = new Task();

if(isset($_POST['text'])){
	$Task->save_edit_task();
}
else{
	$Task->edit_task();
}

