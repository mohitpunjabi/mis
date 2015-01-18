<?php echo form_open('information/view_notice'); ?>
<table width='90%' nozebra>

		
		<tr>		
			<td width='60%'>
				<div>
					<span  style="display: inline-block; margin: 0px 20px 0px 10px;">
						Select Notice ID
					</span>
					<span style="display: inline-block; margin: 0px 50px 0px 0px">
						<select name='notice_id'>
						<?php
							
							foreach($id as $row)
							{
								if($selected == $row->notice_id)
									echo '<option value="'.$row->notice_id.'" selected="selected">'.$row->notice_id.'</option>';
								else
									echo '<option value="'.$row->notice_id.'">'.$row->notice_id.'</option>';
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
