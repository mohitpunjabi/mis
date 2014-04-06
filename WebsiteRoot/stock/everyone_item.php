<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	auth();
	drawHeader("Issued Items");
?>

<?php

	$cquery = 	"select issue_id,item_name, first_name, last_name, quantity, location, date
			  	from
			  	(select * from stockandinventory_c_issue) as a
		    	NATURAL JOIN
				(select item_id,item_name from stockandinventory_stock_item) as b
				NATURAL JOIN
				(select first_name,last_name,id as username from user_details) as c";
	$cresult=mysql_query($cquery);
	
	$c=0;
	if(mysql_num_rows($cresult)!=0)
	{
		echo"<p> &nbsp;</p>";
		echo "<h2><center>Consumable Items Issued</center></h2>";
		echo '<table align="center"> 
						<tr> <th>Issue Id</th> 
							<th>Item Name</th> 
							<th>Name</th> 
							<th>Quantity</th> 
							<th>Location</th> 
							<th>Date</th> 			
							</tr>';
		
		while($row=mysql_fetch_row($cresult))
		{
			echo "<tr>
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]." ".$row[3]."</td>
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
					<td>".$row[6]."</td></tr>";
		}
		echo "</table>";
	}
	else $c+=1;
	
	$ncquery="select issue_id,item_name, first_name, last_name, quantity, location, date
			from
			(select * from stockandinventory_nc_issue) as a
			NATURAL JOIN
			(select item_id,item_name from stockandinventory_stock_item) as b
			NATURAL JOIN
			(select first_name,last_name,id as username from user_details) as c";
	$ncresult=mysql_query($ncquery);
	
	if(mysql_num_rows($ncresult)!=0)
	{
		echo"<p> &nbsp;</p>";
		echo "<h2><center>Non-Consumable Items Issued</center></h2>";
		echo '<table align="center"> 
						<tr> <th>Issue Id</th> 
							<th>Item Name</th> 
							<th>Name</th> 
							<th>Quantity</th> 
							<th>Location</th> 
							<th>Date</th> 			
							</tr>';
		
		while($row=mysql_fetch_row($ncresult))
		{
			echo "<tr>
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]." ".$row[3]."</td>
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
					<td>".$row[6]."</td></tr>";
		}
		echo "</table>";
	}
	else $c+=1;
	
	if($c==2)
		echo "<h1><center>No Items Issued</center></h1>";

	drawFooter();
	mysql_close();
?>