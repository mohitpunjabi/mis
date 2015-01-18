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
	
	function get_departments()
	{
//		alert("Please Select departments.");
//		$("#courseLoad").show();
//		var course = document.getElementById("course").value;
//		if(course==""){
//			alert("Please Select course.");
//			return;
//		}
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("dept").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
//		alert (js_base_url()+"file_tracking/send_new_file_ajax/get_dept");
		xmlhttp.open("POST",js_site_url("file_tracking/send_new_file_ajax/get_dept"),true);
		xmlhttp.send();
		return false;
	}

	function display_send_notification ()
	{
		
		var file_sub = document.getElementById("file_sub").value;
		var rcvd_emp_id = document.getElementById("faculty_name").value;
		var remarks_rcvd = document.getElementById("remarks").value;
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				document.getElementById("send_notification").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
//		alert ("Hitesh");
		xmlhttp.open("POST", js_site_url("file_tracking/send_new_file/insert_file_basic_details/"+file_sub+"/"+rcvd_emp_id+"/"+remarks_rcvd),true);
		xmlhttp.send();
		return false;
	}
	function validate_track_num ()
	{	
		var file_id = document.getElementById("file_id").value;
		var track_no = document.getElementById("track_num").value;
		//alert (""+file_id+" "+ track_no);
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("send").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
//		alert ("Hitesh");
		xmlhttp.open("POST", js_site_url("file_tracking/receive_file_ajax/send_details/"+file_id+"/"+track_no),true);
		xmlhttp.send();
		return false;
	}
	
	function display_send_notification2 ()
	{
		var file_id = document.getElementById("file_id").value;
//		var track_no = document.getElementById("track_num").value;
//		var file_sub = document.getElementById("file_sub").value;
		var rcvd_emp_id = document.getElementById("faculty_name").value;
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("send_notification").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
//		alert ("Hitesh");
		xmlhttp.open("POST",js_site_url("file_tracking/send_new_file/insert_move_details/"+file_id+"/"+rcvd_emp_id),true);
		xmlhttp.send();
		return false;
	}
	
	function display_send_notification3 ()
	{
		var file_id = document.getElementById("file_id").value;
		//alert(file_id);
//		var track_no = document.getElementById("track_num").value;
//		var file_sub = document.getElementById("file_sub").value;
//		var rcvd_emp_id = document.getElementById("emp_id").value;
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("send_notification").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
//		alert ("Hitesh");
		xmlhttp.open("POST",js_site_url("file_tracking/close_file/insert_close_details/"+file_id),true);
		xmlhttp.send();
		return false;
	}
	
	function get_file_details ()
	{
		var file_id = document.getElementById("file_id").value;
		//alert ("hello");
		//alert ("hello"+file_id);
		if(file_id==""){
			alert("Please Select File ID.");
			return;
		}
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("file_details").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",js_site_url("file_tracking/send_running_file/get_file_details/"+file_id),true);
		xmlhttp.send();
		return false;

	}	
	function get_file_details ()
	{
		var file_id = document.getElementById("file_id").value;
		//alert ("hello");
		//alert ("hello"+file_id);
		if(file_id==""){
			alert("Please Select File ID.");
			return;
		}
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("file_details").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",js_site_url("file_tracking/send_running_file/get_file_details/"+file_id),true);
		xmlhttp.send();
		return false;

	}	
	function get_close_file_details ()
	{
		var file_id = document.getElementById("file_id").value;
		//alert ("hello");
		//alert ("hello"+file_id);
		if(file_id==""){
			alert("Please Select File ID.");
			return;
		}
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("file_details").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",js_site_url("file_tracking/close_file/get_file_details/"+file_id),true);
		xmlhttp.send();
		return false;

	}
	function get_file_move_details ()
	{
		var track_num = document.getElementById("track_num").value;
		//alert ("hello");
		//alert ("hello"+file_id);
		if(track_num==""){
			alert("Please Enter Track Number.");
			return;
		}
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("move_details").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",js_site_url("file_tracking/track_file/validate_track_num/"+track_num),true);
		xmlhttp.send();
		return false;

	}
	function get_file_move_details2(track_num)
	{
		//var track_num = document.getElementById("track_num").value;
		//alert ("hello");
		//alert ("hello"+file_id);
		if(track_num==""){
			alert("Please Enter Track Number.");
			return;
		}
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("move_details").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",js_site_url("file_tracking/track_file/validate_track_num/"+track_num),true);
		xmlhttp.send();
		return false;

	}
	function get_faculty_name(department_id){
		if(department_id == ''){
			return false;
		}
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status==200){
				document.getElementById("faculty_name").innerHTML = xmlhttp.responseText;
			}

		}
		xmlhttp.open("POST",js_site_url("file_tracking/send_new_file_ajax/get_faculty_name_by_department_id/"+department_id),true);
		xmlhttp.send();
	}
	function match_track_number(){

		var track_num = document.getElementById("track_num").value;
		if(track_num==""){
			alert("Please Enter Track Number.");
			return;
		}
		var xmlhttp = getxmlhttp();
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				//alert("success");
				document.getElementById("send_files").innerHTML = xmlhttp.responseText;
				//$(".loading").hide();
			}
		}
		xmlhttp.open("POST",js_site_url("file_tracking/track_file/validate_track_number/"+track_num),true);
		xmlhttp.send();
		return false;
	}