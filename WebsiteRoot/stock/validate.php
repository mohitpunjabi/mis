<?php
	require_once('../Includes/Auth.php');
	include_once('../Includes/Layout.php');
	require_once("connectDB.php");
	auth('hod');
	drawHeader("Validate Requests");
?>

<script>
	function onclick_validate(validate,i)
	{
		if(validate=="allow")
		{
			document.getElementById('reason'+i).disabled=true;
			document.getElementById('reason'+i).required=false;
		}
		else
		{
			document.getElementById('reason'+i).disabled=false;
			document.getElementById('reason'+i).required=true;
		}
	}
</script>

<form action="validate_query.php" method="post">
<div class="notification"> <h1 align="center">Validation</h1> </div>

<?php
$p=0;

$query="SELECT item_name, item_id, CONCAT( CONCAT( first_name,  ' ' ) , last_name ) AS emp_name, date, quantity, valid_no, c_nc, username, location
FROM 
	(SELECT * 
	FROM stockandinventory_validation
	WHERE status = 'Pending') AS p
	NATURAL JOIN 
	(SELECT item_id, item_name, c_nc
	FROM stockandinventory_stock_item) AS q
	NATURAL JOIN 
	(SELECT id AS username, first_name, last_name
	FROM user_details) AS v";
	
$result=mysql_query($query);
$rows=mysql_num_rows($result);
if($rows==0) 
{
	echo "<p> &nbsp;</p>";
	echo "<h2 align='center'>No Requests Pending<h2>";
}
else
{
		echo "<p> &nbsp;</p>";
		echo "<h2><center>Pending Requests</center></h2>";
		
		echo "<table align='center'> <tr><th>Item Name</th> <th>Item ID</th> <th>Emp Name</th> <th>Date</th> <th>Quantity</th> <th>Allow</th> <th>Reject</th><th>Reason(If Rejected)</th></tr>";
		while($row=mysql_fetch_row($result))
		{
			echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td>";
			echo "<td><input type='radio' name='hodstatus".$p."' value='allow' onClick='onclick_validate(this.value,".$p.")' ></input></td>";
			echo "<td><input type='radio' name='hodstatus".$p."' value='disallow'  onClick='onclick_validate(this.value,".$p.")' ></input></td>
					<td><input type='text' id='reason".$p."' name='reason".$p."' ></td></tr>";
			$_SESSION['IssueNo'.$p]=$row[5];
			$_SESSION['ItemID'.$p]=$row[1];
			$_SESSION['Quantity'.$p]=$row[4];
			$_SESSION['C_NC'.$p]=$row[6];
			$_SESSION['EmpId'.$p]=$row[7];
			$_SESSION['Loc'.$p]=$row[8];
			$_SESSION['Date'.$p]=$row[3];
			$p=$p+1;
			$_SESSION['$p']=$p;
		}
		echo "<tr><th colspan='8' align='center'><input type='submit' name='submit'></input></th></tr>";
	}
?>
</table>
</form>
<?php
drawFooter();
?>