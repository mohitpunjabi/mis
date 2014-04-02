<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");

	if(isset($_FILES['photo']['name'])) 
	{
		if($_FILES['photo']['name']=="")
			$filename = "";
		else
		{
			$filename = $_FILES['photo']['name']; // Get the name of the file (including file extension).
			$filename=clean(strtolower($filename));
			$ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
			$filename='emp_'.clean(strtolower($_POST['emp_id'])).'_'.$filename;
		}
	}

	$allowed_filetypes = array('.jpg','.JPG','.jpeg','.JPEG','.bmp','.BMP','.png','.PNG'); // These will be the types of file that will pass the validation.
   	$max_filesize = 204800; // Maximum filesize in BYTES (currently 200KB).
	$upload_path = 'Images/'.clean(strtolower($_POST['emp_id'])).'/'; // The place the files will be uploaded.

			
	$error="";
	if($filename!="")		
	{	
		 // Check if the filetype is allowed, if not DIE and inform the user.
		if(!in_array($ext,$allowed_filetypes))
		   	$error='The file you attempted to upload is not allowed.';
		else if(filesize($_FILES['photo']['tmp_name']) > $max_filesize)	// Now check the filesize
     		$error='The file you attempted to upload is too large.';
		else if(!is_writable($upload_path))			// Check if we can upload to the specified path.
    		$error='You cannot upload to the specified directory.'; 
		//handling errors
		if($error!="")
		{
			header('Location: edit_profile_pic.php?emp_id='.$_POST['emp_id'].'&error='.$error);
			die();
		}
		// Upload the file to your specified path.
		if(move_uploaded_file($_FILES['photo']['tmp_name'],$upload_path.$filename))
	    {
			//extracting photograph from database
			$emp_detail=mysql_query("select photopath 
									from user_details
									where id='".$_POST['emp_id']."'");
			$row=mysql_fetch_row($emp_detail);
			$EMP_PIC=$row[0];
			
			//deleting older pic
			if($filename!=$EMP_PIC)
				$delete_pic=unlink('Images/'.$_POST['emp_id'].'/'.$EMP_PIC);
			
		  	$qry="UPDATE user_details SET photopath = '".$filename."' WHERE id='".$_POST['emp_id']."'";
			$uresult = mysql_query($qry);

			if($uresult)
			{
				notify($_POST['emp_id'], "Details Edited", "Your photograph have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=0","success");
				header('Location: index.php?update='.$_POST['emp_id']);
			}
			else
				echo mysql_error();
		}
		else
		{
			$error='There was an error during the file upload.  Please try again.';
			header('Location: edit_profile_pic.php?emp_id='.$_POST['emp_id'].'&error='.$error);
		}
	}
	else
	{
		$error="No file selected";
		header('Location: edit_profile_pic.php?emp_id='.$_POST['emp_id'].'&error='.$error);
	}
	mysql_close();
?>