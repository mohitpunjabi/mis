<?php
if($emp_education_details)
{
	echo '<br>';
	if($emp_validation_details)
	{
		if($emp_validation_details->educational_status=='pending')
			$this->notification->drawNotification("Pending : Educational Qualifications","Educational Qualifications are not yet validated.");
		else if($emp_validation_details->educational_status=='rejected')
		{
			$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 4));
			$this->notification->drawNotification("Rejected : Educational Qualifications","Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""),"error");
		}
	}
	echo '<br><center><h2>Employee Education Details</h2>';
	echo '<table align="center" width="90%">
			<tr>
			 <th>Examination</th>
		     <th>Course(Specialization)</th>
		   	 <th>College/University/Institute</th>
		     <th>Year</th>
		     <th>Percentage/Grade</th>
		     <th>Class/Division</th>
			</tr>';

	foreach($emp_education_details as $row)
	{
		echo '<tr>
				<td>'.strtoupper($row->exam).'</td>
		    	<td>'.strtoupper($row->branch).'</td>
		    	<td>'.strtoupper($row->institute).'</td>
		    	<td>'.$row->year.'</td>
		    	<td>'.strtoupper($row->grade).'</td>
		    	<td>'.ucwords($row->division).'</td>
			</tr>';
	}
	echo "</table></center>";
}
else
{
	if($form==3)
	{
		echo '<br><center><h2>Employee Education Details</h2>';
		$this->notification->drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
	}
}
?>