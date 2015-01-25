<p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
<?php  echo form_open_multipart('student/student_add/insert_basic_details','onSubmit="return form_validation();"');?>
<h1 align="center">Fill up the details of Student</h1>
<table width='90%'>
	<th colspan=4></th>
    <tr>
    	<td width='15%' id="stuId">
        	Admission No.        </td>
        <td width='35%' id="stuId">
        	<input type="text" name="stu_id" required="required" /> 
            <!--input type="button" value="Go" id="fetch_id_btn" onClick="fetch_details()"/>
            <i class="loading" id="stuIdIcon" ></i-->
        </td>
    </tr>
    <tr>
        <td>
            Password
        </td>
        <td>
            <input type="password" name="password" id="password" required />
        </td>
        <td>
            Confirm Password
        </td>
        <td>
            <input type="password" name="confirm_password" id="confirm_password" required />
        </td>
    </tr>
	<tr>
    	<td>
        	Salutation        </td>
        <td>
			<select name="salutation" >
                <option value="mr">Mr</option>
                <option value="mrs">Mrs</option>
                <option value="ms">Ms</option>
                <option value="dr">Dr</option>
             </select>        </td>
        <td>
        	First Name        </td>
        <td>
        	<input type="text" name = "firstname" required="required"/>        </td>
    </tr>
   	<tr>
    	<td>
        	Middle Name        </td>
        <td>
        	<input type="text" name = "middlename" />        </td>
        <td>
        	Last Name        </td>
        <td>
        	<input type="text" name = "lastname" />        </td>
   </tr>
   <tr>
        <td>
          पूरा नाम हिन्दी में        </td>
        <td>
            <input type="text" id="stud_name_hindi" name="stud_name_hindi"  />        </td>
         <td>
        	Roll No.        </td>
        <td>
        	<input type="text" name = "roll_no" />        </td>
   </tr>
      <tr>
        <td>
            Father's Name        </td>
        <td>
            <input type="text" id="father_name" name="father_name"  />        </td>
        <td>
            Father's Occupation        </td>
        <td>
            <input type="text" id="father_occupation" name="father_occupation" />        </td>
   </tr>
   <tr>
       <td>
            Father's Gross Annual Income        </td>
        <td>
            <input type="text" id="father_gross_income" name="father_gross_income"  />        </td>
	   
	   <td>
            Mother's Name        </td>
        <td>
            <input type="text" id="mother_name" name="mother_name" />        </td>
	   
		
       
   </tr>
  
    <tr>
         <td>
            Mother's Occupation        </td>
        <td>
            <input type="text" id="mother_occupation" name="mother_occupation" />        </td>
		<td>
            Mother's Gross Annual Income        </td>
        <td>
            <input type="text" id="mother_gross_income" name="mother_gross_income"  />        </td>
        
   </tr>
    <tr>
	    <td>
            
			Guardian's Name<br/>        </td>
      <td>
             <input type="text" id="guardian_name" name="guardian_name" disabled />
			 <input style="margin-top:2.5px;" type='checkbox' id ="depends_on"  name="depends_on"  onchange="depends_on_whom()"/>        </td>
		 <td>
            
			Relationship<br/>        </td>
        <td>
             <input type="text" id="guardian_relation_name" name="guardian_relation_name" disabled />
			 <!--<input style="margin-top:2.5px;" type='checkbox' id ="depends_on_relation"  name="depends_on_relation"  onchange="depends_on_whom()"/>         --></td>
    </tr>
    <tr>
            <td>Parent/Guardian Mobile No</td>
            <td><input type="text" name="parent_mobile" id="parent_mobile" required="required"></td>
            <td>Parent/Guardian Landline No</td>
            <td><input type="text" name="parent_landline" id="parent_landline"></td>
    </tr>
	 <tr>
		<td>
        	Gender        </td>
        <td>
        	<input type="radio" name="sex" value="male" checked>Male</input>
            <input type="radio" name="sex" value="female">Female</input>
			<input type="radio" name="sex" value="others">Others</input>        </td>
        
   
		<td width='15%'>
        	Physically Challenged        </td>
        <td width='35%'>
   	      	<input type="radio" name="pd" value="yes" />Yes
            <input type="radio" name="pd" value="no" checked />No        </td>
    </tr>
   <tr>
    	<td>
        	Date Of Birth        </td>
    	<td>
  	      	<input type="date" name="dob" value="<?php echo date("Y-m-d",time()+(19800));?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> >        </td>
		<td>
        	Place of Birth        </td>
    	<td>
  	      	<input type="text" name="pob" required="required"/>        </td>
    </tr>
	<tr>
    			<td>
        	Kashmiri Immigrant        </td>
    	<td>
			<input type="radio" name="kashmiri" value="yes"/>Yes
            <input type="radio" name="kashmiri" checked value="no"/>No        </td>
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
                </select></td>
    </tr>
    <tr>
        <td>
            Date of Admission        </td>
        <td>
            <input type="date" name="entrance_date" value="<?php echo date("Y-m-d",time()+(19800));?>" required="required" >        </td>
        <td>
            Student Type        </td>
        <td>
            <select name="stu_type" id="stu_type" ><!--onchange="check_if_student_type_others()" -->
                <?php
                    foreach($stu_type as $row)
                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
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
			Admission Based On       	</td>
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
		 <td><input type="text" id="iitjee_rank" name="iitjee_rank" value="0" />  
   <td>
            
			IIT JEE Category  Rank<br/>        </td>
		 <td><input type="text" id="iitjee_cat_rank" name="iitjee_cat_rank" value="0" />
        </td>
		
    </tr>
    <tr>
		<td>
            
			GATE Score<br/>        </td>
		 <td><input type="text" id="gate_score" name="gate_score"  value="0" disabled />
      
      <td>      
			CAT Score<br/>        </td>
		 <td><input type="text" id="cat_score" name="cat_score" value="0" disabled />
    </tr>
	
   <tr>
		<td>
			Identification Mark		</td>
		<td>
			<input type="text" name="identification_mark" required="required"/>		</td>
        <td>
            Migration Certificate     </td>
        <td>
            <input type="text" name="migration_cert" required="required"/>     </td>
		
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
    	<!--<td>
  	      	<input type="text" name="religion" />
        </td> -->
    </tr>
    <tr>
    	 <td>
            Nationality        </td>
        <td>
            <input type="text" name="nationality" required="required" value="Indian"/>        </td>
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
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }
                ?>
            </select>        </td>
        
    </tr>
	<tr>
		<td>
			ADHAR Card No :		</td>
		<td>
			<input type="text" name="adhar_no" />		</td>
        <td>
            Marital Status        </td>
        <td>
            <select name="mstatus" >
                <option value="Unmarried">Unmarried</option>
                <option value="Married">Married</option>
                <option value="Widow">Widow</option>
                <option value="Widower">Widower</option>
                <option value="Separated">Separated</option>
                <option value="Divorcee">Divorcee</option>
             </select>        </td> 
    </tr>
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
    </tr>
        <td>
            Extra-Curricular Activities ( if any):      </td>
        <td>
            <input type="text" name="extra_activity" />     </td>
        <td>
            Any other relevant information      </td>
        <td>
            <input type="text" name="any_other_information" />      </td>
        
    </tr>
    <tr><th colspan=4 >Details of Fees PAyment at the time of Admission</th></tr><tr></tr>
	<tr>
		<td>
			Mode of Payment :		</td>
		<td>
        	<select name="fee_paid_mode" >
				<option value="dd">Demand Draft</option>
                <option value="cheque">CHEQUE</option>
                <option value="cash">CASH</option>
                <option value="online">ONLINE TRANSFER </option>
                <option value="none">NONE </option>
             </select>        </td>

		<td>
			Fees Paid Date	</td>
		<td>
  	      	<input type="date" name="fee_paid_date" value="<?php echo date("Y-m-d",time()+(19800));?>" max=<?php echo date("Y-m-d", time()+(19800)); ?> >        </td>
    </tr>
	<tr>
		<td>
			DD/CHEQUE/ONLINE/CASH  No 		</td>
		<td>
			<input type="text" name="fee_paid_dd_chk_onlinetransaction_cashreceipt_no" />		</td>
        <td>
            Fees Paid Amount    </td>
        <td>
            <input type="text" name="fee_paid_amount" />        </td>
	
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
	<!--tr><th colspan=4></th></tr-->
        <tr>
        	<td>Email</td>
        	<td><input type="email" name="email" required="required"></td>
			<td>Alternate Email</td>
        	<td><input type="email" name="alternate_email_id" ></td>
            
        </tr>
		<tr>
        	<td>Mobile No</td>
        	<td><input type="text" name="mobile" id="mobile" required="required"></td>
            <td>Alternate Mobile No</td>
            <td><input type="text" name="alternate_mobile" id="alternate_mobile"></td>
        </tr>
		<tr>
        	<td>Hobbies</td>
        	<td><input type="text" name="hobbies" ></td>
            <td>Favourite Pass Time</td>
        	<td><input type="text" name="favpast" ></td>
        </tr>
</table>
<table width="90%">
        <tr><th colspan=2 >Photograph</th></tr><tr></tr>
        <tr  height="150">
            <td width="145" id="preview">
                <img src="<?php echo base_url(); ?>assets/images/student/noProfileImage.png" id="view_photo" width="145" height="150"/></td>
        	<td align="center">Click on choose file to select picture<br>
            	<input type="file" name="photo" id="photo" required="required" ><br>
                <input type="button" value="Preview" onClick="preview_pic();">	
            </td>
		</tr>
</table>
<input type = "submit" value="Next"/>
<?php echo form_close(); ?>
