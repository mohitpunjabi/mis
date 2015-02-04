<!DOCTYPE html>
<html>
    <head>
        <title>
        <?php
            if(isset($title))	echo $title;
            else				echo 'MIS - Indian School of Mines';
        ?>
        </title>
 	    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?= base_url() ?>assets/core/bootstrap-3.3.2/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/core/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/core/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/core/adminLTE/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    	<link href="<?= base_url() ?>assets/core/adminLTE/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/core/img_upload/upload_image.css" rel="stylesheet" type="text/css" />
<!--		<link href="<?= base_url() ?>assets/core/mis-layout.css" rel="stylesheet" type="text/css" /> -->
		<?php if(isset($css)) echo $css; ?>

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?= base_url() ?>assets/core/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/core/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/core/bootstrap-3.3.2/dist/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?= base_url() ?>assets/core/adminLTE/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
		<script src="<?= base_url() ?>assets/core/img_upload/upload_image.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/core/adminLTE/js/AdminLTE/app.js" type="text/javascript"></script>
<!--		<script src="<?= base_url() ?>assets/core/mis-layout.js" type="text/javascript"></script> -->
		<script type="text/javascript">
            function base_url()	{ return "<?= base_url()?>"; }
            function site_url(uri) { return base_url() + "index.php/" + uri; }
        </script>
	    <?php if(isset($javascript)) echo $javascript; ?>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../../index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                AdminLTE
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Jane Doe <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../../img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Jane Doe - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../../img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Jane</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="../../index.html">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="../widgets.html">
                                <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Charts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                                <li><a href="../charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                                <li><a href="../charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                            </ul>
                        </li>
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>UI Elements</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
                                <li><a href="icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
                                <li><a href="buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                                <li><a href="sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                                <li><a href="timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                                <li><a href="../forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                                <li><a href="../forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Tables</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                <li><a href="../tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="../calendar.html">
                                <i class="fa fa-calendar"></i> <span>Calendar</span>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="../mailbox.html">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Examples</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="../examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                <li><a href="../examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                <li><a href="../examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                                <li><a href="../examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                                <li><a href="../examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                                <li><a href="../examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        General UI
                        <small>Preview of UI elements</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
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
				
				if(count($val) == 0) continue;
				
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