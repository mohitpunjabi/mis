<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	drawHeader("Edit Previous Employment Details");
	if(isset($_GET['emp_id']))
		$emp_id = $_GET['emp_id'];
	else
	{
		drawNotification("Employee Id not selected", "<a href='edit_employee.php'>Click here</a> to select Employee Id.", "error");
		die();
	}
	
	$prev_detail=mysql_query("select * 
							from emp_prev_exp_details 
							where id='".$emp_id."'");
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
	
	function onclick_delete(i)
	{
		var result=confirm("Do you really want to delete ?");
		if(result==true)
		{
			var table=document.getElementById('tbl2');
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
			xmlhttp.open("GET","del_prev_emp_detail.php?s="+i,true);
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
		xmlhttp.open("GET","edit_button_prev_exp_detail.php?e="+i,true);
		xmlhttp.send();	
	}

	function onclick_save(i)
	{
		var a=document.getElementById("addr"+i).value;
		var d=document.getElementById("designation"+i).value;
		var f=document.getElementById("from"+i).value;
		var t=document.getElementById("to"+i).value;
		var p=document.getElementById("payscale"+i).value;
		var r=document.getElementById("reason"+i).value;
	
		if(a=="" || d=="" || f=="" || t=="" || p=="" || r=="")
			alert("!! Please fill up all the fields !!");
		else if((new Date(f).getTime()) > (new Date(t).getTime()))
			alert("!! Fill the period correctly !!");
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
			xmlhttp.open("GET","save_prev_exp_detail.php?s="+i+"&a="+a+"&d="+d+"&f="+f+"&t="+t+"&p="+p+"&r="+r,true);
			xmlhttp.send();
		}
	}
	
</script>
<body>
<?php	echo '<table>
				<tr>
					<th>Employee Id</th>
					<td>'.$emp_id.'</td>
				</tr>
				</table>' ;

		$find_date=mysql_query("select joining_date from emp_basic_details where id='".$emp_id."'");
		$row=mysql_fetch_row($find_date);
		$date=$row[0];
?>
<h1>Previous employment details</h1>
<?php
		$i=1;
		if(mysql_num_rows($prev_detail)!=0)
		{
			echo '<table id="tbl2">
    			<tr>
    				<th rowspan="2">S no.</th>
			        <th rowspan="2">Full address of Employer</th>
					<th rowspan="2">Position held</th>
			        <th colspan="2">Organization</th>
			        <th rowspan="2">Pay Scale</th>
			        <th rowspan="2">Remarks</th>
			        <th rowspan="2">Edit/Delete</th>
   			 	</tr>
    			<tr>
    				<th>From</th>
    				<th>To</th>
    			</tr>';
	
			while($prev_emp=mysql_fetch_assoc($prev_detail))
			{
				if($prev_emp['remarks']=="")	$remarks='NA';
				else	$remarks=$prev_emp['remarks'];
				echo '<tr name="row[]" align="center">
						<td>'.$i.'</td>
						<td>'.ucwords($prev_emp['address']).'</td>
				    	<td>'.ucwords($prev_emp['designation']).'</td>
				    	<td>'.date('d M Y', strtotime($prev_emp['from'])).'</td>
				    	<td>'.date('d M Y', strtotime($prev_emp['to'])).'</td>
				    	<td>'.$prev_emp['pay_scale'].'</td>
			    		<td>'.ucfirst($prev_emp['remarks']).'</td>
						<td>
							<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.')">
							<input type="button" class="error" name="delete2[]" value="Delete" onClick="onclick_delete('.$i.');" >
						</td>
				    </tr>';
				$i++;
			}
			echo '</table>';
		}
		else
			drawNotification("Empty","No previous employment details added","error");
?>

<h1>Add here</h1>
<form method = "post" action=  "updateSQL2.php" onSubmit="return onclick_submit()" >
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
</table>
<input type="button" name="add" value="Add More" onClick="onclick_add();" ><br>
<input type="submit" name="submit2" value="Save" />
</form>

<?php
	mysql_close();
	echo '<a href="edit_employee.php"><button>Back</button></a>';
	drawFooter();
?>
</body>
</html>