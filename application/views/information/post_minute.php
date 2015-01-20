	<?php 
	$errors=validation_errors();
	if($errors!='')$this->notification->drawNotification('Validation Errors',validation_errors(),'error'); ?>
	<h1>Enter the details</h1>
	<?php  echo form_open_multipart('information/post_minute/index/'.$auth_id);   ?>
	Fields marked with <span style= "color:red;">*</span> are mandatory.
	<table width='90%'>
		<tr><th colspan=2></th></tr>
		<tr>
			<td width='20%'>
    			Minutes ID<span style= "color:red;"> *</span>
            </td>
			<td width='28%'>
	        	<?php 
				if($id->minutes_id == NULL)
				{
					$data = array(
							'name'=>'minute_ids',
							'required'=>'required',
							'value'=>'1',
							'disabled'=>'disabled'
							);
					echo form_input($data);
					//will produce
					//echo '<input type="text" name=minute_ids" required="required" disabled="disabled"/>';
				}
				else
				{
					$data = array(
							'name'=>'minute_ids',
							'required'=>'required',
							'value'=>$id->minutes_id + 1,
							'disabled'=>'disabled'
							);
					echo form_input($data);
					//will produce
					//echo '<input type="text" name="minutes_ids" required="required" value ="'.$no->notice_no.'" disabled="disabled"/>';
					
				}
				$value=1;
				if($id->minutes_id != NULL)
				   $value = $id->minutes_id +1;
				
				//hidden field because disabled input has 0 value only
				echo form_hidden('minute_id',$value);
				
				?>
			</td>
		</tr>
		<tr>
			<td width="20%">
				Minutes Number<span style= "color:red;"> *</span>
			</td>
			<td>
			<?php
				$minutesno = array(
							  'name'=> 'minutes_no',
							  'id'=> 'minutes_no',
							  'required'=>'required'
							  );
				echo form_input($minutesno);
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

				echo form_dropdown('meeting_type',$categories,'Dean\'s Meeting',$js);
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
    			Viewed By<span style= "color:red;"> *</span>
	        </td>
	        <td width='30%'>
			<?php
				$categories = array(
							  'emp'=>'Employee',
							  'stu'=>'Student',
							  'all'=>'All'
							   );
				echo form_dropdown('meeting_cat',$categories,'emp');
				/*will produce
				echo '<select name="meeting_cat">
						<option value="emp">Employee</option>
						<option value="stu">Student</option>
						</option value="both">Both</option>
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
					$file = array(
							'name'=>'minutes_path',
							'required'=>'required'
							);
					echo form_upload($file);
					/*
						will produce
						echo <input type="file" name="minutes_path"/>
					*/
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Date of Meeting<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<input type="date" name="date_of_meeting" max="<?php echo date("Y-m-d");?>" value = "<?php echo date("Y-m-d");?>"/> 
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Place of Meeting<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<input type="text" name="place_of_meeting" required="required"/> 
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Valid Upto<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$date = array(
							'name'=>'valid_upto',
							'min'=>date("Y-m-d"),
							'value'=>date("Y-m-d"),
							'type'=>'date'
							);
					echo form_input($date);
					/*
						will produce
						echo <input type="date" name="valid_upto" min="date("Y-m-d") value="date("Y-m-d")"/>
					*/
				?>
			</td>
		</tr>
	 </table> 
    <?php 
	echo form_submit('mysubmit','Post Minutes');
	echo form_close(); ?>