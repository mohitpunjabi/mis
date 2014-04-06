<?php
	include_once('../Includes/Layout.php');
	require_once('../Includes/Auth.php');
	require_once('connectDB.php');
	auth();
	drawHeader("Item Issued");

?>
<br>
<?php
	if(isset($_GET['item_id']) && isset($_GET['c_nc']))
	{
		$item_id=$_GET['item_id'];
		$c_nc=$_GET['c_nc'];
	}
	else
		header("location: ../Includes/SessionAuthFail.php");
		
	$r=mysql_query("select item_id,item_name from stockandinventory_stock_item where item_id='".$item_id."'");
	$row=mysql_fetch_row($r);
	$itemname=$row[1];
	
	if($c_nc=="consumable")
	{
		$query = "select issue_id, username, first_name, last_name, quantity, date
			  	from
			  	(select * from stockandinventory_c_issue where item_id='".$item_id."') as a
				NATURAL JOIN
				(select first_name,last_name,id as username from user_details) as b";
	}
	else
	{
		$query = "select issue_id, username, first_name, last_name, quantity, date
			  	from
			  	(select * from stockandinventory_nc_issue where item_id='".$item_id."') as a
		    	NATURAL JOIN
				(select first_name,last_name,id as username from user_details) as b";
	}
	$result=mysql_query($query);
	
	if(mysql_num_rows($result)!=0)
	{
		echo"<p> &nbsp;</p>";
		echo "<center>
					<table>
						<tr><th>Item Id</th><td>".$item_id."</td></tr>
						<tr><th>Item Name</th><td>".$itemname."</td></tr>
					</table>
				</center><br>";
		echo '<table align="center"> 
						<tr> <th>Issue Id</th> 
							<th>Employee Id</th> 
							<th>Name</th> 
							<th>Quantity</th> 
							<th>Date</th> 			
							</tr>';
		
		while($row=mysql_fetch_row($result))
		{
			echo "<tr>
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]." ".$row[3]."</td>
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
				</tr>";
		}
		echo "</table>";
	}
	else
		echo "<h1><center>Item not Issued</center></h1>";
	
	drawFooter();
	mysql_close();
?>

