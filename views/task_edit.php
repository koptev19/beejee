<h1>Редактирование задачи</h1>

<?php if(@$error) { ?>
<div class='error'><?php echo $error; ?></div>
<?php } ?>

<form method="post" action="task_edit.php?id=<?php echo $id; ?>" id='form_edit_task'>
	<div id="task_form">	
	<div class="form_l">Пользователь *:</div>
	<div class="form_r"><?php echo addslashes(@$user_name); ?></div>
	<div class="clear"></div>

	<div class="form_l">E-mail *:</div>
	<div class="form_r"><?php echo @$user_email; ?></div>
	<div class="clear"></div>

	<div class="form_l">Текст задачи *:</div>
	<div class="form_r"><textarea name="text" id='task_text'><?php echo htmlspecialchars(@$text); ?></textarea></div>
	<div class="clear"></div>

	<?php if($status == TASK_STATUS_NEW) { ?>
		<label><input type="checkbox" name="done" value='1'> Отметить как выполненную</label>
	<?php } else { ?>
		Задача помечена как выполненная
	<?php }  ?>

	<br><br>
	<div class="form_submit">
		<input type="submit" value="Сохранить">
	</div>
</div>
</form>