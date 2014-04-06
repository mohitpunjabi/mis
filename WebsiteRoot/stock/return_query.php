<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");	
	drawHeader("");

$return_qty=$_POST['txtQuantity'];
$return_item_id=$_POST['txtItemId'];
$item_name=$_POST['txtItemName'];

$addquantity=mysql_query("update stockandinventory_stock_item set quantity=quantity+".$return_qty." where item_id='".$return_item_id."'");

$delete_qty_nc_issue=mysql_query("delete from stockandinventory_nc_issue where item_id='".$return_item_id."' and username='".$_SESSION['SESS_USERNAME']."'");

if(is_auth('hod'))
	header("Location: Startpage_hod.php?ITEMS=".$return_qty."&INAME=".$item_name);
else if(is_auth('ft'))
	header("Location: Startpage_faculty.php?ITEMS=".$return_qty."&INAME=".$item_name);
else if(is_auth('deo','stock'))
	header("Location: Startpage_dataOP.php?ITEMS=".$return_qty."&INAME=".$item_name); 
drawFooter();
mysql_close();
?>