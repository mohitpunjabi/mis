<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("connectDB.php");
	/*echo $_POST['course_id'];
	$course_id=$_POST['course_id'];
	//echo $_POST['branch_id'];
	$branch_id=$_POST['branch_id'];
	$AuthId='stu';
	$qry = "INSERT INTO stu_academic (id,auth_id,course_id,branch_id,enrollment_year)
						VALUES ('".strtolower($_POST['stu_id'])."','".$AuthId."','".strtolower($course_id)."','".strtolower($branch_id)."','".strtolower($_POST['entrance_age'])."')";
$mresult=mysql_query($qry);
	die();*/
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
					VALUES ('".strtolower($_POST['stu_id'])."',
							'".$_POST['salutation']."',
							'".strtolower($_POST['firstname'])."',
							'".strtolower($_POST['middlename'])."',
							'".strtolower($_POST['lastname'])."',
							'".$_POST['sex']."',
							'".strtolower($_POST['category'])."',
							'".$_POST['dob']."',
							'".strtolower($_POST['email'])."',
							'".$filename."',
							'".strtolower($_POST['mstatus'])."',
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
					VALUES ('".strtolower($_POST['stu_id'])."',
							'".strtolower($_POST['religion'])."',
							'".strtolower($_POST['nationality'])."',
							'".$_POST['kashmiri']."',
							'".strtolower($_POST['hobbies'])."',
							'".strtolower($_POST['favpast'])."',
							'".strtolower($_POST['pob'])."',
							'".$_POST['mobile']."',
							'".strtolower($father)."',
							'".strtolower($mother)."')";
			$uresult = mysql_query($qry);
			//$stu_id=$_POST['stu_id'];
			//$enroll_year=substr($_POST['entrance_age']);
			$AuthId='stu';
			$course_id=$_POST['course_id'];
			$branch_id=$_POST['branch_id'];
			$qry = "INSERT INTO users (id,auth_id)
						VALUES ('".strtolower($_POST['stu_id'])."','".$AuthId."')";
			$mresult=mysql_query($qry);

			$qry = "INSERT INTO stu_academic (id,auth_id,course_id,branch_id,enrollment_year)
						VALUES ('".strtolower($_POST['stu_id'])."','".$AuthId."','".strtolower($course_id)."','".strtolower($branch_id)."','".strtolower($_POST['entrance_age'])."')";

			$mresult=mysql_query($qry);

			if($mresult)
				echo "bye";

			$qry = "INSERT INTO stu_details
					(admn_no,
					 admn_date,
					 enrollment_year,
					 identification_mark)
					VALUES ('".strtolower($_POST['stu_id'])."',
							'".$_POST['entrance_age']."',
							'".$_POST['entrance_age']."',
						    '".strtolower($_POST['identification_mark'])."')";
			$iresult = mysql_query($qry);

			if($iresult)
				echo "hi";

			if($presult && $uresult && $iresult )
			{
				if(!$_POST['correspondence_addr'])
				{
					$qry = "INSERT INTO user_address
						VALUES ('".strtolower($_POST['stu_id'])."',
								'".strtolower($_POST['line13'])."',
								'".strtolower($_POST['line23'])."',
								'".strtolower($_POST['city3'])."',					
								'".strtolower($_POST['state3'])."',
								'".$_POST['pincode3']."',
								'".strtolower($_POST['country3'])."',
								'".$_POST['contact3']."','correspondence')";
				$result3 = mysql_query($qry);
				}
				
				$qry = "INSERT INTO user_address
						VALUES ('".strtolower($_POST['stu_id'])."',
								'".strtolower($_POST['line11'])."',
								'".strtolower($_POST['line21'])."',
								'".strtolower($_POST['city1'])."',					
								'".strtolower($_POST['state1'])."',
								'".$_POST['pincode1']."',
								'".strtolower($_POST['country1'])."',
								'".$_POST['contact1']."','present')";
				$result1 = mysql_query($qry);
				
				$qry = "INSERT INTO user_address
						VALUES ('".strtolower($_POST['stu_id'])."',
								'".strtolower($_POST['line12'])."',
								'".strtolower($_POST['line22'])."',
								'".strtolower($_POST['city2'])."',					
								'".strtolower($_POST['state2'])."',
								'".$_POST['pincode2']."',
								'".strtolower($_POST['country2'])."',
								'".$_POST['contact2']."','permanent')";
				$result2 = mysql_query($qry);
				
				
				if($result1 && $result2)
				{
					$next_step="INSERT INTO stu_current_entry VALUES ('".strtolower($_POST['stu_id'])."',2)";
					mysql_query($next_step);
					$_SESSION['STU_CURRSTEP'] = 2;
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
