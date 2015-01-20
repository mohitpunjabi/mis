<?php
if($emp_last5yrstay_details)
{
	echo '<br>';
	if($emp_validation_details)
	{
		if($emp_validation_details->stay_status=='pending')
			$this->notification->drawNotification("Pending : Last 5 Year Stay Details","Last 5 Year Stay Details are not yet validated.");
		else if($emp_validation_details->stay_status=='rejected')
		{
			$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 5));
			$this->notification->drawNotification("Rejected : Last 5 Year Stay Details","Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""),"error");
		}
	}
	echo '<br><center><h2>Employee Last 5 Year Stay Details</h2>';
	echo '<table align="center" width="90%">
			<tr>
				<th colspan=2>Duration</th>
			   	 <th rowspan=2>Residential Address</th>
			     <th rowspan=2>Name of District Headquarters</th>
		     </tr>
		     <tr>
		     	<th>From</th>
		      	<th>To</th>
			</tr>';

	foreach($emp_last5yrstay_details as $row)
	{
		echo '<tr align="center">
		    	<td>'.date('d M Y', strtotime($row->from)).'</td>
	    		<td>'.date('d M Y', strtotime($row->to)).'</td>
	    		<td>'.$row->res_addr.'</td>
	    		<td>'.ucwords($row->dist_hq_name).'</td>
		    </tr>';
	}
	echo "</table></center>";
}
else
{

	if($form==4)
	{
		echo '<br><center><h2>Employee Last 5 Year Stay Details</h2>';
		$this->notification->drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
	}
}
?>