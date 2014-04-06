<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	auth('hod');
	drawHeader("Issued Items");

	$name_qry=mysql_query("select first_name,last_name,photopath from user_details where id='".$_POST['emp_id']."'");
	$name=mysql_fetch_row($name_qry);
	echo'
		<div class="notification">
		<h1 align="center">Items Issued To '.$name[0].' '.$name[1].'</h1>
		</div>
		<p>&nbsp;</p>';

	echo '<img src="../employee/Images/'.$_POST['emp_id'].'/'.$name[2].'" height="200" width="200" align="right"/>
		<table>
			<tr>
				<th>Employee Id</th>
				<td>'.$_POST['emp_id'].'</td>
			</tr>
			
			<tr>
				<th>Employee Name</th>
				<td>'.$name[0].' '.$name[1].'</td>
			</tr>
		</table>';

	$c=0;
	
	$query = mysql_query("select * from stockandinventory_nc_issue where username='".$_POST['emp_id']."' order by date DESC");
	$validation=mysql_query("select * 
								from stockandinventory_validation 
								NATURAL JOIN 
								(select item_id, item_name, c_nc from stockandinventory_stock_item) as p 
								where c_nc='Non-Consumable' and username='".$_POST['emp_id']."'");
	
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
			echo "<tr><td>".$row[0]."</td>"."<td>".$row[7]."</td>"."<td>".$row[1]."</td>"."<td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td></tr>";
		}
		echo "</table>";
	}
	else $c=$c+1;

	
	$query=mysql_query("select * from stockandinventory_c_issue where username='".$_POST['emp_id']."' order by item_id");
	$validation=mysql_query("select * 
								from stockandinventory_validation 
								NATURAL JOIN 
								(select item_id, item_name, c_nc from stockandinventory_stock_item) as p 
								where c_nc='Consumable' and username='".$_POST['emp_id']."'");
	
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
			echo "<tr><td>".$row[0]."</td>"."<td>".$row[7]."</td>"."<td>".$row[1]."</td>"."<td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td></tr>";
		}
		echo "</table>";
	}
	else $c=$c+1;

	if($c==2) echo "<h1><center>No Items Issued</center></h1>";

	drawFooter();
	mysql_close();
?>
