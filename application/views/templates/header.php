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
	<?php 	if(isset($css))	echo $css;	?>

	<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/mis-layout.js"></script>
	<script >
		function base_url()	{	return "<?= base_url()?>";	}
		function site_url(uri)	{	return base_url()+"index.php/"+uri;	}
	</script>
    <?php 	if(isset($javascript))	echo $javascript;	?>
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
        	<a href="<?= site_url('home') ?>"><?= $this->session->userdata('name') ?></a>
        </div>
		<div class="-mis-right-options">
			<img src="<?= base_url()."assets/images/".$this->session->userdata('photopath') ?>" class="small-profile-thumb" />
        </div>
    </div>

	<div class="-mis-navbar">
    	<div class="-mis-profile-photo">
			<img src="<?= base_url()."assets/images/".$this->session->userdata('photopath'); ?>" />
    		<div class="-mis-profile-details">

            <h2><?= $this->session->userdata('name') ?></h2>
            <span><strong><?= $this->session->userdata('id') ?></strong></span><br />
            <span>
<?php
		if($this->authorization->is_auth('emp'))
			echo $this->session->userdata('designation').', '.$this->session->userdata('dept_name');
		if($this->authorization->is_auth('stu'))
			echo $this->session->userdata('dept_name');
?>
			</span><br /><br />
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
			$dateTimeZone = new DateTimeZone('Asia/Kolkata');

			foreach($menu as $key => $val) {
				$unreadCount = 0;
				$readCount = 0;
				
				if(isset($notifications[$key]["unread"])) $unreadCount = count($notifications[$key]["unread"]);
				if(isset($notifications[$key]["read"])) $readCount = count($notifications[$key]["read"]);

				echo '<div class="-mis-menu-authtype collapsed">
						<div class="role">'.ucfirst($authKeys[$key]).'</div>';

				if($unreadCount > 0) echo '<span class="-mis-counter active">'.$unreadCount.'</span>';
				else 				 echo '<span class="-mis-counter">'.$unreadCount.'</span>';

				echo '<div class="notification-drawer">';

				echo '<div class="unread">';
				if($unreadCount > 0) {
					echo '<h3>Unread Notifications &raquo;</h3>';
					foreach($notifications[$key]["unread"] as $row) {
					
					$dateTime = new DateTime();
					$dateTime->setTimestamp(strtotime($row->send_date));
					$dateTime->setTimeZone($dateTimeZone);
					
					
					$this->notification->drawNotification(ucwords($row->title), $row->description, $row->type, $row->path, $dateTime->format('m/d/Y H:i A'), base_url().'assets/images/'.$row->photopath);
					}
				}
				echo '</div>';


				echo '<div class="read">';
				if($readCount > 0) {
					echo '<h3>Old Notifications &raquo;</h3>';
					foreach($notifications[$key]["read"] as $row) {
						$dateTime = new DateTime();
						$dateTime->setTimestamp(strtotime($row->send_date));
						$dateTime->setTimeZone($dateTimeZone);

						$this->notification->drawNotification(ucwords($row->title), $row->description, $row->type, $row->path, $dateTime->format('m/d/Y H:i A'), base_url().'assets/images/'.$row->photopath);
					}
				}
				echo '</div>';

				if($readCount == 0 && $unreadCount == 0) echo "<center><br />No more notifications.</center>";

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