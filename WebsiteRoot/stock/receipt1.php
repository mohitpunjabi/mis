<?php
	include_once('../Includes/Layout.php');
	require_once('../Includes/Auth.php');
	require_once('connectDB.php');
	auth('deo');
	drawHeader("Receipt Form");
?>

<div class="notification"> <h1 align="center">Receipt</h1> </div>
<br><br>

<form method="get" action="c_nc_receipt.php">
<h3 class="page-head" align="center">Receipt for consumable items
<input type="submit" value="Click Here" name="Go1"></h3>
<br>
<h3 class="page-head" align="center">Receipt for non-consumable items
<input type="submit" value="Click Here" name="Go2"></h3>
</form>

<?php
drawFooter();
?>