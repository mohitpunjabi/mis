<?php
echo form_open('information/view_circular');

$js = 'onclick="javascript:	document.getElementById(\'dropdown_for_ver\').style.visibility=\'visible\'; "';			
echo '<br>';
echo form_button('click_for_prev_ver','Click for Prev Versions',$js);
echo '<div><br></div>';

?>
				<div id='dropdown_for_ver' <?php if(!isset($selected_ver)) echo 'style="visibility:hidden"'; ?> >
					<?php
						if($prev_ver == NULL)
						{
							echo '<font color="red">There is no any previous version for the selected circular</font>';
						}
						else
						{
					?>
					<span  style="display: inline-block; margin: 0px 20px 0px 10px;">
						Select Prev Version
					</span>
					<span style="display: inline-block; margin: 0px 50px 0px 0px">
						<select name='pre_ver'>
						<?php
							
							foreach($prev_ver as $row)
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
							echo form_hidden('circular_id',$selected);
							echo form_submit('get_details','Go');
							echo form_close();

							?>
					</span>
				<?php
				}
				?>
				</div>