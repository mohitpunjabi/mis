$(document).ready(function() {
	
	$('#form_submit').on('submit', function(e) {
		if(!form_validation())
			e.preventDefault();
	});

});

function send_data_to_validate(student_id)
{
	document.getElementsByName("stu_id")[0].value = student_id;
	document.getElementById("form_submit").submit();
}

function form_validation()
{
	var stu_id = document.getElementsByName("stu_id")[0].value;
	if(stu_id.trim() == '')
	{
		alert('Please fill valid details in the field');
		return false;
	}
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	}
	xmlhttp.open("POST",site_url("student/student_ajax/check_if_user_for_validation_exists/"+stu_id),false);
	xmlhttp.send();

	if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			if(xmlhttp.responseText != '')
			{
			 	return true;
			}
			else
			{
				alert('No such users details for Validation.');
				return false
			}
		}
}