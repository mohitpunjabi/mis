<?php
	include_once('../Includes/Layout.php');
	require_once('../Includes/Auth.php');
	require_once('connectDB.php');
	auth('hod','deo');
	/*
	if(is_auth('ft') && !is_auth('hod') && !is_auth('deo','stock'))
	{
		header("location: ../Includes/SessionAuthFail.php");
	}
	*/
	drawHeader("Stock Balance");
?>

<div class="notification"> <h1 align="center">Stock Balance</h1> </div>
<br><br>

<?php

$query = mysql_query("select * 
					from stockandinventory_stock_item 
					where c_nc= 'non-consumable'
					order by item_name");

echo '<h3 align="center"> Non-Consumable Items</h3>';
echo '<table align="center"> <tr><th rowspan=2>Item ID</th> <th rowspan=2>Item Name</th> <th rowspan=2>Item Type</th> <th colspan=3 >Quantity</th> </tr>';
echo '<tr><th>Total</th><th>Available</th><th>Issued</th></tr>';

while($row=mysql_fetch_row($query))
{
	$qry=mysql_query("select item_id,SUM(quantity) from stockandinventory_nc_issue where item_id='".$row[0]."'");
	$roww=mysql_fetch_row($qry);
	if($roww[0]==NULL)
		$ISSUE=0;
	else
		$ISSUE=$roww[1];
	$total=$row[3]+$ISSUE;
	echo "<tr><td><a href='item_query.php?item_id=".$row[0]."&c_nc=nonconsumable'>".$row[0]."</a></td>"."<td>".$row[1]."</td>"."<td>".$row[2]."</td><td>".$total."</td><td>".$row[3]."</td><td>".$ISSUE."</td></tr>";
}
echo '</table>';

$query = mysql_query("select * from stockandinventory_stock_item where c_nc= 'consumable' order by item_name");
echo '<br>';
echo '<h3 align="center"> Consumable Items</h3>';
echo '<table align="center"> <tr><th rowspan=2>Item ID</th> <th rowspan=2>Item Name</th> <th rowspan=2>Item Type</th> <th colspan=3 >Quantity</th> </tr>';
echo '<tr><th>Total</th><th>Available</th><th>Issued</th></tr>';

while($row=mysql_fetch_row($query))
{
	$qry=mysql_query("select item_id,SUM(quantity) from stockandinventory_c_issue where item_id='".$row[0]."'");
	$roww=mysql_fetch_row($qry);
	if($roww[0]==NULL)
		$ISSUE=0;
	else
		$ISSUE=$roww[1];
	$total=$row[3]+$ISSUE;
	echo "<tr><td><a href='item_query.php?item_id=".$row[0]."&c_nc=consumable'>".$row[0]."</a></td>"."<td>".$row[1]."</td>"."<td>".$row[2]."</td><td>".$total."</td><td>".$row[3]."</td><td>".$ISSUE."</td></tr>";

}
echo '</table>';

drawFooter();
mysql_close();
?>