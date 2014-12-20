<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
	<?php
		if(isset($title))	echo $title;
		else	echo 'MIS - Indian School of Mines';
	?>
	</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/mis-layout.css" />
	<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/mis-layout.js"></script>
    <?php
    	if(isset($javascript))
    		echo $javascript;
	?>
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
        	<a href="#">Logout</a>
        </div>
        <div class="-mis-right-options">
            <a href="#">$_SESSION['name']</a>
        </div>
		<div class="-mis-right-options">

<?php
/*			if(is_auth("emp"))
	        	echo '<img src="'.WEBSITE_ROOT.'/employee/Images/'.$_SESSION['id'].'/'.$_SESSION['photopath'].'" class="small-profile-thumb" />';
			else if(is_auth("stu"))
	        	echo '<img src="'.WEBSITE_ROOT.'/student/Images/'.$_SESSION['id'].'/'.$_SESSION['photopath'].'" class="small-profile-thumb" />';
*/
?>
	Image to be shown using session
        </div>
    </div>

	<div class="-mis-navbar">
    	<div class="-mis-profile-photo">
<?php
/*
			if(is_auth("emp"))
	        	echo '<img src="'.WEBSITE_ROOT.'/employee/Images/'.$_SESSION['id'].'/'.$_SESSION['photopath'].'"  />';
			else if(is_auth("stu"))
	        	echo '<img src="'.WEBSITE_ROOT.'/student/Images/'.$_SESSION['id'].'/'.$_SESSION['photopath'].'"  />';
*/
?>

    		<div class="-mis-profile-details">
<?php
        //echo "<h2>$_SESSION['name']</h2>";
    	//echo "<span><strong>$_SESSION['id']</strong></span><br />";
/*
		if(is_auth('emp'))
            echo '<span>'.$_SESSION['designation'].', '.$_SESSION['dept_name'].'</span><br /><br />';
		else if(is_auth('stu'))
            echo '<span>'.$_SESSION['dept_name'].'</span><br /><br />';
*/
?>
    		</div>
		</div>
	<?php //	_drawNavbarMenu();	?>

    </div>

    <div class="-mis-content">
    	<div class="flash-data">
    		<?php
    			if($this->session->flashdata('flashSuccess'))
					echo "<p class='notification success'>".$this->session->flashdata('flashSuccess')."</p>";
				if($this->session->flashdata('flashError'))
					echo "<p class='notification error'>".$this->session->flashdata('flashError')."</p>";
				if($this->session->flashdata('flashInfo'))
					echo "<p class='notification '>".$this->session->flashdata('flashInfo')."</p>";
				if($this->session->flashdata('flashWarning'))
					echo "<p class='notification warning'>".$this->session->flashdata('flashWarning')."</p>";
			?>
		</div>