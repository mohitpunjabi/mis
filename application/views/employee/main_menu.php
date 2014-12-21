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

<?php
	// $password = 'p';
	// $password = $this->authorization->strclean($password);
	// echo $password;
	// echo $this->authorization->encode_password($password,'2014-12-04 00:42:28');
	// print_r($this->session->all_userdata());

?>