<h1>Все задачи</h1>

<table cellpadding=5 cellspacing=1 class='table'>
<thead>
<tr>
	<th>
		Пользователь 
		<a href="?order=name&order_asc=1" class='orderasc <?php if ($active_order['field'] == 'name' && $active_order['asc']) echo "active"; ?>'><img src='images/asc.png'></a> 
		<a href="?order=name&order_asc=0" class='orderdesc <?php if ($active_order['field'] == 'name' && !$active_order['asc']) echo "active"; ?>'><img src='images/desc.png'></a>
	</th>
	<th>
		E-mail 
		<a href="?order=email&order_asc=1" class='orderasc <?php if ($active_order['field'] == 'email' && $active_order['asc']) echo "active"; ?>'><img src='images/asc.png'></a> 
		<a href="?order=email&order_asc=0" class='orderdesc <?php if ($active_order['field'] == 'email' && !$active_order['asc']) echo "active"; ?>'><img src='images/desc.png'></a>
	</th>
	<th class='task_text'>Текст задачи</th>
	<th>
		Статус 
		<a href="?order=status&order_asc=1" class='orderasc <?php if ($active_order['field'] == 'status' && $active_order['asc']) echo "active"; ?>'><img src='images/asc.png'></a> 
		<a href="?order=status&order_asc=0" class='orderdesc <?php if ($active_order['field'] == 'status' && !$active_order['asc']) echo "active"; ?>'><img src='images/desc.png'></a>
	</th>
	<?php if ($is_admin_login) { ?>
		<th>Действия</th>
	<?php } ?>
</tr>
</thead>
<?php 
global $TASK_STATUSES;
foreach($tasks as $task) { ?>
<tr>
	<td><?php echo $task->user_name; ?></td>
	<td><a href="mailto:<?php echo $task->user_email; ?>"><?php echo $task->user_email; ?></a></td>
	<td><?php echo $task->text; ?></td>
	<td>
		<?php echo $TASK_STATUSES[$task->status]; ?>
		<?php if ($task->admin_moderation == ADMIN_MODERATION_YES) { ?>
			<br><br>Отредактировано<br>администратором
		<?php } ?>
	</td>
	<?php if ($is_admin_login) { ?>
		<td><a href="task_edit.php?id=<?php echo $task->id; ?>">Редактировать</a></td>
	<?php } ?>
</tr>
<?php } ?>
</table>

<br><br>
<div class='pagination'>
	<?php if ($active_page > 1) {?>
		<a href="?page=<?php echo $active_page-1; ?>">&lt; &lt;Предыдущая</a>
	<?php } ?>

	<?php for($p = 1; $p <= $pages; $p++){ ?>
		<?php if ($p == $active_page){ ?>
			<span><?php echo $p; ?></span>
		<?php } else { ?>
			<a href="?page=<?php echo $p; ?>"><?php echo $p; ?></a>
		<?php } ?>
	<?php } ?>

	<?php if ($active_page < $pages) {?>
		<a href="?page=<?php echo $active_page+1; ?>">Следующая &gt;&gt;</a>
	<?php } ?>
</div>