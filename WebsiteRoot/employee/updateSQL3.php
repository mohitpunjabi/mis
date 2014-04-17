<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp_id=$_SESSION['EDIT_EMP'];
	$count=count($_POST['name3']);
	$query=mysql_query("SELECT COUNT(*) FROM emp_family_details WHERE id='".$emp_id."'");
	$row=mysql_fetch_row($query);
	$sno=$row[0];
	$i=0;
	$result=true;
	$upload_path = 'Images/'.$emp_id.'/'; // The place the files will be uploaded.
	while($_POST['name3'][$i]!=""  &&  $i<$count)
	{
		$sno=$sno+1;
		if(isset($_FILES['photo3']['name'][$i])) 
		{
			$filename = $_FILES['photo3']['name'][$i]; // Get the name of the file (including file extension).
			$ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
			$filename='emp_'.$emp_id.'_fam_'.$sno.$ext;
		}
		if(move_uploaded_file($_FILES['photo3']['tmp_name'][$i],$upload_path.$filename))
		{
			$qry = "INSERT INTO emp_family_details 
					VALUES ('$emp_id',
							'$sno',
							'".ucwords(clean(strtolower($_POST['name3'][$i])))."',
							'".$_POST['relationship3'][$i]."',
							'".clean(strtolower($_POST['profession3'][$i]))."',
							'".clean(strtolower($_POST['addr3'][$i]))."',
							'".$filename."',
							'".$_POST['dob3'][$i]."',
							'".$_POST['active3'][$i]."')";
							
			$result=mysql_query($qry);
			if(!$result)	break;
			$i++;
		}
		else
		{	//unsuccessful upload
			$error='There was an error during the file upload.  Please try again.';
			header('Location: edit_dependent_family_member.php?emp_id='.$emp_id.'&error='.$error);
		}
	}
	if($result)
	{
		$date=date("Y-m-d H:i:s",time()+(19800));
		//sending for validation
		$find_entry=$mysqli->query("select * from emp_validation_details where id='".$emp_id."'");
		if($find_entry->num_rows!=0)
			$v_query=$mysqli->query("update emp_validation_details set family_details_status='pending' where id='".$emp_id."'");
		else
			$v_query=$mysqli->query("INSERT INTO emp_validation_details VALUES ('".$emp_id."','approved','approved','approved','pending','approved','approved','".$date."')");
		
		//notify employee
		//new user query
		$newuser_query=$mysqli->query("select * from users where id='".$emp_id."' and password='' and auth_id='emp'");
		if($newuser_query->num_rows==0)	//old user
			notify($emp_id, "Details Edited", "Your dependent family member details have been successfully edited by Data Entry Operator ".$_SESSION['id']." and sent for validation.", "show_emp.php?form_name=2");
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
?>