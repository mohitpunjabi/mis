<?php 
if ($verify == 1)
{
//	function drawNotification($title, $description, $type = "")
	$this->notification->drawNotification("Track Number matched.", "");
}
else
{
//	function drawNotification($title, $description, $type = "")
	$this->notification->drawNotification("Track Number not matched. Try again", "");
}
?>