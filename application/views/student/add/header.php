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

    <?php 	if(isset($css))	echo $css;	?>
</head>
<body>

	<div class="content">