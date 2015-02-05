	<?php 
	$errors=validation_errors();
	if($errors!='')$this->notification->drawNotification('Validation Errors',validation_errors(),'error'); ?>
	<h1>Enter the details</h1>
	<?php  echo form_open_multipart('information/edit_notice/edit/'.$notice_row->notice_id);   ?>
	Fields marked with <span style= "color:red;">*</span> are mandatory.
	<table width='90%'>
		<tr><th colspan=2></th></tr>
		<tr>
			<td width='20%'>
    			Notice ID<span style= "color:red;"> *</span>
            </td>
			<td width='28%'>
	        	<?php 
				$data = array(
						'name'=>'notice_ids',
						'required'=>'required',
						'value'=>$notice_row->notice_id,
						'disabled'=>'disabled'
						);
				echo form_input($data);
					//will produce
					//echo '<input type="text" name="notice_ids" required="required" disabled="disabled"/>';
			
				//hidden field because disabled input has 0 value only
				echo form_hidden('notice_id',$notice_row->notice_id);
				
				?>
			</td>
		</tr>
		<tr>
			<td width='20%'>
    			Notice Number<span style= "color:red;"> *</span>
            </td>
			<td width='28%'>
	        	<?php 
				$data = array(
						'name'=>'notice_no',
						'required'=>'required',
						'value'=>$notice_row->notice_no,
						'placeholder'=>'Enter Notice Number'
						);
				echo form_input($data);
					//will produce
					//echo '<input type="text" name="notice_no" required="required" disabled="disabled"/>';
			
				?>
				(Ex: CSE_NOT10185)
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
				echo form_dropdown('notice_cat',$categories,$notice_row->notice_cat);
				/*will produce
				echo '<select name="notice_cat">
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
				Notice Subject<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$subject = array(
								'name'=>'notice_sub',
								'rows'=>'3',
								'cols'=>'80',
								'required'=>'required',
								'value'=>$notice_row->notice_sub,
								'placeholder'=>'Enter the notice Subject in not more than 200 characters'				
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
				echo '<a href="'.base_url().'assets/files/information/notice/'.$notice_row->notice_path.'" title="download file">'.$notice_row->notice_path.'</a>';
				$js = 'onclick="javascript:document.getElementById(\'filebox\').style.visibility=\'visible\';
										   document.getElementById(\'notice_path\').required = true;
								"';
				
				echo form_button('update','Update File',$js);
				?>
					<span id="filebox" style="visibility:hidden;">
					<?php
					$file = array(
							'id'=>'notice_path',
							'name'=>'notice_path',
							);
					echo form_upload($file);
					/*
						will produce
						echo <input type="file" name="notice_path" id="notice_path"/>
					*/
					?>
				</span>
				<br>
				(Allowed Types: pdf, doc, docx, jpg, jpeg, png and Max Size: 1.0 MB)				
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Last Date<span style="color:red;">*</span>
			</td>
			<td width="30%">
				<?php
					$date = array(
							'type'=>'date',
							'name'=>'last_date',
							'min'=>date("Y-m-d"),
							'value'=>$notice_row->last_date
							);
					echo form_input($date);
				?>
				(at least today's date)
			</td>
		</tr>
	 </table> 
    <?php 
	echo form_hidden('modification_value',$notice_row->modification_value);
	echo form_submit('savesubmit','Save');
	echo form_close(); ?>