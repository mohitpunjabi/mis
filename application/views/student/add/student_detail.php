<!--p><?php //if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
<?php  //echo form_open_multipart('student/student_add/insert_basic_details/'.$stu_id,'onSubmit="return form_validation();"');?>
<h1 align="center">Fill your details to continue</h1>
<center>
    Admission No. : <?php //echo $stu_id;?>
</center>
<table width='80%' align="center">
	<th colspan=4></th>
    <tr>
        <td width='25%'>
            <select name="salutation" >
                <option value="mr">Mr</option>
                <option value="mrs">Mrs</option>
                <option value="ms">Ms</option>
                <option value="dr">Dr</option>
             </select>        </td>
        <td width='25%'>
            <input type="text" name = "firstname" required="required" placeholder="First Name"/>        </td>
        <td width='25%'>
            <input type="text" name = "middlename" id = "middlename" placeholder="Middle Name"/>        </td>
        <td width='25%'>
            <input type="text" name = "lastname" id = "lastname" placeholder="Last Name"/>        </td>
    </tr>
    <tr>
        <td>
          पूरा नाम हिन्दी में        </td>
        <td>
            <input type="text" id="stud_name_hindi" name="stud_name_hindi"/>        </td>
        <td>
            Gender        </td>
        <td>
            <input type="radio" name="sex" value="male" checked>Male</input>
            <input type="radio" name="sex" value="female">Female</input>
            <input type="radio" name="sex" value="others">Others</input>        </td>
    </tr>
    <tr>
        <td>
            Date Of Birth        </td>
        <td>
            <input type="date" name="dob" value="<?php //echo date("Y-m-d",time()+(19800));?>" max=<?php //echo date("Y-m-d", time()+(19800)); ?> >        </td>
        <td>
            Place of Birth        </td>
        <td>
            <input type="text" name="pob" required="required"/>        </td>
    </tr>
    <tr>
        <td>
            Physically Challenged        </td>
        <td>
            <input type="radio" name="pd" value="yes" />Yes
            <input type="radio" name="pd" value="no" checked />No        </td>
        <td>Blood Group</td>
        <td>
            <select name="blood_group">
                <option value="apos">A+</option>
                <option value="aneg">A-</option>
                <option value="bpos">B+</option>
                <option value="bneg">B-</option>
                <option value="ops">O+</option>
                <option value="oneg">O-</option>
                <option value="abpos">AB+</option>
                <option value="abneg">AB-</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Kashmiri Immigrant        </td>
        <td>
            <input type="radio" name="kashmiri" value="yes"/>Yes
            <input type="radio" name="kashmiri" checked value="no"/>No        </td>
        <td>
            Marital Status        </td>
        <td>
            <select name="mstatus" >
                <option value="unmarried">Unmarried</option>
                <option value="married">Married</option>
                <option value="widow">Widow</option>
                <option value="widower">Widower</option>
                <option value="separated">Separated</option>
                <option value="divorcee">Divorcee</option>
             </select>        </td> 
    </tr>
    <tr>
        <td>
            Category        </td>
        <td>
            <select name="category">
                <option value="General">GEN</option>
                <option value="OBC">OBC</option>
                <option value="SC">SC</option>
                <option value="ST">ST</option>
                <option value="Others">Others</option>
             </select>        </td>
        <td>
            Religion        </td>
        <td>
            <select name="religion">
                <option value="HINDU">HINDU</option>
                <option value="CHISTIAN">CHRISTIAN</option>
                <option value="MUSLIM">MUSLIM</option>
                <option value="SIKH">SIKH</option>
                <option value="BAUDHH">BAUDHH</option>
                <option value="JAIN">JAIN</option>
                <option value="PARSI">PARSI</option>
                <option value="YAHUDI">YAHUDI</option>
                <option value="Others">Others</option>
             </select>        </td>
    </tr>
    <tr>
        <td>
            Nationality        </td>
        <td>
            <input type="text" name="nationality" required="required" value="Indian"/>        </td>
        <td>
            AADHAR Card No :        </td>
        <td>
            <input type="text" name="aadhar_no" id="aadhar_no"/>        </td>
    </tr>
    <tr>
        <td>
            Identification Mark     </td>
        <td>
            <input type="text" name="identification_mark" required="required"/>     </td>
    </tr>
</table>
<table width='80%' align="center" colspan=6>
    <tr>
        <th width='33%' colspan=2>
            Father's Detail
        </th>
        <th width='34%' colspan=2>
            Mother's Detail
        </th>
        <th width='33%' colspan=2>
            Guardian's Detail
            <input style="margin-top:2.5px;" type='checkbox' id ="depends_on"  name="depends_on"  onchange="depends_on_whom()"/>
        </th>
    </tr>
    <tr>
        <td>
            Father's Name
        </td>
        <td>
            <input type="text" id="father_name" name="father_name"  />
        </td>
        <td>
            Mother's Name
        </td>
        <td>
            <input type="text" id="mother_name" name="mother_name" />
        </td>
        <td>
            Guardian's Name<br/>
        </td>
        <td>
            <input type="text" id="guardian_name" name="guardian_name" disabled />
        </td>
    </tr>
    <tr>
        <td>
            Father's Occupation
        </td>
        <td>
            <input type="text" id="father_occupation" name="father_occupation" />
        </td>
        <td>
            Mother's Occupation
        </td>
        <td>
            <input type="text" id="mother_occupation" name="mother_occupation" />
        </td>
        <td>
            Relationship
        </td>
        <td>
            <input type="text" id="guardian_relation_name" name="guardian_relation_name" disabled />
        </td>
    </tr>
    <tr>
        <td>
            Father's Gross Annual Income
        </td>
        <td>
            <input type="text" id="father_gross_income" name="father_gross_income"  />
        </td>
        <td>
            Mother's Gross Annual Income
        </td>
        <td>
            <input type="text" id="mother_gross_income" name="mother_gross_income"  />
        </td>
    </tr>
</table>
<table width='80%' align="center">
    <th colspan=4></th>
    <tr>
        <td width='25%'>Parent/Guardian Mobile No</td>
        <td width='25%'><input type="text" name="parent_mobile" id="parent_mobile" required="required"></td>
        <td width='25%'>Parent/Guardian Landline No</td>
        <td width='25%'><input type="text" name="parent_landline" id="parent_landline"></td>
    </tr>
    <tr><th colspan=4 >Details of Admission</th></tr>
    <tr>
        <td>
            Migration Certificate
        </td>
        <td>
            <input type="text" name="migration_cert" required="required"/>
        </td>
        <td>
            Roll No.
        </td>
        <td>
            <input type="text" name = "roll_no" id = "roll_no" placeholder="eg. IIT-JEE enrollment no."/>
        </td>
    </tr>
    <tr>
        <td>
            Admission Based On          </td>
        <td>
            <select name="admn_based_on" id="id_admn_based_on" onchange="select_exam_scores()">
                <option value="iitjee" selected="selected" >IIT JEE</option>
                <option value="isme">ISM Entrance</option>
                <option value="gate">GATE</option>
                <option value="cat">CAT</option>
                <option value="direct">Direct</option>
                <option value="others">Others</option>
             </select>        </td>
        <td>
            Other Mode of Admission </td>
        <td>
            <input type="text" id="other_mode_of_admission" name="mode_of_admission" disabled />
        </td>
         
    </tr>
     <tr>
        <td>
            
            IIT JEE General Rank<br/>        </td>
         <td><input type="text" id="iitjee_rank" name="iitjee_rank" value="0" /></td>
   <td>
            
            IIT JEE Category  Rank<br/>        </td>
         <td><input type="text" id="iitjee_cat_rank" name="iitjee_cat_rank" value="0" />
        </td>
        
    </tr>
    <tr>
        <td>
            
            GATE Score<br/>        </td>
         <td><input type="text" id="gate_score" name="gate_score"  value="0" disabled /></td>
      
      <td>      
            CAT Score<br/>        </td>
         <td><input type="text" id="cat_score" name="cat_score" value="0" disabled /></td>
    </tr>
    <tr>
        
        <td>
            Student Type        </td>
        <td>
            <select name="stu_type" id="stu_type" onchange="button_for_add()">
                <?php
                    /*foreach($stu_type as $row)
                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';*/
                ?>
             </select>        </td>
        <td>
            Present Semester
        </td>
        <td>
            <select name="semester">
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
                <option value='6'>6</option>
                <option value='7'>7</option>
                <option value='8'>8</option>
                <option value='9'>9</option>
                <option value='10'>10</option>
            </select>
        </td>
    </tr>
</table>
<table width="80%" align="center" colspan=6>
    <th colspan=6></th>
    <tr>
    	<td>
        	Department        </td>
    	<td>
			<select name="department" id="depts" onchange="options_of_courses()">
            	<?php
                    /*if($academic_departments === FALSE)
                        echo '<option disabled="disabled" selected>No Department</option>';
					else
                        foreach ($academic_departments as $row)
                        {
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }*/
				?>
            </select>        </td>
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
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }*/
                ?>
            </select>        </td>
        
    </tr>
</table>
<table width="80%" align="center">
    <th colspan=4>Your Bank Details</th>
	<tr>
        <td>
            Bank Name       </td>
        <td>
            <input type="text" name="bank_name" required="required"/>       </td>
        <td>
            Bank Account No     </td>
        <td>
            <input type="text" name="bank_account_no" required="required"/>     </td>
        
    </tr>
    <tr><th colspan=4 >Details of Fees Payment at the time of Admission</th></tr><tr></tr>
	<tr>
		<td>
			Mode of Payment :		</td>
		<td>
        	<select name="fee_paid_mode" >
				<option value="dd">Demand Draft</option>
                <option value="cheque">CHEQUE</option>
                <option value="cash">CASH</option>
                <option value="online">ONLINE TRANSFER </option>
                <option value="none" selected>NONE </option>
             </select>        </td>

		<td>
			Fees Paid Date	</td>
		<td>
  	      	<input type="date" name="fee_paid_date" value="<?php //echo date("Y-m-d",time()+(19800));?>" max=<?php //echo date("Y-m-d", time()+(19800)); ?> >        </td>
    </tr>
	<tr>
		<td>
			DD/CHEQUE/ONLINE/CASH  No 		</td>
		<td>
			<input type="text" name="fee_paid_dd_chk_onlinetransaction_cashreceipt_no" id="fee_paid_dd_chk_onlinetransaction_cashreceipt_no"/>		</td>
        <td>
            Fees Paid Amount    </td>
        <td>
            <input type="text" name="fee_paid_amount" id="fee_paid_amount" />        </td>
	
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
  	      	<input type="text" name="line11" required="required" tabindex="10" />        </td>
    	<td>
        	Address Line 1        </td>
    	<td>
  	      	<input type="text" name="line12" required="required" tabindex="17" />        </td>
    </tr>
    <tr>
    	<td>
        	Address Line 2        </td>
    	<td>
  	      	<input type="text" name="line21" required="required" tabindex="11"/>        </td>
    	<td>
        	Address Line 2        </td>
    	<td>
  	      	<input type="text" name="line22" tabindex="18" required="required"/>        </td>
    </tr>
	<tr>
    	<td>
        	City        </td>
    	<td>
  	      	<input type="text" name="city1" tabindex="12" required="required"/>        </td>
        <td>
        	City        </td>
    	<td>
  	      	<input type="text" name="city2"  tabindex="18" required="required"/>        </td>
    </tr>
    <tr>
    	<td>
        	State        </td>
    	<td>
            <input type="text" name="state1" tabindex="13" required="required"/>
  	    </td>
    	<td>
        	State        </td>
    	<td>
            <input type="text" name="state2" tabindex="19" required="required"/>
  	     </td>
    </tr>
    <tr>
    	<td>
        	Pin code        </td>
    	<td>
  	      	<input type="text" name="pincode1" id="pincode1" tabindex="14" required="required"/>        </td>
    	<td>
        	Pin code        </td>
    	<td>
  	      	<input type="text" name="pincode2" id="pincode2" tabindex="19" required="required"/>        </td>
    </tr>
	<tr>
    	<td>
        	Country        </td>
    	<td>
  	      	<input type="text"  tabindex="15" name="country1" required="required" value="India"/>        </td>
    	<td>
        	Country        </td>
    	<td>
  	      	<input type="text" name="country2" tabindex="20" required="required" value="India"/>        </td>
    </tr>
    <tr>
    	<td>
        	Contact No        </td>
    	<td>
  	      	<input type="text"  tabindex="16" name="contact1" id="contact1" required="required"/>        </td>
    	<td>
        	Contact No        </td>
    	<td>
  	      	<input type="text" name="contact2" id="contact2"  tabindex="21" required="required"/>        </td>
    </tr>
    <tr>
	<td colspan=4 align='center'>
	<input type='checkbox' id ="correspondence_addr"  name="correspondence_addr" checked="checked" onchange="corrAddr()"/> 
	<b>Correspondence address same as Permanent address.</b></td>
	</tr>

	<tr >
		<td colspan='4'><div id="corr_addr" style="display:none;">
			<table   width='100%' >
				<th colspan='4'>Corresspondence Address</th>
		
				<tr >
					<td  align="right">
						Address Line 1					</td>
					<td colspan="2">
						<input type="text" name="line13" id="line13"/>					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						Address Line 2					</td>
					<td colspan="2">
						<input type="text" name="line23" id="line23"/>					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						City					</td>
					<td colspan="2">
						<input type="text" name="city3" id="city3"/>					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						State					</td>
					<td colspan="2">
                        <input type="text" name="state3" id="state3"/>
				   </td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						Pin code					</td>
					<td colspan="2">
						<input type="text" name="pincode3" id="pincode3"/>					</td>
				</tr>
				<tr>
					 <td colspan="2" align="right">
						Country					</td>
					<td colspan="2">
						<input type="text" name="country3" id="country3" value="India" />					</td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						Contact No					</td>
					<td colspan="2">
						<input type="text" name="contact3" id="contact3"/>					</td>
				</tr>
			</table>
		</div></td>
	</tr>
    <tr><th colspan=4 >Editable Section</th></tr><tr></tr>
        <tr>
        	<td>Email</td>
        	<td><input type="email" name="email" required="required"></td>
			<td>Alternate Email</td>
        	<td><input type="email" name="alternate_email_id" id="alternate_email_id" ></td>
            
        </tr>
		<tr>
        	<td>Mobile No</td>
        	<td><input type="text" name="mobile" id="mobile" required="required"></td>
            <td>Alternate Mobile No</td>
            <td><input type="text" name="alternate_mobile" id="alternate_mobile"></td>
        </tr>
		<tr>
        	<td>Hobbies</td>
        	<td><input type="text" name="hobbies" id="hobbies"></td>
            <td>Favourite Pass Time</td>
        	<td><input type="text" name="favpast" id="favpast"></td>
        </tr>
        <tr>
            <td>
                Extra-Curricular Activities ( if any):      </td>
            <td>
                <input type="text" name="extra_activity" id="extra_activity"/>     </td>
            <td>
                Any other relevant information      </td>
            <td>
                <input type="text" name="any_other_information" id="any_other_information"/>      </td>
        </tr>
</table>
<table width='80%' align="center">
<tr><th colspan=7 >Educational Qualificatoins</th></tr><tr></tr>
</table>
<table width='80%' align="center" id="tableid">
     <tr>
     <th>S no.</th>
     <th>Examination</th>
     <th>Branch/Specialization</th>
     <th>School/College/University/Institute</th>
     <th>Year</th>
     <th>Percentage/Grade</th>
     <th>Class/Division</th>
     </tr>
        <tr id="addrow">
            <td id="sno">1</td>
            <td><input type="text" name="exam4[]"/></td>
            <td><input type="text" name="branch4[]"/></td>
            <td><input type="text" name="clgname4[]"/></td>
            <td><select name="year4[]">
                <?php
                    /*$year = 2005;
                    $last_year = date('Y');
                    while($year <= $last_year)
                    {
                        echo '<option value="'.$year.'">'.$year.'</option>';
                        $year++;
                    }*/
                ?>
            </select></td>
            <td><input type="text" name="grade4[]" /></td>
            <td><select name="div4[]"/>
                <option value="first">FIRST</option>
                <option value="second">SECOND</option>
                <option value="third">THIRD</option>
                <option value="na">NA</option>
            </selcet></td>
        </tr>
</table>
<center><input type="button" name="add" id="add" value="Add More" onClick="onclick_add();"/></center>
<table width="80%" align="center">
        <tr><th colspan=2 >Photograph</th></tr><tr></tr>
        <tr  height="150">
            <td width="145" id="preview">
                <img src="<?php //echo base_url(); ?>assets/images/student/noProfileImage.png" id="view_photo" width="145" height="150"/></td>
        	<td align="center">Click on choose file to select picture<br>
            	<input type="file" name="photo" id="photo" required="required" ><br>
                <input type="button" value="Preview" onClick="preview_pic();">	
            </td>
		</tr>
</table>
<table width='80%' align="center">
    <th colspan=4>Your Password</th>
    <tr>
        <td width='25%'>
            Password
        </td>
        <td width='25%'>
            <input type="password" name="password" id="password" required />
        </td>
        <td width='25%'>
            Confirm Password
        </td>
        <td width='25%'>
            <input type="password" name="confirm_password" id="confirm_password" required />
        </td>
    </tr>
</table>
<center>
<input type = "submit" value="Next"/>
</center>
<?php //echo form_close(); ?>
<br /><br /-->































<?php

    $ui = new UI();

        $form=$ui->form()
                 ->action('student/student_add/insert_basic_details/'.$stu_id)
                 ->multipart()
                 ->id('form_submit')
                 ->open();


            $student_admn_no = $ui->row()
                                  ->open();

                $column1 = $ui->col()
                              ->width(4)
                              ->open();

                    echo '<label>Admission No.</label>';

                $column1->close();

                $column2 = $ui->col()
                              ->width(6)
                              ->open();

                    echo $stu_id;

                $column2->close();

            $student_admn_no->close();

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
                               ->options(array($ui->option()->value('mr')->text('Mr'),
                                               $ui->option()->value('mrs')->text('Mrs'),
                                               $ui->option()->value('ms')->text('Ms'),
                                               $ui->option()->value('dr')->text('Dr')))
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
                               ->value('male')
                               ->checked()
                               ->show();

                            $ui->radio()
                               ->name('sex')
                               ->label('Female')
                               ->value('female')
                               ->show();

                            $ui->radio()
                               ->name('sex')
                               ->label('Others')
                               ->value('others')
                               ->show();

                        $column_gender->close();

                        /*$column5 = $ui->col()
                                      ->width(3)
                                      ->open();*/

                            $ui->datePicker()
                               ->label('Date of Birth')
                               ->width(3)
                               ->name('dob')
                               ->placeholder(date("Y-m-d", time()+(19800)))
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
                               ->show();

                            $ui->radio()
                               ->name('pd')
                               ->label('No')
                               ->value('no')
                               ->checked()
                               ->show();

                        $column_pd->close();

                        $ui->select()
                           ->name('blood_group')
                           ->width(3)
                           ->label('Blood Group')
                           ->options(array($ui->option()->value('A+')->text('A+'),
                                           $ui->option()->value('A-')->text('A-'),
                                           $ui->option()->value('B+')->text('B+'),
                                           $ui->option()->value('B-')->text('B-'),
                                           $ui->option()->value('O+')->text('O+'),
                                           $ui->option()->value('O-')->text('O-'),
                                           $ui->option()->value('AB+')->text('AB+'),
                                           $ui->option()->value('AB-')->text('AB-')))
                           ->show();

                        $column_ki = $ui->col()
                                        ->width(3)
                                        ->open();
                            echo '<label>Kashmiri Immigrant</label>';

                            $ui->radio()
                               ->name('kashmiri')
                               ->label('Yes')
                               ->value('yes')
                               ->show();

                            $ui->radio()
                               ->name('kashmiri')
                               ->label('No')
                               ->value('no')
                               ->checked()
                               ->show();

                        $column_ki->close();

                        $ui->select()
                           ->name('mstatus')
                           ->width(3)
                           ->label('Marital Status')
                           ->options(array($ui->option()->value('unmarried')->text('Unmarried'),
                                           $ui->option()->value('married')->text('Married'),
                                           $ui->option()->value('widow')->text('Widow'),
                                           $ui->option()->value('Widower')->text('Widower'),
                                           $ui->option()->value('divorcee')->text('Divorcee'),
                                           $ui->option()->value('separated')->text('Separated')))
                           ->show();

                    $student_personal_details_row_2->close();

                    $student_personal_details_row_3 = $ui->row()
                                                         ->open();

                        $ui->select()
                           ->name('category')
                           ->width(3)
                           ->label('Category')
                           ->options(array($ui->option()->value('General')->text('GEN'),
                                           $ui->option()->value('obc')->text('OBC'),
                                           $ui->option()->value('SC')->text('SC'),
                                           $ui->option()->value('ST')->text('ST'),
                                           $ui->option()->value('Others')->text('OTHERS')))
                           ->show();

                        $ui->select()
                           ->name('religion')
                           ->width(3)
                           ->label('Religion')
                           ->options(array($ui->option()->value('HINDU')->text('HINDU'),
                                           $ui->option()->value('CHRISTIAN')->text('CHRISTIAN'),
                                           $ui->option()->value('MUSLIM')->text('MUSLIM'),
                                           $ui->option()->value('SIKH')->text('SIKH'),
                                           $ui->option()->value('BAUDHH')->text('BAUDHH'),
                                           $ui->option()->value('JAIN')->text('JAIN'),
                                           $ui->option()->value('PARSI')->text('PARSI'),
                                           $ui->option()->value('YAHUDI')->text('YAHUDI'),
                                           $ui->option()->value('OTHERS')->text('OTHERS')))
                           ->show();

                        $ui->input()
                           ->label('Nationality')
                           ->name('nationality')
                           ->value('Indian')
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Aadhaar Card No.')
                           ->id('aadhaar_no')
                           ->name('aadhaar_no')
                           ->width(3)
                           ->show();

                    $student_personal_details_row_3->close();

                    $student_personal_details_row_4 = $ui->row()
                                                         ->open();

                        $ui->input()
                           ->label('Identification Mark')
                           ->name('identification_mark')
                           ->required()
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
                               ->show();

                            $ui->input()
                               ->label('Father\'s Occupation')
                               ->id('father_occupation')
                               ->name('father_occupation')
                               ->show();

                            $ui->input()
                               ->label('Father\'s Gross Annual Income')
                               ->id('father_gross_income')
                               ->name('father_gross_income')
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
                               ->show();

                            $ui->input()
                               ->label('Mother\'s Occupation')
                               ->id('mother_occupation')
                               ->name('mother_occupation')
                               ->show();

                            $ui->input()
                               ->label('Mother\'s Gross Annual Income')
                               ->id('mother_gross_income')
                               ->name('mother_gross_income')
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
                               ->show();

                            $ui->input()
                               ->label('Guardian\'s Name')
                               ->id('guardian_name')
                               ->name('guardian_name')
                               ->disabled()
                               ->show();

                            $ui->input()
                               ->label('Relationship')
                               ->id('guardian_relation_name')
                               ->name('guardian_relation_name')
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
                           ->width(6)
                           ->name('parent_mobile')
                           ->show();

                        $ui->input()
                           ->label('Parent/Guardian Landline No')
                           ->id('parent_landline')
                           ->width(6)
                           ->name('parent_landline')
                           ->show();

                    $family_contact_details_row->close();

                $student_family_details_box->close();

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
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Address Line 2')
                               ->name('line21')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('City')
                               ->name('city1')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('State')
                               ->name('state1')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Pincode')
                               ->name('pincode1')
                               ->id('pincode1')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Country')
                               ->name('country1')
                               ->value('India')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Contact No.')
                               ->name('contact1')
                               ->id('contact1')
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
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Address Line 2')
                               ->name('line22')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('City')
                               ->name('city2')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('State')
                               ->name('state2')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Pincode')
                               ->name('pincode2')
                               ->id('pincode2')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Country')
                               ->name('country2')
                               ->value('India')
                               ->required()
                               ->show();

                            $ui->input()
                               ->label('Contact No.')
                               ->name('contact2')
                               ->id('contact2')
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
                               ->checked()
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

                                $ui->input()
                                   ->label('Address Line 1')
                                   ->name('line13')
                                   ->id('line13')
                                   ->show();

                                $ui->input()
                                   ->label('Address Line 2')
                                   ->name('line23')
                                   ->id('line23')
                                   ->show();

                                $ui->input()
                                   ->label('City')
                                   ->name('city3')
                                   ->id('city3')
                                   ->show();

                                $ui->input()
                                   ->label('State')
                                   ->name('state3')
                                   ->id('state3')
                                   ->show();

                                $ui->input()
                                   ->label('Pincode')
                                   ->name('pincode3')
                                   ->id('pincode3')
                                   ->show();

                                $ui->input()
                                   ->label('Country')
                                   ->name('country3')
                                   ->id('country3')
                                   ->value('India')
                                   ->show();

                                $ui->input()
                                   ->label('Contact No.')
                                   ->name('contact3')
                                   ->id('contact3')
                                   ->show();

                        $correspondence_address_details_box->close();

                        $corr_address_col_2->close();

                    $address_details_row_3 ->close();

                    ?></div><?php

                $student_address_details_box->close();

                $student_educational_details_box = $ui->box()
                                                      ->uiType('primary')
                                                      ->solid()
                                                      ->title('Educational Details')
                                                      ->open();

                    $educational_details_row_1 = $ui->row()
                                                    ->open();

                        $educational_detail_col = $ui->col()
                                                     ->width(12)
                                                     ->open();

                        $table = $ui->table()
                                    ->responsive()
                                    ->id('tableid')
                                    ->hover()
                                    ->bordered()
                                    ->open();

                            $year_array = array();
                            $year = 1926;
                            $present_year = date('Y');
                            while ($year <= $present_year)
                            {
                                $year_array[] = $ui->option()->value($year)->text($year);
                                $year_array = array_values($year_array);
                                $year++;
                            }


                            echo '
                            <tr>
                                <th>S no.</th>
                                <th>Examination</th>
                                <th>Branch/Specialization</th>
                                <th>School/College/University/Institute</th>
                                <th>Year</th>
                                <th>Percentage/Grade</th>
                                <th>Class/Division</th>
                            </tr>
                            <tr id="addrow">
                                <td id="sno">1</td>
                                <td>';$ui->input()
                                         ->name('exam4[]')
                                         ->show();echo'</td>
                                <td>';$ui->input()
                                         ->name('branch4[]')
                                         ->show();echo'</td>
                                <td>';$ui->input()
                                         ->name('clgname4[]')
                                         ->show();echo'</td>
                                <td>';$ui->select()
                                         ->name('year4[]')
                                         ->options($year_array)
                                         ->show();echo'</td>
                                <td>';$ui->input()
                                         ->name('grade4[]')
                                         ->show();echo'</td>
                                <td>';$ui->select()
                                         ->name('div4[]')
                                         ->options(array($ui->option()->value('first')->text('FIRST'),
                                               $ui->option()->value('second')->text('SECOND'),
                                               $ui->option()->value('third')->text('THIRD'),
                                               $ui->option()->value('na')->text('NA')))
                                         ->show();echo'</td>
                            </tr>';

                        $table->close();

                        $educational_detail_col->close();

                    $educational_details_row_1->close();

                    $educational_details_row_2 = $ui->row()
                                                    ->open();

                        $educational_detail_col_1 = $ui->col()
                                                       ->width(5)
                                                       ->open();
                        $educational_detail_col_1->close();

                        $educational_detail_col_2 = $ui->col()
                                                       ->width(2)
                                                       ->open();

                            $ui->button()
                               ->block()
                               ->value('Add More')
                               ->id('add')
                               ->name('add')
                               ->show();

                        $educational_detail_col_2->close();

                    $educational_details_row_2->close();

                $student_educational_details_box->close();

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
                           ->show();

                        $ui->input()
                           ->label('Roll No.')
                           ->id('roll_no')
                           ->name('roll_no')
                           ->placeholder('eg. IIT-JEE enrollment no.')
                           ->width(3)
                           ->show();

                        $ui->select()
                           ->name('admn_based_on')
                           ->id('id_admn_based_on')
                           ->width(3)
                           ->label('Admission Based On')
                           ->options(array($ui->option()->value('iitjee')->text('IIT JEE'),
                                           $ui->option()->value('isme')->text('ISM Entrance'),
                                           $ui->option()->value('gate')->text('GATE'),
                                           $ui->option()->value('cat')->text('CAT'),
                                           $ui->option()->value('direct')->text('Direct'),
                                           $ui->option()->value('others')->text('Others')))
                           ->show();

                        $ui->input()
                           ->label('Other Mode of Admission')
                           ->id('other_mode_of_admission')
                           ->name('mode_of_admission')
                           ->disabled()
                           ->width(3)
                           ->show();

                    $admission_details_row_1->close();

                    $admission_details_row_2 = $ui->row()
                                                  ->open();

                        $ui->input()
                           ->label('IIT JEE General Rank')
                           ->id('iitjee_rank')
                           ->name('iitjee_rank')
                           ->value('0')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('IIT JEE Category Rank')
                           ->id('iitjee_cat_rank')
                           ->name('iitjee_cat_rank')
                           ->value('0')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Gate Score')
                           ->id('gate_score')
                           ->name('gate_score')
                           ->disabled()
                           ->value('0')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Cat Score')
                           ->id('cat_score')
                           ->name('cat_score')
                           ->value('0')
                           ->disabled()
                           ->width(3)
                           ->show();

                    $admission_details_row_2->close();

                    $admission_details_row_3 = $ui->row()
                                                ->open();

                        $ui->select()
                           ->label('Student Type')
                           ->id('stu_type')
                           ->name('stu_type')
                           ->width(3)
                           ->options(array($ui->option()->value('ug')->text('Under Graduate'),
                                           $ui->option()->value('g')->text('Graduate'),
                                           $ui->option()->value('pg')->text('Post Graduate'),
                                           $ui->option()->value('jrf')->text('Junior Research Fellow'),
                                           $ui->option()->value('pd')->text('Post Doctoral Fellow')))
                           ->show();

                        $ui->select()
                           ->label('Present Semester')
                           ->name('semester')
                           ->width(3)
                           ->options(array($ui->option()->value('1')->text('1'),
                                           $ui->option()->value('2')->text('2'),
                                           $ui->option()->value('3')->text('3'),
                                           $ui->option()->value('4')->text('4'),
                                           $ui->option()->value('5')->text('5'),
                                           $ui->option()->value('6')->text('6'),
                                           $ui->option()->value('7')->text('7'),
                                           $ui->option()->value('8')->text('8'),
                                           $ui->option()->value('9')->text('9'),
                                           $ui->option()->value('10')->text('10')))
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
                                $dept_array[] = $ui->option()->value($row->id)->text($row->name);
                                $dept_array = array_values($dept_array);
                            }

                        $course_array = array();

                        if($courses === FALSE)
                            $course_array[] = $ui->option()->value('none')->text('No Course');
                        else
                            foreach ($courses as $row)
                            {
                                $course_array[] = $ui->option()->value($row->id)->text($row->name);
                                $course_array = array_values($course_array);
                            }

                        $branch_array = array();

                        if($branches === FALSE)
                            $branch_array[] = $ui->option()->value('none')->text('No Branch');
                        else
                            foreach ($branches as $row)
                            {
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
                           ->required()
                           ->width(6)
                           ->show();

                        $ui->input()
                           ->label('Bank Account No.')
                           ->name('bank_account_no')
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
                           ->options(array($ui->option()->value('dd')->text('CHEQUE'),
                                           $ui->option()->value('cheque')->text('CASH'),
                                           $ui->option()->value('online')->text('ONLINE TRANSFER'),
                                           $ui->option()->value('none')->text('NONE')))
                           ->show();

                        $ui->datePicker()
                           ->label('Fees Paid Date')
                           ->width(3)
                           ->name('fee_paid_date')
                           ->placeholder(date("Y-m-d", time()+(19800)))
                           ->dateFormat('dd-mm-yyyy')
                           ->show();

                        $ui->input()
                           ->label('DD/CHEQUE/ONLINE/CASH NO.')
                           ->name('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
                           ->id('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Fees Paid Amount')
                           ->name('fee_paid_amount')
                           ->id('fee_paid_amount')
                           ->width(3)
                           ->show();

                    $fee_details_row_1 ->close();

                $student_fee_details_box->close();

                $student_editable_details_box = $ui->box()
                                                  ->uiType('primary')
                                                  ->solid()
                                                  ->title('Editable Details')
                                                  ->open();

                    $editable_details_row_1 = $ui->row()
                                                 ->open();

                        $ui->input()
                           ->label('Email')
                           ->name('email')
                           ->type('email')
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Alternate Email')
                           ->name('alternate_email_id')
                           ->id('alternate_email_id')
                           ->type('email')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Mobile No.')
                           ->name('mobile')
                           ->id('mobile')
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Alternate Mobile No.')
                           ->name('alternate_mobile')
                           ->id('alternate_mobile')
                           ->width(3)
                           ->show();


                    $editable_details_row_1 ->close();

                    $editable_details_row_2 = $ui->row()
                                                 ->open();

                        $ui->input()
                           ->label('Hobbies')
                           ->name('hobbies')
                           ->width(3)
                           ->id('hobbies')
                           ->show();

                        $ui->input()
                           ->label('Favourite Pass Time')
                           ->name('favpast')
                           ->id('favpast')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Extra-Curricular Activities ( if any):')
                           ->name('extra_activity')
                           ->id('extra_activity')
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Any other relevant information')
                           ->name('any_other_information')
                           ->id('any_other_information')
                           ->width(3)
                           ->show();


                    $editable_details_row_2 ->close();

                $student_editable_details_box->close();

                $student_photo_details_box = $ui->box()
                                                ->uiType('primary')
                                                ->solid()
                                                ->title('Photograph')
                                                ->open();

                    $photo_details_row_1 = $ui->row()
                                              ->open();

                        $upload_img = $ui->imagePicker()
                                         ->id('photo')
                                         ->width(12)
                                         ->name('photo')
                                         ->required()
                                         ->show();

                    $photo_details_row_1->close();

                $student_photo_details_box->close();

                $student_password_details_box = $ui->box()
                                                   ->uiType('primary')
                                                   ->solid()
                                                   ->title('Password')
                                                   ->open();

                    $password_detail_row = $ui->row()
                                              ->open();

                        $ui->input()
                           ->type('password')
                           ->label('Password')
                           ->id('password')
                           ->name('password')
                           ->required()
                           ->width(6)
                           ->show();

                        $ui->input()
                           ->type('password')
                           ->label('Confirm Password')
                           ->id('confirm_password')
                           ->name('confirm_password')
                           ->required()
                           ->width(6)
                           ->show();

                    $password_detail_row->close();

                $student_password_details_box->close();

                $shift_submit_button_col = $ui->col()
                                              ->width(5)
                                              ->open();
                $shift_submit_button_col->close();

                $ui->input()
                   ->type('submit')
                   ->value('Submit')
                   ->width(2)
                   ->id('submit_button_id')
                   ->show();

            $student_details_row->close();

        $form->close();

?>