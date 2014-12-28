<h1>Edit the Basic details</h1>
<?php  echo form_open('employee/edit/update_basic_details/'.$emp_id);   ?>
Fields marked with <span style= "color:red;">*</span> are mandatory.
<table width='90%'>
	<tr><th colspan=4></th></tr>
    <tr>
    	<td width='20%'>
        	Employee Id<span style= "color:red;"> *</span>
        </td>
        <td width='30%'>
        	<input type="text" name="emp_id" id="emp_id" readonly value="<?= $emp_id ?>"  >
        </td>
        <td width='20%'>
        	Physically Challenged<span style= "color:red;"> *</span>
        </td>
        <td width='30%'>
            <input type="radio" name="pd" value="yes" <?php if($user_details->physically_challenged=="yes") echo 'checked="checked"'; ?>  />Yes
            <input type="radio" name="pd" value="no" <?php if($user_details->physically_challenged=="no") echo 'checked="checked"'; ?> />No
        </td>
    </tr>
	<tr>
    	<td>
        	Salutation<span style= "color:red;"> *</span>
        </td>
        <td>
			<select name="salutation" >
            	<option value="Dr" <?php if($user_details->salutation=="Dr")echo "selected"; ?> >Dr</option>
                <option value="Prof"  <?php if($user_details->salutation=="Prof")echo "selected"; ?> >Prof</option>
                <option value="Mr"  <?php if($user_details->salutation=="Mr")echo "selected"; ?> >Mr</option>
                <option value="Mrs"  <?php if($user_details->salutation=="Mrs")echo "selected"; ?> >Mrs</option>
                <option value="Ms"  <?php if($user_details->salutation=="Ms")echo "selected"; ?> >Ms</option>
             </select>
        </td>
        <td>
        	First Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input  type="text" name = "firstname" required value="<?= $user_details->first_name ?>" >
        </td>
    </tr>
   	<tr>
    	<td>
        	Middle Name
        </td>
        <td>
        	<input type="text" name = "middlename" value=<?= $user_details->middle_name ?> >
        </td>
        <td>
        	Last Name
        </td>
        <td>
        	<input type="text" name = "lastname" value= <?= $user_details->last_name ?> >
        </td>
   </tr>
   <tr>
    	<td>
        	Gender<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="radio" name="sex" value="m" <?php if($user_details->sex=='male' || $user_details->sex=='m') echo 'checked="checked"'; ?> >Male</input>
            <input type="radio" name="sex" value="f" <?php if($user_details->sex=='female' || $user_details->sex=='f') echo 'checked="checked"';?> >Female</input>
        </td>
        <td>
        	Nationality<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="nationality" required value=<?= $user_other_details->nationality ?> >
        </td>
   </tr>
   <tr>
    	<td>
        	Father's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="father" required value="<?= $user_other_details->father_name ?>" >
        </td>
        <td>
			Mother's Name<span style= "color:red;"> *</span>
        </td>
        <td>
        	<input type="text" name="mother" required value="<?= $user_other_details->mother_name ?>" >
        </td>
   </tr>
   <tr>
    	<td>
			Employee Type<span style= "color:red;"> *</span>
       	</td>
        <td>
        	<select name="tstatus" onChange="teaching_handler(this.value);" id="teaching" >
            	<option value="ft" <?php if($emp->auth_id=="ft")echo "selected"; ?> >Faculty</option>
                <option value="nfta" <?php if($emp->auth_id=="nfta")echo "selected"; ?> >Non Faculty (Academic)</option>
                <option value="nftn" <?php if($emp->auth_id=="nftn")echo "selected"; ?> >Non Faculty (Non Academic)</option>
             </select>
        </td>
   		<td>
        	Research Interest
        </td>
        <td>
        	<?php
				if($emp->auth_id=='ft')
				{
					echo '<input type="text" name="research_int" id="res_int_id" value="'.$ft->research_interest.'" >';
				}
				else
					echo '<input type="text" name="research_int" id="res_int_id"  disabled >';
             ?>
        </td>
   </tr>
   <tr>
	   	<td>
        	Marital Status<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="mstatus" >
            	<option value="married" <?php if($user_details->marital_status=="married")echo "selected"; ?> >Married</option>
                <option value="unmarried" <?php if($user_details->marital_status=="unmarried")echo "selected"; ?> >Unmarried</option>
                <option value="widow" <?php if($user_details->marital_status=="widow")echo "selected"; ?> >Widow</option>
                <option value="widower" <?php if($user_details->marital_status=="widower")echo "selected"; ?> >Widower</option>
                <option value="separated" <?php if($user_details->marital_status=="separated")echo "selected"; ?> >Separated</option>
                <option value="divorced" <?php if($user_details->marital_status=="divorced")echo "selected"; ?> >Divorced</option>
             </select>
        </td>
    	<td>
        	Kashmiri Immigrant<span style= "color:red;"> *</span>
        </td>
    	<td>
			<input type="radio" name="kashmiri" value="yes" <?php if($user_other_details->kashmiri_immigrant=='yes') echo 'checked="checked"'; ?>  />Yes
            <input type="radio" name="kashmiri" value="no" <?php if($user_other_details->kashmiri_immigrant=='no') echo 'checked="checked"'; ?>  />No
        </td>
    </tr>
    <tr>
       	<td>
        	Date of Joining<span style= "color:red;"> *</span>
        </td>
    	<td>
			<input type="date" name="entrance_age" value="<?php echo $emp->joining_date;?>" required  >
        </td>
    	<td>
        	Designation<span style= "color:red;"> *</span>
        </td>
    	<td>
	        <select name="designation" id="des"  >
            	<?php
					$designations=$this->Designations_model->get_designations("type in ('".(($emp->auth_id == 'ft')? 'ft':'nft')."','others')");
					if($designations === FALSE)
                        echo '<option value="" disabled="disabled">No designation found</option>';
                    else
						foreach($designations as $row)
                        {
							echo '<option value="'.$row->id.'" ';
							if($row->id == $emp->designation)	echo 'selected';
							echo ' >'.ucwords($row->name).'</option>';
                        }
				?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>
            Category<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="category" >
				<option value="General" <?php if($user_details->category=="General")echo "selected"; ?> >GEN</option>
                <option value="OBC" <?php if($user_details->category=="OBC")echo "selected"; ?> >OBC</option>
                <option value="SC" <?php if($user_details->category=="SC")echo "selected"; ?> >SC</option>
                <option value="ST" <?php if($user_details->category=="ST")echo "selected"; ?> >ST</option>
                <option value="Others" <?php if($user_details->category=="Others")echo "selected"; ?> >Others</option>
             </select>
        </td>
    	<td>
        	Religion<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="religion" value="<?php echo $user_other_details->religion; ?>" required >
        </td>
    </tr>
    <tr>
    	<td>
        	DOB<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="date" name="dob" onChange="retirement_handler()"  value=<?= $user_details->dob ?> max=<?php echo date("Y-m-d", time()); ?> >
        </td>
    	<td>
        	Place of Birth<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="pob" value=<?= $user_other_details->birth_place ?> required >
        </td>
    </tr>
    <tr>
    	<td>
        	Pay Scale<span style= "color:red;"> *</span>
        </td>
    	<td>
        	<select name="payscale" tabindex="26"  required onChange="payband_handler(this.value);" >
            	<option value="" readonly disabled >Pay Band </option>
				<?php
                    if($pay_bands === FALSE)
                        echo '<option value="" disabled="disabled">No pay band found</option>';
                    else
                        foreach($pay_bands as $row)
                        {
                            echo '<option value="'.$row->pay_band.'" ';
                        	if($row->pay_band == $emp_pay_details->pay_band) echo 'selected';
                        	echo ' >'.strtoupper($row->pay_band).' ('.$row->pay_band_description.')</option>';
                        }
                ?>
            </select>
            <select name="gradepay" required tabindex="26" >
				<?php
					$gradepay=$this->pay_scales_model->get_grade_pay($emp_pay_details->pay_band);
					foreach($gradepay as $row)
                        {
                            echo '<option value="'.$row->pay_code.'" ';
                        	if($row->grade_pay == $emp_pay_details->grade_pay) echo 'selected';
                        	echo ' >'.$row->grade_pay.'</option>';
                        }
                ?>
            </select>
            <input type="text" name="basicpay" required id="basicpay" size="10"  placeholder="Basic Pay" value="<?= $emp_pay_details->basic_pay ?>" />
        </td>
        <td>Nature of Employment<span style= "color:red;"> *</span></td>
       	<td>
            <select name="empnature" >
            	<option value="permanent" <?php if($emp->employment_nature=="permanent")echo "selected"; ?> >Permanent</option>
                <option value="temporary" <?php if($emp->employment_nature=="temporary")echo "selected"; ?> >Temporary</option>
                <option value="probation" <?php if($emp->employment_nature=="probation")echo "selected"; ?> >Probation</option>
                <option value="contract" <?php if($emp->employment_nature=="contract")echo "selected"; ?> >Contract</option>
                <option value="others" <?php if($emp->employment_nature=="others")echo "selected"; ?> >Others</option>
            </select>
        </td>
   </tr>
   <tr>
   		<td>
        	Department/Section<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<select name="department" id="depts" >
            	<?php
            		if($emp->auth_id == 'ft')
            			$departments=$this->departments_model->get_departments('academic');
            		else if($emp->auth_id == 'nftn')
            			$departments=$this->departments_model->get_departments('nonacademic');
            		else
            			$departments=$this->departments_model->get_departments();

					if($departments === FALSE)
                    	echo '<option value="" disabled="disabled">No academic department found</option>';
                	else
                    	foreach($departments as $row)
                    	{
	                        echo '<option value="'.$row->id.'" ';
	                        if($row->id == $user_details->dept_id) echo 'selected';
	                        echo '>'.$row->name.'</option>';
                    	}
				?>
            </select>
        </td>
		<td>
        	Date of Retirement
        </td>
        <td>
        	<input type="date" name="retire" id="retire" value="<?= $emp->retirement_date;?>" />
        </td>
    </tr>
    <tr>
    	<th width="50%" colspan=2>
        	Present Address
        </th>
        <th width="50%" colspan=2>
        	Permanent Address
        </th>

    </tr>
    <tr>
        <td>
        	Address Line 1<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<textarea type="text" name="line11" required ><?= $present_address->line1 ?> </textarea>
        </td>
        <td>
        	Address Line 1<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<textarea type="text" name="line12" readonly disabled ><?= $permanent_address->line1 ?> </textarea>
        </td>
    </tr>
     <tr>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line21" value="<?= $present_address->line2 ?>" >
        </td>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line22" readonly disabled value="<?= $permanent_address->line2 ?>" >
        </td>
    </tr>
	<tr>
    	<td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city1" required value="<?= $present_address->city ?>" >
        </td>
        <td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city2" readonly disabled value="<?= $permanent_address->city ?>" >
        </td>
    </tr>
    <tr>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state1" required value="<?= $present_address->state ?>" >
        </td>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state2" value="<?= $permanent_address->state ?>" readonly disabled >
        </td>
    </tr>
    <tr>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode1" value="<?= $present_address->pincode ?>" >
        </td>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode2" value="<?= $permanent_address->pincode ?>" readonly disabled >
        </td>
    </tr>
    <tr>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country1" value="<?= $present_address->country ?>" required />
        </td>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country2" value="<?= $permanent_address->country ?>" readonly disabled />
        </td>
    </tr>
    <tr>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact1" value="<?= $present_address->contact_no ?>" required >
        </td>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact2" value="<?= $permanent_address->contact_no ?>" readonly disabled >
        </td>
    </tr>
	<tr><th colspan=4></th></tr>
		<tr><td>Hobbies</td>
        	<td><input type="text" name="hobbies" value="<?= $user_other_details->hobbies ?>" ></td>
            <td>Favourite Past Time</td>
        	<td><input type="text" name="favpast" value="<?= $user_other_details->fav_past_time ?>" ></td>
        </tr>
        <tr>
            <td>Fax</td>
        	<td><input type="tel" name="fax" value="<?= $emp->fax ?>" ></td>
            <td>Office No</td>
        	<td><input type="tel" name="office" value="<?= $emp->office_no ?>" ></td>
        </tr>
		<tr><td>Email</td>
        	<td><input type="email" name="email" value="<?= $user_details->email ?>" ></td>
            <td>Mobile No</td>
        	<td><input type="tel" name="mobile" value="<?= $user_other_details->mobile_no ?>" ></td>
        </tr>
</table>
<input type = "submit" value="Save"/>
<?php echo form_close(); ?>
<a href= <?= site_url('employee/edit')?> ><button>Back</button></a>