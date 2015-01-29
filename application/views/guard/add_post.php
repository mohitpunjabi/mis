<center><h2>Enter the Details of Post</h2></center>
<table width="100%"><tr><th></th></tr></table>
	<?php  echo form_open_multipart('guard/manage_post/add');   
	
	$value =1;
	if($id->post_id != NULL)
		$value = $id->post_id + 1;
	?>
<table width="100%">
	<tr>
		<td>Post Id</td>
		<td><input type="text" name="postids" id="postids" disabled="disabled" value="<?php echo $value;?>"/></td>
	</tr>
	<tr>
		<td>Post Name</td>
		<td><input type="text" placeholder="Post Name" required="required" name="postname" id="postname"/></td>
	</tr>
	<tr>
		<td>Number of Guards in Shift A</td>
		<td><input type="number"  min="1" placeholder="Number of Guards" required="required" name="number_a" id="number_a"/></td>
	</tr>
	<tr>
		<td>Number of Guards in Shift B</td>
		<td><input type="number"  min="1" placeholder="Number of Guards" required="required" name="number_b" id="number_b"/></td>
	</tr>
	<tr>
		<td>Number of Guards in Shift C</td>
		<td><input type="number"  min="1" placeholder="Number of Guards" required="required" name="number_c" id="number_c"/></td>
	</tr>
</table>
<?php	
		echo form_hidden('post_id',$value);
		echo form_submit('addsubmit','Add');
		echo form_close();
?>