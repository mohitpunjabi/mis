	function preview_pic()
	{
		var file=document.getElementById('photo').files[0];
		if(!file)
			document.getElementById('view_photo').src =  js_base_url()+"assets/images/student/noProfileImage.png";
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

	function form_validation()
	{
		var pgv = parent_gaurdian_validation();
		var abov = admission_based_on_validation();
		var cb = course_branch_validation();
		var cav = correspondence_addr_validation();
		var iv = image_validation();
		return pgv && abov && cb && cav && iv;
	}

	function correspondence_addr_validation()
	{
		var ca=document.getElementById("correspondence_addr").checked;
		if(ca)
			return true;
		else
		{
			var line1 = document.getElementById("line13").value;
			var line2 = document.getElementById("line23").value;
			var city = document.getElementById("city3").value;
			var state = document.getElementById("state3").value;
			var pincode = document.getElementById("pincode3").value;
			var country = document.getElementById("country3").value;
			var contact = document.getElementById("contact3").value;
			if(line1 == '' || line2 == '' || city =='' || state == ''|| pincode == ''|| country == ''|| contact == '')
			{
				alert("Please fill all the fields of correspondence address.")
				return false;
			}
			else
				return true;
		}
	}

	function course_branch_validation()
	{
		var course = document.getElementById("course_id").value;
		var branch = document.getElementById("branch_id").value;
		if(branch == "none" || course == "none")
		{
				alert("Branch or Course not selected or exists.")
				return false;
		}
		else
			return true;
	}

	function parent_gaurdian_validation()
	{
		var dpe = document.getElementById("depends_on").checked;
		/*if(dpe)
		{
			if(m == '' && f == '' && g != '' && r != '' && fo == '' && mo == '' && fgai == '' && mgai == '')
				return true;
			else
				return false;
		}
		else
		{
			if(m != '' && f != '' && g == '' && r == '' && fo != '' && mo != '' && fgai != '' && mgai != '')
				return true;
			else
				return false;
		}*/
		if(!dpe)
		{
			var m=document.getElementById("mother_name").value;
			var f= document.getElementById("father_name").value;
			var fo=document.getElementById("father_occupation").value;
			var mo=document.getElementById("mother_occupation").value;
			var fgai=document.getElementById("father_gross_income").value;
			var mgai=document.getElementById("mother_gross_income").value;
			if(m == '' || f == '' || fo == '' || mo == '' || fgai == '' || mgai == '')
			{
				alert("Please fill all details of parents.")
				return false;
			}
			else
				return true;
		}
		else
		{
			var g=document.getElementById("guardian_name").value;
			var r=document.getElementById("guardian_relation_name").value;
			if(g == '' || r == '')
			{
				alert("Please fill all details of guardian.")
				return false;
			}
			else
				return true;
		}
	}

	function admission_based_on_validation()
	{
		var admission_based_on = document.getElementById("id_admn_based_on").value;
		if(admission_based_on == 'iitjee')
		{
			var iitjee_rank = document.getElementById('iitjee_rank').value;
			var iitjee_cat_rank = document.getElementById('iitjee_cat_rank').value;
			if((iitjee_cat_rank == 0 || iitjee_cat_rank == '') && (iitjee_rank == 0 || iitjee_rank == ''))
			{
				alert("Please fill the IIT-JEE rank or the category rank.")
				return false;
			}
			else
				return true;
		}
		else if(admission_based_on == 'gate')
		{
			var gate_score = document.getElementById('gate_score').value;
			if(gate_score == '' || gate_score == 0)
			{
				alert("Please fill the gate score.")
				return false;
			}
			else
				return true;
		}
		else if(admission_based_on == 'cat')
		{
			var cat_score = document.getElementById('cat_score').value;
			if(cat_score ==0 || cat_score == '')
			{
				alert("Please fill the cat score.")
				return false;
			}
			else
				return true;
		}
		else if(admission_based_on == 'others')
		{
			var other_mode_of_admission = document.getElementById('other_mode_of_admission').value;
			if(other_mode_of_admission == '')
			{
				alert("Please fill the other mode of admission.")
				return false;
			}
			else
				return true;
		}
		return true;
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

	
	function corrAddr()
    {
        var x=document.getElementById("corr_addr");
        var y=document.getElementById("correspondence_addr");
        if(!y.checked)
        {
            x.style.display='block';
            //document.getElementById("line13").='true';
        }
        else
        {
            x.style.display='none';
        }
	}
	
	function depends_on_whom()
	{
		var dpe = document.getElementById("depends_on").checked;
//var dpe_relation = document.getElementById("depends_on_relation").checked;

		var m=document.getElementById("mother_name");
		var f= document.getElementById("father_name");
		var g=document.getElementById("guardian_name");
		var r=document.getElementById("guardian_relation_name");
		var fo=document.getElementById("father_occupation");
		var mo=document.getElementById("mother_occupation");
		var fgai=document.getElementById("father_gross_income");
		var mgai=document.getElementById("mother_gross_income");

		if(dpe)
		{
			m.disabled=true;
			f.disabled=true;
			g.disabled=false;
			r.disabled=false;
			fo.disabled=true;
			mo.disabled=true;
			fgai.disabled=true;
			mgai.disabled=true;
		}
		else
		{
			m.disabled=false;
			f.disabled=false;
			g.disabled=true;
			r.disabled=true;
			fo.disabled=false;
			mo.disabled=false;
			fgai.disabled=false;
			mgai.disabled=false;
		}
		
	}
	
	/*function depends_on_iitjee()
	{
		var dpe_iitjee = document.getElementById("depends_on_iit").checked;
		var g=document.getElementById("iitjee_rank");
		var h=document.getElementById("iitjee_cat_rank");
		if(dpe_iitjee)
		{
			g.disabled=false;
			h.disabled=false;
						
		}
		else
		{
			g.disabled=true;
			h.disabled=true;
		}
		
	}

	
	function depends_on_cat()
	{
		var dpe_cat = document.getElementById("depends_on_cat_score").checked;
		var g=document.getElementById("cat_score");
		if(dpe_cat)
		{
			g.disabled=false;
						
		}
		else
		{
			g.disabled=true;
		}
		
	}
	
	function depends_on_gate()
	{
		var dpe_gate = document.getElementById("depends_on_gate_score").checked;
		var g=document.getElementById("gate_score");
		if(dpe_gate)
		{
			g.disabled=false;
						
		}
		else
		{
			g.disabled=true;
		}
		
	}*/

	function select_exam_scores()
	{
		var admission_based_on = document.getElementById('id_admn_based_on').value;
		var iitjee_rank = document.getElementById('iitjee_rank');
		var iitjee_cat_rank = document.getElementById('iitjee_cat_rank');
		var gate_score = document.getElementById('gate_score');
		var cat_score = document.getElementById('cat_score');
		var other_mode_of_admission = document.getElementById('other_mode_of_admission');
		if(admission_based_on == 'iitjee')
		{
			iitjee_rank.disabled = false;
			iitjee_cat_rank.disabled = false;
			gate_score.disabled = true;
			cat_score.disabled = true;
			other_mode_of_admission.disabled = true;
		}
		else if(admission_based_on == 'gate')
		{
			iitjee_rank.disabled = true;
			iitjee_cat_rank.disabled = true;
			gate_score.disabled = false;
			cat_score.disabled = true;
			other_mode_of_admission.disabled = true;
		}
		else if(admission_based_on == 'cat')
		{
			iitjee_rank.disabled = true;
			iitjee_cat_rank.disabled = true;
			gate_score.disabled = true;
			cat_score.disabled = false;
			other_mode_of_admission.disabled = true;
		}
		else if(admission_based_on == 'others')
		{
			other_mode_of_admission.disabled = false;
			iitjee_rank.disabled = true;
			iitjee_cat_rank.disabled = true;
			gate_score.disabled = true;
			cat_score.disabled = true;
		}
		else
		{
			other_mode_of_admission.disabled = true;
			iitjee_rank.disabled = true;
			iitjee_cat_rank.disabled = true;
			gate_score.disabled = true;
			cat_score.disabled = true;
		}
	}

    function options_of_branches()
    {
    	//alert("hi");
        var tr=document.getElementById('branch_id');
        var course=document.getElementById('course_id').value;
//        var tr=document.getElementById('branch_div');
        var dept=document.getElementById('depts').value;
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
            	//alert ("success");
                tr.innerHTML=xmlhttp.responseText;
            }
        }
        //xmlhttp.open("GET","AJAX_branches_by_dept.php?dept="+dept,true); this is original line to select branch we need to select courses
		xmlhttp.open("POST",site_url("student/student_ajax/update_branch/"+course+"/"+dept),true);
        xmlhttp.send();
        tr.innerHTML="<option selected=\"selected\">Loading...</option>";
    }

    function options_of_courses()
    {
        //set_id_of_branch();
        //alert('reached course');
        var tr=document.getElementById('course_id');
        var dept=document.getElementById('depts').value;
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
            	//alert('success');
                tr.innerHTML=xmlhttp.responseText;
                options_of_branches();
            }
        }
        //alert(branch);
        xmlhttp.open("POST",site_url("student/student_ajax/update_courses/"+dept),true);
        xmlhttp.send();
        tr.innerHTML="<option selected=\"selected\">Loading...</option>";
    }

    /*function set_id_of_branch()
    {
        var branch_id=document.getElementById('branch_id').value;
        document.getElementById('id_of_branch').value=branch_id;
        return 0;
    }

    function set_id_of_course()
    {
        var course_id=document.getElementById('course_id').value;
        document.getElementById('id_of_course').value=course_id;
    }*/
