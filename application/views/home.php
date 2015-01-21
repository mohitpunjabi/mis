<div class="feed-container">

<div id="TabbedPanels1" class="TabbedPanels">

  <ul class="TabbedPanelsTabGroup"> <!-- Tab headings -->
    <li class="TabbedPanelsTab" tabindex="0">Notice <span class="-mis-counter active">6</span></li>
    <li class="TabbedPanelsTab" tabindex="0">Events</li>
    <li class="TabbedPanelsTab" tabindex="0">Circulars <span class="-mis-counter active">2</span></li>
  </ul>
  
  <div class="TabbedPanelsContentGroup"> <!-- Contents of respective tabs -->
    <div class="TabbedPanelsContent">
      <div class="notice">
            <div class="sender-info">
                <div class="dp">
                    <img src="MIS_files/emp_1050_dr_gs.jpg">
                </div>
                <div class="sender">
                    <p class="sender-designation">Assistant Registrar, Establishment Section</p>
                    <p class="sender-name">Dr Gopal  Sinha</p>
                    <p class="notice-date">19 Jan 2015</p>
                </div>
            </div>
            
            <div class="notice-content">
                <div class="content">
                    This is to inform that something important is happening somewhere in 
        Indian School of Mines, Dhanbad. Every one is requested to visit.       
         </div>
                    
                <div class="attachments">
                    <a href="http://localhost/mis/assets/files/information/notice/NOTICE_201501190906208.pdf">Download attachment</a>
                </div>
            </div>    
      </div> <!-- Notice ends -->
      
      <div class="notice">
            <div class="sender-info">
                <div class="dp">
                    <img src="MIS_files/emp_1050_dr_gs.jpg">
                </div>
                <div class="sender">
                    <p class="sender-designation">Assistant Registrar, Establishment Section</p>
                    <p class="sender-name">Dr Gopal  Sinha</p>
                    <p class="notice-date">19 Jan 2015</p>
                </div>
            </div>
            
            <div class="notice-content">
                <div class="content">
                    This is to inform that something important is happening somewhere in 
        Indian School of Mines, Dhanbad. Every one is requested to visit.       
         </div>
                    
                <div class="attachments">
                    <a href="http://localhost/mis/assets/files/information/notice/NOTICE_201501190906208.pdf">Download attachment</a>
                </div>
            </div>    
      </div> <!-- Notice ends -->
      
      <div class="notice">
            <div class="sender-info">
                <div class="dp">
                    <img src="MIS_files/emp_806_ism%252520logo_002.jpg">
                </div>
                <div class="sender">
                    <p class="sender-designation">Associate Professor, Computer Science and Engineering</p>
                    <p class="sender-name">Dr Chiranjeev  Kumar</p>
                    <p class="notice-date">17 Jan 2015</p>
                </div>
            </div>
            
            <div class="notice-content">
                <div class="content">
                    Test Notice 1 Subject        </div>
                    
                <div class="attachments">
                    <a href="http://localhost/mis/assets/files/information/notice/Notice_2015011712512212.pdf">Download attachment</a>
                </div>
            </div>   
      </div>  <!-- Notice ends -->
        
    </div>
    
    <div class="TabbedPanelsContent">
      <div class="notice">
            <div class="sender-info">
                <div class="dp">
                    <img src="MIS_files/emp_806_ism%252520logo_002.jpg">
                </div>
                <div class="sender">
                    <p class="sender-designation">Associate Professor, Computer Science and Engineering</p>
                    <p class="sender-name">Dr Chiranjeev  Kumar</p>
                    <p class="notice-date">17 Jan 2015</p>
                </div>
            </div>
            
            <div class="notice-content">
                <div class="content">
                    Notice Subject 4        </div>
                    
                <div class="attachments">
                    <a href="http://localhost/mis/assets/files/information/notice/NOTICE_201501142333344.pdf">Download attachment</a>
                </div>
            </div>    
        </div>  <!-- Notice ends -->
    </div>
    
    <div class="TabbedPanelsContent">
    	No notices.
    </div>
  </div>
</div>

<div class="calendar">
	<div class="calendar-menu-container">
    	<div class="calendar-menu">
            <span class="calendar-day">Wednesday</span>
            <span class="calendar-date">31</span>
            <div class="calendar-month-year">
                <span class="calendar-month">FEB</span>
                <span class="calendar-year">2021</span>
            </div>
        </div>
    </div>
    <div class="calendar-view">
    	<img src="<?= base_url() ?>assets/images/calendar.png" />
    </div>
</div>



<!--
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

<script type="text/javascript">
$(document).ready(function() {
	$("#loadMoreNotices").click(function() {
		$("#loadMoreNotices").hide();
		$(".more-notices").html("<i class='loading'></i>");
	});
});
</script>
<div class="more-notices"><a id="loadMoreNotices" href="#">Load older notices</a></div>
</center>

-->
