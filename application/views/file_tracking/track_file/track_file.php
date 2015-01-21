<div id="container">
<h1>Enter Track Number :</h1>
<?php echo form_open (); ?> 
<table align="center" nozebra>
	<tr>
		<td>Track Number : </td>
		<td> 
			<input type="text" name="track_num" id="track_num"> 
			<input type="button" value="Track File" onClick="get_file_move_details()">
		</td>

	</tr>
</table>
<?php 
	if($total_rows != 0){
?>
<h2 align="center">OR</h2>
<table align="center">
	<tr>
		<th>File ID</th>
		<th>File Subject</th>
		<th>File Track Number</th>
		<th>Sent To</th>
		<th>Current Status</th>
		<th>File Operations</th>
	</tr>
	<?php
			$sno=1;
			while ($sno <= $total_rows)
			{
	?>
				<tr>
					<td><?php echo $data_array[$sno][1];//$row->file_id; ?></td>
					<td><?php echo $data_array[$sno][2];//$row->file_subject; ?></td>
					<td><?php echo $data_array[$sno][3];//echo $row->track_num; ?></td>
					<td><?php echo $data_array[$sno][4];//echo $row->rcvd_by_emp_id; ?></td>
					<td><?php if ($data_array[$sno][5]/*$row->close_emp_id*/) echo "Closed"; else echo "Active"; ?></td>
					<td>
						<input type="button" value="Track File" onClick="get_file_move_details2(<?php echo $data_array[$sno][3]; ?>)">
					</td>
				</tr>
<?php
				$sno++;
			}
?>
	<h1>Select File :</h1>
</table>

<?php
	}
?>

<div id="move_details">
</div>
</div>