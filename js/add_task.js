function validate_email(email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   return reg.test(email) 
}


function addTaskGo() {
	var err = '';
	if($('#task_name').val() == '' || $('#task_email').val() == '' || $('#task_text').val() == '') {
		err = "Все поля должны быть заполнены";
	}
	else {
		if(!validate_email($('#task_email').val())) {
			err = 'Вы ввели некорректный email';
		}
	}
	if(err) {
		alert(err);
	}
	else{
		$('#form_add_task').submit();
	}
}