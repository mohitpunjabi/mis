<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	auth('ft','hod','deo');
	drawHeader("Consumable/Non-Consumable issue");
?>

<div class="notification"> <h1 align="center">Issue</h1> </div>
<p>&nbsp; </p>
<form method="get" action="c_nc_issue.php">
<h3 class="page-head" align="center">Issue for consumable items
<input type="submit" value="Click Here" name="Go1">
</h3>
<p>&nbsp;</p>
<h3 class="page-head" align="center">Issue for non-consumable items
<input type="submit" value="Click Here" name="Go2">
</h3> 
</form>

<?php
drawFooter();
?>