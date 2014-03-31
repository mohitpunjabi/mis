<?php
	define('FB_DB_HOST', 'localhost');
    define('FB_DB_USER', 'root');
    define('FB_DB_PASSWORD', '');
    define('FB_DB_DATABASE', 'feedback_mis');

	$fb_mysqli = new mysqli(FB_DB_HOST, FB_DB_USER, FB_DB_PASSWORD, FB_DB_DATABASE);