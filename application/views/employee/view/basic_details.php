<?php
    if($emp)
    {
        if($emp_validation_details)
        {
            if($emp_validation_details->basic_details_status=='pending')
                $this->notification->drawNotification("Pending : Basic Details","Basic details are not yet validated.");
            else if($emp_validation_details->basic_details_status=='rejected')
            {
                $reject=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=> 1));
                $this->notification->drawNotification("Rejected : Basic Details","Please contact the Establishment Section for the same.".(($reject)? "<br>Reason behind rejection : ".$reject->reason : ""),"error");
            }
        }
        $deparment=$this->departments_model->getDepartmentById($emp->dept_id)->name;
        $designation=$this->designations_model->getDesignationById($emp->designation)->name;

        echo '<center><h2>Employee Basic Details</h2>';
        echo '  <table width="90%">
                <tr>
                    <th>Name</th><td>'.$this->employee_model->getNameById($emp->id).'</td>
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
        echo    '<td>'.$deparment.'</td>
                <th>Designation</th>
                <td>'.ucwords($designation).'</td>
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
            </tr>
            </table>';

        echo '<table width="90%">
            <tr>
                <th>Present Address</th>
                <th>Permanent Address</th>
            </tr>
            <tr>
                <td>'.$this->employee_model->getAddressById($emp->id)->present_pretty.'</td>
                <td>'.$this->employee_model->getAddressById($emp->id)->permanent_pretty.'</td>

            </tr>
            </table>';

            $emp_type='';
            if(in_array('ft',$emp->auth_id)) $emp_type = 'Faculty';
            if(in_array('nfta',$emp->auth_id)) $emp_type = 'Non Faculty Academic';
            if(in_array('nftn',$emp->auth_id)) $emp_type = 'Non Faculty Non Academic';

        echo '<table  width="90%">
            <tr>
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
            </tr>
            </table></center>';
    }
    else
    {
        if($form==0)
        {
            echo '<center><h2>Employee Basic Details</h2>';
            $this->notification->drawNotification("Not Found","Your details have not been updated. Please check after some time.","error");
        }
    }