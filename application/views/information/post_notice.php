    <p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
	<?php 
	$errors=validation_errors();
	if($errors!='')$this->notification->drawNotification('Validation Errors',validation_errors(),'error'); ?>
	<h1>Enter the details</h1>
	<?php  echo form_open_multipart('information/post_notice');   ?>
	Fields marked with <span style= "color:red;">*</span> are mandatory.
	<table width='90%'>
		<tr><th colspan=2></th></tr>
		<tr>
			<td width='20%'>
    			Notice ID<span style= "color:red;"> *</span>
            </td>
			<td width='28%'>
	        	<?php 
				if($id->notice_id == NULL)
				{
					$data = array(
							'name'=>'notice_ids',
							'required'=>'required',
							'value'=>'1',
							'disabled'=>'disabled'
							);
					echo form_input($data);
					//will produce
					//echo '<input type="text" name="notice_ids" required="required" disabled="disabled"/>';
				}
				else
				{
					$data = array(
							'name'=>'notice_ids',
							'required'=>'required',
							'value'=>$id->notice_id + 1,
							'disabled'=>'disabled'
							);
					echo form_input($data);
					//will produce
					//echo '<input type="text" name="notice_ids" required="required" value ="'.$no->notice_id.'" disabled="disabled"/>';
					
				}
				$value=1;
				if($id->notice_id != NULL)
				   $value = $id->notice_id +1;
				
				//hidden field because disabled input has 0 value only
				echo form_hidden('notice_id',$value);
				
				?>
			</td>
		</tr>
		<tr>
			<td width='20%'>
    			Notice Number<span style= "color:red;"> *</span>
            </td>
			<td width='28%'>
	        	<?php 
					$noticeno = array(
								'name'=>'notice_no',
								'id'=>'notice_no',
								'required'=>'required'
								);
					echo form_input($noticeno);
					//will produce
					//echo '<input type="text" name="notice_no" id="notice_no" required="required"/>';
				?>
			</td>
		</tr>
		<tr>
			<td width='20%'>
    			Notice Category<span style= "color:red;"> *</span>
	        </td>
	        <td width='30%'>
			<?php
				$categories = array(
							  'emp'=>'Employee',
							  'stu'=>'Student',
							  'all'=>'All'
							   );
				echo form_dropdown('notice_cat',$categories,'emp');
				/*will produce
				echo '<select name="notice_cat">
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
				Notice Subject<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$subject = array(
								'name'=>'notice_sub',
								'rows'=>'3',
								'cols'=>'80',
								'required'=>'required'
								);
					echo form_textarea($subject);
					/*
						will produce
						echo <input type="textarea" rows="3" cols="80" name ="notice_sub" required="required"/>
					*/
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Notice File<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$file = array(
							'name'=>'notice_path',
							'required'=>'required'
							);
					echo form_upload($file);
					/*
						will produce
						echo <input type="file" name="notice_path"/>
					*/
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Last Date<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<input type="date" name="last_date" min="<?php echo date("Y-m-d");?>" value = "<?php echo date("Y-m-d");?>"/> 
			</td>
		</tr>
	 </table> 
    <?php 
	echo form_submit('mysubmit','Post Notice');
	echo form_close(); ?>