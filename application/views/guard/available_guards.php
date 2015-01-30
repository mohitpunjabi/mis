<?php 
if(count($available_guards) == 0)
	echo '<font color="red">There is no free Guard to assign this duty.</font>';
else
{
?>
	Select Guard Name
	<select name="Regno" required="required">
		<option value="" disabled="disabled" selected="selected">Select Guard Name</option>
		<?php
			foreach($available_guards as $row)
			{
				echo '<option value="'.$row['Regno'].'">'.$row['firstname'].' '.$row['lastname'].'</option>';
			}
		
		?>
	</select>
	</br>
	<?php 
	echo form_submit('assign_overtime','Assign');
	echo form_close();
}
?>
