<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");	
	auth();


	$result1=mysql_query("select item_id from stockandinventory_stock_item where item_name='".$_GET['ITEM']."' and c_nc='Non-Consumable'");
	if(mysql_num_rows($result1)==1)
	{
		$row=mysql_fetch_row($result1);
		$item_id=$row[0];
		$result2=mysql_query("select sum(quantity) from stockandinventory_nc_issue where item_id=".$item_id." and username=".$_SESSION['SESS_USERNAME']);
		if(mysql_num_rows($result2)==1)
		{
			$row=mysql_fetch_row($result2);
			echo '<tr> <td>Item Id</td> <td><input name="txtItemId" id="txtItemId" value="'.$item_id.'" readonly></td> </tr>';
			echo '<tr> <td>Quantity</td> <td><input name="txtQuantity" type="number" min="1" max='.$row[0].' value='.$row[0].' readonly></td> </tr>';
		}
	}
	else
		echo "No item matched";

	mysql_close();
?>