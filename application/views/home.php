<?php
	echo '<h1 class="page-head">Modules</h1>';
	echo '<h2><a href = "'.site_url('employee/menu').'" >Employee Management</a></h2>';

	echo '<h2>The session variable:</h2>';
	echo '<pre>';
	var_export($this->session->all_userdata());
	echo '</pre>';

?>