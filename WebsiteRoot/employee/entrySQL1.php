<?php
	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
    
	//making directory in images for the employee
    mkdir("Images/".strtolower($_POST['emp_id'])."/");
	
	//uploading image 
	$upload_path = 'Images/'.clean(strtolower($_POST['emp_id'])).'/'; // The place the files will be uploaded.
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
			header('Location: emp_detail.php?error='.$error);
			die();
		}
		// Upload the file to your specified path.
		if(move_uploaded_file($_FILES['photo']['tmp_name'],$upload_path.$filename))
	    {		//on successful upload
			
			
			//insertion in users
			mysql_query("INSERT INTO users VALUES ('".clean(strtolower($_POST['emp_id']))."','','emp','')");

			//insertion in user_details
			$qry = "INSERT INTO user_details
					VALUES ('".clean(strtolower($_POST['emp_id']))."',
							'".clean($_POST['salutation'])."',
							'".clean(strtolower($_POST['firstname']))."',
							'".clean(strtolower($_POST['middlename']))."',
							'".clean(strtolower($_POST['lastname']))."',
							'".clean(strtolower($_POST['sex']))."',
							'".$_POST['category']."',
							'".$_POST['dob']."',
							'".clean($_POST['email'])."',
							'".$filename."',
							'".clean(strtolower($_POST['mstatus']))."',
							'".clean(strtolower($_POST['pd']))."',
							'".$_POST['department']."')";
			$presult = mysql_query($qry);
	
			//insertion in user_other_details
			$qry = "INSERT INTO user_other_details
					VALUES ('".clean(strtolower($_POST['emp_id']))."',
							'".clean(strtolower($_POST['religion']))."',
							'".clean(strtolower($_POST['nationality']))."',
							'".$_POST['kashmiri']."',
							'".clean(strtolower($_POST['hobbies']))."',
							'".clean(strtolower($_POST['favpast']))."',
							'".clean(strtolower($_POST['pob']))."',
							'".clean($_POST['mobile'])."',
							'".clean(strtolower($_POST['father']))."',
							'".clean(strtolower($_POST['mother']))."')";
			$uresult = mysql_query($qry);

			if($_POST['tstatus']!='ft')	$_POST['research_int']='NA';
			$qry = "INSERT INTO emp_basic_details
					VALUES ('".clean(strtolower($_POST['emp_id']))."',
							'".$_POST['tstatus']."',
							'".clean(strtolower($_POST['designation']))."',
							'".clean(strtolower($_POST['post']))."',
							'".$_POST['office']."',
							'".$_POST['fax']."',
							'".$_POST['entrance_age']."',
							'".$_POST['retire']."',
							'".clean(strtolower($_POST['empnature']))."')";
			$qresult = mysql_query($qry);

			$qry="INSERT INTO faculty_details
					VALUES ('".clean(strtolower($_POST['emp_id']))."','".clean(strtolower($_POST['research_int']))."')";

			$sresult = mysql_query($qry);
			
			$qry = "INSERT INTO emp_pay_details
					VALUES ('".clean(strtolower($_POST['emp_id']))."',
							'".clean($_POST['gradepay'])."','".clean($_POST['basicpay'])."')";
			$qresult = mysql_query($qry);

			if($presult && $uresult && $qresult)
			{
				$qry = "INSERT INTO user_address
						VALUES ('".clean(strtolower($_POST['emp_id']))."',
								'".clean($_POST['line11'])."',
								'".clean($_POST['line21'])."',
								'".clean(strtolower($_POST['city1']))."',
								'".clean(strtolower($_POST['state1']))."',
								'".$_POST['pincode1']."',
								'".clean(strtolower($_POST['country1']))."',
								'".$_POST['contact1']."','present')";
				$result1 = mysql_query($qry);
				$qry = "INSERT INTO user_address
						VALUES ('".clean(strtolower($_POST['emp_id']))."',
								'".clean($_POST['line12'])."',
								'".clean($_POST['line22'])."',
								'".clean(strtolower($_POST['city2']))."',					
								'".clean(strtolower($_POST['state2']))."',
								'".$_POST['pincode2']."',
								'".clean(strtolower($_POST['country2']))."',
								'".$_POST['contact2']."','permanent')";
				$result2 = mysql_query($qry);
				if($result1 && $result2)
				{
					$next_step="INSERT INTO emp_current_entry VALUES ('".clean(strtolower($_POST['emp_id']))."',1)";
					mysql_query($next_step);
					$_SESSION['EMP_CURRSTEP'] = 1;
					header('Location: add_employee.php');
				}
				else
				{
					echo mysql_error();		
				}
			}
			else
			{
				echo mysql_error();		
			}
		}
		else
		{			//unsuccessful upload
			$error='There was an error during the file upload.  Please try again.';
			header('Location: emp_detail.php?error='.$error);
		}
	}
	else
	{			//no file selected
		$error="No file selected";
		header('Location: emp_detail.php?error='.$error);
	}
	mysql_close();
?>
