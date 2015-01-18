<?php
if($emp_family_details)
{
	echo '<br>';
	if($emp_validation_details)
	{
		if($emp_validation_details->family_details_status=='pending')
			$this->notification->drawNotification("Pending : Dependent Family Member Details","Dependent Family Member Details are not yet validated.");
		else if($emp_validation_details->family_details_status=='rejected')
		{
			$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 3));
			$this->notification->drawNotification("Rejected : Dependent Family Member Details","Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""),"error");
		}
	}
	echo '<br><center><h2>Employee Family Details</h2>';
	echo '<table align="center">
		<tr>
			 <th>Name</th>
		   	 <th>Relationship</th>
			 <th>Date of Birth</th>
		     <th>Profession</th>
		 	 <th>Present Postal Address</th>
			 <th>Photograph</th>
			 <th>Active/Inactive</th>
		</tr>';
	foreach($emp_family_details as $row)
	{
		if($row->active_inactive=="Active")
			$style="background:#DFD";
		else
			$style="background:#FDD";
	echo '<tr align="center" >
				<td>'.ucwords($row->name).'</td>
			    <td>'.$row->relationship.'</td>
				<td>'.date('d M Y', strtotime($row->dob)).'<br>(Age: '.floor((time() - strtotime($row->dob))/(365*24*60*60)).' years)</td>
			    <td>'.ucwords($row->profession).'</td>
			   	<td>'.$row->present_post_addr.'</td>
			    <td><img src="'.base_url().'assets/images/employee/'.$emp_id.'/'.$row->photopath.'" width="145" height="150"/></td>
				<td style="'.$style.'">'.$row->active_inactive.'</td>
	    	</tr>';
	}
	echo "</table></center>";
}
else
{
	if($form==2)
	{
		echo '<br><center><h2>Employee Family Details</h2>';
		$this->notification->drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
	}
}
?>