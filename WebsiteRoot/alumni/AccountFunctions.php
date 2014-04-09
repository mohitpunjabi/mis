<?php
	$alumni = array();
	
	if(is_auth('alum')){
		$alumni['View Profile'] = array();
		$alumni['View Profile']['Personal'] = "profile_personal.php";
		$alumni['View Profile']['Work'] = "profile_work.php";
		$alumni['View Academic History'] = "";
		$alumni['Post'] = "post.php";
		$alumni['Message'] = "";
		$alumni['Querybox'] = "";
	}
	if(is_auth('stu')){
		$alumni['Alumni'] = array();
		$alumni['Alumni']['Query'] = "";
		$alumni['Alumni']['Search Alumni'] = "";
		$alumni['Alumni']['Postbox'] = "";
	}
?>