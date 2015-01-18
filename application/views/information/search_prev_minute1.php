<?php echo form_open('information/search_prev_minute'); ?>
<table width='90%' nozebra>

		
		<tr>		
			<td width='60%'>
				<div>
					<span  style="display: inline-block; margin: 0px 20px 0px 10px;">
						Select Minutes ID
					</span>
					<span style="display: inline-block; margin: 0px 50px 0px 0px">
						<select name='minute_id'>
						<?php
							
							foreach($id as $row)
							{
								if($selected_id == $row->minutes_id)
									echo '<option value="'.$row->minutes_id.'" selected="selected">'.$row->minutes_id.'</option>';
								else
									echo '<option value="'.$row->minutes_id.'">'.$row->minutes_id.'</option>';
							}
						?>
						</select>
					</span>
					<span style="display: inline-block; margin: 0px 20px">
						<?php
							echo form_submit('go1','Go');
							echo form_close();
						?>
					</span>
				</div>
            </td>
		<td >
		</td>
		</tr>
</table>
