<?php	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("connectDB.php");

	$qry = "UPDATE user_details SET
					salutation='".($_POST['salutation'])."',
					first_name='".(strtolower($_POST['firstname']))."',
					middle_name='".(strtolower($_POST['middlename']))."',
					last_name='".(strtolower($_POST['lastname']))."',
					sex='".(strtolower($_POST['sex']))."',
					category='".(strtolower($_POST['category']))."',
					dob='".$_POST['dob']."',
					email='".($_POST['email'])."',
					marital_status='".(strtolower($_POST['mstatus']))."',
					physically_challenged='".(strtolower($_POST['pd']))."',
					dept_id='".$_POST['department']."' 
			WHERE id='".$_POST['stu_id']."'";	
	$presult = mysql_query($qry);

	$qry = "UPDATE user_other_details SET
					religion='".(strtolower($_POST['religion']))."',
					nationality='".(strtolower($_POST['nationality']))."',
					kashmiri_immigrant='".$_POST['kashmiri']."',
					hobbies='".(strtolower($_POST['hobbies']))."',
					fav_past_time='".(strtolower($_POST['favpast']))."',
					birth_place='".(strtolower($_POST['pob']))."',
					mobile_no='".($_POST['mobile'])."',
					father_name='".(strtolower($_POST['father_name']))."',
					mother_name='".(strtolower($_POST['mother_name']))."'
			WHERE id='".$_POST['stu_id']."'";
	$uresult = mysql_query($qry);
	
	if($presult)
		echo "some error found.7";
	if($uresult)
		echo "some error found.8";

	if($presult && $uresult )
	{
		echo "some error found.2";
		$qry = "UPDATE user_address
				SET line1='".$_POST['line11']."',
					line2='".$_POST['line21']."',					
				    city='".$_POST['city1']."',
					state='".$_POST['state1']."',
					pincode='".$_POST['pincode1']."',
					country='".$_POST['country1']."',
					contact_no='".$_POST['contact1']."' 
				WHERE	id='".$_POST['stu_id']."' AND type='present'";
		$result1 = mysql_query($qry);

		$qry = "UPDATE user_address
				SET line1='".$_POST['line13']."',
					line2='".$_POST['line23']."',					
				    city='".$_POST['city3']."',
					state='".$_POST['state3']."',
					pincode='".$_POST['pincode3']."',
					country='".$_POST['country3']."',
					contact_no='".$_POST['contact3']."' 
				WHERE	id='".$_POST['stu_id']."' AND type='permanent'";
		$result2 = mysql_query($qry);

		if($_POST['line21'])
		{
			echo "some error found.1";
			$qry = "UPDATE user_address
					SET line1='".$_POST['line12']."',
						line2='".$_POST['line22']."',					
				    	city='".$_POST['city2']."',
						state='".$_POST['state2']."',
						pincode='".$_POST['pincode2']."',
						country='".$_POST['country2']."',
						contact_no='".$_POST['contact2']."' 
					WHERE	id='".$_POST['stu_id']."' AND type='correspondance'";
			$result3 = mysql_query($qry);
		}
		
		if($result1 && $result2 && $result3)
		{
			echo "some error found.";
			header('Location: index.php?update='.$_POST['stu_id']);
		}
		else
		{
			echo "some error found.4";
			echo mysql_error();		
		}
	}
	else
	{
		echo "some error found.3";
		echo mysql_error();		
	}
	mysql_close();
?>