<?php
	require_once("../Includes/Auth.php");
	auth("deo");
	require_once("../Includes/Layout.php");

#added by me	
	if(!(isset($_SESSION['EMP_CURRSTEP']) && $_SESSION['EMP_CURRSTEP'] == 2))
	{
		if(!isset($_SESSION['EMP_CURRSTEP']))
			$_SESSION['EMP_CURRSTEP'] = 2;
		header("Location: add_employee.php");
	}
	
	drawHeader("Add Family Details");
	
	if(isset($_GET['error']))
	{
		drawNotification($_GET['error'],"", "error");
	}
?>
<script	type="text/javascript">

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
			document.getElementsByName('view_photo3[]')[row.length-2].src = "Images/noProfileImage.png";
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
			document.getElementsByName('view_photo3[]')[tr_no-1].src =  "Images/noProfileImage.png";
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
</script>
<body>
<?php	echo '<table>
				<tr>
					<th>Employee Id</th>
					<td>'.$_SESSION['ADD_EMP_ID'].'</td>
				</tr></table>' ;
?>
<h1>Step 3 :Please fill up the details of the dependent family members</h1>
<form method = "post" action=  "entrySQL3.php"  enctype="multipart/form-data" onSubmit="return onclick_submit()" >
<table id="tableid">
     <tr>
	     <th align="center">S no.</th>
	     <th>Name</th>
	   	 <th>Relationship</th>
         <th>Date of Birth</th>
	     <th>Profession</th>
	 	 <th>Present Postal Address</th>
         <th>Active/Inactive</th>
   	 	 <th colspan="2">Photograph</th>
     </tr>
		<tr id="addrow">
  	    	<td align="center" id="sno">1</td>
	        <td align="center"><input type="text" name="name3[]"/></td>
            <td align="center">
            	<select name="relationship3[]" >
					<option value="" disabled="disabled" selected="selected">Choose One</option>
                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Son">Son</option>
                    <option value="Daughter">Daughter</option>
                </select>
            </td>
            <td>
          	<input type="date" name="dob3[]" max="<?php echo date("Y-m-d",time()+(19800));?>" >
            </td>
            <td align="center"><input type="text" name="profession3[]"/></td>
            <td align="center"><textarea rows=4 cols=25 name="addr3[]"></textarea></td>
            <td align="center">
            	<input type="text" name="active3[]" value="Active" style="background:#DFD" onClick="change_act(this)" readonly />
            </td>
			<td align="center">
       			<input type="file" name="photo3[]" ><br>
                <input type="button" value="preview" name="preview3[]" onClick="preview_pic(this);"><br>
            </td>
            <td><img src="Images/noProfileImage.png" name="view_photo3[]" width="145" height="150"/></td>
        </tr>
</table>

<input type="button" name="add" value="Add More" onClick="onclick_add();"/>
<br>
<input type="submit" name="submit3" value="Next" />
</form>

<?php
	drawFooter();
?>
</body>
</html>