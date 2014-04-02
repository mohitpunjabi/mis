<?php
	require_once("../Includes/Auth.php");
	auth("deo");
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	if((isset($_SESSION['EMP_CURRSTEP']) && $_SESSION['EMP_CURRSTEP'] == 1) == FALSE)
	{
		if(!isset($_SESSION['EMP_CURRSTEP']))
			$_SESSION['EMP_CURRSTEP'] = 1;
		header("Location: add_employee.php");
	}	
	drawHeader("Add Previous Employment Details");
	
?>

<script	type="text/javascript">
	function onclick_add()
	{	
		var row=document.getElementById("tableid").rows;
		var d=document.getElementsByName("designation2[]")[row.length-3].value;
		var f=document.getElementsByName("from2[]")[row.length-3].value;
		var t=document.getElementsByName("to2[]")[row.length-3].value;
		var a=document.getElementsByName("addr2[]")[row.length-3].value;
		var r=document.getElementsByName("payscale2[]")[row.length-3].value;
		
		
		if(d=="" || f=="" || t=="" || a=="" || r=="")
			alert('Sno '+(row.length-2)+': Please fill up all the fields !!');
		else if((new Date(f).getTime()) > (new Date(t).getTime()))
			alert('Sno '+(row.length-2)+': Fill the period correctly !!');
		else
		{
			var newrow=document.getElementById("tableid").insertRow(row.length);
			newrow.innerHTML=document.getElementById("addrow").innerHTML;
			var newid=newrow.cells[0].id="sno"+Number(row.length-3);
			document.getElementById(newid).innerHTML=row.length-2;
		}			
	}
	
	function validate()
	{
		var n_row=document.getElementById("tableid").rows.length;
		var i=0;
		for(i=0;i<n_row-3;i++)
		{
			var d=document.getElementsByName("designation2[]")[i].value;
			var f=document.getElementsByName("from2[]")[i].value;
			var t=document.getElementsByName("to2[]")[i].value;
			var a=document.getElementsByName("addr2[]")[i].value;
			var r=document.getElementsByName("payscale2[]")[i].value;
				
			if(d=="" || f=="" || t=="" || a=="" || r=="")
			{
				alert('Sno '+(i+1)+': Please fill up all the fields !!');
				return false;
			}
			else if((new Date(f).getTime()) > (new Date(t).getTime()))
			{
				alert('Sno '+(i+1)+': Fill the period correctly !!');
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
		var d=document.getElementsByName("designation2[]")[row.length-3].value;
		var f=document.getElementsByName("from2[]")[row.length-3].value;
		var t=document.getElementsByName("to2[]")[row.length-3].value;
		var a=document.getElementsByName("addr2[]")[row.length-3].value;
		var r=document.getElementsByName("payscale2[]")[row.length-3].value;

		if(f!="" && t!="" && (new Date(f).getTime()) > (new Date(t).getTime()))
		{
			alert('Sno '+(row.length-2)+': Error : Fill the period of entering and leaving correctly !!');
			return false;
		}
		else if((d=="" && f=="" && t=="" && a=="" && r=="")||(d!="" && f!="" && t!="" && a!="" && r!=""))
			return true;
		else
		{
			alert('Sno '+(row.length-2)+': Please fill up all the fields !!');
			return false;
		}
	}
</script>
<body>
<?php	echo '<table>
				<tr>
					<th>Employee Id</th>
					<td>'.$_SESSION['ADD_EMP_ID'].'</td>
				</tr>
				</table>' ;
		$find_date=mysql_query("select joining_date from emp_basic_details where id='".$_SESSION['ADD_EMP_ID']."'");
		$row=mysql_fetch_row($find_date);
		$date=$row[0];
?>
<h1>Step 2 :Please fill up previous employment details</h1>
<form method = "post" action=  "entrySQL2.php" onSubmit="return onclick_submit()" >
<table id="tableid">
    <tr>
    	<th rowspan="2">S no.</th>
        <th rowspan="2">Full address of Employer</th>
		<th rowspan="2">Position held</th>
        <th colspan="2">Organization</th>
        <th rowspan="2">Pay Scale</th>
        <th rowspan="2">Remarks</th>
    </tr>
    <tr>
    	<th>From</th>
    	<th>To</th>
    </tr>
    <tr id="addrow">
    	<td id="sno">1</td>
        <td><textarea rows=5 cols=20 name="addr2[]" ></textarea></td>
    	<td><input type="text" name="designation2[]" size="35" ></td>
        <td><input type="date" name="from2[]" max=<?php echo $date; ?> ></td>
    	<td><input type="date" name="to2[]" max=<?php echo $date; ?>  ></td>	
    	<td><input type="text" name="payscale2[]" ></td>
        <td><textarea rows=5 cols=20 name="reason2[]" ></textarea></td>
    </tr>
</table>
<input type="button" name="add" value="Add More" onClick="onclick_add();"/><br>
<input type="submit" name="submit2" value="Next" />
</form>

<?php
	mysql_close();
	drawFooter();
?>
</body>
</html>