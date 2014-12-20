
	function onclick_emp_id()
	{
		document.getElementById('search_eid').style.display="table-row";
	}

	function onclick_empname()
	{
		var tr=document.getElementById('employee');
		var dept=document.getElementById('emp_dept').value;
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
			    tr.innerHTML=xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("GET","AJAX_emp_name_by_dept.php?dept="+dept,true);
		xmlhttp.send();
		tr.innerHTML = "<th>Employee name</th><td><i class=\"loading\"></i></td>";
	}

	function onclick_emp_nameid()
	{
		var emp_name_id=document.getElementById('emp_name_id').value;
		document.getElementById('emp_id').value=emp_name_id;
	}