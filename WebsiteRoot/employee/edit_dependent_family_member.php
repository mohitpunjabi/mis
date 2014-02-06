<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	drawHeader("Edit Family Details");

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

	function onclick_edit(i)
	{
		var row=document.getElementsByName("row[]")[i-1];
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
			    row.innerHTML=xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("GET","edit_fam_detail.php?e="+i,true);
		xmlhttp.send();	
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
			var row=document.getElementsByName("row[]")[i-1];
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
			    	row.innerHTML=xmlhttp.responseText;
		    	}
	  		}
			xmlhttp.open("GET","save_fam_detail.php?s="+i+"&p="+p+"&a="+a+"&d="+d+"&act="+act,true);
			xmlhttp.send();	
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
<?php	
	if(isset($_GET['emp_id']))
		$emp_id = $_GET['emp_id'];
	else
	{
		drawNotification("Employee Id not selected", "<a href='edit_employee.php'>Click here</a> to select Employee Id.", "error");
		die();
	}
		
	echo '<table>
			<tr>
				<th>Employee Id</th>
				<td>'.$emp_id.'</td>
			</tr></table>' ;
?>
<h1>Dependent Family Members</h1>
<?php
	$i=1;
	$fam_detail=mysql_query("select * 
							from emp_family_details 
							where id='".$emp_id."'");

	if(mysql_num_rows($fam_detail)!=0)
	{
		echo '<table id="tbl"> 
				<tr>
					 <th>S no.</th>
					 <th>Name</th>
				   	 <th>Relationship</th>
					 <th>Date of Birth</th>
				     <th>Profession</th>
				 	 <th>Present Postal Address</th>
					 <th>Active/Inactive</th>
					 <th>Photograph</th>
					 <th>Edit</th>
				</tr>';
				
		while($row=mysql_fetch_row($fam_detail))
		{
			if($row[8]=="Active")
				$style="background:#DFD";
			else
				$style="background:#FDD";
			echo '<tr name="row[]" align="center" >
					
						<td>'.$i.'</td>
						<td>'.ucwords($row[2]).'</td>
					    <td>'.$row[3].'</td>
						<td>'.date('d M Y', strtotime($row[7])).'<br>(Age: '.floor((time() - strtotime($row[7]))/(365*24*60*60)).' years)</td>
					    <td>'.ucwords($row[4]).'</td>
					   	<td>'.$row[5].'</td>
					    <td style="'.$style.'">'.$row[8].'</td>
				    	<td><img src="Images/'.$emp_id.'/'.$row[6].'" name="image3[]" width="145" height="150"/></td>
						<td>
							<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.')"><br>
						</td>
			    </tr>';
			$i++;
		}
		echo "</table>";
	}
	else
		drawNotification("Empty","No dependent family members added","error");
?>
<h1>Add here</h1>
<form method = "post" action=  "updateSQL3.php"  enctype="multipart/form-data"	onsubmit="return onclick_submit()" >
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
	        <td align="center"><input type="text" name="name3[]" ></td>
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

<input type="button" name="add" value="Add More" onClick="onclick_add();" >
<br>
<input type="submit" name="submit3" value="Save" >
</form>

<?php
	echo '<a href="edit_employee.php"><button>Back</button></a>';
	mysql_close();
	drawFooter();
?>
</body>
</html>