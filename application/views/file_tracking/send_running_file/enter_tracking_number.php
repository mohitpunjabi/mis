<h1>File Details</h1>
<?php echo form_open (); ?> 
<table nozebra>
	<tr>
		<td>Track Number : </td>
		<td> 
			<input type="text" name="track_num" id="track_num"> 
			<input type="button" value="Proceed" onClick="match_track_number()">
		</td>

	</tr>
</table>
<div id="send_files">
</div>