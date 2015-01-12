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
        	<a href="<?= site_url('login/logout') ?>">Logout</a>
        </div>
        <div class="-mis-right-options">
        	<?php echo "<a href = \"".site_url('home')."\" >".$this->session->userdata('name')."</a>"; ?>
        </div>
		<div class="-mis-right-options">

<?php
			if($this->authorization->is_auth('emp'))
	        	echo '<img src="'.base_url().'assets/images/employee/'.$this->session->userdata('id').'/'.$this->session->userdata('photopath').'" class="small-profile-thumb" />';
			else if($this->authorization->is_auth('stu'))
	        	echo '<img src="'.base_url().'assets/images/student/'.$this->session->userdata('id').'/'.$this->session->userdata('photopath').'" class="small-profile-thumb" />';

?>
        </div>
    </div>

	<div class="-mis-navbar">
    	<div class="-mis-profile-photo">
<?php

			if($this->authorization->is_auth('emp'))
	        	echo '<img src="'.base_url().'assets/images/employee/'.$this->session->userdata('id').'/'.$this->session->userdata('photopath').'" />';
			else if($this->authorization->is_auth('stu'))
	        	echo '<img src="'.base_url().'assets/images/student/'.$this->session->userdata('id').'/'.$this->session->userdata('photopath').'" />';
?>

    		<div class="-mis-profile-details">
<?php
        echo "<h2>".$this->session->userdata('name')."</h2>";
    	echo "<span><strong>".$this->session->userdata('id')."</strong></span><br />";

		if($this->authorization->is_auth('emp'))
            echo '<span>'.$this->session->userdata('designation').', '.$this->session->userdata('dept_name').'</span><br /><br />';
		if($this->authorization->is_auth('stu'))
            echo '<span>'.$this->session->userdata('dept_name').'</span><br /><br />';

?>
    		</div>
		</div>
		<?php
		function _drawNavbarMenuItem($mi) {
			foreach($mi as $key => $val) {
				$arrow = (is_array($val))? 'class="arrow"': "";
				echo "<li $arrow>";
				echo "<a href=\"".((is_string($val))? $val: "#")."\">$key</a>";
				if(is_array($val)) {
					echo '<ul>';
					_drawNavbarMenuItem($val);
					echo '</ul>';
				}
				echo '</li>';
			}
		}

		if(isset($menu)) {
			foreach($menu as $key => $val) {
				echo '<div class="-mis-menu-authtype collapsed">
						<div class="role">Roles as '.ucfirst($authKeys[$key]).'</div>
						<span class="counter active">42</span>';

				echo '<div class="notification-drawer">';
				if(!$notifications[$key]) $this->notification->drawNotification("No more notifications", "You do not have any unread notifications.");
				else {
					foreach($notifications[$key] as $row) {
						$this->notification->drawNotification(ucwords($row->title), "<b>" . date("d M Y", strtotime($row->send_date)) . "</b>: " . $row->description . " <a href=\"".site_url($row->module_id."/".$row->path)."\">Know more &raquo;</a>", $row->type);
					}
				}
								echo '</div>';
					echo '<ul>';
				_drawNavbarMenuItem($val);
					echo '</ul>';
				echo '</div>';
			}
		}
		?>

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