<center>
<h1>On Line Complaint Form</h1>

<?php echo form_open('complaint/register_complaint/insert');   ?>
 
<table>
	<tr>
		<td>Type of Complaint</td>
		<td>
			<select name="type" id="type" required>
				<option value="">Select</option>
				<option value="Civil">Civil</option>
				<option value="Electrical">Electrical</option>
				<option value="Internet">Internet</option>
				<option value="Mess">Mess</option>
				<option value="Sanitary">Sanitary</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Location</td>
		<td>
			<select name="location" id="location" required>
				<option value="">Select</option>
				<option value="Department">Department</option>
				<option value="Office">Office</option>
				<option value="Residence">Residence</option>
				<option value="Amber Hostel">Amber Hostel</option>
				<option value="Diamond Hostel">Diamond Hostel</option>
				<option value="Emerald Hostel">Emerald Hostel</option>
				<option value="International Hostel">International Hostel</option>
				<option value="Jasper Hostel">Jasper Hostel</option>
				<option value="JRF Hostel">JRF Hostel</option>
				<option value="Opal Hostel">Opal Hostel</option>
				<option value="Ruby">Ruby</option>
				<option value="Ruby Annex">Ruby Annex</option>
				<option value="Shanti Bhawan">Shanti Bhawan</option>
				<option value="Sapphire Hostel">Sapphire Hostel</option>
				<option value="Topaz Hostel">Topaz Hostel</option>
				<option value="Others">Others</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Location Details</td>
		<td><input type="text" placeholder="Location Details" name="locationDetails" value="" required /></td>
	</tr>
	<tr>
		<td>Time of Availability</td>
		<td><input type="text" placeholder="Time of Availability" name="time" value="" required /></td>
	</tr>
	<tr>
		<td>Problem Details</td>
		<td><textarea placeholder="Problem Details" name="problemDetails" required></textarea></td>
	</tr>
</table>

<input type="submit" value="Submit" id="complaint" />

<?php echo form_close(); ?>

</center>