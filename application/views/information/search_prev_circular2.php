<?php echo form_open('information/search_prev_circular'); ?>
<table width='90%' nozebra>

		
		<tr>		
			<td width='60%'>
				<div>
					<span  style="display: inline-block; margin: 0px 20px 0px 10px;">
						Select Prev Version
					</span>
					<span style="display: inline-block; margin: 0px 50px 0px 0px">
						<select name='pre_ver'>
						<?php
							
							foreach($prev_versions as $row)
							{
								if($selected_ver == $row->modification_value)
									echo '<option value="'.$row->modification_value.'" selected="selected">'.$row->modification_value.'</option>';
								else
									echo '<option value="'.$row->modification_value.'">'.$row->modification_value.'</option>';
							}
						?>
						</select>
					</span>
					<span style="display: inline-block; margin: 0px 20px">
						<?php
							echo form_hidden('circular_id',$selected_id);
							echo form_submit('go2','Go');
							echo form_close();
						?>
					</span>
				</div>
            </td>
		<td >
		</td>
		</tr>
</table>
