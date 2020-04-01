<?php
$AdminModel = $this->_getModel('AdminModel');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BeeJee</title>


    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
<meta name="theme-color" content="#563d7c">


   <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
	<script src="js/jquery-3.3.1.min.js"></script>
  </head>
  <body>
    <div class="container">

  <header class="masthead mb-auto">
    <div class="inner">
      <nav class="nav nav-masthead justify-content-center">
	  

		<a href="index.php" class="nav-link">Все задачи</a>
		<a href="add_task.php" class="nav-link">Добавить задачу</a>
		<?php if($AdminModel->is_login()){ ?>
			<a href="admin_logout.php" class="nav-link">Выход из администрирования</a>
		<?php } else { ?>
			<a href="admin_login.php" class="nav-link">Вход администратора</a>
		<?php }  ?>
	</ul>
      </nav>
    </div>
  </header>



<main role="main" class="container">
<?php if(isset($system_messages) && is_array($system_messages) && count($system_messages) > 0) { ?>
	<?php foreach($system_messages as $message) { ?>
		<div class='system_message'><?php echo $message;?></div>
	<?php }?>
<?php }?>


