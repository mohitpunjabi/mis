<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	auth();
	drawHeader("");
?>

<?php
$query1 = "select quantity from stockandinventory_stock_item where item_id='".$_POST['txtItemId']."'";
$result1 = mysql_query($query1);
$row = mysql_fetch_row($result1);

//query for cse hod
$csehodquery=mysql_query("select id from (select dept_id,id from user_details where dept_id='cse' )as p NATURAL JOIN user_auth_types where auth_id='hod'");
$csehod=mysql_fetch_assoc($csehodquery);
//
if($_SESSION['C_NC_TYPE']=='Consumable')
{
			if(is_auth('hod'))
			{
				$c_valid_query = "insert into stockandinventory_validation values (0,'".$_POST['txtDate'].
								"','".$_POST['txtItemId'].
								"','".$_POST['txtEmpId'].
								"',".$_POST['txtQuantity'].
								",'".$_POST['txtLoc'].
								"','Allowed')";
				
				mysql_query($c_valid_query);
				
				$t_issueid = "select valid_no from stockandinventory_validation where status='Allowed'";
				$issue_id = mysql_fetch_row(mysql_query($t_issueid));

				$c_issue_query = "insert into stockandinventory_c_issue values(".$issue_id[0].",'".$_POST['txtItemId'].
								"','".$_POST['txtEmpId'].
								"',".$_POST['txtQuantity'].
								",'".$_POST['txtLoc'].
								"','".$_POST['txtDate']."')";
				
				mysql_query($c_issue_query);

				$row[0] = $row[0]-$_POST['txtQuantity'];
				
				$stock_item_query = "update stockandinventory_stock_item set quantity=".$row[0]."
									where item_id='".$_POST['txtItemId']."'";
				$stock_item_result=mysql_query($stock_item_query);
				
				$qry = "delete from stockandinventory_validation where status='Allowed'";
				mysql_query($qry);
				
				echo ' <div class="notification success"> <h2 align="center">Item Issued</h2> </div>';	
			}
			
			else 
			{			
				$c_valid_query = "insert into stockandinventory_validation values (0,'".$_POST['txtDate'].
								"','".$_POST['txtItemId'].
								"','".$_POST['txtEmpId'].
								"',".$_POST['txtQuantity'].
								",'".$_POST['txtLoc'].
								"','Pending')";
				mysql_query($c_valid_query);	
				//added by ashwani for notification
				
				notify($csehod['id'],'Item Issue Request','Request for issuing an item by employee '.$_SESSION['id'],'validate.php');
				//till here
				echo "<div class='notification success'><h2><center>Your request has been sent for validation</center></h2></div>";
			}
		}
		
		else			//non consumable
		{
			if(is_auth('hod'))
			{
				$c_valid_query = "insert into stockandinventory_validation values (0,'".$_POST['txtDate'].
								"','".$_POST['txtItemId'].
								"','".$_POST['txtEmpId'].
								"',".$_POST['txtQuantity'].
								",'".$_POST['txtLoc'].
								"','Allowed')";
				mysql_query($c_valid_query);
				
				$t_issueid = "select valid_no from stockandinventory_validation where status='Allowed'";
				$issue_id = mysql_fetch_row(mysql_query($t_issueid));

				$nc_issue_query = "insert into stockandinventory_nc_issue values(".$issue_id[0].",'".$_POST['txtItemId'].
								"','".$_POST['txtEmpId'].
								"',".$_POST['txtQuantity'].
								",'".$_POST['txtLoc'].
								"','".$_POST['txtDate']."')";
				$nc_issue_result = mysql_query($nc_issue_query);

				$row[0] = $row[0]-$_POST['txtQuantity'];
				
				$stock_item_query = "update stockandinventory_stock_item set quantity=".$row[0]."
									where item_id='".$_POST['txtItemId']."'";
				$stock_item_result=mysql_query($stock_item_query);
				
				$qry = "delete from stockandinventory_validation where status='Allowed'";
				mysql_query($qry);
			
				echo "<div class='notification success'><h2><center>Item Issued</center></h2></div>";
			}
			
			else 
			{			
				$nc_valid_query = "insert into stockandinventory_validation values(0,'".$_POST['txtDate'].
								"','".$_POST['txtItemId'].
								"','".$_POST['txtEmpId'].
								"',".$_POST['txtQuantity'].
								",'".$_POST['txtLoc'].
								"','Pending')";
				mysql_query($nc_valid_query);
				//notify added by ashwani
				notify($csehod['id'],'Item Issue Request','Request for issuing an item by employee '.$_SESSION['id'],'validate.php');
				//
				echo "<div class='notification success'><h2><center>Your request has been sent for validation</center></h2></div>";
			}
		}
drawFooter();
?>