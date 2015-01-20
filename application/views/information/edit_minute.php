	<?php 
	$errors=validation_errors();
	if($errors!='')$this->notification->drawNotification('Validation Errors',validation_errors(),'error'); ?>
	<h1>Enter the details</h1>
	<?php  echo form_open_multipart('information/edit_minute/edit/'.$minute_row->minutes_id);   ?>
	Fields marked with <span style= "color:red;">*</span> are mandatory.
	<table width='90%'>
		<tr><th colspan=2></th></tr>
		<tr>
			<td width='20%'>
    			Minutes ID<span style= "color:red;"> *</span>
            </td>
			<td width='28%'>
	        	<?php 
				$data = array(
						'name'=>'minutes_ids',
						'required'=>'required',
						'value'=>$minute_row->minutes_id,
						'disabled'=>'disabled'
						);
				echo form_input($data);
				//will produce
				//echo '<input type="text" name=minute_ids" required="required" disabled="disabled"/>';
				
				
				//hidden field because disabled input has 0 value only
				echo form_hidden('minutes_id',$minute_row->minutes_id);
				
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Minutes Number<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$minutesno = array(
								'name'=>'minutes_no',
								'required'=>'required',
								'value'=>$minute_row->minutes_no
								);
					echo form_input($minutesno);
					/*
						will produce
						echo <input type="text" name ="minutes_no" required="required"/>
					*/
				?>
			</td>
		</tr>
		
		<tr>
			<td width='20%'>
    			Meeting Type<span style= "color:red;"> *</span>
	        </td>
	        <td width='30%'>
			<?php
				$categories = array(
							  'Dean\'s Meeting'=>'Dean\'s Meeting',
							  'HOD\'s Meeting'=>'HOD\'s Meeting',
							  'EB Meeting'=>'EB Meeting',
							  'GC Meeting'=>'GC Meeting',
							  'DAC Meeting'=>'DAC Meeting',
							  'others'=>'others'
							   );
				
				//javascript to make text box visible
				$js = 'onchange="javascript:
											if(this.value == \'others\') 
												document.getElementById(\'others\').style.visibility=\'visible\'; 
											else 
												document.getElementById(\'others\').style.visibility=\'hidden\';
								"
						';			

				echo form_dropdown('meeting_type',$categories,$minute_row->meeting_type,$js);
				/*will produce
				echo '<select name="meeting_type">
						<option value="Dean\'s Meeting">Dean\'s Meeting</option>
						<option value="HOD\'s Meeting">HOD\'s Meeting</option>
						<option value="EB Meeting">EB Meeting</option>
						<option value="GC Meeting">GC Meeting</option>
						<option value="DAC Meeting">DAC Meeting</option>
						<option value="others">others</option>
					</select>';				
				*/
			?>
			<input type="text" name="meeting_others" id="others" style="visibility:hidden" />
	   	    </td>
		</tr>
		<tr>
			<td width='20%'>
    			Meeting Category<span style= "color:red;"> *</span>
	        </td>
	        <td width='30%'>
			<?php
				$categories = array(
							  'emp'=>'Employee',
							  'stu'=>'Student',
							  'all'=>'All'
							   );
				echo form_dropdown('meeting_cat',$categories,$minute_row->meeting_cat);
				/*will produce
				echo '<select name="meeting_cat">
						<option value="emp">Employee</option>
						<option value="stu">Student</option>
						</option value="all">All</option>
					</select>';				
				*/
			?>
	   	    </td>
		</tr>
		<tr>
			<td width ="20%">
				Meeting File<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
				echo '<a href="'.base_url().'assets/files/information/minute/'.$minute_row->minutes_path.'" title="download file">'.$minute_row->minutes_path.'</a>';
				$js = 'onclick="javascript:document.getElementById(\'filebox\').style.visibility=\'visible\';
										   document.getElementById(\'minutes_path\').required = true;
								"';
				
				echo form_button('update','Update File',$js);
				?>
					<span id="filebox" style="visibility:hidden;">
					<?php
					$file = array(
							'id'=>'minutes_path',
							'name'=>'minutes_path',
							//'required'=>'required',
							);
					echo form_upload($file);
					/*
						will produce
						echo <input type="file" name="minutes_path" id="minutes_path"/>
					*/
					?>
					</span>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Date of Meeting<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<input type="date" name="date_of_meeting" max = "<?php echo date("Y-m-d"); ?>" value = "<?php echo $minute_row->date_of_meeting;?>"/> 
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Place of Meeting<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<input type="text" name="place_of_meeting" required="required" value="<?php echo $minute_row->place_of_meeting;?>"/> 
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Valid Upto<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<input type="date" name="valid_upto" min="<?php echo date("Y-m-d");?>" value = "<?php echo $minute_row->valid_upto;?>"/> 
			</td>
		</tr>
	 </table> 
    <?php 
	echo form_hidden('modification_value',$minute_row->modification_value);
	echo form_submit('savesubmit','Save');
	echo form_close(); ?>