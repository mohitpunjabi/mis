    <p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
	<?php 
	$errors=validation_errors();
	if($errors!='')$this->notification->drawNotification('Validation Errors',validation_errors(),'error'); ?>
	<h1>Enter the details</h1>
	<?php  echo form_open_multipart('information/post_circular');   ?>
	Fields marked with <span style= "color:red;">*</span> are mandatory.
	<table width='90%'>
		<tr><th colspan=2></th></tr>
		<tr>
			<td width='20%'>
    			Circular ID<span style= "color:red;"> *</span>
            </td>
			<td width='28%'>
	        	<?php 
				if($id->circular_id == NULL)
				{
					$data = array(
							'name'=>'circular_ids',
							'required'=>'required',
							'value'=>'1',
							'disabled'=>'disabled'
							);
					echo form_input($data);
					//will produce
					//echo '<input type="text" name="circular_ids" required="required" disabled="disabled"/>';
				}
				else
				{
					$data = array(
							'name'=>'circular_ids',
							'required'=>'required',
							'value'=>$id->circular_id + 1,
							'disabled'=>'disabled'
							);
					echo form_input($data);
					//will produce
					//echo '<input type="text" name="circular_ids" required="required" tabindex="1" value ="'.$no->circular_no.'" disabled="disabled"/>';
					
				}
				$value=1;
				if($id->circular_id != NULL)
				   $value = $id->circular_id +1;
				
				//hidden field because disabled input has 0 value only
				echo form_hidden('circular_id',$value);
				
				?>
			</td>
		</tr>
		<tr>
			<td width="20%">
				Circular Number<span style= "color:red;"> *</span>
			</td>
			<td>
			<?php
				$circularno = array(
							  'name'=> 'circular_no',
							  'id'=> 'circular_no',
							  'required'=>'required'
							  );
				echo form_input($circularno);
			?>
			</td>
		</tr>
		<tr>
			<td width='20%'>
    			Circular Category<span style= "color:red;"> *</span>
	        </td>
	        <td width='30%'>
			<?php
				$categories = array(
							  'emp'=>'Employee',
							  'stu'=>'Student',
							  'all'=>'All'
							   );
				echo form_dropdown('circular_cat',$categories,'emp');
				/*will produce
				echo '<select name="circular_cat">
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
				Circular Subject<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$subject = array(
								'name'=>'circular_sub',
								'rows'=>'3',
								'cols'=>'80',
								'required'=>'required'
								);
					echo form_textarea($subject);
					/*
						will produce
						echo <input type="textarea" rows="3" cols="80" name ="circular_sub" required="required"/>
					*/
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Circular File<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$file = array(
							'name'=>'circular_path',
							'required'=>'required'
							);
					echo form_upload($file);
					/*
						will produce
						echo <input type="file" name="circular_path"/>
					*/
				?>
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
	echo form_submit('mysubmit','Post Circular');
	echo form_close(); ?>