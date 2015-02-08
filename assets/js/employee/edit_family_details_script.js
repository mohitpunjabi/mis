function onclick_add()
{
	var n=document.getElementsByName("name3")[0].value;
	var r=document.getElementsByName("relationship3")[0].value;
	var p=document.getElementsByName("profession3")[0].value;
	var a=document.getElementsByName("addr3")[0].value;
	var d=document.getElementsByName("dob3")[0].value;
	var file=document.getElementsByName("photo3")[0].files[0];
	if(file)
		var f=file.name;
	else
		var f="";

	if(n=="" || r=="" || p=="" || a==""	||	f=="" || d=="")
		alert('!! Please fill up all the fields !!');
	else
	{
		var ext=f.substring(f.lastIndexOf('.') + 1);
		if(ext == "bmp" || ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg" )
		{
			if(file.size>204800)
				alert('The file size must be less than 200KB');
			else
				return true;
		}
		else
			alert('The image should be in bmp, gif, png, jpg or jpeg format.');
	}
	return false;
}


function change_act(obj,btn)
{
	if(obj.val()=="Active")
	{
		btn.css('background',"#f56954");
		obj.val("Inactive");
		btn.find('i').attr('class','fa fa-times');
	}
	else
	{
		btn.css('background',"#00a65a");
		obj.val("Active");
		btn.find('i').attr('class','fa fa-check');
	}
}

function closeframe()
{
	$('#edit_div').remove();
}

function onclick_edit(i, dob, photopath)
{
/*	var row=document.getElementsByName("row[]")[i-1];
		if(row.cells[6].innerHTML=="Active")
		var style="background:#DFD";
	else
		var style="background:#FDD";
	var x = '<form action="'+site_url('employee/edit/update_old_fam_details/'+i)+'" onSubmit="return onclick_save('+i+');" enctype="multipart/form-data" method="post" accept-charset="utf-8" >';
	x+='<table><tr>';
	x+='<th>Name</th><td>'+row.cells[1].innerHTML+'</td></tr>';
	x+='<tr><th>Relationship</th><td>'+row.cells[2].innerHTML+'</td></tr>';
	x+='<tr><th>Date of Birth</th><td><input type="date" id="dob'+i+'" name="dob'+i+'" value="'+dob+'" /></td></tr>';
	x+='<tr><th>Profession</th><td><input type="text" id="profession'+i+'" name="profession'+i+'" value="'+row.cells[4].innerHTML+'" /></td></tr>';
	x+='<tr><th>Present Postal Address</th><td><textarea rows=4 cols=25 id="address'+i+'" name="address'+i+'" >'+row.cells[5].innerHTML+'</textarea></td></tr>';
	x+='<tr><th>Active/Inactive</th><td><input type="text" id="active'+i+'" name="active'+i+'" style="'+style+'" value="'+row.cells[6].innerHTML+'" onClick="change_act(this)" readonly /></td></tr>';
	x+='<tr><th>Photograph</th><td><img src="'+base_url()+'assets/images/'+photopath+'" name="view_photo3'+i+'" id="view_photo3'+i+'" width="145" height="150"/>';
	x+='<br><input type="file" id="photo3'+i+'" name="photo3'+i+'" /><input type="button" value="Preview" id="preview3'+i+'" name="preview3'+i+'" onClick="edit_preview_pic('+i+');"></td></tr>';
	x+='<tr style="background:#00092a;" align="center"><td colspan=2><input type="submit" name="save" value="Save" /><input type="button" name="cancel" value="Cancel" onClick="closeframe();" />';
	x+='</td></tr></table>';
	x+='</form>';

	var coverdiv = '<div id="coverdiv" style="height: 100%; width: 100%; top: 0px; left: 0px; opacity: 0.5; position: fixed; z-index: 2000; background: rgb(170, 170, 170);"></div>';
	var formdiv = '<div id="formdiv" style="height: auto; width: auto; top: 10%; left: 35%; display: block; position: absolute; z-index: 2001; background: #FEFEFE;">';
	formdiv+=x+'</div>';
	var div = document.createElement('div');
	div.setAttribute("id", "edit_div");
	div.innerHTML=coverdiv+formdiv;
	document.body.appendChild(div);
*/
	var xmlhttp;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}
	else {
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
		    var coverdiv = '<div id="coverdiv" style="height: 100%; width: 100%; top: 0px; left: 0px; opacity: 0.5; position: fixed; z-index: 2000; background: rgb(170, 170, 170);"></div>';
			var formdiv = '<div id="formdiv" style="height: auto; width: auto; top: 10%; left: 15%; right:15%; display: block; position: absolute; z-index: 2001; background: #FEFEFE;">';
			formdiv+=xmlhttp.responseText+'</div>';
			var div = document.createElement('div');
			div.setAttribute("id", "edit_div");
			div.innerHTML=coverdiv+formdiv;
			document.body.appendChild(div);
			$("#edit_photo_container"+i+" img").attr("src", base_url()+'assets/images/'+photopath);
			alert("Here");
	    }
  	}
  	xmlhttp.open("POST",site_url("employee/emp_ajax/edit_record/3/"+i),true);
	xmlhttp.send();
}

function onclick_save(i)
{
	var p=document.getElementById("edit_profession"+i).value;
	var a=document.getElementById("edit_address"+i).value;
	var d=document.getElementById("edit_dob"+i).value;
	var act=document.getElementById("edit_active"+i).value;

	if(p=="" || a=="" || d=="")
	{
		alert("!! Please fill up the fields !!");
	}
	else
	{
		return true;
	}
	return false;
}

$(document).ready(function() {
    $("#add_btn").click(function(e) {
            if(!onclick_add())
                    e.preventDefault();
    });

    $('#status_toggle').click(function(){
    	change_act($('input[name=active3]'),$('#status_toggle'));
    });

    $("input[name=dob3]").datepicker("setEndDate", new Date());

    $("#back_btn").click(function(e) {
                window.location.href = site_url("employee/edit");
        });
});
