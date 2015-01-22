<div id="container">
<h1>File Details</h1>
<?php echo form_open (); ?> 
<table align="center" nozebra>
	<tr>
		<td>File No : </td>
<?php
		if ($file_no)
		{
?>
		<td> 
			<input type="text" name="file_no" id="file_no" value="<?php echo $file_no; ?>" readonly> 
		</td>
<?php
		}
		else
		{
?>
		<td> 
			<input type="text" name="file_no" id="file_no" value=""> 
		</td> 
<?php
		}
?>
	</tr>
	<tr>
		<td>File Subject : </td>
		<td> 
			<input type="text" name="file_sub" id="file_sub" value="<?php echo $file_sub; ?>" readonly> 
		</td>
	</tr>
	<tr>
		<td>Department Type : </td>
		<td> 
			<select name="type" id="type" onchange="get_departments(this.value)">
				<option type="text" value="">Select</option>
				<option type="text" value="academic">Academic</option>
				<option type="text" value="nonacademic">Non Academic</option>
			</select>
		</td>
	<td>Department Name : </td>
		<td>
			<select name="department_name" id="department_name" onchange="get_designation_name(this.value)">
				<option type="text" value="">Select</option>
			</select>
		</td> 
	</tr>
	<tr>
		<td>Designation : </td>
		<td> 
			<select name="designation" id="designation" onchange="get_emp_name(this.value)">
				<option type="text" value="">Select</option>
			</select>
		</td>
		<td>Employee Name : </td>
		<td> 
			<select name="emp_name" id="emp_name">
				<option type="text" value="">Select</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Remarks : </td>
		<td> 
			<textarea name="remarks" id="remarks" ></textarea>
		</td>
	</tr>
</table>
<table align="center" nozebra>
	<tr>
		<td> 
			<input type="button" value="Send File" onClick="display_send_notification2(<?php echo $file_id; ?>)">
		</td>
	</tr>
</table>
<h2 align="center">OR</h2>
<table align="center" nozebra>
	<tr>
		<td>Remarks: </td>
		<td> 
			<textarea name="remarks2" id="remarks2" ></textarea>
		</td>
		<td> 
			<input type="button" value="Send File Back" onClick="display_send_notification4(<?php echo $file_id; ?>,<?php echo $sent_by_emp_id ?>)">
		</td>
	</tr>	
</table>
</div>
<div id="send_notification"></div>
