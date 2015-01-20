<h1>File Details</h1>
<?php echo form_open (); ?> 
<table nozebra>
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
		<td>Type : </td>
		<td> 
			<select name="type" id="type" onchange=get_departments("hii")>
				<option type="text" value="">Select</option>
				<option type="text" value="academic">Academic</option>
				<option type="text" value="nonacademic">Non Academic</option>
			</select>
		</td>
	</tr>
	<tr>
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
		</td>
	</tr>
	<tr>
		<td> 
			<input type="button" value="Send File" onClick="display_send_notification2()">
		</td>
		<td></td>
	</tr>	
</table>
<div id="send_notification"></div>
