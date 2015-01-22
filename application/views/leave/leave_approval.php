<?php 
if($approve=='Approved')
echo $this->notification->drawNotification('',$remarks,'success');
else
{
	
	echo("<h2 class='page-head'>Please specify the reason for disapproving the leave</h2>");
		echo("
		<form action='leave_disapproval_reason' method='POST'>
		<textarea rows='20' cols='40' name='comment'>
		</textarea>
		<input type='hidden' name='leave_index' value=$id>
		<input type='submit' value='submit'>
		</form>");
}
?>