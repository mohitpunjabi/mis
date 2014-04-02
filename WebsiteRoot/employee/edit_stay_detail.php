<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	drawHeader("Edit last 5 year stay details");
	
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
		var f=document.getElementsByName("from5[]")[row.length-3].value;
		var t=document.getElementsByName("to5[]")[row.length-3].value;
		var a=document.getElementsByName("addr5[]")[row.length-3].value;
		var d=document.getElementsByName("dist5[]")[row.length-3].value;

		if(f=="" || t=="" || a=="" || d=="" )
			alert('Sno '+(row.length-2)+': Please fill up all the fields !!');
		else if((new Date(f).getTime()) > (new Date(t).getTime()))
			alert('Sno '+(row.length-2)+': Error : Fill the period of entering and leaving correctly !!');
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
			var f=document.getElementsByName("from5[]")[i].value;
			var t=document.getElementsByName("to5[]")[i].value;
			var a=document.getElementsByName("addr5[]")[i].value;
			var d=document.getElementsByName("dist5[]")[i].value;

			if(f=="" || t=="" || a=="" || d=="" )
			{
				alert('Sno '+(i+1)+' : Please fill up all the fields !!');
				return false;
			}
			else if((new Date(f).getTime()) > (new Date(t).getTime()))
			{
				alert('Sno '+(i+1)+' : Fill the period correctly !!');
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
		var f=document.getElementsByName("from5[]")[row.length-3].value;
		var t=document.getElementsByName("to5[]")[row.length-3].value;
		var a=document.getElementsByName("addr5[]")[row.length-3].value;
		var d=document.getElementsByName("dist5[]")[row.length-3].value;

		if(f!="" && t!="" && (new Date(f).getTime()) > (new Date(t).getTime()))
		{
			alert("!! Error : Fill the period of entering and leaving correctly !!");
			return false;
		}
		else if((f=="" && t=="" && a=="" && d=="")	||	(f!="" && t!="" && a!="" && d!=""))
			return true;
		else
		{
			alert("!! Please fill up all the fields !!");
			return false;
		}
	}
	
	function onclick_delete(i)
	{
		var result=confirm("Do you really want to delete ?");
		if(result==true)
		{
			var table=document.getElementById('tbl5');
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
			xmlhttp.open("GET","del_stay_details.php?s="+i,true);
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
		xmlhttp.open("GET","edit_button_stay_details.php?e="+i,true);
		xmlhttp.send();	
	}

	function onclick_save(i)
	{
		var f=document.getElementById("from"+i).value;
		var t=document.getElementById("to"+i).value;
		var a=document.getElementById("addr"+i).value;
		var d=document.getElementById("dist"+i).value;
		
		if(f=="" || t=="" || a=="" || d=="" )
			alert("!! Please fill up all the fields !!");
		else if((new Date(f).getTime()) > (new Date(t).getTime()))
			alert("!! Error : Fill the period of entering and leaving correctly !!");
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
			xmlhttp.open("GET","save_stay_details.php?s="+i+"&f="+f+"&t="+t+"&a="+a+"&d="+d,true);
			xmlhttp.send();
		}
	}
	
</script>
<body>
<?php	echo '<table>
				<tr>
					<th>Employee Id</th>
					<td>'.$emp.'</td>
				</tr></table>' ;
?>
<h1>Last 5 year stay details</h1>
<form method = "post" action=  "updateSQL5.php" onSubmit="return onclick_submit()">
<?php
	$i=1;
	$last5_detail=mysql_query("select * 
								from emp_last5yrstay_details 
								where id='".$emp."'");
	if(mysql_num_rows($last5_detail)!=0)
	{
		echo '<table id="tbl5"> 
				<tr>
					 <th rowspan=2>S no.</th>
					 <th colspan=2>Duration</th>
				   	 <th rowspan=2>Residential Address</th>
				     <th rowspan=2>Name of District Headquarters</th>
					 <th rowspan=2>Edit/Delete</th>
			     </tr>
			     <tr>
			     	<th>From</th>
			      	<th>To</th>
				</tr>';
				
		while($row=mysql_fetch_row($last5_detail))
		{
			echo '<tr name=row[] align="center">
					<td>'.$i.'</td>
			    	<td>'.date('d M Y', strtotime($row[2])).'</td>
			    	<td>'.date('d M Y', strtotime($row[3])).'</td>
			    	<td>'.$row[4].'</td>
			    	<td>'.ucwords($row[5]).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.')">
						<input type="button" class="error" name="delete5[]" value="Delete" onClick="onclick_delete('.$i.');" >
					</td>
			    </tr>';
			$i++;
		}
		echo "</table>";
	}
?>
<h1>Add here</h1>
<table id="tableid">
     <tr>
     	 <th rowspan=2>S no.</th>
	     <th colspan=2>Duration</th>
	   	 <th rowspan=2>Residential Address</th>
	     <th rowspan=2>Name of District Headquarters</th>
     </tr>
     <tr>
     	<th>From</th>
      	<th>To</th>
     </tr>
	<tr id="addrow">
    	<td id="sno">1</td>
	    <td><input type="date" name="from5[]" max=<?php echo date("Y-m-d", time()+(19800)); ?> 
        			min = <?php $date=date("Y-m-d", time()+(19800));
								$newdate = strtotime ( '-5 year' , strtotime ( $date ) ) ;
								echo date("Y-m-d", $newdate); ?> ></td>
        <td><input type="date" name="to5[]" max=<?php echo date("Y-m-d", time()+(19800)); ?> 
        			min = <?php $date=date("Y-m-d", time()+(19800));
								$newdate = strtotime ( '-5 year' , strtotime ( $date ) ) ;
								echo date("Y-m-d", $newdate); ?> ></td>
        <td><textarea rows=4 cols=30 name="addr5[]" ></textarea></td>
		<td align="center"><input type="text" size=30 name="dist5[]"></td>
    </tr>
	
</table>
<input type="button" name="add" value="Add More" onClick="onclick_add();"/>
<br>
<input type="submit" name="submit5"/>
</form>

<?php
	echo '<a href="edit_employee.php"><button>Back</button></a>';
	mysql_close();
	drawFooter();
?>
</body>
</html>