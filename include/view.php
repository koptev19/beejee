<?php


class View {

	public function load($view_name, $params = array()){
		$file_name = 'views/'.$view_name.".php";
		if(!file_exists($file_name)){
			die('View "'.$view_name.'" doesn`t exist');
		}
		if(is_array($params) && count($params) > 0) {
			foreach($params as $key => $value) {
				$$key = $value;
			}
		}
		if($view_name == 'head'){
			global $MessageModel;
			$system_messages = $MessageModel->getAll();
			$MessageModel->removeAll();
		}
		include $file_name;
	}

	private function _getModel($model_name){
		$file_name = 'models/'.$model_name.".php";
		if(!file_exists($file_name)){
			die('View "'.$view_name.'" doesn`t exist');
		}
		include_once $file_name;
		return new $model_name;
	}


}