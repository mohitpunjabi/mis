<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
</head>
<body>
	<?php
		if($entry === FALSE)
			echo "<h2><a href = \"".site_url('employee/add/step')."\" >Add Employee</a></h2>";
		else
		{
			echo "<h2><a href = \"".site_url('employee/add/step/'.$entry->curr_step.'/'.$entry->id)."\" >Add Employee</a></h2>";
			echo "(Continue with Employee ".$entry->id.")";
		}
	?>
	<br>
	<h2><a href = "<?php echo site_url('employee/edit'); ?>" >Edit Employee Details</a></h2>
	<br>
	<h2><a href = "<?php echo site_url('employee/view'); ?>" >View Employee Details</a></h2>
	<br>
	<h2><a href = "<?php echo site_url('employee/validation_requests'); ?>" >Employee Validation Requests</a></h2>

<!--	If not DEO
	<br>
	<h2><a href = "<?php echo site_url_extended('employee/show_emp'); ?>" >View Employee Details</a></h2>
-->
</body>
</html>
