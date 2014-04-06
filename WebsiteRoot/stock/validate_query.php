<?php
	require_once('../Includes/Auth.php');
	include_once('../Includes/Layout.php');
	require_once("connectDB.php");
	auth('hod');
	drawHeader("Validate Requests");
?>

<h1 align="center">Validation</h1>
<br>
<?php

$j=0;
if(isset($_SESSION['$p']))
{
	$p=$_SESSION['$p'];
	for($i=0;$i<$p;$i++)
	{
		if(isset($_POST['hodstatus'.$i]))
		{
		$j=$i+1;
		if($_POST['hodstatus'.$i]=="allow")
		{
			$validate_status="delete from stockandinventory_validation
							where valid_no='".$_SESSION['IssueNo'.$i]."'";
							
			$stock_item_result=mysql_query($validate_status);
			if(!$stock_item_result)
			{
				drawNotification("Request $j cannot be updated<br>","","error"); 
			}
			else
			{
				$stock_item_query="update stockandinventory_stock_item set quantity= quantity-".$_SESSION['Quantity'.$i]."
									where item_id='".$_SESSION['ItemID'.$i]."'";
				mysql_query($stock_item_query);
				
				if($_SESSION['C_NC'.$i]=="Consumable")
				{
					$u_query="insert into stockandinventory_c_issue values(".$_SESSION['IssueNo'.$i].",'".$_SESSION['ItemID'.$i].
								"','".$_SESSION['EmpId'.$i].
								"',".$_SESSION['Quantity'.$i].
								",'".$_SESSION['Loc'.$i]."','".$_SESSION['Date'.$i]."')";
					mysql_query($u_query);
				}
				else
				{
					$u_query="insert into stockandinventory_nc_issue values(".$_SESSION['IssueNo'.$i].",'".$_SESSION['ItemID'.$i].
								"','".$_SESSION['EmpId'.$i].
								"',".$_SESSION['Quantity'.$i].
								",'".$_SESSION['Loc'.$i]."','".$_SESSION['Date'.$i]."')";
					mysql_query($u_query);
				}
				//
				notify($_SESSION['EmpId'.$i],'Item Issue Request Approved','Request for issuing an item is approved','self_items.php','success');
				//
				drawNotification("Request $j updated<br>" , "" ,"success");
			}
		}
		else if($_POST['hodstatus'.$i]=="disallow")
		{
			$validate_status="update stockandinventory_validation 
								set status = 'Rejected'
							  where valid_no='".$_SESSION['IssueNo'.$i]."'";
			$stock_item_result=mysql_query($validate_status);
			
			$reject_reason=mysql_query("insert into stockandinventory_reject_reason values(".$_SESSION['IssueNo'.$i].",'".$_POST['reason'.$i]."')");
			
			if(!$stock_item_result)
			{
				drawNotification("Request $j cannot be updated<br>","","error");
			}
			else
			{
				notify($_SESSION['EmpId'.$i],'Item Issue Request Rejected','Request for issuing an item is rejected','self_items.php',"error");
				drawNotification("Request $j updated<br>" , "" ,"success");
			}
			
		}
		}
	}
}

drawFooter();
?>