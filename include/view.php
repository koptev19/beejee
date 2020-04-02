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
		$AdminModel = $this->_getModel('AdminModel');
		$is_admin_login = $AdminModel->is_login();
		include $file_name;
	}

	private function &_getModel($model_name){
		return Model::getModel($model_name);
	}


}