<!--<h1>Sending Details : </h1>
<table nozebra>
	<tr>
		<td>Employee ID : </td>
		<td> 
			<input type="text" name="emp_id" id="emp_id"> 
			<input type="button" value="Send" onClick="display_send_notification2()">
		</td>
	</tr>
	<tr>
		<td>
			<div id="send_notification"></div>
		</td>
		<td></td>
	</tr>
</table>
-->
<!--<h1>Select Pending File to be send : </h1>
	<select  id="file_id" name="file_id" onchange="get_file_details()" >
	<option value="" >Select File ID</option>
<?php
	//echo print_r($res);
	//foreach($res->result() as $row) 
	{
?>		
		<option value="<?php //echo $row->file_id; ?>" ><?php //echo $row->file_id; ?></option> 
<?php
	}
?>
	</select>
<?php
?>			
<div id="file_details">
</div>-->
<h1>File Details</h1>
<?php echo form_open (); ?> 
<table nozebra>
	<tr>
		<td>File Id : </td>
		<td> 
			<input type="text" name="file_id" id="file_id" value="<?php echo $file_id; ?>"> 
<!--		<input type="button" value="Get Departments" onClick="get_departments()"  />  -->
		</td>
	</tr>
	<!--<tr>
		<td>
			<div id="dept"></div>
		</td>
		<td>
		</td>
	</tr>-->
	<tr>
		<td>Department Name : </td>
		<td>
			<select name="department_name" id="department_name" onchange="get_faculty_name(this.value)">
				<option type="text" >Select</option>
			<?php
				foreach($department as $department_array)
				{
					echo '<option type="text" value="'.$department_array['id'].'" >'.$department_array['name'].'</option>';
				}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Employee Name : </td>
		<td> 
			<select name="faculty_name" id="faculty_name">
				<option type="text" >Select</option>
			</select>
		</td>
	</tr>
	<tr>
		<td> 
			<input type="button" value="Send File" onClick="display_send_notification2()">
			<!--<input type="text" name="emp_id" id="emp_id">-->
		</td>
	</tr>
	
	<tr>
		<td>
			<div id="send_notification"></div>
		</td>
		<td></td>
	</tr>
</table>
<?php
//	function drawNotification($title, $description, $type = "")
//	$this->notification->drawNotification("No more notifications", "You do not have any unread notifications.");
?>
