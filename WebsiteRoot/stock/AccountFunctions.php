<?php
		$stock = array();
if(is_auth('deo')||is_auth('ft')){
		$stock["Stock and Inventory Management"] = array();	
		$stock["Stock and Inventory Management"]["Issue"] = array();
	
	if(is_auth('ft'))
	{
		$stock["Stock and Inventory Management"]["Issue"]['Consumable Items'] = 'c_nc_issue.php?Go1=Click+Here';
		$stock["Stock and Inventory Management"]["Issue"]['Non Consumable Items'] = 'c_nc_issue.php?Go2=Click+Here';
		$stock["Stock and Inventory Management"]["Items Issued"] = "self_items.php";
		$stock["Stock and Inventory Management"]["Return Items"] = "return.php";
	}
	if(is_auth('hod'))
	{
		$stock["Stock and Inventory Management"]["Issue"]['Consumable Items'] = 'c_nc_issue.php?Go1=Click+Here';
		$stock["Stock and Inventory Management"]["Issue"]['Non Consumable Items'] = 'c_nc_issue.php?Go2=Click+Here';
		$stock["Stock and Inventory Management"]["Items Issued"] = "items_issued.php";
		$stock["Stock and Inventory Management"]["Stock Balance"] = "stock_bal.php";
		$stock["Stock and Inventory Management"]["Return Items"] = "return.php";
		$stock["Stock and Inventory Management"]["Validate"] = "validate.php";
	}
	if(is_auth('deo','stock')) 
	{
		$stock["Stock and Inventory Management"]["Issue"]['Consumable Items'] = 'c_nc_issue.php?Go1=Click+Here';
		$stock["Stock and Inventory Management"]["Issue"]['Non Consumable Items'] = 'c_nc_issue.php?Go2=Click+Here';
		$stock["Stock and Inventory Management"]["Items Issued"] = "self_items.php";
		$stock["Stock and Inventory Management"]["Stock Balance"] = "stock_bal.php";
		$stock["Stock and Inventory Management"]["Return Items"] = "return.php";
		$stock["Stock and Inventory Management"]["Receipt"] = array();
		$stock["Stock and Inventory Management"]["Receipt"]['Consumable Items'] = 'c_nc_receipt.php?Go1=Click+Here';
		$stock["Stock and Inventory Management"]["Receipt"]['Non Consumable Items'] = 'c_nc_receipt.php?Go2=Click+Here';
	}
}
?>	
