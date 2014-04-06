<?php
	include_once('../Includes/Layout.php');
	require_once('../Includes/Auth.php');
	require_once('connectDB.php');
	
if(isset($_GET['TYPE']) && $_GET['TYPE']=='Consumable')
{
	$query1="select item_id,item_type from stockandinventory_stock_item where item_name='".$_GET['ITEM']."' and c_nc='Consumable'";
	$sql="SELECT * FROM stockandinventory_stock_item where c_nc='Consumable' ";
}
if(isset($_GET['TYPE']) && $_GET['TYPE']=='Non-Consumable')
{
	$query1="select item_id,item_type from stockandinventory_stock_item where item_name='".$_GET['ITEM']."' and c_nc='Non-Consumable'";
	$sql="SELECT * FROM stockandinventory_stock_item where c_nc='Non-Consumable' ";
}
$result1=mysql_query($query1);
$n=mysql_num_rows($result1);
$row=mysql_fetch_row($result1);
$itemid=$row[0];
$itemspec=$row[1];
$result = mysql_query($sql);
if($n==1)
{
		echo '<tr> <td>Item Name</td><td>';
		echo "<select name='txtItemName' id='txtItemName' onChange='getID(this.value)'>";
		while ($roww= mysql_fetch_assoc($result)) 
		{
			if($roww['item_name']==$_GET['ITEM'])
				echo "<option value='" . $roww['item_name'] . "' selected=true >" . $roww['item_name'] . "</option>";
			else
				echo "<option value='" . $roww['item_name'] . "'>" . $roww['item_name'] . "</option>";
		}
		echo "<option value='new'>Add new item</option>";
	echo '</select></td></tr>';

	echo '<tr> <td>Item Id</td> <td><input name="txtItemId" id="txtItemId" value="'.$itemid.'" readonly></td> </tr>';	

	echo '<tr> <td>Item Specification</td> <td><input name="txtItemSpec" id="txtItemSpec" value="'.$itemspec.'"></td> </tr>';
}
else if($n==0)
{
	$generate_item_id=mysql_query("SELECT max(item_id) FROM stockandinventory_stock_item");
	$row=mysql_fetch_row($generate_item_id);
	$new_item_id=$row[0]+1;
	echo '<tr> <td>Item Name</td><td><input name="txtItemName" id="txtItemName"></td></tr>';
	echo '<tr> <td>Item Id</td> <td><input name="txtItemId" id="txtItemId" value="'.$new_item_id.'"></td> </tr>';	
	echo '<tr> <td>Item Specification</td> <td><input name="txtItemSpec" id="txtItemSpec" ></td> </tr>';
}
mysql_close();
?>