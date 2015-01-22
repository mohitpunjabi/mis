<?php

if($var==TRUE)
	$this->notification->drawNotification('',$desc,'success');
else
	$this->notification->drawNotification('',$desc,'error');
?>