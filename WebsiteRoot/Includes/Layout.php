<?php
	var_dump($_SERVER);
	$sn = $_SERVER['PHP_SELF'];
	die($sn);

	@session_start();
	define("SERVER_NAME", "http://localhost/ismportal");
	
	function drawHeader($title = "Feedback System - Indian School of Mines") {
		echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$title.'</title>


<link rel="stylesheet" type="text/css" href="'.SERVER_NAME.'/CSS/feedback-layout-style.css" />
<script type="text/javascript" src="'.SERVER_NAME.'/JS/jQuery 1.8.js"></script>
<script type="text/javascript" src="'.SERVER_NAME.'/JS/feedback-layout-script.js"></script>
</head>

<body>
	<div class="-feedback-search-bar">
		<div class="-feedback-logo"></div>
    	<div class="-feedback-search-button">
            <form id="-feedback-search-form">
            <input type="text" name="-feedback-search-text" class="-feedback-search-text" placeholder="Search Feedback" />
            <input type="submit" name="-feedback-search-submit" value="Search" />
            </form>
        </div>
		<div class="-feedback-right-options">
        	<a href="'.SERVER_NAME.'/WebsiteRoot/Logout.php">Logout</a>
        </div>
        <div class="-feedback-right-options">
            <a href="AccountFunctions.php">'.$_SESSION['SESS_NAME'].'</a>
        </div>        
		<div class="-feedback-right-options">
        	<img src="'.SERVER_NAME.'/Images/'.$_SESSION['SESS_PHOTOPATH'].'" class="small-profile-thumb" />
        </div>
    </div>
    ';
	
	echo
	'
	
    
    <div class="-feedback-navbar">
    	<div class="-feedback-profile-photo">
        	<img src="'.SERVER_NAME.'/Images/'.$_SESSION['SESS_PHOTOPATH'].'" />
            <div class="-feedback-profile-details">
                <h2>'.$_SESSION['SESS_NAME'].'</h2>
                <span><strong>'.$_SESSION['SESS_USERNAME'].'</strong></span><br />
                <span>'.$_SESSION['SESS_AUTHFULL'].'</span><br />
				';
			if($_SESSION['SESS_AUTH'] == 'ST')
                echo '<span>'.$_SESSION['SESS_COURSE'].', '.$_SESSION['SESS_BRANCH'].'</span><br /><br />';
			if($_SESSION['SESS_AUTH'] == 'FT' || $_SESSION['SESS_AUTH'] == 'FA')
                echo '<span>'.$_SESSION['SESS_DESIGN'].', '.$_SESSION['SESS_DEPT'].'</span><br /><br />';
	echo'
            </div>
        </div>';
		
		
    echo '<ul>
        	<li><a href="'.SERVER_NAME.'/WebsiteRoot/">Home</a></li>
		  ';
	
		if($_SESSION["SESS_AUTH"] == 'FT') {
        	echo '<li><a href="'.SERVER_NAME.'/WebsiteRoot/employee/show_emp.php">View Details</a></li>';
		}
		if($_SESSION["SESS_AUTH"] == 'DO') {
        	echo '<li>
			<a href="'.SERVER_NAME.'/WebsiteRoot/employee/">Employee Management</a>
				<ul>
					<li><a href="'.SERVER_NAME.'/WebsiteRoot/employee/add_employee.php">Add an employee</a></li>
					<li><a href="'.SERVER_NAME.'/WebsiteRoot/employee/edit_employee.php">Edit employee details</a></li>
					<li><a href="'.SERVER_NAME.'/WebsiteRoot/employee/emp_view.php">View employee Details</a></li>
				</ul>
			</li>';
		}

	echo '
    </div>
    
    <div class="-feedback-content">
		';
	}
	
	
	function drawFooter() {
		echo '
    </div>
	
    <div class="-feedback-footer">
    	<a href="#">Indian School of Mines, Dhanbad</a> | 
    	<a href="#">Student Registration</a> | 
    	<a href="#">Faculty Registration</a> |
    	<a href="#">Developers</a> |
    	<a href="#">Help</a>
    </div>
</body>
</html>
		';
	}
	
	function drawNotification($title, $description, $type = "") {
		echo '
			<div class="notification '.$type.'">
				<h2>'.$title.'</h2>
				'.$description.'
			</div>
		';
	}
?>