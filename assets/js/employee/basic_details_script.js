
	function teaching_handler(auth)
	{
		designation_dropdown(auth);
		retirement_handler();
		if(auth =='ft')
		{
			document.getElementById('res_int_id').disabled=false;
			document.getElementById('res_int_id').value="";
		}
		else
			document.getElementById('res_int_id').disabled=true;

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
			    document.getElementById("depts").innerHTML=xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",js_site_url("ajax/department/"+auth),true);
		xmlhttp.send();
		document.getElementById("depts").innerHTML="<option selected=\"selected\">Loading...</option>";
	}

	function payband_handler(pb)
	{
		var gp = document.getElementsByName("gradepay")[0];
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
			    gp.innerHTML=xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("POST",js_site_url("ajax/grade_pay/"+pb),true);
		xmlhttp.send();
		gp.innerHTML="<option selected=\"selected\">Loading...</option>";
		gp.style.visibility = "visible";
		document.getElementById('basicpay').style.visibility='visible';
	}

	function retirement_handler()
	{
		var retire = document.getElementById("retire");
		var auth = document.getElementsByName("tstatus")[0].value;
		var source=document.getElementsByName("dob")[0].value;
		var new_date=new Date(source);

		if(auth=="ft")
			new_date.setFullYear(new_date.getFullYear() + 65);
		else if(auth=="nfta")
			new_date.setFullYear(new_date.getFullYear() + 62);
		else if(auth=="nftn")
			new_date.setFullYear(new_date.getFullYear() + 60);

		//change suggested for 1st day of month dob
		if(new_date.getDate()==1)
		{
			if(new_date.getMonth()==0)
			{
				new_date.setMonth(11);
				new_date.setFullYear(new_date.getFullYear() - 1);
			}
			else
			{
				new_date.setMonth(new_date.getMonth()-1);
			}
		}

		var month=new_date.getMonth();
		var year=new_date.getFullYear();

		if(month==0 || month==2 || month==4 || month==6 || month==7 || month==9 || month==11)
			new_date.setDate(31);
		else if(month!=1)
			new_date.setDate(30);
		else
		{
			if(year%4==0 && year%100!=0)
				new_date.setDate(29);
			else
				new_date.setDate(28);
		}

		var date='';
		if(new_date.getDate()<10)	date='0'+new_date.getDate();
		else	date+=new_date.getDate();

		month+=1;
		var mon='';
		if(month<10)	mon='0'+month;
		else	mon+=month;

		retire.value=new_date.getFullYear()+'-'+mon+'-'+date;
	}

//AJAX for designation called from teaching_handler
	function designation_dropdown(auth)
	{
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
			    document.getElementById("des").innerHTML=xmlhttp.responseText;
		    	}
	  	}
		xmlhttp.open("POST",js_site_url("ajax/designation/"+auth),true);
		xmlhttp.send();
		document.getElementById("des").innerHTML="<option selected=\"selected\">Loading...</option>";
	}

	function preview_pic()
	{
		var file=document.getElementById('photo').files[0];
		if(!file)
			document.getElementById('view_photo').src =  js_base_url()+"assets/images/employee/noProfileImage.png";
      	else
		{
			oFReader = new FileReader();
        	oFReader.onload = function(oFREvent)
			{
				var dataURI = oFREvent.target.result;
				document.getElementById('view_photo').src = dataURI;
			};
			oFReader.readAsDataURL(file);
		}
	}

	function image_validation()
	{
		var file=document.getElementById('photo').files[0];
		var ext=file.name.substring(file.name.lastIndexOf('.') + 1);
		if(ext == "bmp" || ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg" )
		{
			if(file.size>204800)
			{
				alert('The file size must be less than 200KB');
				return false;
			}
			else
				return true;
		}
		else
		{
			alert('The image should be in bmp, gif, png, jpg or jpeg format.');
			return false;
		}
	}

	function fetch_details()
	{
		var emp_id = document.getElementsByName("emp_id")[0].value;
		$("#fetch_id_btn").hide();
		$("#empIdIcon").show();
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
				if(xmlhttp.responseText != "") {
					var details = eval(xmlhttp.responseText);
					$("select[name=salutation]").val(details['salutation']);
					$("input[name=firstname]").val(details['first_name']);
					$("input[name=middlename]").val(details['middle_name']);
					$("input[name=lastname]").val(details['last_name']);
					$("select[name=tstatus]").val('ft');
					$("input[name=research_int]").val(details['research_int']);
					$("select[name=category]").val(details['category']);
					$("input[name=mobile]").val(details['ph_no']);
				}
				else {
					$("select[name=salutation]").val("Dr");
					$("input[name=firstname]").val("");
					$("input[name=middlename]").val("");
					$("input[name=lastname]").val("");
					$("select[name=tstatus]").val('ft');
					$("input[name=research_int]").val("");
					$("select[name=category]").val("");
					$("input[name=mobile]").val("");
				}
				$("td, th").css("visibility", "visible");
				$("#fetch_id_btn").hide();
				$("#empIdIcon").hide();
		    }
	  	}
		xmlhttp.open("POST",js_site_url("employee/emp_ajax/feedback_emp_detail/"+emp_id),true);
		xmlhttp.send();
	}

	$(document).ready(function() {
		$("td, th").css("visibility", "hidden");
		$("td#empId").css("visibility", "visible");
		$("#empIdIcon").hide();
	});

