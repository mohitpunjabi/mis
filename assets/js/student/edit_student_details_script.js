// $(document).ready(function() {
// 	$("#go_to_next").hide();
// });

function check_user()
{
	if(check_user())
	{
		alert('true');
		return true;
	}
	else
	{
		alert('false');
		return false;
	}
}

function form_validation()
{
	var stu_id = document.getElementsByName("stu_id")[0].value;
	//alert(stu_id);
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
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	//alert("success");
	    	//alert(xmlhttp.responseText);
	    	//td.innerHTML = xmlhttp.responseText;
			// if(xmlhttp.responseText == '')
			// {
			//  	//alert('User does not exist.');
			//  	//$("#go_to_next").hide();
			//  	return false;
			// }
			// else
			// {
			// 	//alert('user exist');
			// 	//$("#go_to_next").show();
			// 	return true;
			// }
	    }
  	}
  	
  	xmlhttp.open("POST",site_url("student/student_ajax/check_if_user_exists/"+stu_id),false);
	xmlhttp.send();
	if(xmlhttp.responseText == '')
	{
	 	alert('User does not exist.');
	 	//$("#go_to_next").hide();
	 	return false;
	}
	else
	{
		return true;
	}
}