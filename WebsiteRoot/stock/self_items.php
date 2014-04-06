<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	auth();
	drawHeader("Issued Items");
?>

<div class="notification">
<h1 align="center">Items Issued To You</h1>
</div>
<p>&nbsp;</p>

<?php
	$c=0;
	
	$query = mysql_query("select * from stockandinventory_nc_issue where username='".$_SESSION['id']."' order by date DESC");
	$validation=mysql_query("select * 
								from stockandinventory_validation 
								NATURAL JOIN 
								(select item_id, item_name, c_nc from stockandinventory_stock_item) as p 
								where c_nc='Non-Consumable' and username='".$_SESSION['id']."'");
	
	if(mysql_num_rows($query)!=0 || mysql_num_rows($validation)!=0)
	{
		echo "<h2><center>Non-Consumable Items Issued</center></h2>";
		echo '<table align="center"> 
						<tr> <th>IssueNo</th> 
							<th>Item Name</th> 
							<th>Date</th> 
							<th>Quantity</th> 
							<th>location</th> 
							<th>Status</th> 			
							</tr>';

		while($row=mysql_fetch_row($query))
		{
			$itemname=mysql_fetch_row(mysql_query("select item_name from stockandinventory_stock_item where item_id='".$row[1]."'"));
			echo "<tr><td>".$row[0]."</td>"."<td>".$itemname[0]."</td>"."<td>".$row[5]."</td>"."<td>".$row[3]."</td><td>".$row[4]."</td><td>Approved</td></tr>";
		}
		while($row=mysql_fetch_row($validation))
		{
			echo "<tr><td>".$row[1]."</td><td>".$row[7]."</td>"."<td>".$row[2]."</td>"."<td>".$row[4]."</td><td>".$row[5]."</td>";
			if($row[6]=="Rejected")
				echo "<td><a href=reject_reason.php?issue=".$row[1].">".$row[6]."</a></td>";
			else
				echo "<td>".$row[6]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else $c=$c+1;

	
	$query=mysql_query("select * from stockandinventory_c_issue where username='".$_SESSION['id']."' order by item_id");
	$validation=mysql_query("select * 
								from stockandinventory_validation 
								NATURAL JOIN 
								(select item_id, item_name, c_nc from stockandinventory_stock_item) as p 
								where c_nc='Consumable' and username='".$_SESSION['id']."'");
	
	if(mysql_num_rows($query)!=0 || mysql_num_rows($validation)!=0)
	{
		echo"<p> &nbsp;</p>";
		echo "<h2><center>Consumable Items Issued</center></h2>";
		echo '<table align="center"> 
						<tr> <th>IssueNo</th> 
							<th>Item Name</th> 
							<th>Date</th> 
							<th>Quantity</th> 
							<th>location</th> 
							<th>Status</th> 			
							</tr>';
		
		while($row=mysql_fetch_row($query))
		{
			$itemname=mysql_fetch_row(mysql_query("select item_name from stockandinventory_stock_item where item_id='".$row[1]."'"));
			echo "<tr><td>".$row[0]."</td>"."<td>".$itemname[0]."</td>"."<td>".$row[5]."</td>"."<td>".$row[3]."</td><td>".$row[4]."</td><td>Approved</td></tr>";
		}
		while($row=mysql_fetch_row($validation))
		{
			echo "<tr><td>".$row[1]."</td><td>".$row[7]."</td>"."<td>".$row[2]."</td>"."<td>".$row[4]."</td><td>".$row[5]."</td>";
			if($row[6]=="Rejected")
				echo "<td><a href=reject_reason.php?issue=".$row[1].">".$row[6]."</a></td>";
			else
				echo "<td>".$row[6]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else $c=$c+1;

	if($c==2) echo "<h1><center>No Items Issued</center></h1>";

	drawFooter();
?>
