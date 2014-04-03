<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	drawHeader("Edit Educational Qualifications");
	
	if(isset($_GET['emp_id']))
		$emp = $_GET['emp_id'];
	else
	{
		drawNotification("Employee Id not selected", "<a href='edit_employee.php'>Click here</a> to select Employee Id.", "error");
		die();
	}
?>
<script	type="text/javascript">
	function onclick_add()
	{	
		var row=document.getElementById("tableid").rows;
		var e=document.getElementsByName("exam4[]")[row.length-2].value;
		var b=document.getElementsByName("branch4[]")[row.length-2].value;
		var c=document.getElementsByName("clgname4[]")[row.length-2].value;
		var y=document.getElementsByName("year4[]")[row.length-2].value;
		var g=document.getElementsByName("grade4[]")[row.length-2].value;
		var d=document.getElementsByName("div4[]")[row.length-2].value;

		if(e=="" || b=="" || c=="" || y=="" || g=="" || d=="" )
			alert('Sno '+(row.length-1)+' : Please fill up all the fields !!');
		else
		{
			var newrow=document.getElementById("tableid").insertRow(row.length);
			newrow.innerHTML=document.getElementById("addrow").innerHTML;
			var newid=newrow.cells[0].id="sno"+Number(row.length-2);
			document.getElementById(newid).innerHTML=row.length-1;
		}
	}
	
	function validate()
	{
		var n_row=document.getElementById("tableid").rows.length;
		var i=0;
		for(i=0;i<n_row-2;i++)
		{
			var e=document.getElementsByName("exam4[]")[i].value;
			var b=document.getElementsByName("branch4[]")[i].value;
			var c=document.getElementsByName("clgname4[]")[i].value;
			var y=document.getElementsByName("year4[]")[i].value;
			var g=document.getElementsByName("grade4[]")[i].value;
			var d=document.getElementsByName("div4[]")[i].value;
				
			if(e=="" || b=="" || c=="" || y=="" || g=="" || d=="" )
			{
				alert('Sno '+(i+1)+': Please fill up all the fields !!');
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
		var e=document.getElementsByName("exam4[]")[row.length-2].value;
		var b=document.getElementsByName("branch4[]")[row.length-2].value;
		var c=document.getElementsByName("clgname4[]")[row.length-2].value;
		var y=document.getElementsByName("year4[]")[row.length-2].value;
		var g=document.getElementsByName("grade4[]")[row.length-2].value;
		var d=document.getElementsByName("div4[]")[row.length-2].value;

		if((e=="" && b=="" && c=="" && y=="" && g=="" && d=="" && row.length!=2)	||	(e!="" && b!="" && c!="" && y!="" && g!="" && d!=""))
			return true;
		else
		{
			alert('Sno '+(row.length-1)+' : Please fill up all the fields !!');
			return false;
		}
	}
	
	function onclick_delete(i)
	{
		var result=confirm("Do you really want to delete ?");
		if(result==true)
		{
			var table=document.getElementById('tbl4');
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
				    table.innerHTML=xmlhttp.responseText;
			    }
		  	}
			xmlhttp.open("GET","del_educational_details.php?s="+i,true);
			xmlhttp.send();
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
		xmlhttp.open("GET","edit_button_edu_details.php?e="+i,true);
		xmlhttp.send();	
	}

	function onclick_save(i)
	{
		var e=document.getElementById("exam"+i).value;
		var b=document.getElementById("branch"+i).value;
		var c=document.getElementById("clgname"+i).value;
		var y=document.getElementById("year"+i).value;
		var g=document.getElementById("grade"+i).value;
		var d=document.getElementById("div"+i).value;

		if(e=="" || b=="" || c=="" || y=="" || g=="" || d=="" )
			alert("!! Please fill up all the fields !!");
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
			xmlhttp.open("GET","save_edu_details.php?s="+i+"&e="+e+"&b="+b+"&c="+c+"&y="+y+"&g="+g+"&d="+d,true);
			xmlhttp.send();
		}
	}
	
	function examination_editbtn_handler(i)
	{
		var exam=document.getElementById("exam"+i).value;
			if(exam=="non-matric")
			{
				document.getElementById("branch"+i).value="n/a";
				document.getElementById("clgname"+i).value="n/a";
				document.getElementById("year"+i).value="n/a";
				document.getElementById("grade"+i).value="n/a";
				document.getElementById("div"+i).value="n/a";
			}
	}
	
	function examination_handler(obj)
	{		
		var row=document.getElementById("tableid").rows.length;
		var i=0;
		for(i=0;i<row;i++)
		{
			var exam=document.getElementsByName("exam4[]")[i].value;
			if(exam=="non-matric")
			{
				document.getElementsByName("branch4[]")[i].value="n/a";
				document.getElementsByName("clgname4[]")[i].value="n/a";
				document.getElementsByName("year4[]")[i].value="n/a";
				document.getElementsByName("grade4[]")[i].value="n/a";
				document.getElementsByName("div4[]")[i].value="n/a";
			}
		}
	}
	
</script>

<body>
<?php
	echo '<table>
				<tr>
					<th>Employee Id</th>
					<td>'.$emp.'</td>
				</tr></table>' ;
?>
<h1>Educational Qualifications</h1>
<form method = "post" action=  "updateSQL4.php"  onsubmit="return onclick_submit()" >
<?php
	$i=1;
	$edu_detail=mysql_query("select * 
								from emp_education_details 
								where id='".$emp."'");
	if(mysql_num_rows($edu_detail)!=0)
	{
		echo '<table id="tbl4"> 
				<tr>
					 <th>S no.</th>
				     <th>Examination</th>
				     <th>Course(Specialization)</th>
				   	 <th>College/University/Institute</th>
				     <th>Year</th>
				     <th>Percentage/Grade</th>
				     <th>Class/Division</th>
					 <th>Edit/Delete</th>
				</tr>';
				
		while($row=mysql_fetch_row($edu_detail))
		{
			echo '<tr name="row[]" align="center">
					<td>'.$i.'</td>
			    	<td>'.strtoupper($row[2]).'</td>
			    	<td>'.strtoupper($row[3]).'</td>
			    	<td>'.strtoupper($row[4]).'</td>
			    	<td>'.$row[5].'</td>
			    	<td>'.strtoupper($row[6]).'</td>
			    	<td>'.ucwords($row[7]).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.')">
						<input type="button" class="error" name="delete4[]" value="Delete" onClick="onclick_delete('.$i.');" >
					</td>
			    </tr>';
			$i++;
		}
		echo "</table>";
	}
	else
		drawNotification("Empty","No educational details added","error");
?>
<h1>Add here</h1>
<table id="tableid">
     <tr>
		 <th>S no.</th>
	     <th>Examination</th>
	     <th>Course(Specialization)</th>
	   	 <th>College/University/Institute</th>
	     <th>Year</th>
	     <th>Percentage/Grade</th>
	     <th>Class/Division</th>     
    </tr>
	<tr id="addrow">
  	    	<td id="sno">1</td>
	        <td><select name="exam4[]" onChange="examination_handler(this);" >
            		<option disabled selected value="" >Select Examination</option>
            		<option value="non-matric">Non-Matric</option>
                    <option value="matric">Matric</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="graduation">Graduation</option>
                    <option value="post-graduation">Post Graduation</option>
                    <option value="doctorate">Doctorate</option>
                    <option value="post-doctorate">Post Doctorate</option>
                    <option value="others">Others</option>
                </select></td>
            <td><input type="text" name="branch4[]"/></td>
            <td><input type="text" name="clgname4[]"/></td>
            <td><input type="text" name="year4[]" /></td>
            <td><input type="text" name="grade4[]" /></td>
            <td><input type="text" name="div4[]"/></td>
    </tr>
</table>
<input type="button" name="add" value="Add More" onClick="onclick_add();" >
<br>
<input type="submit" name="submit4" value="Save" >
</form>

<?php
	
	echo '<a href="edit_employee.php"><button>Back</button></a>';
	mysql_close();
	drawFooter();
?>
</body>
</html>