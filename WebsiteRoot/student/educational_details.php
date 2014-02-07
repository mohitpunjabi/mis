<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("../Includes/ConfigSQL.php");
	require_once("../Includes/Layout.php");

/*	if(!(isset($_SESSION['EMP_CURRSTEP']) && $_SESSION['EMP_CURRSTEP'] == 3))
	{
		if(!isset($_SESSION['EMP_CURRSTEP']))
			$_SESSION['EMP_CURRSTEP'] = 3;
		header("Location: add_employee.php");
	}	*/
	drawHeader("Add educational qualifications");
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
</script>

<body>
<?php
	echo '<table>
				<tr>
					<th>Student Id</th>
					<td>'.$_SESSION['ADD_STU_ID'].'</td>
				</tr></table>' ;
?>
<h1>Step 4 :Please fill up the Educational Qualificatoins</h1>
<form method = "post" action=  "entrySQL4.php" onSubmit="return onclick_submit()">
<table id="tableid">
     <tr>
     <th>S no.</th>
     <th>Examination</th>
     <th>Branch/Specialization</th>
   	 <th>College/University/Institute</th>
     <th>Year</th>
     <th>Percentage/Grade</th>
     <th>Class/Division</th>
     </tr>
		<tr id="addrow">
  	    	<td id="sno">1</td>
	        <td><input type="text" name="exam4[]"/></td>
            <td><input type="text" name="branch4[]"/></td>
            <td><input type="text" name="clgname4[]"/></td>
            <td><input type="text" name="year4[]" /></td>
            <td><input type="text" name="grade4[]" /></td>
            <td><input type="text" name="div4[]"/></td>
        </tr>
</table>
<input type="button" name="add" value="Add More" onClick="onclick_add();"/>
<br>
<input type="submit" name="submit4" value="Next" />
</form>

<?php
	drawFooter();
?>
</body>
</html>