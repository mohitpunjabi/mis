<h1 align="center">Validation Requests</h1><br>
<?php
	if(!$emp_validation_details)
	{
		drawNotification("No Pending Requests","There are no pending requests.");
	}else{
?>
<table align="center">
	<tr>
		<th rowspan='2'>Employee Id</th>
		<th rowspan='2'>Employee Name</th>
		<th colspan='6'>Status</th>
	</tr>
	<tr>
		<th>Profile Pic</th>
		<th>Basic Details</th>
		<th>Previous Employment Details</th>
		<th>Dependent Family Member Details</th>
		<th>Educational Details</th>
		<th>Last 5 Year Stay Details</th>
	</tr>
	<?php
		$i=0;
		foreach($emp_validation_details as $v_row)
		{
			$i++;
			$user = $this->user_details_model->getUserById($v_row->id);
			$emp_name = ucwords($user->salutation.' '.$user->first_name.(($user->middle_name != '')? ' '.$user->middle_name: '').(($user->last_name != '')? ' '.$user->last_name: ''));
			echo "<tr>
					<td align=\"center\" >".$v_row->id."</td>
					<td align=\"center\">".$emp_name."</td>";

			//profile picture step
			if($v_row->profile_pic_status=='pending')
			{
				echo "<td align=\"center\" style=\"background:#DDF;\" >";
				if($this->authorization->is_auth('est_ar'))
					echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/0")."'>".ucwords($v_row->profile_pic_status)."</a></td>";
				else
					echo ucwords($v_row->profile_pic_status)."</td>";
			}
			else if($v_row->profile_pic_status=='rejected')
			{
				echo "<td align=\"center\" style=\"background:#FDD;\" ><a onclick=\"reject_reason('0".$i."')\" >".ucwords($v_row->profile_pic_status)."</a></td>";
				$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 0));
				echo "<div id='rejected0".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
			}
			else
				echo "<td align=\"center\" style=\"background:#DFD;\" >".ucwords($v_row->profile_pic_status)."</td>";

			//basic details step
			if($v_row->basic_details_status=='pending')
			{
				echo "<td align=\"center\" style=\"background:#DDF;\" >";
				if($this->authorization->is_auth('est_ar'))
					echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/1")."'>".ucwords($v_row->basic_details_status)."</a></td>";
				else
					echo ucwords($v_row->basic_details_status)."</td>";
			}
			else if($v_row->basic_details_status=='rejected')
			{
				echo "<td align=\"center\" style=\"background:#FDD;\" ><a onclick=\"reject_reason('1".$i."')\" >".ucwords($v_row->basic_details_status)."</a></td>";
				$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 1));
				echo "<div id='rejected1".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
			}
			else
				echo "<td align=\"center\" style=\"background:#DFD;\" >".ucwords($v_row->basic_details_status)."</td>";


			//previous emp details step
			if($v_row->prev_exp_status=='pending')
			{
				echo "<td align=\"center\" style=\"background:#DDF;\" >";
				if($this->authorization->is_auth('est_ar'))
					echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/2")."'>".ucwords($v_row->prev_exp_status)."</a></td>";
				else
					echo ucwords($v_row->prev_exp_status)."</td>";
			}
			else if($v_row->prev_exp_status=='rejected')	//changes to be done in rejected
			{
				echo "<td align=\"center\" style=\"background:#FDD;\" ><a onclick=\"reject_reason('2".$i."')\" >".ucwords($v_row->prev_exp_status)."</a></td>";
				$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 2));
				echo "<div id='rejected2".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
			}
			else
				echo "<td align=\"center\" style=\"background:#DFD;\" >".ucwords($v_row->prev_exp_status)."</td>";


			//family details step
			if($v_row->family_details_status=='pending')
			{
				echo "<td align=\"center\" style=\"background:#DDF;\" >";
				if($this->authorization->is_auth('est_ar'))
					echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/3")."'>".ucwords($v_row->family_details_status)."</a></td>";
				else
					echo ucwords($v_row->family_details_status)."</td>";
			}
			else if($v_row->family_details_status=='rejected')	//changes to be done in rejected
			{
				echo "<td align=\"center\" style=\"background:#FDD;\" ><a onclick=\"reject_reason('3".$i."')\" >".ucwords($v_row->family_details_status)."</a></td>";
				$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 3));
				echo "<div id='rejected3".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
			}
			else
				echo "<td align=\"center\" style=\"background:#DFD;\" >".ucwords($v_row->family_details_status)."</td>";

			//educational details
			if($v_row->educational_status=='pending')
			{
				echo "<td align=\"center\" style=\"background:#DDF;\" >";
				if($this->authorization->is_auth('est_ar'))
					echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/4")."'>".ucwords($v_row->educational_status)."</a></td>";
				else
					echo ucwords($v_row->educational_status)."</td>";
			}
			else if($v_row->educational_status=='rejected')	//changes to be done in rejected
			{
				echo "<td align=\"center\" style=\"background:#FDD;\" ><a onclick=\"reject_reason('4".$i."')\" >".ucwords($v_row->educational_status)."</a></td>";
				$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 4));
				echo "<div id='rejected4".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
			}
			else
				echo "<td align=\"center\" style=\"background:#DFD;\" >".ucwords($v_row->educational_status)."</td>";

			//last 5 yr stay details step
			if($v_row->stay_status=='pending')
			{
				echo "<td align=\"center\" style=\"background:#DDF;\" >";
				if($this->authorization->is_auth('est_ar'))
					echo "<a href='".site_url("employee/validation/validate_step/".$v_row->id."/5")."'>".ucwords($v_row->stay_status)."</a></td>";
				else
					echo ucwords($v_row->stay_status)."</td>";

			}
			else if($v_row->stay_status=='rejected')	//changes to be done in rejected
			{
				echo "<td align=\"center\" style=\"background:#FDD;\" ><a onclick=\"reject_reason('5".$i."')\" >".ucwords($v_row->stay_status)."</a></td>";
				$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$v_row->id, 'step'=> 5));
				echo "<div id='rejected5".$i."' style='display:none'>".(($reject)? $reject->reason:"")."</div>";
			}
			else
				echo "<td align=\"center\" style=\"background:#DFD;\" >".ucwords($v_row->stay_status)."</td>";
			echo "</tr>";
		}
	?>
</table>
<?php } ?>