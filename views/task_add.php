<h1>Добавление новой задачи</h1>

<script src="js/add_task.js"></script>

<?php if(@$error) { ?>
<div class='error'><?php echo $error; ?></div>
<?php } ?>

<form method="post" action="add_task.php" id='form_add_task'>
	<div id="task_form">	
	<div class="form_l">Пользователь *:</div>
	<div class="form_r"><input type="text" id='task_name' name="name" value='<?php echo addslashes(@$name); ?>'></div>
	<div class="clear"></div>

	<div class="form_l">E-mail *:</div>
	<div class="form_r"><input type="text" id='task_email' name="email" value='<?php echo @$email; ?>'></div>
	<div class="clear"></div>

	<div class="form_l">Текст задачи *:</div>
	<div class="form_r"><textarea name="text" id='task_text'><?php echo htmlspecialchars(@$text); ?></textarea></div>
	<div class="clear"></div>


	<div class="form_submit">
		<input type="button" value="Добавить" onclick="addTaskGo(); return false;">
	</div>
</div>
</form>