<?php


class Model {

	protected $db;

	private static $_models = [];

	public function __construct(){
		global $DB;
		$this->db = &$DB;
	}

	public static function &getModel($model_name){
		if(!isset(self::$_models[$model_name])){
			self::$_models[$model_name] = self::_createNewModel($model_name);
		}
		return self::$_models[$model_name];
	}

	private static function &_createNewModel($model_name){
		$filename = "models/".$model_name.".php";
		if(!file_exists($filename)){
			die('Model "'.$model_name.'" doesn`t exist');
		}
		include_once $filename;
		return new $model_name;
	}

}