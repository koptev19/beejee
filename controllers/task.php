<?php


class Task extends Controller {

	private $_task_model = null;

	public function __construct(){
		parent::__construct();
		$this->_task_model = $this->loadModel('TaskModel');
	}

	public function tasks(){
		$order = isset($_SESSION["order"]) ? $_SESSION["order"] : 'crtime desc';
		$active_order = array();
		if(isset($_SESSION["order_field"])) {
			$active_order['field'] = $_SESSION["order_field"];
			$active_order['asc'] = $_SESSION["order_asc"];
		} 
		else{
			$active_order['field'] = 'crtime';
			$active_order['asc'] = 0;
		}
		if(isset($_GET['order'])) {
			$order_asc = isset($_GET['order_asc']) && $_GET['order_asc'] ? "asc" : "desc";
			$active_order = array('field' => $_GET['order'], 'asc' => $order_asc == 'asc' ? 1 : 0);
			if($_GET['order'] == 'name'){
				$order = 'user_name '.$order_asc;
			}
			if($_GET['order'] == 'email'){
				$order = 'user_email '.$order_asc;
			}
			if($_GET['order'] == 'status'){
				$order = 'status '.$order_asc;
			}
		}
		$_SESSION["order"] = $order;
		$_SESSION["order_field"] = $active_order['field'];
		$_SESSION["order_asc"] = $active_order['asc'];

		$allQuantityTasks = $this->_task_model->getAllQuantity();
		$pages = ceil($allQuantityTasks / QUANTITY_TASKS);
		$active_page = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION["active_page"]) ? $_SESSION["active_page"] : 1);
		$active_page = max($active_page, 1);
		$active_page = min($active_page, $pages);
		$_SESSION["active_page"] = $active_page;
		
		$where = array();
		$limit = QUANTITY_TASKS;
		$offset = ($active_page - 1) * QUANTITY_TASKS;
		$tasks = $this->_task_model->getTasks($where, $order, $limit, $offset);

		$AdminModel = $this->loadModel("AdminModel");
		$is_admin_login = $AdminModel->is_login();

		$this->view('head');
		$this->view('tasks', array('tasks' => $tasks, 'pages' => $pages, 'active_page' => $active_page, 'active_order' => $active_order, 'is_admin_login' => $is_admin_login));
		$this->view('foot');
	}

	public function add_task(){
		$this->view('head');
		$this->view('task_add');
		$this->view('foot');
	}

	public function save_new_task(){
		global $MessageModel;
		$name = trim($_POST['name']);
		$email = trim($_POST['email']);
		$text = trim($_POST['text']);
		$error = '';
		if($name == '' || $email == '' || $text == ''){
			$error = 'Все поля должны быть заполнены';
		}
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = 'E-mail указан не верно';
		}
		if(!$error) {
			$result = $this->_task_model->insert_task($name, $email, $text);
			if($result) {
				$MessageModel->add('Задача успешно добавлена');
				Header("Location: index.php");
				return;
			}
			else{
				$error = 'Произошла ошибка базы данных при добавлении задачи';
			}
		}
		$this->view('head');
		$this->view('task_add', array('name' => $name, 'email' => $email, 'text' => $text, 'error' => $error));
		$this->view('foot');
	}


	public function edit_task(){
		$AdminModel = $this->loadModel("AdminModel");
		if(!$AdminModel->is_login()){
			Header('Location: index.php');
			return;
		}
		$id = intval($_GET['id']);
		$task = $this->_task_model->getTask($id);
		$this->view('head');
		$this->view('task_edit', array('id' => $id, 'user_name' => $task->user_name, 'user_email' => $task->user_email, 'text' => $task->text, 'status' => $task->status));
		$this->view('foot');
	}

	public function save_edit_task(){
		global $MessageModel;
		$AdminModel = $this->loadModel("AdminModel");
		if(!$AdminModel->is_login()){
			Header('Location: index.php');
			return;
		}
		$id = intval($_GET['id']);
		$text = trim($_POST['text']);
		$done = isset($_POST['done']) && $_POST['done'] ? true : false;
		$error = '';
		if($text == ''){
			$error = 'Все поля должны быть заполнены';
		}
		if(!$error) {
			$update_vars = array(
			);
			$task = $this->_task_model->getTask($id);
			if($task->status == TASK_STATUS_NEW && $done){
				$status = TASK_STATUS_DONE;
				$update_vars['status'] = $status;
			}
			if($task->text != $text){
				$update_vars['text'] = $text;
				$update_vars['admin_moderation'] = ADMIN_MODERATION_YES;
			}
			if(count($update_vars) > 0) {
				$result = $this->_task_model->update_task($id, $update_vars);
				if($result) {
					$MessageModel->add('Задача успешно обновлена');
					Header("Location: index.php");
					return;
				}
				else{
					$error = 'Произошла ошибка базы данных при обновлении задачи';
				}
			}
			else{
				$MessageModel->add('Вы не сделали никаких изменений');
				Header("Location: index.php");
				return;
			}
		}
		$this->view('head');
		$this->view('task_edit', array('id' => $id, 'user_name' => $name, 'user_email' => $email, 'text' => $text, 'status' => $status, 'error' => $error));
		$this->view('foot');
	}


}