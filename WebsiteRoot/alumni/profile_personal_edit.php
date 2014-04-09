<?php
	require_once("../Includes/Auth.php");
	auth();
	
	$basarr = get_object_vars(json_decode($_POST['bas']));
	$xplodarr = explode(' ',$basarr['username']);
	$namelen = sizeof($xplodarr);
	$salutation = $xplodarr[0];
	$first_name = $xplodarr[1];
	$middle_name = ($namelen>3)?$xplodarr[2]:'';
	$last_name = $xplodarr[$namelen - 1];
	$sex = (strtoupper($basarr['sex']) == 'MALE')?'m':'f';
	$dob = $basarr['dob'];
	$email = $basarr['email'];
	$marry = $basarr['marry'];
	$handi = $basarr['handicap'];
	if(!($res = $mysqli->query("UPDATE user_details 
								SET salutation = '".$salutation."', first_name = '".$first_name."', middle_name = '".$middle_name."', last_name = '".$last_name."', sex = '".$sex."', dob = '".$dob."', email = '".$email."', marital_status = '".$marry."', physically_challenged = '".$handi."'
								WHERE id = '".$_SESSION['id']."'")))
		echo 'Basic Error Encountered'.$mysqli->error;
	
	$addarr = get_object_vars(json_decode($_POST['add']));
	$contact = $addarr['contact'];
	$father = $addarr['father'];
	$mother = $addarr['mother'];
	$religion = $addarr['religion'];
	$kashmir = $addarr['kashmir'];
	$nation = $addarr['nation'];
	$birth = $addarr['birthplace'];
	if(!($res = $mysqli->query("UPDATE user_other_details 
								SET religion = '".$religion."', nationality = '".$nation."', kashmiri_immigrant = '".$kashmir."', birth_place = '".$birth."', mobile_no = '".$contact."', father_name = '".$father."', mother_name = '".$mother."'
								WHERE id = '".$_SESSION['id']."'")))
		echo 'Additional Error Encountered'.$mysqli->error;
	
	$eduarr = get_object_vars(json_decode($_POST['edu']));
	$course = $eduarr['course'];
	$branch = $eduarr['branch'];
	$batch = $eduarr['batch'];
	if(!($res = $mysqli->query("UPDATE alu_ism_acad 
								SET course_id = '".$course."', branch_id = '".$branch."', pass_year = '".$batch."'
								WHERE id = '".$_SESSION['id']."'")))
		echo 'Additional Error Encountered'.$mysqli->error;
?>