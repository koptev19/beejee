<?php


class Controller {

	private $_view;

	public function __construct(){
		$this->view = $this->_loadViewer();
	}

	private function _loadViewer()
	{
		return new View();
	}

	protected function loadModel($model_name){
		$filename = "models/".$model_name.".php";
		if(!file_exists($filename)){
			die('Model "'.$model_name.'" doesn`t exist');
		}
		include_once $filename;
		return new $model_name;
	}

	public function view($view_name, $params = array())
	{
		$this->view->load($view_name, $params);
	}

}