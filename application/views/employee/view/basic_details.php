<?php
    if($user_details && $user_other_details && $emp && $emp_pay_details && $permanent_address && $present_address)
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
        $deparment=$this->departments_model->getDepartmentById($user_details->dept_id)->name;
        $designation=$this->designations_model->getDesignationById($emp->designation)->name;

        echo '<center><h2>Employee Basic Details</h2>';
        echo '  <table width="90%">
                <tr>
                    <th>Name</th><td>'.$user_details->salutation.' '.ucwords(trim($user_details->first_name)).' '.ucwords($user_details->middle_name).' '.ucwords(trim($user_details->last_name)).'</td>
                    <th>Marital Status</th><td>'.ucwords($user_details->marital_status).'</td>
                    <th>Physically Challenged</th><td>'.ucwords($user_details->physically_challenged).'</td>
                </tr>
                <tr>
                    <th>Gender</th><td>'.ucwords($user_details->sex).'</td>
                    <th>Category</th><td>'.ucwords($user_details->category).'</td>
                    <th>Kashmiri Immigrant</th><td>'.ucwords($user_other_details->kashmiri_immigrant).'</td>
                </tr>
            <tr>
                <th>DOB</th><td>'.date('d M Y', strtotime($user_details->dob)).'</td>
                <th>Place of Birth</th><td>'.ucwords($user_other_details->birth_place).'</td>
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
                <th>Father\'s Name</th><td>'.$user_other_details->father_name.'</td>
                <th>Mother\'s Name</th><td>'.$user_other_details->mother_name.'</td>
                <th>Date of Retirement</th><td>'.$dt->format("d M Y").'</td>
            </tr>
            <tr>
                <th>Email</th><td>'.$user_details->email.'</td>
                <th>Mobile no.</th><td>'.$user_other_details->mobile_no.'</td>
            </tr>
            </table>';

        echo '<table width="90%">
            <tr>
                <th>Present Address</th>
                <th>Permanent Address</th>
            </tr>
            <tr>
                <td>'.$present_address->line1.',<br>'.(($present_address->line2=='')? '':$present_address->line2.',<br>')
                    .ucwords($present_address->city).', '.ucwords($present_address->state).' - '.$present_address->pincode.'<br>'
                    .ucwords($present_address->country).'<br>
                    Contact no. '.$present_address->contact_no.'</td>
                <td>'.$permanent_address->line1.',<br>'.(($permanent_address->line2=='')? '':$permanent_address->line2.',<br>')
                    .ucwords($permanent_address->city).', '.ucwords($permanent_address->state).' - '.$permanent_address->pincode.'<br>'
                    .ucwords($permanent_address->country).'<br>
                    Contact no. '.$permanent_address->contact_no.'</td>

            </tr>
            </table>';

            $emp_type='';
            switch($emp->auth_id)
            {
                case 'ft' : $emp_type = 'Faculty';break;
                case 'nfta' : $emp_type = 'Non Faculty Academic';break;
                case 'nftn' : $emp_type = 'Non Faculty Non Academic';break;
            }

        echo '<table  width="90%">
            <tr>
                <th>Employee Type</th><td>'.$emp_type.'</td>
                <th>Research Interest</th>
                <td>'.(($emp->auth_id!='ft')?   'NA' : ucwords($ft->research_interest)).'</td>
                <th>Religion</th><td>'.ucwords($user_other_details->religion).'</td>
                <th>Nationality</th><td>'.ucwords($user_other_details->nationality).'</td>
            </tr>
            <tr>
                <th>Office no.</th><td>'.$emp->office_no.'</td>
                <th>Fax</th><td>'.$emp->fax.'</td>
                <th>Hobbies</th><td>'.ucfirst($user_other_details->hobbies).'</td>
                <th>Favourite Past Time</th><td>'.ucfirst($user_other_details->fav_past_time).'</td>
            </tr>
            <tr>
                <th>Pay Scale</th>
                <td><u>Pay Band</u> =>'.strtoupper($emp_pay_details->pay_band).' ('.$emp_pay_details->pay_band_description.')<br>
                    <u>Grade Pay</u> =>'.$emp_pay_details->grade_pay.'<br>
                    <u>Basic Pay</u> =>'.$emp_pay_details->basic_pay.'
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