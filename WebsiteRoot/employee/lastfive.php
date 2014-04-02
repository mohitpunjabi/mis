<?php
	require_once("../Includes/Auth.php");
	auth("deo");
	require_once("../Includes/Layout.php");

	if(!(isset($_SESSION['EMP_CURRSTEP']) && $_SESSION['EMP_CURRSTEP'] == 4))
		header("Location: add_employee.php");
	
	drawHeader("Add last 5 year stay details");
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
			alert('Sno '+(row.length-2)+': Error : Fill the period of entering and leaving correctly !!');
			return false;
		}
		else if((f=="" && t=="" && a=="" && d=="" && row.length!=3)	||	(f!="" && t!="" && a!="" && d!=""))
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
				</tr></table>' ;
?>
<h1>Step 5 :Please fill up last 5 year stay details</h1>
<form method = "post" action=  "entrySQL5.php" onSubmit="return onclick_submit()">
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
        			min = <?php  $date=date("Y-m-d", time()+(19800));
								$newdate = strtotime ( '-5 year' , strtotime ( $date ) ) ;
								echo date("Y-m-d", $newdate); ?> ></td>
	    <td><input type="date" name="to5[]" max=<?php echo date("Y-m-d", time()+(19800)); ?> 
        			min = <?php  $date=date("Y-m-d", time()+(19800));
								$newdate = strtotime ( '-5 year' , strtotime ( $date ) ) ;
								echo date("Y-m-d", $newdate); ?> ></td>
        <td><textarea rows=4 cols=30 name="addr5[]" ></textarea></td>
		<td align="center"><input type="text" size=30 name="dist5[]"></textarea></td>
    </tr>
	
</table>
<input type="button" name="add" value="Add More" onClick="onclick_add();"/>
<br>
<input type="submit" name="submit5"/>
</form>

<?php
	drawFooter();
?>
</body>
</html>