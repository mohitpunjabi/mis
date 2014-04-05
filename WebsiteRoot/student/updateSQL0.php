<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("connectDB.php");

	if(isset($_FILES['photo']['name'])) 
	{
		if($_FILES['photo']['name']=="")
			$filename = "";
		else
		{
			$filename = $_FILES['photo']['name']; // Get the name of the file (including file extension).
			$ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
			$filename='stu_'.$_POST['student_id'].'_'.$filename;
		}
	}

	$allowed_filetypes = array('.jpg','.JPG','.bmp','.BMP','.png','.PNG'); // These will be the types of file that will pass the validation.
   	$max_filesize = 204800; // Maximum filesize in BYTES (currently 200KB).

	//uploading image 
	$upload_path = 'Images/'.$_POST['student_id'].'/'; // The place the files will be uploaded.
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
			header('Location: stu_detail.php?error='.$error);
			die();
		}
		
		// Upload the file to your specified path.
		if(move_uploaded_file($_FILES['photo']['tmp_name'],$upload_path.$filename))
	    {
			//on successful upload---extracting photograph from database
			
			$stu_detail=mysql_query("select photopath 
									from user_details
									where id='".$_POST['student_id']."'");
			echo $row=mysql_fetch_assoc($stu_detail);
			echo $STU_PIC=$row['photopath'];
			echo $_POST['student_id'];
			
			
			//deleting older pic
			if($filename!=$STU_PIC)
				$delete_pic=unlink('Images/'.$_POST['student_id'].'/'.$STU_PIC);
				
			
			
		  	$qry="UPDATE user_details SET photopath = '".$filename."' WHERE id='".$_POST['student_id']."'";
			$uresult = mysql_query($qry);

			
			
			if($uresult)
				header('Location: index.php?update='.$_POST['student_id']);
			else
				echo mysql_error();
		}
		else
		{
			$error='There was an error during the file upload.  Please try again.';
			header('Location: edit_stu_profile_pic.php?stu_id='.$_POST['student_id'].'&error='.$error);
		}
	}
	else
	{
		$error="No file selected";
		header('Location: edit_stu_profile_pic.php?stu_id='.$_POST['student_id'].'&error='.$error);
	}
?>