<?php
	require_once("Auth.php");
	
	function drawHeader($title = "Feedback System - Indian School of Mines") {
		echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$title.'</title>


<link rel="stylesheet" type="text/css" href="'.WEBSITE_ROOT.'/../css/mis-layout.css" />
<script type="text/javascript" src="'.WEBSITE_ROOT.'/../js/jquery.js"></script>
<script type="text/javascript" src="'.WEBSITE_ROOT.'/../js/mis-layout.js"></script>
</head>

<body>
	<div class="-mis-search-bar">
		<div class="-mis-logo"></div>
    	<div class="-mis-search-button">
            <form id="-mis-search-form">
            <input type="text" name="-mis-search-text" class="-mis-search-text" placeholder="Enter text to search for" />
            <input type="submit" name="-mis-search-submit" value="Search" />
            </form>
        </div>
		<div class="-mis-right-options">
        	<a href="'.WEBSITE_ROOT.'/Logout.php">Logout</a>
        </div>
        <div class="-mis-right-options">
            <a href="AccountFunctions.php">'.$_SESSION['SESS_NAME'].'</a>
        </div>        
		<div class="-mis-right-options">
        	<img src="'.WEBSITE_ROOT.'/Images/'.$_SESSION['SESS_PHOTOPATH'].'" class="small-profile-thumb" />
        </div>
    </div>
    ';
	
	echo
	'
	
    
    <div class="-mis-navbar">
    	<div class="-mis-profile-photo">
        	<img src="'.SERVER_NAME.'/Images/'.$_SESSION['SESS_PHOTOPATH'].'" />
            <div class="-mis-profile-details">
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
    
    <div class="-mis-content">
		';
	}
	
	
	function drawFooter() {
		echo '
    </div>
	
    <div class="-mis-footer">
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