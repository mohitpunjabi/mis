<?php
	echo '<h2>The session variables :</h2>';
	echo '<pre>';
	var_export($this->session->all_userdata());
	echo '</pre>';

?>