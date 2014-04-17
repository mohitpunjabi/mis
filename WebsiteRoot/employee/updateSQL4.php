<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
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
		$date=date("Y-m-d H:i:s",time()+(19800));
		//sending for validation
		$find_entry=$mysqli->query("select * from emp_validation_details where id='".$emp_id."'");
		if($find_entry->num_rows!=0)
			$v_query=$mysqli->query("update emp_validation_details set educational_status='pending' where id='".$emp_id."'");
		else
			$v_query=$mysqli->query("INSERT INTO emp_validation_details VALUES ('".$emp_id."','approved','approved','approved','approved','pending','approved','".$date."')");

		//notify employee
		//new user query
		$newuser_query=$mysqli->query("select * from users where id='".$emp_id."' and password='' and auth_id='emp'");
		if($newuser_query->num_rows==0)	//old user
			notify($emp_id, "Details Edited", "Your educational details have been successfully edited by Data Entry Operator ".$_SESSION['id']." and sent for validation.", "show_emp.php?form_name=3");
		$emp_name_query=$mysqli->query("select salutation,first_name,last_name from user_details where id='".$emp_id."'");
		$emp_name_row=$emp_name_query->fetch_assoc();
		$emp_name=$emp_name_row['salutation'].' '.$emp_name_row['first_name'].' '.$emp_name_row['last_name'];
		//notify nodal officer
		$nodal_query=$mysqli->query("SELECT id FROM user_auth_types WHERE auth_id='est_ar'");
		while($no=$nodal_query->fetch_assoc())
		{
			notify($no['id'], "Validation Request", "Please validate ".$emp_name." details", "validate_step.php?emp=".$emp_id);
		}
		header('Location: index.php?update='.$emp_id);
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>