<?php
	include_once('../Includes/Layout.php');
	require_once('../Includes/Auth.php');
	require_once('connectDB.php');
	auth('deo');
	drawHeader("Item Receipt");


	$query1 = "select quantity from stockandinventory_stock_item where item_id='".$_POST['txtItemId']."'";
	$row1=mysql_query($query1);
	$result1=mysql_fetch_row($row1);

	$value=$_POST['txtUprice']*$_POST['txtQuantity'];

	//adding old item
	if(mysql_num_rows($row1)==1)
	{
		$result1[0]=$result1[0]+$_POST['txtQuantity'];
		$stock_item_query="update stockandinventory_stock_item set quantity=".$result1[0]."
						where item_id='".$_POST['txtItemId']."'";
		$stock_item_result=mysql_query($stock_item_query);
	}
	//adding new item
	else if(mysql_num_rows($row1)==0)
	{
		$stock_item_query="insert into stockandinventory_stock_item values('".$_POST['txtItemId'].
																		"','".$_POST['txtItemName'].
																		"','".$_POST['txtItemSpec'].
																		"',".$_POST['txtQuantity'].
																		",'".$_POST['txtType'].
																		"')";
		$stock_item_result=mysql_query($stock_item_query);
	}


	//generating receipt
	$receipt_query = " insert into stockandinventory_receipt values(0,".$_POST['txtUprice'].
																	",'".$_POST['txtDescription'].
																	"','".$_POST['txtDate'].
																	"',".$value.
																	",".$_POST['txtQuantity'].
																	",'".$_POST['txtItemId']."')";

	$receipt_result=mysql_query($receipt_query);
	
	if($_POST['txtType']=="Consumable")
	{	
		$receipt_no_query = " select max(receipt_no) from stockandinventory_receipt";
		$receipt_no_result = mysql_query($receipt_no_query);
		$row = mysql_fetch_row($receipt_no_result);

		$c_receipt_query = "insert into stockandinventory_c_receipt values('".$_POST['txtInvoiceNo'].
																			"','".$_POST['txtDate'].
																			"',".$_POST['txtPoNumber'].
																			",'".$_POST['txtRemark'].
																			"',".$row[0].
																			",'".$_POST['txtItemId']."')";
	
		$c_receipt_result=mysql_query($c_receipt_query);
		$seller_query = " insert into stockandinventory_seller values('".$_POST['txtSellerName'].
																	"','".$_POST['txtSellerAddr'].
																	"','".$_POST['txtInvoiceNo']."')";
		$seller_result = mysql_query($seller_query);
	}
	else 
	{
		$receipt_no_query = "select max(receipt_no) from stockandinventory_receipt";
		$receipt_no_result = mysql_query($receipt_no_query);
		$row1 = mysql_fetch_row($receipt_no_result);
	
		$nc_receipt_query = " insert into stockandinventory_nc_receipt values('".$_POST['txtChallan'].
																			"','".$_POST['txtCname'].
																			"','".$_POST['txtRemark'].
																			"',".$row1[0].
																			",'".$_POST['txtItemId']."')";
		$nc_receipt_result = mysql_query($nc_receipt_query);
		
	}
	//
	//query for cse hod
	$csehodquery=mysql_query("select id from (select dept_id,id from user_details where dept_id='cse' )as p NATURAL JOIN user_auth_types where auth_id='hod'");
	$csehod=mysql_fetch_assoc($csehodquery);
	notify($csehod['id'],'Item Added','Data Entry Operator '.$_SESSION['id'].' added '.$_POST['txtQuantity'].' '.$_POST['txtItemName'].' in Inventory','stock_bal.php','success');
	//
	header("Location: Startpage_dataOP.php?qty=".$_POST['txtQuantity']."&item=".$_POST['txtItemName']);
	drawFooter();
	mysql_close();
?>