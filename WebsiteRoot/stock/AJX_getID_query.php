<?php
	require_once('../Includes/Auth.php');
	require_once('connectDB.php');

if(isset($_GET['TYPE']) && $_GET['TYPE']=='Consumable')
{
	$query1="select item_id,quantity from stockandinventory_stock_item where item_name='".$_GET['ITEM']."' and c_nc='Consumable'";
}
if(isset($_GET['TYPE']) && $_GET['TYPE']=='Non-Consumable')
{
	$query1="select item_id,quantity from stockandinventory_stock_item where item_name='".$_GET['ITEM']."' and c_nc='Non-Consumable'";
}

$result1=mysql_query($query1);

if(mysql_num_rows($result1)==1)
{
	$row=mysql_fetch_row($result1);
	echo '<tr> <td>Item Id</td> <td><input name="txtItemId" id="txtItemId" value="'.$row[0].'" readonly></td> </tr>';
	echo '<tr> <td>Quantity</td> <td><input name="txtQuantity" type="number" min="1" max='.$row[1].' ></td> </tr>';
}
else
{
	echo "No item matched";
}
mysql_close();
?>