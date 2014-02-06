<?php	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$emp_id=$_SESSION['EDIT_EMP'];
	$count=count($_POST['from5']);
	$query=mysql_query("SELECT COUNT(*) FROM emp_last5yrstay_details WHERE id='".$emp_id."'");
	$row=mysql_fetch_row($query);
	$sno=$row[0];
	$i=0;
	$result=true;
	while($_POST['from5'][$i]!=""  &&  $i<$count)
	{
		$sno=$sno+1;
		$qry = "INSERT INTO emp_last5yrstay_details 
				VALUES ('$emp_id','$sno','".$_POST['from5'][$i]."','".$_POST['to5'][$i]."',
						'".clean($_POST['addr5'][$i])."','".clean(strtolower($_POST['dist5'][$i]))."')";
		$result=mysql_query($qry);
		if(!$result)	break;
		$i++;
	}
	if($result)
	{
		header('Location: index.php?update='.$emp_id);
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>