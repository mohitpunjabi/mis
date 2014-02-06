<?php
	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$res=mysql_query("SELECT * FROM  emp_current_entry ");
	$row=mysql_fetch_array($res);
	$emp_id=$row[0];
	$count=count($_POST['name3']);
	$upload_path = 'Images/'.$emp_id.'/'; // The place the files will be uploaded.
	$i=0;
	$result=true;
	while($_POST['name3'][$i]!=""  &&  $i<$count)
	{
		if(isset($_FILES['photo3']['name'][$i])) 
		{
			$filename = $_FILES['photo3']['name'][$i]; // Get the name of the file (including file extension).
			$filename=strtolower($filename);
			$ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
			$filename='emp_'.$emp_id.'_fam_'.($i+1).$ext;
		}
		if(move_uploaded_file($_FILES['photo3']['tmp_name'][$i],$upload_path.$filename))
		{
			$sno=$sno+1;
			$qry = "INSERT INTO emp_family_details 
					VALUES ('$emp_id',
							'$sno',
							'".clean(strtolower($_POST['name3'][$i]))."',
							'".$_POST['relationship3'][$i]."',
							'".clean(strtolower($_POST['profession3'][$i]))."',
							'".clean($_POST['addr3'][$i])."',
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
			header('Location: family_details.php?error='.$error);
		}
	}
	if($result)
	{
		$next_step="UPDATE emp_current_entry 
					SET curr_step = 3";
		mysql_query($next_step);
		header('Location: add_employee.php');
		$_SESSION['EMP_CURRSTEP'] = 3;
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>