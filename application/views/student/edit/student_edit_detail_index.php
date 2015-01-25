<p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
<?php  echo form_open_multipart('student/student_edit/select_details_to_edit','onSubmit="return form_validation();"');?>
<h1>Please enter the Student Id and select the form</h1>
<table align="center">
	<tr>
		<th>
        	Admission No.
        </th>
        <td>
        	<input type="text" name="stu_id" required="required" />
        </td>
	</tr>
	<tr>
		<th>
        	Select Form
        </th>
        <td>
        	<select name="select_form">
        		<option value="0">Change profile picture</option>
    			<option value="1">Basic Details</option>
    			<option value="2">Education Details</option>
        	</select>
        </td>
	</tr>
</table>
<center><input type = "submit" value="Go"/></center>
<!--center><input type = "button" value="Check" onClick="form_validation()"/></center>
<center><input type = "submit" id="go_to_next" value="Go"/></center-->
<?php echo form_close(); ?>