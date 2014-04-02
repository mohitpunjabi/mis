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
							'".clean(strtolower($_POST['name3'][$i]))."',
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
		notify($emp_id, "Details Edited", "Your dependent family member details have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=2","success");
		header('Location: index.php?update='.$emp_id);
	}
	else
	{
		echo mysql_error();		
	}
?>