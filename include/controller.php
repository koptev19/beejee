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

	protected function &loadModel($model_name){
		return Model::getModel($model_name);
	}

	public function view($view_name, $params = array())
	{
		$this->view->load($view_name, $params);
	}

}