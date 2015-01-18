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
			document.getElementsByName('view_photo3[]')[row.length-2].src = js_base_url()+"assets/images/employee/noProfileImage.png";
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

	function preview_pic(sender)
	{
		var tr_no=sender.parentNode.parentNode.rowIndex;
		var row=document.getElementById("tableid").rows;
		var file=document.getElementsByName("photo3[]")[tr_no-1].files[0];
		if(!file)
			document.getElementsByName('view_photo3[]')[tr_no-1].src =  js_base_url()+"assets/images/employee/noProfileImage.png";
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
