<h1>Вход для администратора</h1>

<?php if(@$error) { ?>
<div class='error'><?php echo $error; ?></div>
<?php } ?>

<form method="post" action="admin_login.php">
	<div id="task_form">	
	<div class="form_l">Логин:</div>
	<div class="form_r"><input type="text" id='login' name="login"></div>
	<div class="clear"></div>

	<div class="form_l">Пароль:</div>
	<div class="form_r"><input type="password" id='password' name="password"></div>
	<div class="clear"></div>


	<div class="form_submit">
		<input type="submit" value="Войти">
	</div>
</div>
</form>