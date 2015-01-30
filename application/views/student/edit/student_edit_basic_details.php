<h1>Edit the Basic details</h1>
<?php//  echo form_open('student/student_edit/update_basic_details/'.$stu_id);   ?>
<?php
    if($correspondence_address)
        $coress_recv = true;
    else
        $coress_recv = false;
?>
<?php  echo form_open_multipart('student/student_edit/update_basic_details/'.$stu_id.'/'.$coress_recv,'onSubmit="return form_validation();"');?>
<table width='90%'>
    <th colspan=4></th>
    <tr>
        <td width='15%' id="stuId">
            Admission No.        </td>
        <td width='35%' id="stuId">
            <?php echo $stu_id;?>
        </td>
        <td>
            Present Semester
        </td>
        <td>
            <select name="semester">
                <option value='1' <?php if($stu_academic_details->semester == '1') echo "selected";?>>1</option>
                <option value='2' <?php if($stu_academic_details->semester == '2') echo "selected";?>>2</option>
                <option value='3' <?php if($stu_academic_details->semester == '3') echo "selected";?>>3</option>
                <option value='4' <?php if($stu_academic_details->semester == '4') echo "selected";?>>4</option>
                <option value='5' <?php if($stu_academic_details->semester == '5') echo "selected";?>>5</option>
                <option value='6' <?php if($stu_academic_details->semester == '6') echo "selected";?>>6</option>
                <option value='7' <?php if($stu_academic_details->semester == '7') echo "selected";?>>7</option>
                <option value='8' <?php if($stu_academic_details->semester == '8') echo "selected";?>>8</option>
                <option value='9' <?php if($stu_academic_details->semester == '9') echo "selected";?>>9</option>
                <option value='10' <?php if($stu_academic_details->semester == '10') echo "selected";?>>10</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Salutation        </td>
        <td>
            <select name="salutation" >
                <option value="mr"  <?php if($user_details->salutation=="mr")echo "selected"; ?> >Mr</option>
                <option value="mrs" <?php if($user_details->salutation=="mrs")echo "selected"; ?> >Mrs</option>
                <option value="ms"  <?php if($user_details->salutation=="ms")echo "selected"; ?> >Ms</option>
                <option value="dr"  <?php if($user_details->salutation=="dr")echo "selected"; ?> >Dr</option>
            </select>
        </td>
        <td>
            First Name
        </td>
        <td>
            <input type="text" name = "firstname" required="required" value="<?= $user_details->first_name ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            Middle Name        </td>
        <td>
            <input type="text" name = "middlename" id = "middlename" value="<?= $user_details->middle_name ?>"/>        </td>
        <td>
            Last Name        </td>
        <td>
            <input type="text" name = "lastname" id = "lastname" value="<?= $user_details->last_name ?>"/>        </td>
   </tr>
   <tr>
        <td>
          पूरा नाम हिन्दी में        </td>
        <td>
            <input type="text" id="stud_name_hindi" name="stud_name_hindi" value="<?= $stu_basic_details->name_in_hindi ?>" />        </td>
         <td>
            Roll No.        </td>
        <td>
            <input type="text" name = "roll_no" id = "roll_no" value="<?= $stu_basic_details->enrollment_no ?>"/>        </td>
   </tr>
      <tr>
        <td>
            Father's Name        </td>
        <td>
            <input type="text" id="father_name" name="father_name"  value="<?= $user_other_details->father_name ?>"/>        </td>
        <td>
            Father's Occupation        </td>
        <td>
            <input type="text" id="father_occupation" name="father_occupation" value="<?= $stu_other_details->fathers_occupation ?>"/>        </td>
   </tr>
   <tr>
       <td>
            Father's Gross Annual Income        </td>
        <td>
            <input type="text" id="father_gross_income" name="father_gross_income"  value="<?= $stu_other_details->fathers_annual_income ?>"/>        </td>
       
       <td>
            Mother's Name        </td>
        <td>
            <input type="text" id="mother_name" name="mother_name" value="<?= $user_other_details->mother_name ?>"/>        </td>
       
        
       
   </tr>
  
    <tr>
         <td>
            Mother's Occupation        </td>
        <td>
            <input type="text" id="mother_occupation" name="mother_occupation" value="<?= $stu_other_details->mothers_occupation ?>"/>        </td>
        <td>
            Mother's Gross Annual Income        </td>
        <td>
            <input type="text" id="mother_gross_income" name="mother_gross_income" value="<?= $stu_other_details->mothers_annual_income ?>" />        </td>
        
   </tr>
    <tr>
        <td>
            
            Guardian's Name<br/>        </td>
      <td>
             <input type="text" id="guardian_name" name="guardian_name" value="<?= $stu_other_details->guardian_name ?>"/>
             <input style="margin-top:2.5px;" type='checkbox' id ="depends_on"  name="depends_on"  onchange="depends_on_whom()"/>        </td>
         <td>
            
            Relationship<br/>        </td>
        <td>
             <input type="text" id="guardian_relation_name" name="guardian_relation_name" value="<?= $stu_other_details->guardian_relation ?>"/>
             <!--<input style="margin-top:2.5px;" type='checkbox' id ="depends_on_relation"  name="depends_on_relation"  onchange="depends_on_whom()"/>         --></td>
    </tr>
    <tr>
            <td>Parent/Guardian Mobile No</td>
            <td><input type="text" name="parent_mobile" id="parent_mobile" required="required" value="<?= $stu_basic_details->parent_mobile_no?>"></td>
            <td>Parent/Guardian Landline No</td>
            <td><input type="text" name="parent_landline" id="parent_landline" value="<?= $stu_basic_details->parent_landline_no?>"></td>
    </tr>
     <tr>
        <td>
            Gender        </td>
        <td>
            <input type="radio" name="sex" value="male" <?php if($user_details->sex=="m")echo "checked"; ?> >Male</input>
            <input type="radio" name="sex" value="female" <?php if($user_details->sex=="f")echo "checked"; ?> >Female</input>
            <input type="radio" name="sex" value="others" <?php if($user_details->sex=="o")echo "checked"; ?> >Others</input>
        </td>
        
   
        <td width='15%'>
            Physically Challenged        </td>
        <td width='35%'>
            <input type="radio" name="pd" value="yes" <?php if($user_details->physically_challenged=="yes")echo "checked"; ?>/>Yes
            <input type="radio" name="pd" value="no" <?php if($user_details->physically_challenged=="no")echo "checked"; ?>/>No        </td>
    </tr>
   <tr>
        <td>
            Date Of Birth        </td>
        <td>
            <input type="date" name="dob" value="<?php echo $user_details->dob;?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> >        </td>
        <td>
            Place of Birth        </td>
        <td>
            <input type="text" name="pob" required="required" value="<?= $user_other_details->birth_place ?>"/>        </td>
    </tr>
    <tr>
        <td>
            Kashmiri Immigrant        </td>
        <td>
            <input type="radio" name="kashmiri" value="yes" <?php if($user_other_details->kashmiri_immigrant=="yes")echo "checked"; ?>/>Yes
            <input type="radio" name="kashmiri" value="no" <?php if($user_other_details->kashmiri_immigrant=="no")echo "checked"; ?>/>No        </td>
        <td>Blood Group</td>
        <td>
                <select name="blood_group">
                    <option value="apos" <?php if($stu_basic_details->blood_group=="apos")echo "selected"; ?>>A+</option>
                    <option value="aneg" <?php if($stu_basic_details->blood_group=="aneg")echo "selected"; ?>>A-</option>
                    <option value="bpos" <?php if($stu_basic_details->blood_group=="bpos")echo "selected"; ?>>B+</option>
                    <option value="bneg" <?php if($stu_basic_details->blood_group=="bneg")echo "selected"; ?>>B-</option>
                    <option value="opos" <?php if($stu_basic_details->blood_group=="opos")echo "selected"; ?>>O+</option>
                    <option value="oneg" <?php if($stu_basic_details->blood_group=="oneg")echo "selected"; ?>>O-</option>
                    <option value="abpos" <?php if($stu_basic_details->blood_group=="abpos")echo "selected"; ?>>AB+</option>
                    <option value="abneg" <?php if($stu_basic_details->blood_group=="abneg")echo "selected"; ?>>AB-</option>
                </select>
        </td>
    </tr>
    <tr>
        <td>
            Date of Admission        </td>
        <td>
            <input type="date" name="entrance_date" value="<?php echo $stu_basic_details->admn_date;?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> required>
        </td>
        <td>
            Student Type        </td>
        <td>
            <select name="stu_type" id="stu_type" ><!--onchange="check_if_student_type_others()" -->
                <?php
                    foreach($stu_type as $row)
                    {
                        if($row->id == $stu_academic_details->auth_id)
                            echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                        else
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                    }
                ?>
                <!--option value="others">Others</option-->
             </select>        </td>
        <!--td>
            Student Other type   </td>
        <td>
            <input type="text" name="student_other_type" id="student_other_type" disabled/></td-->
    </tr>
<tr>
        <td>
            Admission Based On          </td>
        <td>
            <select name="admn_based_on" id="id_admn_based_on" onchange="select_exam_scores()">
                <option value="iitjee" <?php if($stu_academic_details->admn_based_on=="iitjee")echo "selected"; ?> >IIT JEE</option>
                <option value="isme" <?php if($stu_academic_details->admn_based_on=="isme")echo "selected"; ?> >ISM Entrance</option>
                <option value="gate" <?php if($stu_academic_details->admn_based_on=="gate")echo "selected"; ?> >GATE</option>
                <option value="cat" <?php if($stu_academic_details->admn_based_on=="cat")echo "selected"; ?> >CAT</option>
                <option value="direct" <?php if($stu_academic_details->admn_based_on=="direct")echo "selected"; ?> >Direct</option>
                <option value="others" <?php if($stu_academic_details->admn_based_on!="iitjee"&&$stu_academic_details->admn_based_on!="isme"&&$stu_academic_details->admn_based_on!="gate"&&$stu_academic_details->admn_based_on!="cat"&&$stu_academic_details->admn_based_on!="direct")echo "selected"; ?> >Others</option>
            </select>
        </td>
        <td>
            Other Mode of Admission </td>
        <td>
            <input type="text" id="other_mode_of_admission" name="mode_of_admission" <?php if($stu_academic_details->admn_based_on!="iitjee"&&$stu_academic_details->admn_based_on!="isme"&&$stu_academic_details->admn_based_on!="gate"&&$stu_academic_details->admn_based_on!="cat"&&$stu_academic_details->admn_based_on!="direct")echo "value=".$stu_academic_details->admn_based_on; ?>/>
        </td>
         
    </tr>
     <tr>
        <td>
            
            IIT JEE General Rank<br/>        </td>
         <td><input type="text" id="iitjee_rank" name="iitjee_rank" value="<?php echo $stu_academic_details->iit_jee_rank; ?>" />  
   <td>
            
            IIT JEE Category  Rank<br/>        </td>
         <td><input type="text" id="iitjee_cat_rank" name="iitjee_cat_rank" value="<?php echo $stu_academic_details->iit_jee_cat_rank; ?>" />
        </td>
        
    </tr>
    <tr>
        <td>
            
            GATE Score<br/>        </td>
         <td><input type="text" id="gate_score" name="gate_score"  value="<?php echo $stu_academic_details->gate_score; ?>" />
      
      <td>      
            CAT Score<br/>        </td>
         <td><input type="text" id="cat_score" name="cat_score" value="<?php echo $stu_academic_details->cat_score; ?>" />
    </tr>
    
   <tr>
        <td>
            Identification Mark     </td>
        <td>
            <input type="text" name="identification_mark" required="required" value="<?php echo $stu_basic_details->identification_mark ;?>"/>     </td>
        <td>
            Migration Certificate     </td>
        <td>
            <input type="text" name="migration_cert" required="required" value="<?php echo $stu_basic_details->migration_cert;?>"/>     </td>
        
    </tr>
    <tr>
        <td>
            Category        </td>
        <td>
            <select name="category">
                <option value="general" <?php if($user_details->category =="") echo "selected";?>>GEN</option>
                <option value="obc" <?php if($user_details->category =="") echo "selected";?>>OBC</option>
                <option value="sc" <?php if($user_details->category =="") echo "selected";?>>SC</option>
                <option value="st" <?php if($user_details->category =="") echo "selected";?>>ST</option>
                <option value="others" <?php if($user_details->category =="") echo "selected";?>>Others</option>
             </select>        </td>
        <td>
            Religion        </td>
        <td>
            <select name="religion">
                <option value="HINDU" <?php if($user_other_details->religion == "hindu") echo "selected";?>>HINDU</option>
                <option value="CHRISTIAN" <?php if($user_other_details->religion == "christian") echo "selected";?>>CHRISTIAN</option>
                <option value="MUSLIM" <?php if($user_other_details->religion == "muslim") echo "selected";?>>MUSLIM</option>
                <option value="SIKH" <?php if($user_other_details->religion == "sikh") echo "selected";?>>SIKH</option>
                <option value="BAUDHH" <?php if($user_other_details->religion == "buadhh") echo "selected";?>>BAUDHH</option>
                <option value="JAIN" <?php if($user_other_details->religion == "jain") echo "selected";?>>JAIN</option>
                <option value="PARSI" <?php if($user_other_details->religion == "parsi") echo "selected";?>>PARSI</option>
                <option value="YAHUDI" <?php if($user_other_details->religion == "yahudi") echo "selected";?>>YAHUDI</option>
                <option value="Others" <?php if($user_other_details->religion == "others") echo "selected";?>>Others</option>
             </select>        </td>
        <!--<td>
            <input type="text" name="religion" />
        </td> -->
    </tr>
    <tr>
         <td>
            Nationality        </td>
        <td>
            <input type="text" name="nationality" required="required" value="<?php echo $user_other_details->nationality;?>"/>        </td>
        <td>
            Department        </td>
        <td>
            <!--<select name="department" id="depts" onchange="options_of_branches()">   this is original -->
            <select name="department" id="depts" onchange="options_of_courses()"><!--We need to switch to select courses offered by the selected department as department offers different courses -->
                <?php
                    if($academic_departments === FALSE)
                        echo '<option disabled="disabled" selected>No Department</option>';
                    else
                        foreach ($academic_departments as $row)
                        {
                            if($row->id == $user_details->dept_id)
                                echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                            else
                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }
                ?>
            </select>        </td>
    </tr>
    <tr>
        <td>
            Course        </td>
        <td id="course">
        
            
            <select name="course" id="course_id" onchange="options_of_branches()">
                <?php
                    if($courses === FALSE)
                        echo '<option disabled="disabled" value="none" selected>No Department</option>';
                    else
                        foreach ($courses as $row)
                        {
                            if($row->id == $stu_academic_details->course_id)
                                echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                            else
                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }
                ?>
            </select>        </td>
        <td>
            Branch        </td>
        <td id="branch">
        
        <!--div id="branch_div"-->
        <select name="branch" id="branch_id">
                <?php
                    if($branches === FALSE)
                        echo '<option disabled="disabled" selected>No Department</option>';
                    else
                        foreach ($branches as $row)
                        {
                            if($row->id == $stu_academic_details->branch_id)
                                echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                            else
                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }
                ?>
            </select>        </td>
        
    </tr>
    <tr>
        <td>
            AADHAR Card No :     </td>
        <td>
            <input type="text" name="aadhar_no" id="aadhar_no" value="<?php echo $stu_other_details->aadhar_card_no;?>"/>       </td>
        <td>
            Marital Status        </td>
        <td>
            <select name="mstatus" >
                <option value="unmarried" <?php if($user_details->marital_status == "unmarried") echo"selected"; ?>>Unmarried</option>
                <option value="married" <?php if($user_details->marital_status == "married") echo"selected"; ?>>Married</option>
                <option value="widow" <?php if($user_details->marital_status == "widow") echo"selected"; ?>>Widow</option>
                <option value="widower" <?php if($user_details->marital_status == "widower") echo"selected"; ?>>Widower</option>
                <option value="separated" <?php if($user_details->marital_status == "separated") echo"selected"; ?>>Separated</option>
                <option value="divorcee" <?php if($user_details->marital_status == "divorcee") echo"selected"; ?>>Divorcee</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Bank Name       </td>
        <td>
            <input type="text" name="bank_name" required="required" value="<?php echo $stu_other_details->bank_name;?>"/>       </td>
        <td>
            Bank Account No     </td>
        <td>
            <input type="text" name="bank_account_no" required="required" value="<?php echo $stu_other_details->account_no;?>"/>     </td>
        
    </tr>
    <!--tr>
        <td>
            Extra-Curricular Activities ( if any):      </td>
        <td>
            <input type="text" name="extra_activity" id="extra_activity" value="<?php //echo $stu_other_details->extra_curricular_activity;?>"/>     </td>
        <td>
            Any other relevant information      </td>
        <td>
            <input type="text" name="any_other_information" id="any_other_information" value="<?php //echo $stu_other_details->other_relevant_info;?>"/>      </td>
        
    </tr-->
    <tr><th colspan=4 >Details of Fees Payment at the time of Admission</th></tr><tr></tr>
    <tr>
        <td>
            Mode of Payment :       </td>
        <td>
            <select name="fee_paid_mode" >
                <option value="dd" <?php if($stu_fee_details->fee_mode == "dd") echo "selected";?>>Demand Draft</option>
                <option value="cheque" <?php if($stu_fee_details->fee_mode == "cheque") echo "selected";?>>CHEQUE</option>
                <option value="cash" <?php if($stu_fee_details->fee_mode == "cash") echo "selected";?>>CASH</option>
                <option value="online" <?php if($stu_fee_details->fee_mode == "online") echo "selected";?>>ONLINE TRANSFER </option>
                <option value="none" <?php if($stu_fee_details->fee_mode == "none") echo "selected";?>>NONE </option>
             </select>        </td>

        <td>
            Fees Paid Date  </td>
        <td>
            <input type="date" name="fee_paid_date" value="<?php echo $stu_fee_details->payment_made_on;?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> >        </td>
    </tr>
    <tr>
        <td>
            DD/CHEQUE/ONLINE/CASH  No       </td>
        <td>
            <input type="text" name="fee_paid_dd_chk_onlinetransaction_cashreceipt_no" id="fee_paid_dd_chk_onlinetransaction_cashreceipt_no" value="<?php echo $stu_fee_details->transaction_id;?>"/>       </td>
        <td>
            Fees Paid Amount    </td>
        <td>
            <input type="text" name="fee_paid_amount" id="fee_paid_amount" value="<?php echo $stu_fee_details->fee_amount;?>" />        </td>
    
    <!--tr >
    </tr!-->
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
            <input type="text" name="line11" required="required" tabindex="10" value="<?php echo $present_address->line1;?>"/>        </td>
        <td>
            Address Line 1        </td>
        <td>
            <input type="text" name="line12" required="required" tabindex="17" value="<?php echo $permanent_address->line1;?>"/>        </td>
    </tr>
    <tr>
        <td>
            Address Line 2        </td>
        <td>
            <input type="text" name="line21" required="required" tabindex="11" value="<?php echo $present_address->line2;?>"/>        </td>
        <td>
            Address Line 2        </td>
        <td>
            <input type="text" name="line22" tabindex="18" required="required" value="<?php echo $permanent_address->line2;?>"/>        </td>
    </tr>
    <tr>
        <td>
            City        </td>
        <td>
            <input type="text" name="city1" tabindex="12" required="required" value="<?php echo $present_address->city;?>"/>        </td>
        <td>
            City        </td>
        <td>
            <input type="text" name="city2"  tabindex="18" required="required" value="<?php echo $permanent_address->city;?>"/>        </td>
    </tr>
    <tr>
        <td>
            State        </td>
        <td>
            <input type="text" name="state1" tabindex="13" required="required" value="<?php echo $present_address->state;?>"/>
        </td>
        <td>
            State        </td>
        <td>
            <input type="text" name="state2" tabindex="19" required="required" value="<?php echo $permanent_address->state;?>"/>
         </td>
    </tr>
    <tr>
        <td>
            Pin code        </td>
        <td>
            <input type="text" name="pincode1" id="pincode1" tabindex="14" required="required" value="<?php echo $present_address->pincode;?>"/>        </td>
        <td>
            Pin code        </td>
        <td>
            <input type="text" name="pincode2" id="pincode2" tabindex="19" required="required" value="<?php echo $permanent_address->pincode;?>"/>        </td>
    </tr>
    <tr>
        <td>
            Country        </td>
        <td>
            <input type="text"  tabindex="15" name="country1" required="required" value="<?php echo $present_address->country;?>"/>        </td>
        <td>
            Country        </td>
        <td>
            <input type="text" name="country2" tabindex="20" required="required"value="<?php echo $permanent_address->country;?>" />        </td>
    </tr>
    <tr>
        <td>
            Contact No        </td>
        <td>
            <input type="text"  tabindex="16" name="contact1" id="contact1" required="required" value="<?php echo $present_address->contact_no;?>"/>        </td>
        <td>
            Contact No        </td>
        <td>
            <input type="text" name="contact2" id="contact2"  tabindex="21" required="required" value="<?php echo $permanent_address->contact_no;?>"/>        </td>
    </tr>
    <tr>
    <td colspan=4 align='center'>
    <input type='checkbox' id ="correspondence_addr"  name="correspondence_addr" <?php if(!$correspondence_address) echo "checked"; ?> onchange="corrAddr()"/> 
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
                        <input type="text" name="line13" id="line13" <?php if($correspondence_address) echo "value=".$correspondence_address->line1; ?>/>                  </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        Address Line 2                  </td>
                    <td colspan="2">
                        <input type="text" name="line23" id="line23" <?php if($correspondence_address) echo "value=".$correspondence_address->line2; ?>/>                  </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        City                    </td>
                    <td colspan="2">
                        <input type="text" name="city3" id="city3" <?php if($correspondence_address) echo "value=".$correspondence_address->city; ?>/>                    </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        State                   </td>
                    <td colspan="2">
                        <input type="text" name="state3" id="state3" <?php if($correspondence_address) echo "value=".$correspondence_address->state; ?>/>
                   </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        Pin code                    </td>
                    <td colspan="2">
                        <input type="text" name="pincode3" id="pincode3" <?php if($correspondence_address) echo "value=".$correspondence_address->pincode; ?>/>                  </td>
                </tr>
                <tr>
                     <td colspan="2" align="right">
                        Country                 </td>
                    <td colspan="2">
                        <input type="text" name="country3" id="country3" <?php if($correspondence_address) echo "value=".$correspondence_address->country; ?>/>                   </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        Contact No                  </td>
                    <td colspan="2">
                        <input type="text" name="contact3" id="contact3" <?php if($correspondence_address) echo "value=".$correspondence_address->contact_no; ?>/>                  </td>
                </tr>
            </table>
        </div></td>
    </tr>
    <!--tr><th colspan=4 >Editable Section</th></tr><tr></tr>
    <tr><th colspan=4></th></tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" required="required" value="<?php //echo $user_details->email;?>"></td>
            <td>Alternate Email</td>
            <td><input type="email" name="alternate_email_id" id="alternate_email_id" value="<?php //echo $stu_basic_details->alternate_email_id?>"></td>
            
        </tr>
        <tr>
            <td>Mobile No</td>
            <td><input type="text" name="mobile" id="mobile" required="required" value="<?php //echo $user_other_details->mobile_no;?>"></td>
            <td>Alternate Mobile No</td>
            <td><input type="text" name="alternate_mobile" id="alternate_mobile" value="<?php //echo $stu_basic_details->alternate_mobile_no;?>"></td>
        </tr>
        <tr>
            <td>Hobbies</td>
            <td><input type="text" name="hobbies" id="hobbies" value="<?php //echo $user_other_details->hobbies;?>"></td>
            <td>Favourite Pass Time</td>
            <td><input type="text" name="favpast" id="favpast" value="<?php //echo $user_other_details->fav_past_time;?>"></td>
        </tr-->
</table>
<input type = "submit" value="Update"/>
<?php echo form_close(); ?>
<a href= <?= site_url('student/student_edit')?> ><button>Back</button></a>
