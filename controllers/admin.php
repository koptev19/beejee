<?php


class Admin extends Controller {

	private $_admin_model = null;

	public function __construct(){
		parent::__construct();
		$this->_admin_model = $this->loadModel('AdminModel');
	}



	public function login_form(){
		$this->view('head');
		$this->view('admin_login');
		$this->view('foot');
	}

	public function login(){
		global $MessageModel;
		$login = trim($_POST['login']);
		$password = trim($_POST['password']);
		$error = '';
		if($login == '' || $password == ''){
			$error = 'Все поля должны быть заполнены';
		}
		else{
			$check = $this->_admin_model->checkLoginPassword($login, $password);
			if($check) {
				$this->_admin_model->remember();
			}
			else{
				$error = 'Логин и пароль не подходят';
			}
		}
		if($error) {
			$this->view('head');
			$this->view('admin_login', array('error' => $error));
			$this->view('foot');
		}
		else{
			$MessageModel->add('Вы успешно авторизовались');
			Header('Location: index.php');
		}
	}


	public function logout(){
		global $MessageModel;
		$this->_admin_model->forget();
		$MessageModel->add('Вы успешно вышли');
		Header('Location: index.php');
	}


}
