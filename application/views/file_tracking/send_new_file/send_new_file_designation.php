<select>
<?php
	foreach($result as $dept_array)
	{
?>
		<option type="text" value="<?php echo $dept_array->id; ?>" ><?php echo $dept_array->name; ?></option>
<?php
	}
?>
</select>