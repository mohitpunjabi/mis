<?php	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$emp_id=$_SESSION['EDIT_EMP'];
	$count=count($_POST['clgname4']);
	$query=mysql_query("SELECT COUNT(*) FROM emp_education_details WHERE id='".$emp_id."'");
	$row=mysql_fetch_row($query);
	$sno=$row[0];
	$i=0;
	$result=true;
	while($_POST['clgname4'][$i]!=""  &&  $i<$count)
	{
		$sno=$sno+1;
		$qry = "INSERT INTO emp_education_details 
				VALUES ('$emp_id','$sno',
						'".clean(strtolower($_POST['exam4'][$i]))."',
						'".clean(strtolower($_POST['branch4'][$i]))."',
						'".clean(strtolower($_POST['clgname4'][$i]))."',
						'".clean($_POST['year4'][$i])."',
						'".clean(strtolower($_POST['grade4'][$i]))."',
						'".clean(strtolower($_POST['div4'][$i]))."')";
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