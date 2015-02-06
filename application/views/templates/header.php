<?php $ui = new UI(); ?>
    <body class="skin-blue">
        <header class="header">
            <a href="<?= site_url("") ?>" class="logo">
                <img src="<?= base_url() ?>assets/images/mis-logo-small.png" />
            </a>

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
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= $this->session->userdata('name') ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?= base_url()."assets/images/".$this->session->userdata('photopath'); ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?= $this->session->userdata('name') ?>
                                        <small>
<?php
		if($this->authorization->is_auth('emp'))
			echo $this->session->userdata('designation').', '.$this->session->userdata('dept_name');
		if($this->authorization->is_auth('stu'))
			echo $this->session->userdata('dept_name');
?>
                                        </small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= site_url('home') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= site_url('login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
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
                            <img src="<?= base_url()."assets/images/".$this->session->userdata('photopath'); ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?= $this->session->userdata('name'); ?></p>

                            <a href="#"><i class="glyphicon glyphicon-user"></i> <?= $this->session->userdata('id'); ?></a>
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
                    
<?php

			function _drawNavbarMenuItem($mi) {
				foreach($mi as $key => $val) {
					$arrow = (is_array($val))? ' <i class="fa fa-angle-right pull-right"></i>': "";
					$treeview =  (is_array($val))? 'class="treeview"': "";
					echo '<li '.$treeview.'><a href="'.((is_string($val))? $val: "#").'">'.$arrow.$key.'</a>';

					if(is_array($val)) {
						echo '<ul class="treeview-menu">';
						_drawNavbarMenuItem($val);
						echo '</ul>';
					}

					echo '</li>';
				}
			}

			$dateTimeZone = new DateTimeZone('Asia/Kolkata');
			foreach($menu as $key => $val) {
				$unreadCount = 0;
				$readCount = 0;
				
				if(count($val) == 0) continue;

				if(isset($notifications[$key]["unread"])) $unreadCount = count($notifications[$key]["unread"]);
				if(isset($notifications[$key]["read"])) $readCount = count($notifications[$key]["read"]);
				?>
                
                        <li class="treeview">
                            <a href="#">
								<i class="fa fa-angle-right"></i>
                                <span><?= ucfirst($authKeys[$key]) ?></span>
                                <small class="badge pull-right <?php if($unreadCount > 0) echo "bg-red"; ?>"><?= $unreadCount ?></small>                                
                            </a>
                            <ul class="treeview-menu">
                            	<?= _drawNavbarMenuItem($val); ?>
                            </ul>
                        </li>

				<?php
/*
				echo '<div class="-mis-menu-authtype collapsed">
						<div class="role">'.ucfirst($authKeys[$key]).'</div>';

				if($unreadCount > 0) echo '<span class="-mis-counter active">'.$unreadCount.'</span>';
				else 				 echo '<span class="-mis-counter">'.$unreadCount.'</span>';

				echo '<!-- <div class="notification-drawer">';

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
				echo '</div>';

				if($readCount == 0 && $unreadCount == 0) echo "<center><br />No more notifications.</center>";

				echo '</div> -->';
				

				echo '<ul>';
				_drawNavbarMenuItem($val);
					echo '</ul>';
				echo '</div>';
			}
			*/
		}
		?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?= $title ?>
                        <small><?= $subtitle ?></small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

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