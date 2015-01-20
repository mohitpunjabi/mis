	<?php 
	$errors=validation_errors();
	if($errors!='')$this->notification->drawNotification('Validation Errors',validation_errors(),'error'); ?>
	<h1>Enter the details</h1>
	<?php  echo form_open_multipart('information/edit_circular/edit/'.$circular_row->circular_id);   ?>
	Fields marked with <span style= "color:red;">*</span> are mandatory.
	<table width='90%'>
		<tr><th colspan=2></th></tr>
		<tr>
			<td width='20%' >
    			Circular ID<span style= "color:red;"> *</span>
            </td>
			<td width='28%'>
	        	<?php 
				$data = array(
						'name'=>'circular_ids',
						'required'=>'required',
						'value'=>$circular_row->circular_id,
						'disabled'=>'disabled'
						);
				echo form_input($data);
					//will produce
					//echo '<input type="text" name="circular_ids" required="required" disabled="disabled"/>';
			
				//hidden field because disabled input has 0 value only
				echo form_hidden('circular_id',$circular_row->circular_id);
				
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Circular Number<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$circularno = array(
								'name'=>'circular_no',
								'required'=>'required',
								'value'=>$circular_row->circular_no
								);
					echo form_input($circularno);
					/*
						will produce
						echo <input type="text" name ="circular_no" required="required"/>
					*/
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
				echo form_dropdown('circular_cat',$categories,$circular_row->circular_cat);
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
								'required'=>'required',
								'value'=>$circular_row->circular_sub
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
				echo '<a href="'.base_url().'assets/files/information/circular/'.$circular_row->circular_path.'" title="download file">'.$circular_row->circular_path.'</a>';
				$js = 'onclick="javascript:document.getElementById(\'filebox\').style.visibility=\'visible\';
										   document.getElementById(\'circular_path\').required = true;
								"';
				
				echo form_button('update','Update File',$js);
				?>
					<span id="filebox" style="visibility:hidden;">
					<?php
					$file = array(
							'id'=>'circular_path',
							'name'=>'circular_path',
							);
					echo form_upload($file);
					/*
						will produce
						echo <input type="file" name="circular_path" id="circular_path"/>
					*/
					?>
					</span>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Valid Upto<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$date = array(
							'type'=>'date',
							'name'=>'valid_upto',
							'min'=>date("Y-m-d"),
							'value'=>$circular_row->valid_upto
							);
					echo form_input($date);
				?>
			</td>
		</tr>
	 </table> 
    <?php 
	echo form_hidden('modification_value',$circular_row->modification_value);
	echo form_submit('savesubmit','Save');
	echo form_close(); ?>