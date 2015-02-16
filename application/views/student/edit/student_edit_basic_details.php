<!--h1>Edit the Basic details</h1>
<?php
    /*if($correspondence_address)
        $coress_recv = true;
    else
        $coress_recv = false;*/
?>
<?php  //echo form_open_multipart('student/student_edit/update_basic_details/'.$stu_id.'/'.$coress_recv,'onSubmit="return form_validation();"');?>
<table width='90%'>
    <th colspan=4></th>
    <tr>
        <td width='15%' id="stuId">
            Admission No.        </td>
        <td width='35%' id="stuId">
            <?php //echo $stu_id;?>
        </td>
        <td>
            Present Semester
        </td>
        <td>
            <select name="semester">
                <option value='1' <?php //if($stu_academic_details->semester == '1') echo "selected";?>>1</option>
                <option value='2' <?php //if($stu_academic_details->semester == '2') echo "selected";?>>2</option>
                <option value='3' <?php //if($stu_academic_details->semester == '3') echo "selected";?>>3</option>
                <option value='4' <?php //if($stu_academic_details->semester == '4') echo "selected";?>>4</option>
                <option value='5' <?php //if($stu_academic_details->semester == '5') echo "selected";?>>5</option>
                <option value='6' <?php //if($stu_academic_details->semester == '6') echo "selected";?>>6</option>
                <option value='7' <?php //if($stu_academic_details->semester == '7') echo "selected";?>>7</option>
                <option value='8' <?php //if($stu_academic_details->semester == '8') echo "selected";?>>8</option>
                <option value='9' <?php //if($stu_academic_details->semester == '9') echo "selected";?>>9</option>
                <option value='10' <?php //if($stu_academic_details->semester == '10') echo "selected";?>>10</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Salutation        </td>
        <td>
            <select name="salutation" >
                <option value="mr"  <?php //if($user_details->salutation=="mr")echo "selected"; ?> >Mr</option>
                <option value="mrs" <?php //if($user_details->salutation=="mrs")echo "selected"; ?> >Mrs</option>
                <option value="ms"  <?php //if($user_details->salutation=="ms")echo "selected"; ?> >Ms</option>
                <option value="dr"  <?php //if($user_details->salutation=="dr")echo "selected"; ?> >Dr</option>
            </select>
        </td>
        <td>
            First Name
        </td>
        <td>
            <input type="text" name = "firstname" required="required" value="<?php// $user_details->first_name ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            Middle Name        </td>
        <td>
            <input type="text" name = "middlename" id = "middlename" value="<?php// $user_details->middle_name ?>"/>        </td>
        <td>
            Last Name        </td>
        <td>
            <input type="text" name = "lastname" id = "lastname" value="<?php// $user_details->last_name ?>"/>        </td>
   </tr>
   <tr>
        <td>
          पूरा नाम हिन्दी में        </td>
        <td>
            <input type="text" id="stud_name_hindi" name="stud_name_hindi" value="<?php// $stu_basic_details->name_in_hindi ?>" />        </td>
         <td>
            Roll No.        </td>
        <td>
            <input type="text" name = "roll_no" id = "roll_no" value="<?php// $stu_basic_details->enrollment_no ?>"/>        </td>
   </tr>
      <tr>
        <td>
            Father's Name        </td>
        <td>
            <input type="text" id="father_name" name="father_name"  value="<?php// $user_other_details->father_name ?>"/>        </td>
        <td>
            Father's Occupation        </td>
        <td>
            <input type="text" id="father_occupation" name="father_occupation" value="<?php// $stu_other_details->fathers_occupation ?>"/>        </td>
   </tr>
   <tr>
       <td>
            Father's Gross Annual Income        </td>
        <td>
            <input type="text" id="father_gross_income" name="father_gross_income"  value="<?php// $stu_other_details->fathers_annual_income ?>"/>        </td>
       
       <td>
            Mother's Name        </td>
        <td>
            <input type="text" id="mother_name" name="mother_name" value="<?php// $user_other_details->mother_name ?>"/>        </td>
       
        
       
   </tr>
  
    <tr>
         <td>
            Mother's Occupation        </td>
        <td>
            <input type="text" id="mother_occupation" name="mother_occupation" value="<?php// $stu_other_details->mothers_occupation ?>"/>        </td>
        <td>
            Mother's Gross Annual Income        </td>
        <td>
            <input type="text" id="mother_gross_income" name="mother_gross_income" value="<?php// $stu_other_details->mothers_annual_income ?>" />        </td>
        
   </tr>
    <tr>
        <td>
            
            Guardian's Name<br/>        </td>
      <td>
             <input type="text" id="guardian_name" name="guardian_name" value="<?php// $stu_other_details->guardian_name ?>"/>
             <input style="margin-top:2.5px;" type='checkbox' id ="depends_on"  name="depends_on"  onchange="depends_on_whom()"/>        </td>
         <td>
            
            Relationship<br/>        </td>
        <td>
             <input type="text" id="guardian_relation_name" name="guardian_relation_name" value="<?php $stu_other_details->guardian_relation ?>"/>
        </td>
    </tr>
    <tr>
            <td>Parent/Guardian Mobile No</td>
            <td><input type="text" name="parent_mobile" id="parent_mobile" required="required" value="<?php $stu_basic_details->parent_mobile_no?>"></td>
            <td>Parent/Guardian Landline No</td>
            <td><input type="text" name="parent_landline" id="parent_landline" value="<?php// $stu_basic_details->parent_landline_no?>"></td>
    </tr>
     <tr>
        <td>
            Gender        </td>
        <td>
            <input type="radio" name="sex" value="male" <?php //if($user_details->sex=="m")echo "checked"; ?> >Male</input>
            <input type="radio" name="sex" value="female" <?php //if($user_details->sex=="f")echo "checked"; ?> >Female</input>
            <input type="radio" name="sex" value="others" <?php //if($user_details->sex=="o")echo "checked"; ?> >Others</input>
        </td>
        
   
        <td width='15%'>
            Physically Challenged        </td>
        <td width='35%'>
            <input type="radio" name="pd" value="yes" <?php //if($user_details->physically_challenged=="yes")echo "checked"; ?>/>Yes
            <input type="radio" name="pd" value="no" <?php //if($user_details->physically_challenged=="no")echo "checked"; ?>/>No        </td>
    </tr>
   <tr>
        <td>
            Date Of Birth        </td>
        <td>
            <input type="date" name="dob" value="<?php //echo $user_details->dob;?>" max=<?php //echo date("Y-m-d", time()+(19800)); ?> >        </td>
        <td>
            Place of Birth        </td>
        <td>
            <input type="text" name="pob" required="required" value="<?php $user_other_details->birth_place ?>"/>        </td>
    </tr>
    <tr>
        <td>
            Kashmiri Immigrant        </td>
        <td>
            <input type="radio" name="kashmiri" value="yes" <?php //if($user_other_details->kashmiri_immigrant=="yes")echo "checked"; ?>/>Yes
            <input type="radio" name="kashmiri" value="no" <?php //if($user_other_details->kashmiri_immigrant=="no")echo "checked"; ?>/>No        </td>
        <td>Blood Group</td>
        <td>
                <select name="blood_group">
                    <option value="apos" <?php //if($stu_basic_details->blood_group=="apos")echo "selected"; ?>>A+</option>
                    <option value="aneg" <?php //if($stu_basic_details->blood_group=="aneg")echo "selected"; ?>>A-</option>
                    <option value="bpos" <?php //if($stu_basic_details->blood_group=="bpos")echo "selected"; ?>>B+</option>
                    <option value="bneg" <?php //if($stu_basic_details->blood_group=="bneg")echo "selected"; ?>>B-</option>
                    <option value="opos" <?php //if($stu_basic_details->blood_group=="opos")echo "selected"; ?>>O+</option>
                    <option value="oneg" <?php //if($stu_basic_details->blood_group=="oneg")echo "selected"; ?>>O-</option>
                    <option value="abpos" <?php //if($stu_basic_details->blood_group=="abpos")echo "selected"; ?>>AB+</option>
                    <option value="abneg" <?php //if($stu_basic_details->blood_group=="abneg")echo "selected"; ?>>AB-</option>
                </select>
        </td>
    </tr>
    <tr>
        <td>
            Date of Admission        </td>
        <td>
            <input type="date" name="entrance_date" value="<?php //echo $stu_basic_details->admn_date;?>" max=<?php //echo date("Y-m-d", time()+(19800)); ?> required>
        </td>
        <td>
            Student Type        </td>
        <td>
            <select name="stu_type" id="stu_type" >
                <?php
                    /*foreach($stu_type as $row)
                    {
                        if($row->id == $stu_academic_details->auth_id)
                            echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                        else
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                    }*/
                ?>
             </select>        </td>
    </tr>
<tr>
        <td>
            Admission Based On          </td>
        <td>
            <select name="admn_based_on" id="id_admn_based_on" onchange="select_exam_scores()">
                <option value="iitjee" <?php //if($stu_academic_details->admn_based_on=="iitjee")echo "selected"; ?> >IIT JEE</option>
                <option value="isme" <?php //if($stu_academic_details->admn_based_on=="isme")echo "selected"; ?> >ISM Entrance</option>
                <option value="gate" <?php //if($stu_academic_details->admn_based_on=="gate")echo "selected"; ?> >GATE</option>
                <option value="cat" <?php //if($stu_academic_details->admn_based_on=="cat")echo "selected"; ?> >CAT</option>
                <option value="direct" <?php //if($stu_academic_details->admn_based_on=="direct")echo "selected"; ?> >Direct</option>
                <option value="others" <?php //if($stu_academic_details->admn_based_on!="iitjee"&&$stu_academic_details->admn_based_on!="isme"&&$stu_academic_details->admn_based_on!="gate"&&$stu_academic_details->admn_based_on!="cat"&&$stu_academic_details->admn_based_on!="direct")echo "selected"; ?> >Others</option>
            </select>
        </td>
        <td>
            Other Mode of Admission </td>
        <td>
            <input type="text" id="other_mode_of_admission" name="mode_of_admission" <?php //if($stu_academic_details->admn_based_on!="iitjee"&&$stu_academic_details->admn_based_on!="isme"&&$stu_academic_details->admn_based_on!="gate"&&$stu_academic_details->admn_based_on!="cat"&&$stu_academic_details->admn_based_on!="direct")echo "value=".$stu_academic_details->admn_based_on; ?>/>
        </td>
         
    </tr>
     <tr>
        <td>
            
            IIT JEE General Rank<br/>        </td>
         <td><input type="text" id="iitjee_rank" name="iitjee_rank" value="<?php //echo $stu_academic_details->iit_jee_rank; ?>" />  
   <td>
            
            IIT JEE Category  Rank<br/>        </td>
         <td><input type="text" id="iitjee_cat_rank" name="iitjee_cat_rank" value="<?php //echo $stu_academic_details->iit_jee_cat_rank; ?>" />
        </td>
        
    </tr>
    <tr>
        <td>
            
            GATE Score<br/>        </td>
         <td><input type="text" id="gate_score" name="gate_score"  value="<?php //echo $stu_academic_details->gate_score; ?>" />
      
      <td>      
            CAT Score<br/>        </td>
         <td><input type="text" id="cat_score" name="cat_score" value="<?php //echo $stu_academic_details->cat_score; ?>" />
    </tr>
    
   <tr>
        <td>
            Identification Mark     </td>
        <td>
            <input type="text" name="identification_mark" required="required" value="<?php //echo $stu_basic_details->identification_mark ;?>"/>     </td>
        <td>
            Migration Certificate     </td>
        <td>
            <input type="text" name="migration_cert" required="required" value="<?php //echo $stu_basic_details->migration_cert;?>"/>     </td>
        
    </tr>
    <tr>
        <td>
            Category        </td>
        <td>
            <select name="category">
                <option value="general" <?php //if($user_details->category =="") echo "selected";?>>GEN</option>
                <option value="obc" <?php //if($user_details->category =="") echo "selected";?>>OBC</option>
                <option value="sc" <?php //if($user_details->category =="") echo "selected";?>>SC</option>
                <option value="st" <?php //if($user_details->category =="") echo "selected";?>>ST</option>
                <option value="others" <?php //if($user_details->category =="") echo "selected";?>>Others</option>
             </select>        </td>
        <td>
            Religion        </td>
        <td>
            <select name="religion">
                <option value="HINDU" <?php //if($user_other_details->religion == "hindu") echo "selected";?>>HINDU</option>
                <option value="CHRISTIAN" <?php //if($user_other_details->religion == "christian") echo "selected";?>>CHRISTIAN</option>
                <option value="MUSLIM" <?php //if($user_other_details->religion == "muslim") echo "selected";?>>MUSLIM</option>
                <option value="SIKH" <?php //if($user_other_details->religion == "sikh") echo "selected";?>>SIKH</option>
                <option value="BAUDHH" <?php //if($user_other_details->religion == "buadhh") echo "selected";?>>BAUDHH</option>
                <option value="JAIN" <?php //if($user_other_details->religion == "jain") echo "selected";?>>JAIN</option>
                <option value="PARSI" <?php //if($user_other_details->religion == "parsi") echo "selected";?>>PARSI</option>
                <option value="YAHUDI" <?php //if($user_other_details->religion == "yahudi") echo "selected";?>>YAHUDI</option>
                <option value="Others" <?php //if($user_other_details->religion == "others") echo "selected";?>>Others</option>
             </select>        </td>
    </tr>
    <tr>
         <td>
            Nationality        </td>
        <td>
            <input type="text" name="nationality" required="required" value="<?php //echo $user_other_details->nationality;?>"/>        </td>
        <td>
            Department        </td>

            <select name="department" id="depts" onchange="options_of_courses()">
                <?php
                    /*if($academic_departments === FALSE)
                        echo '<option disabled="disabled" selected>No Department</option>';
                    else
                        foreach ($academic_departments as $row)
                        {
                            if($row->id == $user_details->dept_id)
                                echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                            else
                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }*/
                ?>
            </select>        </td>
    </tr>
    <tr>
        <td>
            Course        </td>
        <td id="course">
        
            
            <select name="course" id="course_id" onchange="options_of_branches()">
                <?php
                    /*if($courses === FALSE)
                        echo '<option disabled="disabled" value="none" selected>No Department</option>';
                    else
                        foreach ($courses as $row)
                        {
                            if($row->id == $stu_academic_details->course_id)
                                echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                            else
                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }*/
                ?>
            </select>        </td>
        <td>
            Branch        </td>
        <td id="branch">
        
        <select name="branch" id="branch_id">
                <?php
                    /*if($branches === FALSE)
                        echo '<option disabled="disabled" selected>No Department</option>';
                    else
                        foreach ($branches as $row)
                        {
                            if($row->id == $stu_academic_details->branch_id)
                                echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                            else
                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }*/
                ?>
            </select>        </td>
        
    </tr>
    <tr>
        <td>
            AADHAR Card No :     </td>
        <td>
            <input type="text" name="aadhar_no" id="aadhar_no" value="<?php //echo $stu_other_details->aadhar_card_no;?>"/>       </td>
        <td>
            Marital Status        </td>
        <td>
            <select name="mstatus" >
                <option value="unmarried" <?php //if($user_details->marital_status == "unmarried") echo"selected"; ?>>Unmarried</option>
                <option value="married" <?php //if($user_details->marital_status == "married") echo"selected"; ?>>Married</option>
                <option value="widow" <?php //if($user_details->marital_status == "widow") echo"selected"; ?>>Widow</option>
                <option value="widower" <?php //if($user_details->marital_status == "widower") echo"selected"; ?>>Widower</option>
                <option value="separated" <?php //if($user_details->marital_status == "separated") echo"selected"; ?>>Separated</option>
                <option value="divorcee" <?php //if($user_details->marital_status == "divorcee") echo"selected"; ?>>Divorcee</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Bank Name       </td>
        <td>
            <input type="text" name="bank_name" required="required" value="<?php //echo $stu_other_details->bank_name;?>"/>       </td>
        <td>
            Bank Account No     </td>
        <td>
            <input type="text" name="bank_account_no" required="required" value="<?php //echo $stu_other_details->account_no;?>"/>     </td>
        
    </tr>
    <tr><th colspan=4 >Details of Fees Payment at the time of Admission</th></tr><tr></tr>
    <tr>
        <td>
            Mode of Payment :       </td>
        <td>
            <select name="fee_paid_mode" >
                <option value="dd" <?php //if($stu_fee_details->fee_mode == "dd") echo "selected";?>>Demand Draft</option>
                <option value="cheque" <?php //if($stu_fee_details->fee_mode == "cheque") echo "selected";?>>CHEQUE</option>
                <option value="cash" <?php //if($stu_fee_details->fee_mode == "cash") echo "selected";?>>CASH</option>
                <option value="online" <?php //if($stu_fee_details->fee_mode == "online") echo "selected";?>>ONLINE TRANSFER </option>
                <option value="none" <?php //if($stu_fee_details->fee_mode == "none") echo "selected";?>>NONE </option>
             </select>        </td>

        <td>
            Fees Paid Date  </td>
        <td>
            <input type="date" name="fee_paid_date" value="<?php //echo $stu_fee_details->payment_made_on;?>" max=<?php //echo date("Y-m-d", time()+(19800)); ?> >        </td>
    </tr>
    <tr>
        <td>
            DD/CHEQUE/ONLINE/CASH  No       </td>
        <td>
            <input type="text" name="fee_paid_dd_chk_onlinetransaction_cashreceipt_no" id="fee_paid_dd_chk_onlinetransaction_cashreceipt_no" value="<?php //echo $stu_fee_details->transaction_id;?>"/>       </td>
        <td>
            Fees Paid Amount    </td>
        <td>
            <input type="text" name="fee_paid_amount" id="fee_paid_amount" value="<?php //echo $stu_fee_details->fee_amount;?>" />        </td>
    
    <tr>
        <th width='50%' colspan=2>
            Present Address        </th>
        <th width='50%' colspan=2>
            Permanent Address        </th>
    </tr>    
    <tr>
        <td>
            Address Line 1        </td>
        <td>
            <input type="text" name="line11" required="required" tabindex="10" value="<?php //echo $present_address->line1;?>"/>        </td>
        <td>
            Address Line 1        </td>
        <td>
            <input type="text" name="line12" required="required" tabindex="17" value="<?php //echo $permanent_address->line1;?>"/>        </td>
    </tr>
    <tr>
        <td>
            Address Line 2        </td>
        <td>
            <input type="text" name="line21" required="required" tabindex="11" value="<?php //echo $present_address->line2;?>"/>        </td>
        <td>
            Address Line 2        </td>
        <td>
            <input type="text" name="line22" tabindex="18" required="required" value="<?php //echo $permanent_address->line2;?>"/>        </td>
    </tr>
    <tr>
        <td>
            City        </td>
        <td>
            <input type="text" name="city1" tabindex="12" required="required" value="<?php //echo $present_address->city;?>"/>        </td>
        <td>
            City        </td>
        <td>
            <input type="text" name="city2"  tabindex="18" required="required" value="<?php //echo $permanent_address->city;?>"/>        </td>
    </tr>
    <tr>
        <td>
            State        </td>
        <td>
            <input type="text" name="state1" tabindex="13" required="required" value="<?php //echo $present_address->state;?>"/>
        </td>
        <td>
            State        </td>
        <td>
            <input type="text" name="state2" tabindex="19" required="required" value="<?php //echo $permanent_address->state;?>"/>
         </td>
    </tr>
    <tr>
        <td>
            Pin code        </td>
        <td>
            <input type="text" name="pincode1" id="pincode1" tabindex="14" required="required" value="<?php //echo $present_address->pincode;?>"/>        </td>
        <td>
            Pin code        </td>
        <td>
            <input type="text" name="pincode2" id="pincode2" tabindex="19" required="required" value="<?php //echo $permanent_address->pincode;?>"/>        </td>
    </tr>
    <tr>
        <td>
            Country        </td>
        <td>
            <input type="text"  tabindex="15" name="country1" required="required" value="<?php //echo $present_address->country;?>"/>        </td>
        <td>
            Country        </td>
        <td>
            <input type="text" name="country2" tabindex="20" required="required"value="<?php //echo $permanent_address->country;?>" />        </td>
    </tr>
    <tr>
        <td>
            Contact No        </td>
        <td>
            <input type="text"  tabindex="16" name="contact1" id="contact1" required="required" value="<?php ////echo $present_address->contact_no;?>"/>        </td>
        <td>
            Contact No        </td>
        <td>
            <input type="text" name="contact2" id="contact2"  tabindex="21" required="required" value="<?php //echo $permanent_address->contact_no;?>"/>        </td>
    </tr>
    <tr>
    <td colspan=4 align='center'>
    <input type='checkbox' id ="correspondence_addr"  name="correspondence_addr" <?php //if(!$correspondence_address) echo "checked"; ?> onchange="corrAddr()"/> 
    <b>Correspondence address same as Permanent address.</b></td>
    </tr>

    <tr >
        <td colspan='4'><div id="corr_addr" style="display:none;">
            <table   width='100%' >
                <th colspan='4'>Corresspondence Address</th>
        
                <tr >
                    <td  align="right">
                        Address Line 1                  </td>
                    <td colspan="2">
                        <input type="text" name="line13" id="line13" <?php //if($correspondence_address) echo "value=".$correspondence_address->line1; ?>/>                  </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        Address Line 2                  </td>
                    <td colspan="2">
                        <input type="text" name="line23" id="line23" <?php //if($correspondence_address) echo "value=".$correspondence_address->line2; ?>/>                  </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        City                    </td>
                    <td colspan="2">
                        <input type="text" name="city3" id="city3" <?php //if($correspondence_address) echo "value=".$correspondence_address->city; ?>/>                    </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        State                   </td>
                    <td colspan="2">
                        <input type="text" name="state3" id="state3" <?php //if($correspondence_address) echo "value=".$correspondence_address->state; ?>/>
                   </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        Pin code                    </td>
                    <td colspan="2">
                        <input type="text" name="pincode3" id="pincode3" <?php //if($correspondence_address) echo "value=".$correspondence_address->pincode; ?>/>                  </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        Country                 </td>
                    <td colspan="2">
                        <input type="text" name="country3" id="country3" <?php //if($correspondence_address) echo "value=".$correspondence_address->country; ?>/>                   </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        Contact No                  </td>
                    <td colspan="2">
                        <input type="text" name="contact3" id="contact3" <?php //if($correspondence_address) echo "value=".$correspondence_address->contact_no; ?>/>                  </td>
                </tr>
            </table>
        </div></td>
    </tr>
</table>
<input type = "submit" value="Update"/>
<?php //echo form_close(); ?>
<a href= <?php //site_url('student/student_edit') ?> ><button>Back</button></a-->


























<?php
    if($correspondence_address)
        $coress_recv = true;
    else
        $coress_recv = false;

    $ui = new UI();

        $form=$ui->form()
                 ->action('student/student_edit/update_basic_details/'.$stu_id.'/'.$coress_recv)
                 ->multipart()
                 ->id('form_submit')
                 ->open();


            $student_admn_no = $ui->row()
                                  ->open();

                $column1 = $ui->col()
                              ->width(10)
                              ->open();

                    echo '<label>Admission No. : </label>';
                    echo $stu_id;

                $column1->close();

            $student_admn_no->close();

            ?><div id="stu_details_hidden"><?php

            $student_details_row = $ui->row()
                                  ->open();

                $student_details_box = $ui->box()
                                          ->uiType('primary')
                                          ->solid()
                                          ->title('Personal Details')
                                          ->open();

                    $student_name = $ui->row()
                                       ->open();

/*                        $salutation_column = $ui->col()
                                                ->width(3)
                                                ->open();
*/
                            $ui->select()
                               ->name('salutation')
                               ->width(3)
                               ->options(array($ui->option()->value('mr')->text('Mr')->selected($user_details->salutation=="mr"),
                                               $ui->option()->value('mrs')->text('Mrs')->selected($user_details->salutation=="mrs"),
                                               $ui->option()->value('ms')->text('Ms')->selected($user_details->salutation=="ms"),
                                               $ui->option()->value('dr')->text('Dr')->selected($user_details->salutation=="dr")))
                            ->show();

                        /*$salutation_column->close();

                        $firstname_column = $ui->col()
                                               ->width(3)
                                               ->open();
*/
                            $ui->input()
                               ->placeholder('First Name')
                               ->id('firstname')
                               ->required()
                               ->value($user_details->first_name)
                               ->width(3)
                               ->name('firstname')
                               ->show();

/*                        $firstname_column->close();

                        $middlename_column = $ui->col()
                                                ->width(3)
                                                ->open();

*/                            $ui->input()
                               ->placeholder('Middle Name')
                               ->id('middlename')
                               ->width(3)
                               ->value($user_details->middle_name)
                               ->name('middlename')
                               ->show();

/*                        $middlename_column->close();

                        $lastname_column = $ui->col()
                                              ->width(3)
                                              ->open();
*/
                            $ui->input()
                               ->placeholder('Last Name')
                               ->width(3)
                               ->id('lastname')
                               ->name('lastname')
                               ->value($user_details->last_name)
                               ->show();

//                        $lastname_column->close();

                    $student_name->close();

                    $student_personal_details_row_1 = $ui->row()
                                                         ->open();

                        /*$column3 = $ui->col()
                                      ->width(3)
                                      ->open();*/

                            $ui->input()
                               ->label('पूरा नाम हिन्दी में')
                               ->id('stud_name_hindi')
                               ->name('stud_name_hindi')
                               ->value($stu_basic_details->name_in_hindi)
                               ->width(3)
                               ->show();

                       // $column3->close();

                        $column_gender = $ui->col()
                                      ->width(3)
                                      ->open();
                            echo '<label>Gender</label>';

                            $ui->radio()
                               ->name('sex')
                               ->label('Male')
                               ->value('m')
                               ->checked($user_details->sex=="m")
                               ->show();

                            $ui->radio()
                               ->name('sex')
                               ->label('Female')
                               ->value('f')
                               ->checked($user_details->sex=="f")
                               ->show();

                            $ui->radio()
                               ->name('sex')
                               ->label('Others')
                               ->value('o')
                               ->checked($user_details->sex=="o")
                               ->show();

                        $column_gender->close();

                        /*$column5 = $ui->col()
                                      ->width(3)
                                      ->open();*/

                            $ui->datePicker()
                               ->label('Date of Birth')
                               ->width(3)
                               ->name('dob')
                               ->placeholder(date("d-m-Y", time()+(19800)))
                               ->value(date('d-m-Y',strtotime($user_details->dob)))
                               ->dateFormat('dd-mm-yyyy')
                               ->show();

                        /*$column5->close();

                        $column6 = $ui->col()
                                      ->width(3)
                                      ->open();

                        $column6->close();*/

                            $ui->input()
                               ->label('Place of Birth')
                               ->name('pob')
                               ->required()
                               ->value($user_other_details->birth_place)
                               ->width(3)
                               ->show();

                    $student_personal_details_row_1->close();

                    $student_personal_details_row_2 = $ui->row()
                                                         ->open();

                        $column_pd = $ui->col()
                                            ->width(3)
                                            ->open();
                            echo '<label>Physically Challenged</label>';

                            $ui->radio()
                               ->name('pd')
                               ->label('Yes')
                               ->value('yes')
                               ->checked($user_details->physically_challenged=="yes")
                               ->show();

                            $ui->radio()
                               ->name('pd')
                               ->label('No')
                               ->value('no')
                               ->checked($user_details->physically_challenged=="no")
                               ->show();

                        $column_pd->close();

                        $ui->select()
                           ->name('blood_group')
                           ->width(3)
                           ->label('Blood Group')
                           ->options(array($ui->option()->value('A+')->text('A+')->selected($stu_basic_details->blood_group=="A+"),
                                           $ui->option()->value('A-')->text('A-')->selected($stu_basic_details->blood_group=="A-"),
                                           $ui->option()->value('B+')->text('B+')->selected($stu_basic_details->blood_group=="B+"),
                                           $ui->option()->value('B-')->text('B-')->selected($stu_basic_details->blood_group=="B-"),
                                           $ui->option()->value('O+')->text('O+')->selected($stu_basic_details->blood_group=="O+"),
                                           $ui->option()->value('O-')->text('O-')->selected($stu_basic_details->blood_group=="O-"),
                                           $ui->option()->value('AB+')->text('AB+')->selected($stu_basic_details->blood_group=="AB+"),
                                           $ui->option()->value('AB-')->text('AB-')->selected($stu_basic_details->blood_group=="AB-")))
                           ->show();

                        $column_ki = $ui->col()
                                        ->width(3)
                                        ->open();
                            echo '<label>Kashmiri Immigrant</label>';

                            $ui->radio()
                               ->name('kashmiri')
                               ->label('Yes')
                               ->value('yes')
                               ->checked($user_other_details->kashmiri_immigrant=="yes")
                               ->show();

                            $ui->radio()
                               ->name('kashmiri')
                               ->label('No')
                               ->value('no')
                               ->checked($user_other_details->kashmiri_immigrant=="no")
                               ->show();

                        $column_ki->close();

                        $ui->select()
                           ->name('mstatus')
                           ->width(3)
                           ->label('Marital Status')
                           ->options(array($ui->option()->value('unmarried')->text('Unmarried')->selected($user_details->marital_status == "unmarried"),
                                           $ui->option()->value('married')->text('Married')->selected($user_details->marital_status == "married"),
                                           $ui->option()->value('widow')->text('Widow')->selected($user_details->marital_status == "widow"),
                                           $ui->option()->value('Widower')->text('Widower')->selected($user_details->marital_status == "widower"),
                                           $ui->option()->value('divorcee')->text('Divorcee')->selected($user_details->marital_status == "divorcee"),
                                           $ui->option()->value('separated')->text('Separated')->selected($user_details->marital_status == "separated")))
                           ->show();

                    $student_personal_details_row_2->close();

                    $student_personal_details_row_3 = $ui->row()
                                                         ->open();

                        $ui->select()
                           ->name('category')
                           ->width(3)
                           ->label('Category')
                           ->options(array($ui->option()->value('General')->text('GEN')->selected($user_details->category =="General"),
                                           $ui->option()->value('OBC')->text('OBC')->selected($user_details->category =="OBC"),
                                           $ui->option()->value('SC')->text('SC')->selected($user_details->category =="SC"),
                                           $ui->option()->value('ST')->text('ST')->selected($user_details->category =="ST"),
                                           $ui->option()->value('Others')->text('OTHERS')->selected($user_details->category =="Others")))
                           ->show();

                        $ui->select()
                           ->name('religion')
                           ->width(3)
                           ->label('Religion')
                           ->options(array($ui->option()->value('HINDU')->text('HINDU')->selected($user_other_details->religion == "hindu"),
                                           $ui->option()->value('CHRISTIAN')->text('CHRISTIAN')->selected($user_other_details->religion == "christian"),
                                           $ui->option()->value('MUSLIM')->text('MUSLIM')->selected($user_other_details->religion == "muslim"),
                                           $ui->option()->value('SIKH')->text('SIKH')->selected($user_other_details->religion == "sikh"),
                                           $ui->option()->value('BAUDHH')->text('BAUDHH')->selected($user_other_details->religion == "baudhh"),
                                           $ui->option()->value('JAIN')->text('JAIN')->selected($user_other_details->religion == "jain"),
                                           $ui->option()->value('PARSI')->text('PARSI')->selected($user_other_details->religion == "parsi"),
                                           $ui->option()->value('YAHUDI')->text('YAHUDI')->selected($user_other_details->religion == "yahudi"),
                                           $ui->option()->value('OTHERS')->text('OTHERS')->selected($user_other_details->religion == "others")))
                           ->show();

                        $ui->input()
                           ->label('Nationality')
                           ->name('nationality')
                           ->value($user_other_details->nationality)
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Aadhaar Card No.')
                           ->id('aadhaar_no')
                           ->name('aadhaar_no')
                           ->value($stu_other_details->aadhaar_card_no)
                           ->width(3)
                           ->show();

                    $student_personal_details_row_3->close();

                    $student_personal_details_row_4 = $ui->row()
                                                         ->open();

                        $ui->input()
                           ->label('Identification Mark')
                           ->name('identification_mark')
                           ->required()
                           ->value($stu_basic_details->identification_mark)
                           ->width(12)
                           ->show();

                    $student_personal_details_row_4->close();


                $student_details_box->close();

                $student_family_details_box = $ui->box()
                                                 ->uiType('primary')
                                                 ->solid()
                                                 ->title('Family Details')
                                                 ->open();

                    $family_details_row = $ui->row()
                                             ->open();

                    $family_father = $ui->col()
                                         ->width(4)
                                         ->open();

                        $student_father_details_box = $ui->box()
                                                         ->uiType('primary')
                                                         ->solid()
                                                         ->title('Father\'s Details')
                                                         ->open();

                            $ui->input()
                               ->label('Father\'s Name')
                               ->id('father_name')
                               ->name('father_name')
                               ->value($user_other_details->father_name)
                               ->show();

                            $ui->input()
                               ->label('Father\'s Occupation')
                               ->id('father_occupation')
                               ->name('father_occupation')
                               ->value($stu_other_details->fathers_occupation)
                               ->show();

                            $ui->input()
                               ->label('Father\'s Gross Annual Income')
                               ->id('father_gross_income')
                               ->name('father_gross_income')
                               ->value($stu_other_details->fathers_annual_income)
                               ->show();

                        $student_father_details_box->close();


                    $family_father->close();

                    $family_mother = $ui->col()
                                         ->width(4)
                                         ->open();

                        $student_mother_details_box = $ui->box()
                                                         ->uiType('primary')
                                                         ->solid()
                                                         ->title('Mother\'s Details')
                                                         ->open();

                            $ui->input()
                               ->label('Mother\'s Name')
                               ->id('mother_name')
                               ->name('mother_name')
                               ->value($user_other_details->mother_name)
                               ->show();

                            $ui->input()
                               ->label('Mother\'s Occupation')
                               ->id('mother_occupation')
                               ->name('mother_occupation')
                               ->value($stu_other_details->mothers_occupation)
                               ->show();

                            $ui->input()
                               ->label('Mother\'s Gross Annual Income')
                               ->id('mother_gross_income')
                               ->name('mother_gross_income')
                               ->value($stu_other_details->mothers_annual_income)
                               ->show();

                        $student_mother_details_box->close();

                    $family_mother->close();

                    $family_guardian = $ui->col()
                                         ->width(4)
                                         ->open();

                        $student_guardian_details_box = $ui->box()
                                                           ->uiType('primary')
                                                           ->solid()
                                                           ->title('Guardian\'s Details')
                                                           ->open();

                            echo '<label>Fill Guardian Details</label>';

                            $ui->checkbox()
                               ->name('depends_on')
                               ->id('depends_on')
                               ->checked($stu_other_details->guardian_name != 'na')
                               ->show();

                            $ui->input()
                               ->label('Guardian\'s Name')
                               ->id('guardian_name')
                               ->name('guardian_name')
                               ->value($stu_other_details->guardian_name)
                               ->disabled()
                               ->show();

                            $ui->input()
                               ->label('Relationship')
                               ->id('guardian_relation_name')
                               ->name('guardian_relation_name')
                               ->value($stu_other_details->guardian_relation)
                               ->disabled()
                               ->show();

                        $student_guardian_details_box->close();

                    $family_guardian->close();

                    $family_details_row->close();

                    $family_contact_details_row = $ui->row()
                                                     ->open();

                        $ui->input()
                           ->label('Parent/Guardian Mobile No')
                           ->id('parent_mobile')
                           ->required()
                           ->value($stu_basic_details->parent_mobile_no)
                           ->width(6)
                           ->name('parent_mobile')
                           ->show();

                        $ui->input()
                           ->label('Parent/Guardian Landline No')
                           ->id('parent_landline')
                           ->width(6)
                           ->value($stu_basic_details->parent_landline_no)
                           ->name('parent_landline')
                           ->show();

                    $family_contact_details_row->close();

                $student_family_details_box->close();

                $student_admission_details_box = $ui->box()
                                                 ->uiType('primary')
                                                 ->solid()
                                                 ->title('Admission Details')
                                                 ->open();

                    $admission_details_row_1 = $ui->row()
                                                ->open();

                        $ui->input()
                           ->label('Migration Certiificate')
                           ->width(3)
                           ->name('migration_cert')
                           ->value($stu_basic_details->migration_cert)
                           ->show();

                        $ui->input()
                           ->label('Roll No.')
                           ->id('roll_no')
                           ->name('roll_no')
                           ->placeholder('eg. IIT-JEE enrollment no.')
                           ->value($stu_basic_details->enrollment_no)
                           ->width(3)
                           ->show();

                        $ui->datePicker()
                           ->label('Date of Admission')
                           ->width(3)
                           ->name('entrance_date')
                           ->placeholder(date("d-m-Y", time()+(19800)))
                           ->value(date('d-m-Y',strtotime($stu_basic_details->admn_date)))
                           ->dateFormat('dd-mm-yyyy')
                           ->show();

                        $ui->select()
                           ->name('admn_based_on')
                           ->id('id_admn_based_on')
                           ->width(3)
                           ->label('Admission Based On')
                           ->options(array($ui->option()->value('iitjee')->text('IIT JEE')->selected($stu_academic_details->admn_based_on=="iitjee"),
                                           $ui->option()->value('isme')->text('ISM Entrance')->selected($stu_academic_details->admn_based_on=="isme"),
                                           $ui->option()->value('gate')->text('GATE')->selected($stu_academic_details->admn_based_on=="gate"),
                                           $ui->option()->value('cat')->text('CAT')->selected($stu_academic_details->admn_based_on=="cat"),
                                           $ui->option()->value('direct')->text('Direct')->selected($stu_academic_details->admn_based_on=="direct"),
                                           $ui->option()->value('others')->text('Others')->selected($stu_academic_details->admn_based_on!="iitjee"&&$stu_academic_details->admn_based_on!="isme"&&$stu_academic_details->admn_based_on!="gate"&&$stu_academic_details->admn_based_on!="cat"&&$stu_academic_details->admn_based_on!="direct")))
                           ->show();

                    $admission_details_row_1->close();

                    $admission_details_row_2 = $ui->row()
                                                  ->open();

                        if($stu_academic_details->admn_based_on!="iitjee"&&$stu_academic_details->admn_based_on!="isme"&&$stu_academic_details->admn_based_on!="gate"&&$stu_academic_details->admn_based_on!="cat"&&$stu_academic_details->admn_based_on!="direct")
                            $ui->input()
                               ->label('Other Mode of Admission')
                               ->id('other_mode_of_admission')
                               ->name('mode_of_admission')
                               ->value($stu_academic_details->admn_based_on)
                               ->disabled()
                               ->width(3)
                               ->show();
                        else
                            $ui->input()
                               ->label('Other Mode of Admission')
                               ->id('other_mode_of_admission')
                               ->name('mode_of_admission')
                               ->disabled()
                               ->width(3)
                               ->show();

                        $ui->input()
                           ->label('IIT JEE General Rank')
                           ->id('iitjee_rank')
                           ->name('iitjee_rank')
                           ->value($stu_academic_details->iit_jee_rank)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('IIT JEE Category Rank')
                           ->id('iitjee_cat_rank')
                           ->name('iitjee_cat_rank')
                           ->value($stu_academic_details->iit_jee_cat_rank)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Gate Score')
                           ->id('gate_score')
                           ->name('gate_score')
                           ->disabled()
                           ->value($stu_academic_details->gate_score)
                           ->width(3)
                           ->show();

                    $admission_details_row_2->close();

                    $admission_details_row_3 = $ui->row()
                                                ->open();

                        $ui->input()
                           ->label('Cat Score')
                           ->id('cat_score')
                           ->name('cat_score')
                           ->value($stu_academic_details->cat_score)
                           ->disabled()
                           ->width(3)
                           ->show();

                        $ui->select()
                           ->label('Student Type')
                           ->id('stu_type')
                           ->name('stu_type')
                           ->width(3)
                           ->options(array($ui->option()->value('ug')->text('Under Graduate')->selected($stu_academic_details->auth_id=="ug"),
                                           $ui->option()->value('g')->text('Graduate')->selected($stu_academic_details->auth_id=="g"),
                                           $ui->option()->value('pg')->text('Post Graduate')->selected($stu_academic_details->auth_id=="pg"),
                                           $ui->option()->value('jrf')->text('Junior Research Fellow')->selected($stu_academic_details->auth_id=="jrf"),
                                           $ui->option()->value('pd')->text('Post Doctoral Fellow')->selected($stu_academic_details->auth_id=="pd")))
                           ->show();

                        $ui->select()
                           ->label('Present Semester')
                           ->name('semester')
                           ->width(3)
                           ->options(array($ui->option()->value('1')->text('1')->selected($stu_academic_details->semester == '1'),
                                           $ui->option()->value('2')->text('2')->selected($stu_academic_details->semester == '2'),
                                           $ui->option()->value('3')->text('3')->selected($stu_academic_details->semester == '3'),
                                           $ui->option()->value('4')->text('4')->selected($stu_academic_details->semester == '4'),
                                           $ui->option()->value('5')->text('5')->selected($stu_academic_details->semester == '5'),
                                           $ui->option()->value('6')->text('6')->selected($stu_academic_details->semester == '6'),
                                           $ui->option()->value('7')->text('7')->selected($stu_academic_details->semester == '7'),
                                           $ui->option()->value('8')->text('8')->selected($stu_academic_details->semester == '8'),
                                           $ui->option()->value('9')->text('9')->selected($stu_academic_details->semester == '9'),
                                           $ui->option()->value('10')->text('10')->selected($stu_academic_details->semester == '10')))
                           ->show();

                    $admission_details_row_3->close();

                    $admission_details_row_4 = $ui->row()
                                                  ->open();

                        $dept_array = array();

                        if($academic_departments === FALSE)
                            $dept_array[] = $ui->option()->value('')->text('No Depatment');
                        else
                            foreach ($academic_departments as $row)
                            {
                                if($row->id == $user_details->dept_id)
                                    $dept_array[] = $ui->option()->value($row->id)->text($row->name)->selected();
                                else
                                    $dept_array[] = $ui->option()->value($row->id)->text($row->name);
                                $dept_array = array_values($dept_array);
                            }

                        $course_array = array();

                        if($courses === FALSE)
                            $course_array[] = $ui->option()->value('none')->text('No Course');
                        else
                            foreach ($courses as $row)
                            {
                                if($row->id == $stu_academic_details->course_id)
                                    $course_array[] = $ui->option()->value($row->id)->text($row->name)->selected();
                                else
                                    $course_array[] = $ui->option()->value($row->id)->text($row->name);
                                $course_array = array_values($course_array);
                            }

                        $branch_array = array();

                        if($branches === FALSE)
                            $branch_array[] = $ui->option()->value('none')->text('No Branch');
                        else
                            foreach ($branches as $row)
                            {
                                if($row->id == $stu_academic_details->branch_id)
                                    $branch_array[] = $ui->option()->value($row->id)->text($row->name)->selected();
                                else
                                    $branch_array[] = $ui->option()->value($row->id)->text($row->name);
                                $branch_array = array_values($branch_array);
                            }

                        $ui->select()
                           ->width(4)
                           ->label('Department')
                           ->name('department')
                           ->id('depts')
                           ->options($dept_array)
                           ->show();

                        $ui->select()
                           ->width(4)
                           ->label('Course')
                           ->name('course')
                           ->id('course_id')
                           ->options($course_array)
                           ->show();

                        $ui->select()
                           ->width(4)
                           ->label('Branch')
                           ->name('branch')
                           ->id('branch_id')
                           ->options($branch_array)
                           ->show();

                    $admission_details_row_4->close();

                $student_admission_details_box->close();

                $student_bank_details_box = $ui->box()
                                                   ->uiType('primary')
                                                   ->solid()
                                                   ->title('Bank Details')
                                                   ->open();

                    $bank_details_row_1 = $ui->row()
                                             ->open();

                        $ui->input()
                           ->label('Bank Name')
                           ->name('bank_name')
                           ->value($stu_other_details->bank_name)
                           ->required()
                           ->width(6)
                           ->show();

                        $ui->input()
                           ->label('Bank Account No.')
                           ->name('bank_account_no')
                           ->value($stu_other_details->account_no)
                           ->required()
                           ->width(6)
                           ->show();

                    $bank_details_row_1 ->close();

                $student_bank_details_box->close();

                $student_fee_details_box = $ui->box()
                                              ->uiType('primary')
                                              ->solid()
                                              ->title('Details of Fees Payment at the time of Admission')
                                              ->open();

                    $fee_details_row_1 = $ui->row()
                                            ->open();

                        $ui->select()
                           ->label('Mode of Payment')
                           ->name('fee_paid_mode')
                           ->width(3)
                           ->options(array($ui->option()->value('dd')->text('CHEQUE')->selected($stu_fee_details->fee_mode == "dd"),
                                           $ui->option()->value('cheque')->text('CASH')->selected($stu_fee_details->fee_mode == "cheque"),
                                           $ui->option()->value('online')->text('ONLINE TRANSFER')->selected($stu_fee_details->fee_mode == "online"),
                                           $ui->option()->value('none')->text('NONE')->selected()->selected($stu_fee_details->fee_mode == "none")))
                           ->show();

                        $ui->datePicker()
                           ->label('Fees Paid Date')
                           ->width(3)
                           ->name('fee_paid_date')
                           ->placeholder(date("d-m-Y", time()+(19800)))
                           ->value(date('d-m-Y',strtotime($stu_fee_details->payment_made_on)))
                           ->dateFormat('dd-mm-yyyy')
                           ->show();

                        $ui->input()
                           ->label('DD/CHEQUE/ONLINE/CASH NO.')
                           ->name('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
                           ->id('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
                           ->value($stu_fee_details->transaction_id)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Fees Paid Amount')
                           ->name('fee_paid_amount')
                           ->id('fee_paid_amount')
                           ->value($stu_fee_details->fee_amount)
                           ->width(3)
                           ->show();

                    $fee_details_row_1 ->close();

                $student_fee_details_box->close();

                $student_address_details_box = $ui->box()
                                                  ->uiType('primary')
                                                  ->solid()
                                                  ->title('Address Details')
                                                  ->open();

                    $address_details_row_1 = $ui->row()
                                                ->open();

                        $address_col_1 = $ui->col()
                                          ->width(6)
                                          ->open();

                        $present_address_details_box = $ui->box()
                                                          ->uiType('primary')
                                                          ->solid()
                                                          ->title('Present Address')
                                                          ->open();

                            $ui->input()
                               ->label('Address Line 1')
                               ->name('line11')
                               ->value($present_address->line1)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Address Line 2')
                               ->name('line21')
                               ->value($present_address->line2)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('City')
                               ->name('city1')
                               ->value($present_address->city)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('State')
                               ->name('state1')
                               ->required()
                               ->value($present_address->state)
                               ->show();

                            $ui->input()
                               ->label('Pincode')
                               ->name('pincode1')
                               ->id('pincode1')
                               ->value($present_address->pincode)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Country')
                               ->name('country1')
                               ->value($present_address->country)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Contact No.')
                               ->name('contact1')
                               ->id('contact1')
                               ->value($present_address->contact_no)
                               ->required()
                               ->show();

                        $present_address_details_box->close();

                        $address_col_1->close();

                        $address_col_2 = $ui->col()
                                          ->width(6)
                                          ->open();

                        $permanent_address_details_box = $ui->box()
                                                          ->uiType('primary')
                                                          ->solid()
                                                          ->title('Permanent Address')
                                                          ->width(6)
                                                          ->open();

                            $ui->input()
                               ->label('Address Line 1')
                               ->name('line12')
                               ->value($permanent_address->line1)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Address Line 2')
                               ->name('line22')
                               ->value($permanent_address->line2)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('City')
                               ->name('city2')
                               ->value($permanent_address->city)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('State')
                               ->name('state2')
                               ->value($permanent_address->state)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Pincode')
                               ->name('pincode2')
                               ->id('pincode2')
                               ->value($permanent_address->pincode)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Country')
                               ->name('country2')
                               ->value($permanent_address->country)
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Contact No.')
                               ->name('contact2')
                               ->id('contact2')
                               ->value($permanent_address->contact_no)
                               ->required()
                               ->show();

                        $permanent_address_details_box->close();

                        $address_col_2->close();

                    $address_details_row_1 ->close();

                    $address_details_row_2 = $ui->row()
                                                ->open();

                        $check_corr_address_col_0 = $ui->col()
                                                       ->width(3)
                                                       ->open();
                        $check_corr_address_col_0->close();

                        $check_corr_address_col_1 = $ui->col()
                                                       ->width(1)
                                                       ->open();

                            $ui->checkbox()
                               ->name('correspondence_addr')
                               ->id('correspondence_addr')
                               ->checked(!$correspondence_address)
                               ->show();

                        $check_corr_address_col_1->close();

                        $check_corr_address_col_2 = $ui->col()
                                                       ->width(7)
                                                       ->open();

                            echo '<label>Correspondence address same as Permanent address.</label>';

                        $check_corr_address_col_2->close();

                    $address_details_row_2 ->close();

                    ?><div id="corr_addr_visibility"><?php

                    $address_details_row_3 = $ui->row()
                                                ->open();

                        $corr_address_col_1 = $ui->col()
                                                 ->width(3)
                                                 ->open();

                        $corr_address_col_1->close();

                        $corr_address_col_2 = $ui->col()
                                                 ->width(6)
                                                 ->open();

                            $correspondence_address_details_box = $ui->box()
                                                          ->uiType('primary')
                                                          ->solid()
                                                          ->title('Correspondence Address')
                                                          ->open();

                                if($correspondence_address){
                                $ui->input()
                                   ->label('Address Line 1')
                                   ->name('line13')
                                   ->value($correspondence_address->line1)
                                   ->show();

                                $ui->input()
                                   ->label('Address Line 2')
                                   ->name('line23')
                                   ->value($correspondence_address->line2)
                                   ->show();

                                $ui->input()
                                   ->label('City')
                                   ->name('city3')
                                   ->value($correspondence_address->city)
                                   ->show();

                                $ui->input()
                                   ->label('State')
                                   ->name('state3')
                                   ->value($correspondence_address->state)
                                   ->show();

                                $ui->input()
                                   ->label('Pincode')
                                   ->name('pincode3')
                                   ->id('pincode3')
                                   ->value($correspondence_address->pincode)
                                   ->show();

                                $ui->input()
                                   ->label('Country')
                                   ->name('country3')
                                   ->value($correspondence_address->country)
                                   ->show();

                                $ui->input()
                                   ->label('Contact No.')
                                   ->name('contact3')
                                   ->id('contact3')
                                   ->value($correspondence_address->contact_no)
                                   ->show();
                                }
                                else{
                                    $ui->input()
                                   ->label('Address Line 1')
                                   ->name('line13')
                                   ->show();

                                $ui->input()
                                   ->label('Address Line 2')
                                   ->name('line23')
                                   ->show();

                                $ui->input()
                                   ->label('City')
                                   ->name('city3')
                                   ->show();

                                $ui->input()
                                   ->label('State')
                                   ->name('state3')
                                   ->show();

                                $ui->input()
                                   ->label('Pincode')
                                   ->name('pincode3')
                                   ->id('pincode3')
                                   ->show();

                                $ui->input()
                                   ->label('Country')
                                   ->name('country3')
                                   ->value('India')
                                   ->show();

                                $ui->input()
                                   ->label('Contact No.')
                                   ->name('contact3')
                                   ->id('contact3')
                                   ->show();
                                }

                        $correspondence_address_details_box->close();

                        $corr_address_col_2->close();

                    $address_details_row_3 ->close();

                    ?></div><?php

                $student_address_details_box->close();

                $student_details_row_2 = $ui->row()
                                          ->open();

                    $student_details_2_1 = $ui->col()
                                              ->width(5)
                                              ->open();

                        $student_details_2_1->close();

                        $ui->input()
                           ->type('submit')
                           ->value('Update')
                           ->id('submit_button_id')
                           ->width(2)
                           ->show();

                $student_details_row_2->close();

            $student_details_row->close();

        $form->close();

?>