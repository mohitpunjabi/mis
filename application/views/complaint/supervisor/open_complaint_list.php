<?php 
if ($total_rows == 0)
{
?>
<h1>No Complaints</h1>
<?php
}
else
{
?>
<h1>List of all complaints</h1>
<table align="center">
	<tr>
		<th>Complaint ID</th>
		<th>Registered By</th>
		<th>Registered On</th>
		<th>Location</th>
		<th>Location Details</th>
		<th>Problem Details</th>
		<th>Remarks</th>
	</tr>
	<?php
			$sno=1;
			while ($sno <= $total_rows)
			{
	?>
				<tr>
					<td><a href="../complaint_details/<?php echo $data_array[$sno][1]?>"><?php echo $data_array[$sno][1];?></a></td>
					<td><?php echo $data_array[$sno][2];?></td>
					<td><?php echo $data_array[$sno][3];?></td>
					<td><?php echo $data_array[$sno][4];?></td>
					<td><?php echo $data_array[$sno][5];?></td>
					<td><?php echo $data_array[$sno][6];?></td>
					<td><?php echo $data_array[$sno][7];?></td>
				</tr>
<?php
				$sno++;
			}
?>
</table>
<?php
}//if else
?>