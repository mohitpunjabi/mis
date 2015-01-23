<?php
	if($status=='Approve')
	{
		$this->notification->drawNotification('',$approval_comment,'success');
	}
	else if($status=='Disapprove')
	{
		$desc=$_SERVER['PHP_SELF'];
		echo("<h2 class='page-head'>Please specify the reason for disapproving the leave</h2>");
		echo("
		<form action=$desc method='POST'>
		<textarea rows='5' cols='40' name='comment'>
		</textarea>
		<input type='hidden' name='leave_index' value=$id>
		<input type='submit' name='submit_reason' value='submit'>
		</form>");
	}
	else if($status=='Disapproval_Reason')
	{
		//echo "Hello";
		echo $this->notification->drawNotification('',$remarks,'error');
	}
?>
<div><div><table border="1">
<tr><th>Employee Id</th><th>Employee Name</th><th>Dept-Id</th><th>Designation</th><th>Leave Type</th><th>Starting Period</th><th>Ending Period</th><th>Number of Days</th><th colspan='2'>Type Of Approval</th></tr>
<?php
$info=$leaves_pending_for_approval;
$cnt=$info[0][0];
for($inc=1;$inc<$cnt;$inc++)
{
	$leave_app_id=$info[$inc][0];
	$leave_app_name=$info[$inc][7];
	$leave_app_dept_name=$info[$inc][8];
	$leave_app_desg=$info[$inc][2];
	$leave_name=$info[$inc][3];
	$leave_from=date('d-m-Y',strtotime($info[$inc][4]));
	$leave_to=date('d-m-Y',strtotime($info[$inc][5]));
	$period=$info[$inc][6];
	$num=$info[$inc][9];
	$desc=  $_SERVER['PHP_SELF'];
	$check=0;
	if($status=='Disapprove')
	{
		if($num==$id)
			$check=1;
	}
	if($check!=1){
	echo("<form action=$desc  method='POST'>
<tr><td>".$leave_app_id."</td> <td>".$leave_app_name."</td> 
<td>".$leave_app_dept_name."</td><td>".$leave_app_desg."</td><td>".$leave_name."</td><td>".$leave_from."</td><td>".$leave_to."</td><td>".$period."</td>
	<td><input type='submit' name='approve' value='Approve'></td>
	<td><input type='submit' name='approve' value='Disapprove'></td>
	<input type='hidden' name='id' value=$num>
	</form></tr>");}
}
?>
</table></div></div>