<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	auth('deo');
	drawHeader("Stock and Inventory Management");
	
	if(isset($_GET['ITEMS']))
	{
		if($_GET['ITEMS']==0)
			drawNotification("No Non-Consumable Items Issued","","error");
		else
		{
			if(isset($_GET['INAME']))
				drawNotification("Items Returned",$_GET['ITEMS']." ".$_GET['INAME']." were returned successfully.","success");
		}
	}

	if(isset($_GET['qty']) && isset($_GET['item']))
	{
		$qty=$_GET['qty'];
		$item=$_GET['item'];
		drawNotification("Item Added",$qty." ".$item." was successfully added","success");
	}
?>
<div class="notification"> <h1 align="center">Stock and Inventory Management</h1> </div>
<br><br>
<h2 class="page-head" align="center"><a href="issue1.php"> Issue</a></h2>
<br>
<h2 class="page-head" align="center"><a href="self_items.php">Items issued</a></h2>
<br>
<h2 class="page-head" align="center"><a href='stock_bal.php'>Stock Balance</a></h2>
<br>
<h2 class="page-head" align="center"><a href='receipt1.php'>Receipt</a></h2>
<br>
<h2 class="page-head" align="center"><a href='return.php'>Return</a></h2>

<?php
drawFooter();
?>