<?php
/**
 * Author :- Nishant Raj
 */
?>
<option type="text" value="">Select</option>
<?php
    echo "abc";
	foreach($result as $dept_array)
	{
?>
		<option type="text" value="<?php echo $dept_array->id; ?>" ><?php echo $dept_array->name; ?></option>
<?php
	}
?>
