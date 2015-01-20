<h1 class="page-head">You have <?= count($notices) ?> notices</h1>

<center>

<?php 
foreach($notices as $key => $notice) { 

?>

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