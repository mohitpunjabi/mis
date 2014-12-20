    <p><?php echo $error; ?></p>
	<h1>Step 1 :Fill up the details</h1>
	<?php  echo form_open_multipart('employee/add/insert_basic_details','onSubmit="return image_validation();"');   ?>
	Fields marked with <span style= "color:red;">*</span> are mandatory.
	<table width='90%'>
		<tr><th colspan=4></th></tr>
		<tr>
			<td width='20%' id="empId">
    			Employee Id<span style= "color:red;"> *</span>
            </td>
			<td width='28%' id="empId">
	        	<input type="text" name="emp_id" required="required" tabindex="1" />
				<input type="button" value="Go" id="fetch_id_btn" onClick="fetch_details()" tabindex="1" />
				<i class="loading" id="empIdIcon"></i>
			</td>
			<td width='22%'>
    			Physically Challenged<span style= "color:red;"> *</span>
	        </td>
	        <td width='30%'>
	   	      	<input type="radio" name="pd" value="Yes" tabindex="2" />Yes
				<input type="radio" name="pd" checked value="No" tabindex="3" />No
	        </td>
		</tr>
		<tr>
	    	<td>
	        	Salutation<span style= "color:red;"> *</span>
	        </td>
	        <td>
    			<select name="salutation" tabindex="4" >
	            	<option value="Dr" >Dr</option>
	                <option value="Prof">Prof</option>
	                <option value="Mr">Mr</option>
	                <option value="Mrs">Mrs</option>
	                <option value="Ms">Ms</option>
     			</select>
	        </td>
	        <td>
	        	First Name<span style= "color:red;"> *</span>
	        </td>
	        <td>
	        	<input type="text" name = "firstname" required="required" tabindex="5"/>
	        </td>
		</tr>
	   	<tr>
			<td>
	        	Middle Name
	        </td>
	        <td>
	        	<input type="text" name = "middlename" tabindex="6" />
	        </td>
	        <td>
	        	Last Name
	        </td>
	        <td>
            	<input type="text" name = "lastname" tabindex="7" />
	        </td>
		</tr>
		<tr>
			<td>
    			Gender<span style= "color:red;"> *</span>
	        </td>
	        <td>
	        	<input type="radio" name="sex" checked value="male" tabindex="8">Male</input>
		        <input type="radio" name="sex" value="female" tabindex="9">Female</input>
	        </td>
	        <td>
	        	Nationality<span style= "color:red;"> *</span>
	        </td>
	        <td>
	        	<input type="text" name="nationality" required="required" value="Indian" tabindex="10"/>
	        </td>
		</tr>
		<tr>
	    	<td>
	        	Father's Name<span style= "color:red;"> *</span>
        	</td>
    		<td>
	        	<input type="text" name="father" required="required" tabindex="11" />
	        </td>
	        <td>
				Mother's Name<span style= "color:red;"> *</span>
	        </td>
	        <td>
	        	<input type="text" name="mother" required="required" tabindex="12" />
	        </td>
    	</tr>
		<tr>
			<td>
                Employee Type<span style= "color:red;"> *</span>
	       	</td>
            <td>
            	<select name="tstatus" onchange="teaching_handler(this.value);" tabindex="13" >
	            	<option value="ft" selected="selected" >Faculty</option>
	                <option value="nfta">Non Faculty (Academic)</option>
	                <option value="nftn">Non Faculty (Non Academic)</option>
                </select>
	        </td>
	   		<td>
    			Research Interest
    		</td>
	        <td>
	        	<input type="text" name="research_int" id="res_int_id" tabindex="14" />
	        </td>
		</tr>
		<tr>
		   	<td>
		        	Marital Status<span style= "color:red;"> *</span>
	        </td>
	    	<td>
		        	<select name="mstatus" tabindex="15" >
			            	<option value="married">Married</option>
	                		<option value="unmarried">Unmarried</option>
			                <option value="widow">Widow</option>
			                <option value="widower">Widower</option>
			                <option value="separated">Separated</option>
			                <option value="divorced">Divorced</option>
    				</select>
	        </td>
	    	<td>
		        Kashmiri Immigrant<span style= "color:red;"> *</span>
	        </td>
	    	<td>
				<input type="radio" name="kashmiri" value="yes" tabindex="16"/>Yes
				<input type="radio" name="kashmiri" checked value="no" tabindex="17"/>No
	        </td>
		</tr>
		<tr>
			<td>
	        	Date of Joining<span style= "color:red;"> *</span>
	        </td>
	    	<td>
    			<input type="date" name="entrance_age" value="<?php echo date("Y-m-d",time());?>" required="required" tabindex="18" >
	        </td>
          	<td>
                Designation<span style= "color:red;"> *</span>
            </td>
            <td>
                <select name="designation" id="des" tabindex="19">
                <?php
                    //Designation changes ..... fetched from designations table
                    //by default faculty designations are to be fetched
                    if($designations === FALSE)
                        echo '<option value="" disabled="disabled">No designation found</option>';
                    else
                        foreach($designations as $row)
                        {
                            echo '<option value="'.$row->id.'">'.ucwords($row->name).'</option>';
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
            	<select name="category" tabindex="22">
		      		<option value="General">GEN</option>
                    <option value="OBC">OBC</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                    <option value="Others">Others</option>
                </select>
            </td>
            <td>
            	Religion<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="text" name="religion" required="required" tabindex="23"/>
            </td>
        </tr>
        <tr>
            <td>
        	   DOB<span style= "color:red;"> *</span>
            </td>
            <td>
	      	    <input type="date" name="dob" value="<?php echo date("Y-m-d",time());?>" max=<?php echo date("Y-m-d", time()); ?>  required="required" tabindex="24" onchange="retirement_handler()" />
            </td>
        	<td>
            	Place of Birth<span style= "color:red;"> *</span>
            </td>
            <td>
                <input type="text" name="pob" required="required" tabindex="25" />
            </td>
        </tr>
        <tr>
        	<td>
        	   Pay Details<span style= "color:red;"> *</span>
            </td>
            <td>
                <select name="payscale" tabindex="26"  onchange="payband_handler(this.value);" required >
                    <option value="" disabled selected>Pay Band </option>
			        <?php
                        if($pay_bands === FALSE)
                            echo '<option value="" disabled="disabled">No pay band found</option>';
                        else
                            foreach($pay_bands as $row)
                            {
                                echo '<option value="'.$row->pay_band.'">'.strtoupper($row->pay_band).' ('.$row->pay_band_description.')</option>';
                            }
                    ?>
                </select>
                <select name="gradepay" tabindex="26" onchange="javascript: document.getElementById('basicpay').style.visibility='visible'" style="visibility:hidden" required ></select>
                <input type="text" name="basicpay" tabindex="26" id="basicpay" style="visibility:hidden" size="10"  placeholder="Basic Pay" required />
            </td>
            <td>Nature of Employment<span style= "color:red;"> *</span></td>
       	    <td>
            	<select name="empnature" tabindex="27" >
            	    <option value="permanent">Permanent</option>
                    <option value="temporary">Temporary</option>
                    <option value="probation">Probation</option>
                    <option value="contract">Contract</option>
                    <option value="others">Others</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Department/Section<span style= "color:red;"> *</span>
            </td>
            <td>
                <select name="department" id="depts" tabindex="28" >
                <?php
                    if($academic_departments === FALSE)
                        echo '<option value="" disabled="disabled">No academic department found</option>';
                    else
                        foreach($academic_departments as $row)
                        {
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }
                ?>
                </select>
            </td>
            <?php
	           $date = new DateTime(date("Y-m-d",time()));
	           $date->modify('+65 year');
            ?>
            <td>
            	Date of Retirement
            </td>
            <td>
	       	   <input type="date" id="retire" name="retire" value="<?php 	echo $date->format('Y-m-d'); ?>" tabindex="28" />
            </td>
        </tr>
        <tr>
            <th width='50%' colspan=2>
        	   Present Address
            </th>
            <th width='50%' colspan=2>
        	   Permanent Address
            </th>
        </tr>
        <tr>
            <td>
        	   Address Line 1<span style= "color:red;"> *</span>
            </td>
            <td>
                <textarea name="line11" required="required" tabindex="29"></textarea>
            </td>
            <td>
        	   Address Line 1<span style= "color:red;"> *</span>
            </td>
            <td>
                <textarea name="line12" required="required" tabindex="36"></textarea>
            </td>
        </tr>
        <tr>
    	       <td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line21" tabindex="30" />
        </td>
    	<td>
        	Address Line 2
        </td>
    	<td>
  	      	<input type="text" name="line22" tabindex="36" />
        </td>
    </tr>
	<tr>
    	<td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city1" required="required" tabindex="31"/>
        </td>
        <td>
        	City<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="city2" required="required" tabindex="37"/>
        </td>
    </tr>
    <tr>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state1" required="required" tabindex="32"/>
        </td>
    	<td>
        	State<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="state2" required="required" tabindex="38"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode1" required="required" tabindex="33"/>
        </td>
    	<td>
        	Pin code<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="pincode2" required="required" tabindex="39"/>
        </td>
    </tr>
	    <tr>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country1" value="India" required="required" tabindex="34"/>
        </td>
    	<td>
        	Country<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="text" name="country2" value="India" required="required" tabindex="40"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact1" required="required" tabindex="35"/>
        </td>
    	<td>
        	Contact No<span style= "color:red;"> *</span>
        </td>
    	<td>
  	      	<input type="tel" name="contact2" required="required" tabindex="41"/>
        </td>
    </tr>
    <tr><th colspan=4></th></tr>
		<tr><td>Hobbies</td>
        	<td><input type="text" name="hobbies" tabindex="42"></td>
            <td>Favourite Past Time</td>
        	<td><input type="text" name="favpast" tabindex="43"></td>
        </tr>
        <tr>
            <td>Fax</td>
        	<td><input type="tel" name="fax" tabindex="44"></td>
            <td>Office No</td>
        	<td><input type="tel" name="office" tabindex="45"></td>
        </tr>
        <tr>
        	<td>Email</td>
        	<td><input type="email" name="email" tabindex="46" ></td>
            <td>Mobile No</td>
        	<td><input type="tel" name="mobile" tabindex="47" ></td>
        </tr>
    </table>
    <table width="90%">
        <tr><th colspan=2 >Photograph</th></tr><tr></tr>
        <tr  height="150">
            <td width="145" id="preview">
                <img src="<?php echo base_url(); ?>assets/images/employee/noProfileImage.png" id="view_photo" width="145" height="150"/>
            </td>
        	<td align="center">Click on choose file to select picture<span style= "color:red;"> *</span><br>
            	<input type="file" name="photo" id="photo" required="required" tabindex="48" ><br>
                <input type="button" value="preview" onClick="preview_pic();" tabindex="49">
            </td>
	    </tr>
    </table>
    <input type = "submit" value="Next" tabindex="50"/>
    <?php echo form_close(); ?>