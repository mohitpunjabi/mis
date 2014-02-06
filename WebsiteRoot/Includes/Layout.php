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
            <a href="AccountFunctions.php">'.$_SESSION['name'].'</a>
        </div>        
		<div class="-mis-right-options">
        	<img src="'.WEBSITE_ROOT.'/Images/'.$_SESSION['photopath'].'" class="small-profile-thumb" />
        </div>
    </div>
    ';
	
	echo
	'
    <div class="-mis-navbar">
    	<div class="-mis-profile-photo">
        	<img src="'.WEBSITE_ROOT.'/Images/'.$_SESSION['photopath'].'" />
            <div class="-mis-profile-details">
                <h2>'.$_SESSION['name'].'</h2>
                <span><strong>'.$_SESSION['id'].'</strong></span><br />
				';
			if(in_array('emp', $_SESSION['auth']))
                echo '<span>'.$_SESSION['designation'].', '.$_SESSION['dept_name'].'</span><br /><br />';
			else if(in_array('st', $_SESSION['auth']))
                echo '<span>, '.$_SESSION['dept_name'].'</span><br /><br />';
	echo'
            </div>
        </div>';

	_drawNavbarMenu();	
		
	echo '
    </div>
    
    <div class="-mis-content">
		';
	}
	
	function _drawNavbarMenu() {
		global $mysqli;
		echo '<ul>
			<li>
				<a href="'.WEBSITE_ROOT .'/home">Home</a>
			</li>
		';
		$result = $mysqli->query("SELECT * FROM modules");
		while($row = $result->fetch_assoc()) {
			include_once("../" . $row["id"] . "/AccountFunctions.php");
			_drawNavbarMenuItem($$row["id"], WEBSITE_ROOT . "/" . $row["id"]);
		}
		echo '</ul>';
	}
	
	function _drawNavbarMenuItem($mi, $basePath) {
		foreach($mi as $key => $val) {
			$arrow = (is_array($val))? 'class="arrow"': "";
			echo "<li $arrow>";
			echo "<a href=\"$basePath/".((is_string($val))? $val: "#")."\">$key</a>";
			if(is_array($val))	{
				echo '<ul>';
				_drawNavbarMenuItem($val, $basePath);
				echo '</ul>';
			}
			echo '</li>';
		}
	}
	
	function currentModule() {
		$urlParts = explode("/", $_SERVER['PHP_SELF']);
		$i = 0;
		for($i = 0; $i < sizeof($urlParts); $i++)
			if(strtolower($urlParts[$i]) == "websiteroot") break;
		
		return $urlParts[$i+1];
	}
	
	
	function drawFooter() {
		echo '
    </div>
	
    <div class="-mis-footer">
    	<a href="#">Indian School of Mines, Dhanbad</a> | 
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