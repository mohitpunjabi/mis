<?php echo form_open('information/view_circular'); ?>
<table width='90%' nozebra>

		
		<tr>		
			<td width='60%'>
				<div>
					<span  style="display: inline-block; margin: 0px 20px 0px 10px;">
						Select Circular ID
					</span>
					<span style="display: inline-block; margin: 0px 50px 0px 0px">
						<select name='circular_id'>
						<?php
							
							foreach($id as $row)
							{
								if($selected == $row->circular_id)
									echo '<option value="'.$row->circular_id.'" selected="selected">'.$row->circular_id.'</option>';
								else
									echo '<option value="'.$row->circular_id.'">'.$row->circular_id.'</option>';
							}
						?>
						</select>
					</span>
					<span style="display: inline-block; margin: 0px 20px">
						<?php
							echo form_submit('go','Go');
							echo form_close();
						?>
					</span>
				</div>
            </td>
		<td >
		</td>
		</tr>
</table>
