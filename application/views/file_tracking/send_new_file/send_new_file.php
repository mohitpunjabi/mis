<?php echo form_open (); ?> 
<div id="container">
	<h1>File Details</h1>
	<table align="center" nozebra>
		<tr>
			<td>File No. : </td>
			<td> 
				<input type="text" name="file_no" id="file_no"> 
			</td>
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
				<textarea name="remarks" id="remarks"></textarea>
				<!--<input type="text" name="emp_id" id="emp_id">-->
			</td>
		</tr>
		
	</table>
	<table align="center" nozebra>
		<tr>
			<td> 
				<input type="button" value="Send File" onClick="display_send_notification()">
			</td>
		</tr>
	</table>
</div>
	
<div id="send_notification"></div>