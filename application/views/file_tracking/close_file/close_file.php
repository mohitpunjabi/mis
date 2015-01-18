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
<h1>Details of Closing File : </h1>
<!--	<select  id="file_id" name="file_id" onchange="get_close_file_details()" >
	<option value="" >Select File ID</option>
<?php
	//foreach($res->result() as $row) 
	{
?>		
		<option value="<?php //echo $row->file_id; ?>" ><?php //echo $row->file_id; ?></option> 
<?php
	}
?>
	</select>
<?php
?>-->
	<td>
		<input type="text" name="file_id" id="file_id" value="<?php echo $file_id; ?>">
		<input type="button" value="Confirm File ID" onClick="get_close_file_details()">
	</td>
<div id="file_details">
</div>