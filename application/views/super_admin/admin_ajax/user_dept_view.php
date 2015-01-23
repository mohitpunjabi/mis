<br><table align="center" width="80%" id ="user_dept_view">
	<tr>
	<?php echo '<th width = "20%" >Total Users</th><td align = \'center\' colspan = 3>'.count($users).'</td>'; ?>
	</tr>
	<?php if(count($users))	{ ?>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Department</th>
		<th>Operation</th>
	</tr>
	<?php
		foreach($users as $user)
		{
			echo '<td align ="center">'.$user->id.'</td>';
			echo '<td align ="center">'.$user->salutation.'. '.ucwords(trim($user->first_name)).(($user->middle_name != '')? ' '.ucwords(trim($user->middle_name)):'').(($user->last_name != '')? ' '.ucwords(trim($user->last_name)):'').'</td>';
			echo '<td align ="center">'.$user->dept_name.'</td>';
			echo '<td align ="center"><input type="button" value="Deny" name="deny" onclick="delete_auth('.$user->id.');"/></td>';
		}
	}
	?>
</table>