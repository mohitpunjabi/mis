<h1>File Details</h1>
<?php echo form_open (); ?> 
<table nozebra>
	<tr>
		<td>File ID : </td>
		<td> 
			<input type="text" name="file_id" id="file_id"> 
		</td>
	</tr>
	<tr>
		<td>File Subject : </td>
		<td> 
			<input type="text" name="file_sub" id="file_sub"> 
		</td>
	</tr>
	<tr>
		<td>Department/Section : </td>
		<td> 
			<select name="type" id="type" onchange="get_departments(this.value)">
				<option type="text" value="">Select</option>
				<option type="text" value="academic">Academic</option>
				<option type="text" value="nonacademic">Non Academic</option>
			</select>
		</td>
	</tr>
	<tr>
	<td>Select Department OR Section : </td>
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
				<option type="text" >Select</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Employee Name : </td>
		<td> 
			<select name="emp_name" id="emp_name">
				<option type="text" >Select</option>
			</select>
		</td>
	</tr> 
	<tr>
		<td>Remarks : </td>
		<td> 
			<textarea name="remarks" id="remarks"></textarea>
			<!--<input type="text" name="emp_id" id="emp_id">-->
		</td>
	</tr>
	<tr>
		<td> 
			<input type="button" value="Send" onClick="display_send_notification()">
		</td>
		<td>
		</td>
	</tr>
</table>
	
<div id="send_notification"></div>