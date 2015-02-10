function ajax(query_by)
{
	document.getElementById('display_employee').style.display="auto";
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
	    	$("#display_employee").hideLoading();
			document.getElementById("display_employee").innerHTML = xmlhttp.responseText;
	    }
  	}
	xmlhttp.open("POST",site_url("employee/emp_ajax/getEmpBy"+query_by+"/"+document.getElementById('query').value),true);
	xmlhttp.send();
	$("#display_employee").showLoading();
}