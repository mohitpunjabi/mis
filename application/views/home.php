<style>
.notice {
	width: 600px;
	margin: 20px auto;
	left: 0;
	right: 0;
	height: auto;
	border: rgb(102,102,102) 1px solid;
	background-color: #FAFAFA;
	text-align: left;
}

.sender-info {
	height: auto;
}

.sender-info .dp {
	display: inline-block;
	margin: 10px;
	margin-right: 0px;
	vertical-align: top;
}

.sender-info .dp img {
	height: 80px;
}

.sender-info .sender {
	display: inline-block;
	margin: 10px;
	vertical-align: top;
}

.sender p {
	margin: 0;
	padding: 0;
}

.sender .sender-designation {
	font-size: 14px;
	font-weight: 100;
	color: #888;
}

.sender .sender-name {
	font-size: 26px;
	margin: -4px 0px;
}

.sender .notice-date {
	font-size: 12px;
	color: #AAA;
}

.notice-content {
	width:100%;
	height:auto;
}

.notice-content .content {
	margin: 10px;
	height:auto;
	font-size:14px;
}

.notice-content .attachments {
	height: auto;
}

.notice-content .attachments a {
	display: block;
	border-top: rgb(102,102,102) 1px solid;	
	text-align: right;
	padding: 5px;
	font-size: 14px;
	line-height: 14px;
	background: #001A7C;
	color: #FFF;
}

.notice-content .attachments a:hover {
	text-decoration: none;
	background: #00094A;
}
</style>	
</head>

<body>

<h1 class="page-head">You have 2 notices</h1>

<div class="notice">
	<div class="sender-info">
        <div class="dp">
            <img src="<?php echo base_url(); ?>assets/images/cksir.PNG" />
        </div>
        <div class="sender">
            <p class="sender-designation">Head of Department, Computer Science and Engineering</p>
            <p class="sender-name">Dr. Chiranjeev Kumar</p>
            <p class="notice-date">Jan 11 2015, 2:30 PM</p>
        </div>
    </div>
    
    <div class="notice-content">
    	<div class="content">
        	This is to inform all the students that <em>Buffered Reader v2.0</em> is being released in the Department of Computer Science and Engineering. Everyone is requested to reach <strong>Penman Auditorium on February 1, 2015 at 6:00 pm.</strong>
        </div>
        	
        <div class="attachments">
        	<a href="#">Download attachment</a>
        </div>
    </div>    
    
</div>


<div class="notice">
	<div class="sender-info">
        <div class="dp">
            <img src="<?php echo base_url(); ?>assets/images/cksir.PNG" />
        </div>
        <div class="sender">
            <p class="sender-designation">Head of Department, Computer Science and Engineering</p>
            <p class="sender-name">Dr. Chiranjeev Kumar</p>
            <p class="notice-date">Jan 11 2015, 2:30 PM</p>
        </div>
    </div>
    
    <div class="notice-content">
    	<div class="content">
        	This is to inform all the students that <em>Buffered Reader v2.0</em> is being released in the Department of Computer Science and Engineering. Everyone is requested to reach <strong>Penman Auditorium on February 1, 2015 at 6:00 pm.</strong>
        </div>
        	
        <div class="attachments">
        	<a href="#">Download attachment</a>
        </div>
    </div>    
    
</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#loadMoreNotices").click(function() {
		$("#loadMoreNotices").hide();
		$(".more-notices").html("<i class='loading'></i>");
	});
});
</script>
<center>
<div class="more-notices"><a id="loadMoreNotices" href="#">Load older notices</a></div>
</center>