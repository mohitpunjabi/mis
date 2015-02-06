<h1>Complaint Details</h1>
<?php echo form_open('complaint/supervisor/update_complaint_details/'.$complaint_id);   ?>
<table align="center">
	<tr>
		<th>Complaint ID</th>
		<td><?php echo $complaint_id;?></td>
	</tr>
	<tr>
		<th>Complaint By</th>
		<td><?php echo $complaint_by;?></td>
	</tr>
	<tr>
		<th>Mobile No.</th>
		<td><?php echo $mobile;?></td>
	</tr>
	<tr>
		<th>Email ID</th>
		<td><?php echo $email;?></td>
	</tr>
	<tr>
		<th>Registered On</th>
		<td><?php echo $date_n_time;?></td>
	</tr>
	<tr>
		<th>Location</th>
		<td><?php echo $location;?></td>
	</tr>
	<tr>
		<th>Location Details</th>
		<td><?php echo $location_details;?></td>
	</tr>
	<tr>
		<th>Problem Details</th>
		<td><?php echo $problem_details;?></td>
	</tr>
	<tr>
		<th>Prefered Time</th>
		<td><?php echo $pref_time;?></td>
	</tr>
	<tr>
		<th>Status</th>
		<td>
			<select name="status">
				<option value="Under Processing" selected>Under Processing</option>
				<option value="Rejected">Rejected</option>
				<option value="Closed">Closed</option>
			</select>
		</td>
	</tr>
	<tr>
		<th>Action Taken</th>
		<td>
					<textarea name="action_taken" readonly><?php echo $remarks;?></textarea>
		</td>
	</tr>
	<tr>
		<th>Fresh Action</th>
		<td>
			<textarea placeholder="Fresh Action" name="fresh_action" required></textarea>
		</td>
	</tr>
</table>

<center><input type="submit" value="Submit" id="complaint" /></center>

<?php echo form_close(); ?>
