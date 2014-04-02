<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp_id=$_SESSION['EDIT_EMP'];
	$count=count($_POST['designation2']);
	$query=mysql_query("SELECT COUNT(*) FROM emp_prev_exp_details WHERE id='".$emp_id."'");
	$row=mysql_fetch_row($query);
	$sno=$row[0];
	$i=0;
	$result=true;
	while($_POST['designation2'][$i]!=""  &&  $i<$count)
	{
		$sno=$sno+1;
		$qry = "INSERT INTO emp_prev_exp_details 
				VALUES ('$emp_id','$sno','".clean(strtolower($_POST['designation2'][$i]))."','".$_POST['from2'][$i]."',
						'".$_POST['to2'][$i]."','".clean(strtolower($_POST['payscale2'][$i]))."','".clean(strtolower($_POST['addr2'][$i]))."','".clean(strtolower($_POST['reason2'][$i]))."')";
		$result=mysql_query($qry);
		if(!$result)	break;
		$i++;
	}
	if($result)
	{
		notify($emp_id, "Details Edited", "Your previous employment details have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=1","success");
		header('Location: index.php?update='.$emp_id);
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>