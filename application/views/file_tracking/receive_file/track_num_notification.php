<?php 
if ($verify == 1)
{
//	function drawNotification($title, $description, $type = "")
	$this->notification->drawNotification("Track Number matched.", "");
?>

<?php //echo form_open (); ?> 
<!--<h1>Sending Details : </h1>
<table nozebra>
	<tr>
		<td>Employee ID : </td>
		<td> 
			<input type="text" name="emp_id" id="emp_id"> 
			<input type="button" value="Send" onClick="display_send_notification2()">
		</td>
	</tr>
	<tr>
		<td>
			<div id="send_notification"></div>
		</td>
		<td></td>
	</tr>
</table>
-->
<?php
}
else
{
//	function drawNotification($title, $description, $type = "")
	$this->notification->drawNotification("Track Number not matched. Try again", "");
}
?>