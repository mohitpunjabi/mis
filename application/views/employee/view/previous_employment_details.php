<?php
if($emp_prev_exp_details)
{
	echo '<br>';
	if($emp_validation_details)
	{
		if($emp_validation_details->prev_exp_status=='pending')
			$this->notification->drawNotification("Pending : Previous Employment Details","Previous Employment Details are not yet validated.");
		else if($emp_validation_details->prev_exp_status=='rejected')
		{
			$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 2));
			$this->notification->drawNotification("Rejected : Previous Employment Details","Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""),"error");
		}
	}
	echo '<br><center><h2>Previous Employment Details</h2>';
	echo '<table align="center" width="90%">
		<tr>
	        <th>Full address of Employer</th>
			<th>Position held</th>
	        <th>Date of joining</th>
	        <th>Date of leaving</th>
	        <th>Pay Scale</th>
	        <th>Remarks</th>
		</tr>';
	foreach($emp_prev_exp_details as $row)
	{
		if($row->remarks == "")	$remarks='NA';
		else	$remarks = $row->remarks;
		echo '<tr>
				<td>'.ucwords($row->address).'</td>
	    		<td>'.ucwords($row->designation).'</td>
		    	<td>'.date('d M Y', strtotime($row->from)).'</td>
		    	<td>'.date('d M Y', strtotime($row->to)).'</td>
		    	<td>'.$row->pay_scale.'</td>
    			<td>'.ucfirst($remarks).'</td>
			</tr>';
	}
	echo "</table></center>";
}
else
{
	if($form==1)
	{
		echo '<br><center><h2>Previous Employment Details</h2>';
		$this->notification->drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
	}
}
?>