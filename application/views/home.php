<? $ui = new UI();

	$row = $ui->row()->open();
		$eventsCol = $ui->col()->width(8)->open();
			$eventsTabBox = $ui->tabBox()
						   	   ->tab("notices", $ui->icon("info-circle") ." Notices" . ' <small class="badge bg-red">2</small>', true) // 'true' means active
						   	   ->tab("circulars", $ui->icon("file-text-o") . " Circulars")
						   	   ->tab("minutes", $ui->icon("users") . " Meetings "  . ' <small class="badge bg-red">12</small>')
						       ->open();
							   
				$noticesTab = $ui->tabPane()
								 ->id("notices")
								 ->active()
								 ->open();
					?>
                           <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-blue">
                                        14 Feb 2014
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-info-circle"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                        <h3 class="timeline-header"><a href="#">Dr. Chiranjeev Kumar</a><br />Head of Department, Computer Science and Engineering</h3>
                                        <div class="timeline-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab.
                                        </div>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-primary btn-xs">Download Attachments</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-user bg-aqua"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-comments bg-yellow"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-green">
                                        3 Jan. 2014
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class='margin' />
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-video-camera bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                                        <div class="timeline-body">
                                            <iframe width="300" height="169" src="//www.youtube.com/embed/fLe_qO4AE-M" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-xs bg-maroon">See comments</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                </li>
                            </ul>
					<?
				$noticesTab->close();
				
				$circularsTab = $ui->tabPane()
								 ->id("circulars")
								 ->open();
?>
                           <ul class="timeline">
                                <li class="time-label">
                                    <span class="bg-green">
                                        3 Jan. 2014
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class='margin' />
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-video-camera bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                                        <div class="timeline-body">
                                            <iframe width="300" height="169" src="//www.youtube.com/embed/fLe_qO4AE-M" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-xs bg-maroon">See comments</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                </li>
                            </ul>
<?
				$circularsTab->close();
				
				$minutesTab = $ui->tabPane()
								 ->id("minutes")
								 ->open();
?>
<?
				$minutesTab->close();
			$eventsTabBox->close();
?>
<?php foreach($notices as $key => $notice) { ?>

<div class="notice">
	<div class="sender-info">
        <div class="dp">
            <img src="<?= base_url()."assets/images/".$notice->photopath; ?>" />
        </div>
        <div class="sender">
            <p class="sender-designation"><?= ucwords($notice->auth_name) ?>, <?= $notice->department ?></p>
            <p class="sender-name"><?= $notice->salutation ?> <?= $notice->first_name ?> <?= $notice->middle_name ?> <?= $notice->last_name ?></p>
            <p class="notice-date"><?= date_format(new DateTime($notice->posted_on), "d M Y h:m:s") ?></p>
        </div>
    </div>
    
    <div class="notice-content">
    	<div class="content">
			<?= $notice->notice_sub ?>
        </div>
        	
        <div class="attachments">
        	<a href="<?= base_url()."assets/files/information/notice/".$notice->notice_path ?>">Download attachment</a>
        </div>
    </div>    
    
</div>


<?php } 
?>



<?
		$eventsCol->close();

		$calendarCol = $ui->col()->width(4)->open();
			$calendar = $ui->box()
						   ->solid()
						   ->containerClasses("bg-blue-gradient")
						   ->title("Calendar")
						   ->icon($ui->icon("calendar"))
						   ->open();
				?><div id="calendar"></div><?
			$calendar->close();
		$calendarCol->close();
		
	$row->close();
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#calendar").datepicker();
	});
</script>