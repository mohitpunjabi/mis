	function getxmlhttp()
	{
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	    }
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		return xmlhttp;
	}
	
	function get_departments(type)
	{
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("department_name").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",site_url("file_tracking/send_new_file_ajax/get_dept/"+type),true);
		xmlhttp.send();
		return false;
	}

	function get_designation_name(dept_id)
	{
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("designation").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",site_url("file_tracking/send_new_file_ajax/get_designation/"+dept_id),true);
		xmlhttp.send();
		return false;
	}
	
	function get_emp_name(designation)
	{
		var dept_id = document.getElementById("department_name").value; 
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("emp_name").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",site_url("file_tracking/send_new_file_ajax/get_emp_name/"+designation+"/"+dept_id),true);
		xmlhttp.send();
		return false;		
	}
	
	function validate_track_num ()
	{
		var file_id = document.getElementById("file_id").value;
		var track_no = document.getElementById("track_num").value;
		var xmlhttp = getxmlhttp();
		if(track_no==""){
			alert("Please Enter Track Number.");
			return;
		}
		if (isNaN(track_no))
		{
			alert ("Please Enter digits only!!");
			return;
		}		
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("send").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST", site_url("file_tracking/receive_file_ajax/send_details/"+file_id+"/"+track_no),true);
		xmlhttp.send();
		return false;
	}
			
	function get_file_details ()
	{
		var file_id = document.getElementById("file_id").value;
		if(file_id==""){
			alert("Please Select File ID.");
			return;
		}
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("file_details").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",site_url("file_tracking/send_running_file/get_file_details/"+file_id),true);
		xmlhttp.send();
		return false;
	}	

	function get_file_move_details_by_track_num ()
	{
		var track_num = document.getElementById("track_num").value;
		if(track_num==""){
			alert("Please Enter Track Number.");
			return;
		}
		if (isNaN(track_num))
		{
			alert ("Please Enter digits only!!");
			return;
		}		
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("move_details_by_track_num").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",site_url("file_tracking/track_file/validate_track_num/"+track_num),true);
		xmlhttp.send();
		return false;
	}

	function get_file_move_details_of_sent_files(track_num)
	{
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("move_details_of_sent_files").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",site_url("file_tracking/track_file/validate_track_num/"+track_num),true);
		xmlhttp.send();
		return false;
	}	