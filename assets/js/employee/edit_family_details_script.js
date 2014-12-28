
	function js_base_url()
	{
		return window.location.protocol+'//'+window.location.hostname+'/index.php/';
	}

	function onclick_add()
	{
		var row=document.getElementById("tableid").rows;
		var n=document.getElementsByName("name3[]")[row.length-2].value;
		var r=document.getElementsByName("relationship3[]")[row.length-2].value;
		var p=document.getElementsByName("profession3[]")[row.length-2].value;
		var a=document.getElementsByName("addr3[]")[row.length-2].value;
		var d=document.getElementsByName("dob3[]")[row.length-2].value;
		var file=document.getElementsByName("photo3[]")[row.length-2].files[0];
		if(file)
			var f=file.name;
		else
			var f="";

		if(n=="" || r=="" || p=="" || a==""	||	f=="" || d=="")
			alert('Sno '+(row.length-1)+':!! Please fill up all the fields !!');
		else
		{
			var ext=f.substring(f.lastIndexOf('.') + 1);
			if(ext == "bmp" || ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg" )
			{
				if(file.size>204800)
					alert('Sno '+(row.length-1)+':The file size must be less than 200KB');
				else
					addrow();
			}
			else
				alert('Sno '+(row.length-1)+':The image should be in bmp, gif, png, jpg or jpeg format.');
		}

		function addrow()
		{
			var newrow=document.getElementById("tableid").insertRow(row.length);
			newrow.innerHTML=document.getElementById("addrow").innerHTML;
			var newid=newrow.cells[0].id="sno"+Number(row.length-2);
			document.getElementById(newid).innerHTML=row.length-1;
			document.getElementsByName('view_photo3[]')[row.length-2].src = window.location.protocol+"//"+window.location.hostname+"/assets/images/employee/noProfileImage.png";
			document.getElementsByName('active3[]')[row.length-2].style.background = "#DFD";
		}
	}

	function validate()
	{
		var n_row=document.getElementById("tableid").rows.length;
		var i=0;
		for(i=0;i<n_row-2;i++)
		{
			var n=document.getElementsByName("name3[]")[i].value;
			var r=document.getElementsByName("relationship3[]")[i].value;
			var p=document.getElementsByName("profession3[]")[i].value;
			var a=document.getElementsByName("addr3[]")[i].value;
			var d=document.getElementsByName("dob3[]")[i].value;
			var file=document.getElementsByName("photo3[]")[i].files[0];
			if(file)
				var f=file.name;
			else
				var f="";

			if(n!="" && r!="" && p!="" && a!="" && f!="" && d!="")
			{
				var ext=f.substring(f.lastIndexOf('.') + 1);
				if(ext == "bmp" || ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg" )
				{
					if(file.size>204800)
					{
						alert('Sno '+(i+1)+': The file size must be less than 200KB');
						return false;
					}
				}
				else
				{
					alert('Sno '+(i+1)+': The image should be in bmp, gif, png, jpg or jpeg format.');
					return false;
				}
			}
			else
			{
				alert('Sno '+(i+1)+': !! Please fill up all the fields !!');
				return false;
			}
		}
		return true;
	}

	function onclick_submit()
	{
		if(!validate())			//validation of rows except last one
			return false;
		//validation of last row
		var row=document.getElementById("tableid").rows;
		var n=document.getElementsByName("name3[]")[row.length-2].value;
		var r=document.getElementsByName("relationship3[]")[row.length-2].value;
		var p=document.getElementsByName("profession3[]")[row.length-2].value;
		var a=document.getElementsByName("addr3[]")[row.length-2].value;
		var d=document.getElementsByName("dob3[]")[row.length-2].value;
		var file=document.getElementsByName("photo3[]")[row.length-2].files[0];
		if(file)
			var f=file.name;
		else
			var f="";

		if((n=="" && r=="" && p=="" && a=="" && d=="" && f=="")	||	(n!="" && r!="" && p!="" && a!="" && d!="" && f!=""))
		{
			if(f!="")
			{
				var ext=f.substring(f.lastIndexOf('.') + 1);
				if(ext == "bmp" || ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg" )
				{
					if(file.size>204800)
					{
						alert('Sno '+(row.length-1)+': The file size must be less than 200KB');
						return false;
					}
					else
						return true;
				}
				else
				{
					alert('Sno '+(row.length-1)+': The image should be in bmp, gif, png, jpg or jpeg format.');
					return false;
				}
			}
			else
				return true;
		}
		else
		{
			alert('Sno '+(row.length-1)+': Please fill up all the fields !!');
			return false;
		}
	}

	function closeframe()
	{
		$('#edit_div').remove();
	}

	function onclick_edit(i, dob)
	{
		var row=document.getElementsByName("row[]")[i-1];
   		if(row.cells[6].innerHTML=="Active")
			var style="background:#DFD";
		else
			var style="background:#FDD";

		var x = '<form action="'+js_base_url()+'employee/edit/update_old_fam_details/'+i+'" onSubmit="return onclick_save('+i+');" method="post" accept-charset="utf-8" >';
		x+='<table><tr>';
		x+='<th>Name</th><td>'+row.cells[1].innerHTML+'</td></tr>';
		x+='<tr><th>Relationship</th><td>'+row.cells[2].innerHTML+'</td></tr>';
		x+='<tr><th>Date of Birth</th><td><input type="date" id="dob'+i+'" name="dob'+i+'" value="'+dob+'" /></td></tr>';
		x+='<tr><th>Profession</th><td><input type="text" id="profession'+i+'" name="profession'+i+'" value="'+row.cells[4].innerHTML+'" /></td></tr>';
		x+='<tr><th>Present Postal Address</th><td><textarea rows=4 cols=25 id="address'+i+'" name="address'+i+'" >'+row.cells[5].innerHTML+'</textarea></td></tr>';
		x+='<tr><th>Active/Inactive</th><td><input type="text" id="active'+i+'" name="active'+i+'" style="'+style+'" value="'+row.cells[6].innerHTML+'" onClick="change_act(this)" readonly /></td></tr>';
		x+='<tr style="background:#00092a;" align="center"><td colspan=2><input type="submit" name="save" value="Save" /><input type="button" name="cancel" value="Cancel" onClick="closeframe();" />';
		x+='</td></tr></table>';
		x+='</form>';

		var coverdiv = '<div id="coverdiv" style="height: 100%; width: 100%; top: 0px; left: 0px; opacity: 0.5; position: fixed; z-index: 2000; background: rgb(170, 170, 170);"></div>';
		var formdiv = '<div id="formdiv" style="height: auto; width: auto; top: 20%; left: 35%; display: block; position: absolute; z-index: 2001; background: #FEFEFE;">';
		formdiv+=x+'</div>';
		var div = document.createElement('div');
		div.setAttribute("id", "edit_div");
		div.innerHTML=coverdiv+formdiv;
		document.body.appendChild(div);
	}

	function onclick_save(i)
	{
		var p=document.getElementById("profession"+i).value;
		var a=document.getElementById("address"+i).value;
		var d=document.getElementById("dob"+i).value;
		var act=document.getElementById("active"+i).value;

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

	function preview_pic(sender)
	{
		var tr_no=sender.parentNode.parentNode.rowIndex;
		var row=document.getElementById("tableid").rows;
		var file=document.getElementsByName("photo3[]")[tr_no-1].files[0];
		if(!file)
			document.getElementsByName('view_photo3[]')[tr_no-1].src =  window.location.protocol+"//"+window.location.hostname+"/assets/images/employee/noProfileImage.png";
		else
      	{
			oFReader = new FileReader();
        	oFReader.onload = function(oFREvent)
			{
				var dataURI = oFREvent.target.result;
				document.getElementsByName('view_photo3[]')[tr_no-1].src = dataURI;
			};
			oFReader.readAsDataURL(file);
		}
	}

	function change_act(obj)
	{
		if(obj.value=="Active")
		{
			obj.style.background="#FDD";
			obj.value="Inactive";
		}
		else
		{
			obj.style.background="#DFD";
			obj.value="Active";
		}
	}

	function onclick_add_new()
	{
		document.getElementById('add_new').style.display='none';
		document.getElementById('addnew').style.display='block';
	}