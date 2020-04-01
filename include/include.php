<?php

include "include/config.php";
include "include/db_config.php";
include "include/db.php";

$DB = new DB(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

include "include/model.php";
include "include/controller.php";
include "include/view.php";


session_start();

include "models/MessageModel.php";
$MessageModel = new MessageModel();
