<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("connectDB.php");
	
	$pb=$_GET['pb'];
	$pbquery=mysql_query("select pay_code,grade_pay from pay_scales where pay_band='".$pb."'");
	while($row=mysql_fetch_row($pbquery))
		echo '<option value="'.$row[0].'">'.$row[1].'</option>';
	
	mysql_close();
?>