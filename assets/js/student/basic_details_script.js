	function preview_pic()
	{
		var file=document.getElementById('photo').files[0];
		if(!file)
			document.getElementById('view_photo').src =  "Images/noProfileImage.png";
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

		if(dpe)
		{
			g.disabled=false;
			r.disabled=false;
			m.disabled=true;
			f.disabled=true;
		}
		else
		{
			m.disabled=false;
			f.disabled=false;
			g.disabled=true;
			r.disabled=true;
		}
		
	}
	
	function depends_on_iitjee()
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
		
	}

    function options_of_courses()
	//function options_of_branches()
    {
        var tr=document.getElementById('course');
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
                tr.innerHTML=xmlhttp.responseText;
            }
        }
        //xmlhttp.open("GET","AJAX_branches_by_dept.php?dept="+dept,true); this is original line to select branch we need to select courses
		xmlhttp.open("GET","AJAX_courses_by_dept.php?dept="+dept,true);
        xmlhttp.send();
        tr.innerHTML = "<td><i class=\"loading\"></i></td>";
    }

    function options_of_branches()
	//function options_of_courses()
    {
        //set_id_of_branch();
        var tr=document.getElementById('branch');
        var course=document.getElementById('course_id').value;
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
        xmlhttp.open("GET","AJAX_courses_by_branch.php?course="+course,true);
        xmlhttp.send();
        tr.innerHTML = "<td><i class=\"loading\"></i></td>";
    }

    function set_id_of_branch()
    {
        var branch_id=document.getElementById('branch_id').value;
        document.getElementById('id_of_branch').value=branch_id;
        return 0;
    }

    function set_id_of_course()
    {
        var course_id=document.getElementById('course_id').value;
        document.getElementById('id_of_course').value=course_id;
    }
