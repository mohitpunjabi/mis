<table align="center">
<?php
	echo "<tr><th>Total Employees</th><td align = 'center'>".count($emp)."</td></tr>";
?>
	<tr>
		<th>Employee Id</th>
		<th>Employee Name</th>
	</tr>
<?php
	foreach($emp as $row)
	{
		echo '<tr><td align ="center">'.$row->id.'</td>';
		echo '<td align ="center">'.$row->salutation.'. '.ucwords(trim($row->first_name)).(($row->middle_name != '')? ' '.ucwords(trim($row->middle_name)):'').(($row->last_name != '')? ' '.ucwords(trim($row->last_name)):'').'</td></tr>';
	}
	if(count($emp)==0)
		echo '<tr><td colspan=2 align = "center">None</td></tr>';
?>
</table>