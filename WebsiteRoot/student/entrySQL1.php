<?php	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
    
	//making directory in images for the student
    mkdir("Images/".$_POST['stu_id']."/");
	
	//uploading image 
	$upload_path = 'Images/'.$_POST['stu_id'].'/'; // The place the files will be uploaded.
	if(isset($_FILES['photo']['name'])) 
	{
		if($_FILES['photo']['name']=="")
			$filename = "";
		else
		{
			$filename = $_FILES['photo']['name']; // Get the name of the file (including file extension).
			$ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
			$filename='stu_'.$_POST['stu_id'].'_'.$filename;
		}
	}
	$allowed_filetypes = array('.jpg','.JPG','.bmp','.BMP','.png','.PNG'); // These will be the types of file that will pass the validation.
   	$max_filesize = 204800; // Maximum filesize in BYTES (currently 200KB).
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
			
				
		$dob_in_words="";
		// Upload the file to your specified path.
		if(move_uploaded_file($_FILES['photo']['tmp_name'],$upload_path.$filename))
	    {		//on successful upload
			$qry = "INSERT INTO user_details
					VALUES ('".$_POST['stu_id']."',
							'".$_POST['salutation']."',
							'".$_POST['firstname']."',
							'".$_POST['middlename']."',
							'".$_POST['lastname']."',
							'".$_POST['sex']."',
							'".$_POST['category']."',
							'".$_POST['dob']."',
							'".$_POST['email']."',
							'".$filename."',
							'".$_POST['mstatus']."',
							'".$_POST['pd']."',
							'".$_POST['department']."')";
			$presult = mysql_query($qry);
			
			if(empty($_POST['guardian_name']))
				$guardian="";
			else
				$guardian=$_POST['guardian_name'];
				
			if(empty($_POST['mother_name']))
				$mother="";
			else
				$mother=$_POST['mother_name'];
				
				if(empty($_POST['father_name']))
				$father="";
			else
				$father=$_POST['father_name'];
	
			$qry = "INSERT INTO user_other_details
					VALUES ('".$_POST['stu_id']."',
							'".$_POST['religion']."',
							'".$_POST['nationality']."',
							'".$_POST['kashmiri']."',
							'".$_POST['hobbies']."',
							'".$_POST['favpast']."',
							'".$_POST['pob']."',
							'".$_POST['mobile']."',
							'".$father."',
							'".$mother."',
							'".$guardian."')";
			$uresult = mysql_query($qry);

			$qry = "INSERT INTO stu_details
					(admn_no,
					 admn_date,
					 identification_mark)
					VALUES ('".$_POST['stu_id']."',
							'".$_POST['entrance_age']."',
						    '".$_POST['identification_mark']."')";
			$iresult = mysql_query($qry);

			if($presult && $uresult && $iresult )
			{
				if(!$_POST['correspondence_addr'])
				{
					$qry = "INSERT INTO user_address
						VALUES ('".$_POST['stu_id']."',
								'".$_POST['line13']."',
								'".$_POST['line23']."',
								'".$_POST['city3']."',					
								'".$_POST['state3']."',
								'".$_POST['pincode3']."',
								'".$_POST['country3']."',
								'".$_POST['contact3']."','correspondence')";
				$result3 = mysql_query($qry);
				}
				
				$qry = "INSERT INTO user_address
						VALUES ('".$_POST['stu_id']."',
								'".$_POST['line11']."',
								'".$_POST['line21']."',
								'".$_POST['city1']."',					
								'".$_POST['state1']."',
								'".$_POST['pincode1']."',
								'".$_POST['country1']."',
								'".$_POST['contact1']."','present')";
				$result1 = mysql_query($qry);
				$qry = "INSERT INTO user_address
						VALUES ('".$_POST['stu_id']."',
								'".$_POST['line12']."',
								'".$_POST['line22']."',
								'".$_POST['city2']."',					
								'".$_POST['state2']."',
								'".$_POST['pincode2']."',
								'".$_POST['country2']."',
								'".$_POST['contact2']."','permanent')";
				$result2 = mysql_query($qry);
				
				
				
				if($result1 && $result2)
				{
					$next_step="INSERT INTO stu_current_entry VALUES ('".$_POST['stu_id']."',1)";
					mysql_query($next_step);
					$_SESSION['STU_CURRSTEP'] = 1;
					header('Location: add_student.php');
				}
				else
				{
					echo mysql_error("Error in address ");		
				}
			}
			else
			{
				echo mysql_error("There was an error in entering user datails or user other details");		
			}
		}
		else
		{			//unsuccessful upload
			$error='There was an error during the file upload.  Please try again.';
			header('Location: stu_detail.php?error='.$error);
		}
	}
	else
	{			//no file selected
		$error="No file selected";
		header('Location: stu_detail.php?error='.$error);
	}
	mysql_close();
?>
