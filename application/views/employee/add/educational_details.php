    <p><?php $this->notification->drawNotification('',$error,'error'); ?></p>
    <table>
    	<tr>
            <th>Employee Id</th>
            <td><?= $add_emp_id ?></td>
        </tr>
    </table>

	<h1>Step 4 :Please fill up the Educational Qualifications</h1>
	<?php  echo form_open('employee/add/insert_education_details/'.$add_emp_id,'onSubmit="return onclick_submit();"');  ?>
	<table id="tableid">
	 	<tr>
			<th>S no.</th>
    		<th>Examination</th>
    		<th>Course(Specialization)</th>
    		<th>College/University/Institute</th>
    		<th>Year</th>
    		<th>Percentage/Grade</th>
    		<th>Class/Division</th>
    	</tr>
    	<tr id="addrow">
	        <td id="sno">1</td>
        	<td><select name="exam4[]" onChange="examination_handler(this);" >
		        	<option disabled selected value="" >Select Examination</option>
                	<option value="non-matric">Non-Matric</option>
                	<option value="matric">Matric</option>
                	<option value="intermediate">Intermediate</option>
                	<option value="graduation">Graduation</option>
                	<option value="post-graduation">Post Graduation</option>
                	<option value="doctorate">Doctorate</option>
                	<option value="post-doctorate">Post Doctorate</option>
                	<option value="others">Others</option>
	            </select>
        	</td>
        	<td><input type="text" name="branch4[]"/></td>
        	<td><input type="text" name="clgname4[]"/></td>
        	<td><input type="text" name="year4[]" /></td>
        	<td><input type="text" name="grade4[]" /></td>
        	<td><input type="text" name="div4[]"/></td>
    	</tr>
	</table>
	<input type="button" name="add" value="Add More" onClick="onclick_add();"/>
	<br>
	<input type="submit" name="submit4" value="Next" />
	<?php echo form_close(); ?>