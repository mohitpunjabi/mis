<?php
?>
<select name="dept" id="deptlist">
<?php
	foreach($dept as $row)
	{
?>
		<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>   
<?php
	}
?>
</select>
