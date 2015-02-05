<center><h2>Edit the Details of <?php echo $details_of_a_postname['postname'];?> Post</h2></center>
<table width="100%"><tr><th></th></tr></table>
	<?php  echo form_open_multipart('guard/manage_post/edit');   ?>
<table width="100%">
	<tr>
		<td>Post ID</td>
		<td><input type="text" name="postids" id="postids" disabled="disabled" value="<?php echo $details_of_a_postname['post_id'];?>"/></td>
	</tr>
	<tr>
		<td>Post Name</td>
		<td><input type="text" placeholder="Post Name" required="required" name="postname" id="postname"  value="<?php echo $details_of_a_postname['postname'];?>"/></td>
	</tr>
	<tr>
		<td>Number of Guards in Shift A</td>
		<td><input type="number"  min="1" placeholder="Number of Guards" required="required" name="number_a" id="number_a" value="<?php echo $details_of_a_postname['number_a'];?>"/></td>
	</tr>
	<tr>
		<td>Number of Guards in Shift B</td>
		<td><input type="number"  min="1" placeholder="Number of Guards" required="required" name="number_b" id="number_b" value="<?php echo $details_of_a_postname['number_b'];?>"/></td>
	</tr>
	<tr>
		<td>Number of Guards in Shift C</td>
		<td><input type="number"  min="1" placeholder="Number of Guards" required="required" name="number_c" id="number_c" value="<?php echo $details_of_a_postname['number_c'];?>"/></td>
	</tr>
</table>
<input type="hidden" value="<?php echo $details_of_a_postname['post_id'];?>" name="post_id" id="post_id"/>
<?php	echo form_submit('savesubmit','Edit');
		echo form_close();
?>