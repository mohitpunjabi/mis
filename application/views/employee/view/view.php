<?php $ui = new UI();
echo '<div id="print" >';
	$head = $ui->row()->open();
		$h_col = $ui->col()->width(12)->open();

			//Selecting Initial tab pane.
			if($step < 0 || $step > 5)	$step=5;

			$tabbox = $ui->tabBox()
							->tab('all',$ui->icon('user').'All Details',$step==5)
							->tab('basic_details','Basic Details',$step==0)
							->tab('prev_emp','Previous Employment Details',$step==1)
							->tab('emp_fam','Dependent Family Member Details',$step==2)
							->tab('emp_edu','Educational Qualifications',$step==3)
							->tab('last_five','Last 5 Year Stay Details',$step==4)
							->open();

				$basic = $ui->tabPane()->id('basic_details');
				if($step==0)	$basic->active();
				$basic->open();
					if($emp) {
						$data['name'] = $this->employee_model->getNameById($emp->id);
						$data['deparment']=$this->departments_model->getDepartmentById($emp->dept_id)->name;
    					$data['designation']=$this->designations_model->getDesignationById($emp->designation)->name;
    					$data['address'] = $this->employee_model->getAddressById($emp->id);
    					if($emp_validation_details)
					    {
					        if($emp_validation_details->profile_pic_status=='pending')
					            $ui->callout()->title("Pending")->desc("Profile Picture is not yet validated.")->uiType('info')->show();
					        else if($emp_validation_details->profile_pic_status=='rejected')
					        {
					            $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 0));
					            $ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
					        }
					    }
						view_profile_pic($emp,$emp_validation_details);

						if($emp_validation_details)
					    {
					        if($emp_validation_details->basic_details_status=='pending')
					            $ui->callout()->title("Pending")->desc("Basic Details are not yet validated.")->uiType('info')->show();
					        else if($emp_validation_details->basic_details_status=='rejected')
					        {
					            $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 1));
					            $ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
					        }
					    }
						view_basic_details($data,$emp,$ft,$emp_validation_details);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$basic->close();

				$prev_emp = $ui->tabPane()->id('prev_emp');
				if($step==1)	$prev_emp->active();
				$prev_emp->open();
					if($emp_prev_exp_details) {
						if($emp_validation_details)
						{
							if($emp_validation_details->prev_exp_status=='pending')
								$ui->callout()->title("Pending")->desc("Previous Employment Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->prev_exp_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 2));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_prev_emp_details($emp_prev_exp_details,$emp_validation_details);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$prev_emp->close();

				$emp_fam = $ui->tabPane()->id('emp_fam');
				if($step==2)	$emp_fam->active();
				$emp_fam->open();
					if($emp_family_details) {
						if($emp_validation_details)
						{
							if($emp_validation_details->family_details_status=='pending')
								$ui->callout()->title("Pending")->desc("Dependent Family Member Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->family_details_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 3));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_family_details($emp_family_details,$emp_validation_details);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$emp_fam->close();

				$emp_edu = $ui->tabPane()->id('emp_edu');
				if($step==3)	$emp_edu->active();
				$emp_edu->open();
					if($emp_education_details) {
						if($emp_validation_details)
						{
							if($emp_validation_details->educational_status=='pending')
								$ui->callout()->title("Pending")->desc("Educational Qualificatons are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->educational_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 4));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_education_details($emp_education_details,$emp_validation_details);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$emp_edu->close();

				$last_five = $ui->tabPane()->id('last_five');
				if($step==4)	$last_five->active();
				$last_five->open();
					if($emp_last5yrstay_details) {
						if($emp_validation_details)
						{
							if($emp_validation_details->stay_status=='pending')
								$ui->callout()->title("Pending")->desc("Last 5 Year Stay Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->stay_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 5));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_stay_details($emp_last5yrstay_details,$emp_validation_details);
					}
					else
						$ui->callout()->title('Not Found')->desc("Your details have not been updated. Please check after some time.")->uiType('warning')->show();
				$last_five->close();

				$all = $ui->tabPane()->id('all');
				if($step==5)	$all->active();
				$all->open();
					if($emp) {
						$data['name'] = $this->employee_model->getNameById($emp->id);
						$data['deparment']=$this->departments_model->getDepartmentById($emp->dept_id)->name;
    					$data['designation']=$this->designations_model->getDesignationById($emp->designation)->name;
    					$data['address'] = $this->employee_model->getAddressById($emp->id);

						if($emp_validation_details)
					    {
					        if($emp_validation_details->profile_pic_status=='pending')
					            $ui->callout()->title("Pending")->desc("Profile Picture is not yet validated.")->uiType('info')->show();
					        else if($emp_validation_details->profile_pic_status=='rejected')
					        {
					            $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 0));
					            $ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
					        }
					    }
						view_profile_pic($emp,$emp_validation_details);

						if($emp_validation_details)
					    {
					        if($emp_validation_details->basic_details_status=='pending')
					            $ui->callout()->title("Pending")->desc("Basic Details are not yet validated.")->uiType('info')->show();
					        else if($emp_validation_details->basic_details_status=='rejected')
					        {
					            $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 1));
					            $ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
					        }
					    }
						view_basic_details($data,$emp,$ft,$emp_validation_details);
					}
					if($emp_prev_exp_details) {
						if($emp_validation_details)
						{
							if($emp_validation_details->prev_exp_status=='pending')
								$ui->callout()->title("Pending")->desc("Previous Employment Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->prev_exp_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 2));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_prev_emp_details($emp_prev_exp_details,$emp_validation_details);
					}
					if($emp_family_details) {
						if($emp_validation_details)
						{
							if($emp_validation_details->family_details_status=='pending')
								$ui->callout()->title("Pending")->desc("Dependent Family Member Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->family_details_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 3));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_family_details($emp_family_details,$emp_validation_details);
					}
					if($emp_education_details) {
						if($emp_validation_details)
						{
							if($emp_validation_details->educational_status=='pending')
								$ui->callout()->title("Pending")->desc("Educational Qualificatons are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->educational_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 4));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_education_details($emp_education_details,$emp_validation_details);
					}
					if($emp_last5yrstay_details) {
						if($emp_validation_details)
						{
							if($emp_validation_details->stay_status=='pending')
								$ui->callout()->title("Pending")->desc("Last 5 Year Stay Details are not yet validated.")->uiType('info')->show();
							else if($emp_validation_details->stay_status=='rejected')
							{
								$reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 5));
								$ui->callout()->title("Rejected")->desc("Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""))->uiType('danger')->show();
							}
						}
						view_stay_details($emp_last5yrstay_details,$emp_validation_details);
					}
				$all->close();

			$tabbox->close();
		$h_col->close();
	$head->close();
echo '</div>';
echo '<center>';
$ui->button()
	->uiType('primary')
	->id('print_btn')
	->value('PRINT')
	->show();
echo '</center>';

function view_profile_pic($emp,$emp_validation_details) {
	$ui = new UI();
    echo '<center><img src="'.base_url().'assets/images/'.$emp->photopath.'"  height="150" /></center><br>';
}


function view_basic_details($data,$emp,$ft,$emp_validation_details) {
	$ui = new UI();
    $row = $ui->row()->open();
    	$col = $ui->col()->open();
    		echo '<h3 class="page-header" align="center">Employee Details</h3>';
    		$table = $ui->table()->bordered()->condensed()->responsive()->striped()->open();

			echo '<tr>
                    <th>Name</th><td>'.$data['name'].'</td>
                    <th>Marital Status</th><td>'.ucwords($emp->marital_status).'</td>
                    <th>Physically Challenged</th><td>'.ucwords($emp->physically_challenged).'</td>
                </tr>
                <tr>
                    <th>Gender</th><td>'.ucwords($emp->sex).'</td>
                    <th>Category</th><td>'.ucwords($emp->category).'</td>
                    <th>Kashmiri Immigrant</th><td>'.ucwords($emp->kashmiri_immigrant).'</td>
                </tr>
	            <tr>
	                <th>DOB</th><td>'.date('d M Y', strtotime($emp->dob)).'</td>
	                <th>Place of Birth</th><td>'.ucwords($emp->birth_place).'</td>
	                <th>Date of joining</th><td>'.date('d M Y', strtotime($emp->joining_date)).'</td>
	            </tr>
	            <tr>
	                <th>Department</th>';
	        	$dt = DateTime::createFromFormat("Y-m-d", $emp->retirement_date);
	        echo    '<td>'.$data['deparment'].'</td>
	                <th>Designation</th>
	                <td>'.ucwords($data['designation']).'</td>
	                <th>Employment Nature</th><td>'.ucwords($emp->employment_nature).'</td>
	            </tr>
	            <tr>
	                <th>Father\'s Name</th><td>'.$emp->father_name.'</td>
	                <th>Mother\'s Name</th><td>'.$emp->mother_name.'</td>
	                <th>Date of Retirement</th><td>'.$dt->format("d M Y").'</td>
	            </tr>
	            <tr>
	                <th>Email</th><td>'.$emp->email.'</td>
	                <th>Mobile no.</th><td>'.$emp->mobile_no.'</td>
	            </tr>';
        $table->close();

        $row1 = $ui->row()->open();
        $col1 = $ui->col()->width(2)->t_width(0)->m_width(0)->open();
        $col1->close();
        $col2 = $ui->col()->width(8)->t_width(12)->m_width(12)->open();
        $table = $ui->table()->bordered()->condensed()->responsive()->open();
	        echo '<tr>
	                <th>Present Address</th>
	                <th>Permanent Address</th>
	            </tr>
	            <tr>
	                <td>'.$data['address']->present_pretty.'</td>
	                <td>'.$data['address']->permanent_pretty.'</td>

	            </tr>';
		$table->close();
		$col2->close();
		$col3 = $ui->col()->width(2)->t_width(0)->m_width(0)->open();
		$col3->close();
		$row1->close();

        $emp_type='';
        if(in_array('ft',$emp->auth_id)) $emp_type = 'Faculty';
        if(in_array('nfta',$emp->auth_id)) $emp_type = 'Non Faculty Academic';
        if(in_array('nftn',$emp->auth_id)) $emp_type = 'Non Faculty Non Academic';

		$table = $ui->table()->bordered()->condensed()->responsive()->open();
        echo '<tr>
                <th>Employee Type</th><td>'.$emp_type.'</td>
                <th>Research Interest</th>
                <td>'.((!in_array('ft',$emp->auth_id))?   'NA' : ucwords($ft->research_interest)).'</td>
                <th>Religion</th><td>'.ucwords($emp->religion).'</td>
                <th>Nationality</th><td>'.ucwords($emp->nationality).'</td>
            </tr>
            <tr>
                <th>Office no.</th><td>'.$emp->office_no.'</td>
                <th>Fax</th><td>'.$emp->fax.'</td>
                <th>Hobbies</th><td>'.ucfirst($emp->hobbies).'</td>
                <th>Favourite Past Time</th><td>'.ucfirst($emp->fav_past_time).'</td>
            </tr>
            <tr>
                <th>Pay Scale</th>
                <td><u>Pay Band</u> =>'.strtoupper($emp->pay_band).' ('.$emp->pay_band_description.')<br>
                    <u>Grade Pay</u> =>'.$emp->grade_pay.'<br>
                    <u>Basic Pay</u> =>'.$emp->basic_pay.'
                </td>
            </tr>';

    		$table->close();
    	$col->close();
    $row->close();
}


function view_prev_emp_details($emp_prev_exp_details,$emp_validation_details) {
	$ui = new UI();
	echo '<h3 class="page-header" align="center">Previous Employment Details</h3>';

	$table = $ui->table()->id('tbl2')->responsive()->condensed()->bordered()->striped()->open();
            echo '<thead valign="middle" ><tr align="center">
                <th>Full address of Employer</th>
                <th>Position held</th>
                <th>Date of joining</th>
	        	<th>Date of leaving</th>
                <th>Pay Scale</th>
                <th>Remarks</th>
            </tr>
            </thead><tbody>';

            foreach($emp_prev_exp_details as $row) {
                if($row->remarks == "") $remarks='NA';
                else    $remarks = $row->remarks;
                echo '<tr name="row[]" align="center">
                        <td>'.ucwords($row->address).'</td>
                        <td>'.ucwords($row->designation).'</td>
                        <td>'.date('d M Y', strtotime($row->from)).'</td>
                        <td>'.date('d M Y', strtotime($row->to)).'</td>
                        <td>'.$row->pay_scale.'</td>
                        <td>'.ucfirst($remarks).'</td>
                		</tr>';
            }
            echo'</tbody>';
    $table->close();
}


function view_family_details($emp_family_details,$emp_validation_details) {
	$ui = new UI();
	echo '<h3 class="page-header" align="center">Dependent Family Member Details</h3>';

	$table = $ui->table()->id('tbl3')->responsive()->bordered()->striped()->open();
	echo '<thead valign="middle" ><tr align="center">
	    <th>Name</th>
	    <th>Relationship</th>
	    <th>Date of Birth</th>
	    <th>Profession</th>
	    <th>Present Postal Address</th>
	    <th>Active/Inactive</th>
	    <th colspan="2">Photograph</th>
	    </tr>
	    </thead><tbody>';
	foreach($emp_family_details as $row)
	{
	    if($row->active_inactive=="Active")
	        $color="#00a65a";
	    else
	        $color="#f56954";
	    echo '<tr name="row[]" align="center" >
	                <td>'.ucwords($row->name).'</td>
	                <td>'.$row->relationship.'</td>
	                <td>'.date('d M Y', strtotime($row->dob)).'<br>(Age: '.floor((time() - strtotime($row->dob))/(365*24*60*60)).' years)</td>
	                <td>'.ucwords($row->profession).'</td>
	                <td>'.$row->present_post_addr.'</td>
	                <td><b><font color="'.$color.'">'.$row->active_inactive.'</font></b></td>
	                <td><img src="'.base_url().'assets/images/'.$row->photopath.'" height="150"/></td>
	        </tr>';
	}
	echo'</tbody>';
    $table->close();
}


function view_education_details($emp_education_details,$emp_validation_details) {
	$ui = new UI();
	echo '<h3 class="page-header" align="center">Educational Qualifications</h3>';

	$table = $ui->table()->id('tbl4')->responsive()->bordered()->striped()->open();
        echo '<thead valign="middle" ><tr align="center">
            <th>Examination</th>
            <th>Course(Specialization)</th>
            <th>College/University/Institute</th>
            <th>Year</th>
            <th>Percentage/Grade</th>
            <th>Class/Division</th>
            </tr>
            </thead><tbody>';

        foreach($emp_education_details as $row)
        {
            echo '<tr name="row[]" align="center">
                    <td>'.strtoupper($row->exam).'</td>
                    <td>'.strtoupper($row->branch).'</td>
                    <td>'.strtoupper($row->institute).'</td>
                    <td>'.$row->year.'</td>
                    <td>'.strtoupper($row->grade).'</td>
                    <td>'.ucwords($row->division).'</td>
                </tr>';
        }
        echo'</tbody>';
    $table->close();
}


function view_stay_details($emp_last5yrstay_details,$emp_validation_details) {
	$ui = new UI();
	echo '<h3 class="page-header" align="center">Last 5 Year Stay Details</h3>';

    $table = $ui->table()->id('tbl5')->responsive()->bordered()->striped()->open();
        echo '<thead valign="middle" ><tr align="center">
				<th colspan=2>Duration</th>
				<th rowspan=2>Residential Address</th>
				<th rowspan=2>Name of District Headquarters</th>
        	</tr>
        	<tr align="center">
            	<th>From</th>
            	<th>To</th>
        	</tr></thead><tbody>';

        foreach($emp_last5yrstay_details as $row)
		{
			echo '<tr name=row[] align="center">
			    	<td>'.date('d M Y', strtotime($row->from)).'</td>
			    	<td>'.date('d M Y', strtotime($row->to)).'</td>
			    	<td>'.$row->res_addr.'</td>
			    	<td>'.ucwords($row->dist_hq_name).'</td>
			    </tr>';
		}
        echo'</tbody>';
    $table->close();
}
?>