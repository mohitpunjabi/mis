    <p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
	<h2>Minutes Details</h2>
	<table width='90%'>
		<tr><th colspan=2></th></tr>
		<tr>
			<td width='20%'>
    			Minutes ID
            </td>
			<td width='28%'>
	        	<?php 
				echo $minute_row->minutes_id;
				?>
			</td>
		</tr>

		<tr>
			<td width='20%'>
    			Minutes Number
            </td>
			<td width='28%'>
	        	<?php 
				echo $minute_row->minutes_no;
				?>
			</td>
		</tr>
		<tr>
			<td width='20%'>
    			Meeting Type
	        </td>
	        <td width='30%'>
			<?php
				echo $minute_row->meeting_type;
			?>
	   	    </td>
		</tr>
		<tr>
			<td width='20%'>
    			Meeting Category
	        </td>
	        <td width='30%'>
			<?php
				if($minute_row->meeting_cat == 'all') echo 'All';
				else if($minute_row->meeting_cat == 'stu') echo 'Student';
				else echo 'Employee';
			?>
	   	    </td>
		</tr>
		<tr>
			<td width ="20%">
				Meeting File
			</td>
			<td width="30%">
				<?php
				echo '<a href="'.base_url().'assets/files/information/minute/'.$minute_row->minutes_path.'" title="download file">'.$minute_row->minutes_path.'</a>';
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Date of Meeting
			</td>
			<td width="30%">
				<?php
					echo date_format(date_create($minute_row->date_of_meeting),"d M Y");
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Place of Meeting
			</td>
			<td width="30%">
				<?php
					echo $minute_row->place_of_meeting;
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Posted on/ Edited on 
			</td>
			<td width="30%">
				<?php
					echo date_format(date_create($minute_row->posted_on),"d M Y");
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Valid Upto 
			</td>
			<td width="30%">
				<?php
					echo date_format(date_create($minute_row->valid_upto),"d M Y");
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Modification Status 
			</td>
			<td width="30%">
				<?php
					if( $minute_row->modification_value == 0) echo 'Unmodified';
					else echo '<font color="red">Modified Version '.$minute_row->modification_value.'</font>';
				?>
			</td>
		</tr>
	 </table> 
    <?php 
		echo form_open('information/edit_minute');
		echo form_hidden('minutes_id',$minute_row->minutes_id);
		echo form_hidden('minutes_no',$minute_row->minutes_no);
		echo form_hidden('meeting_type',$minute_row->meeting_type);
		echo form_hidden('meeting_cat',$minute_row->meeting_cat);
		echo form_hidden('minutes_path',$minute_row->minutes_path);
		echo form_hidden('date_of_meeting',$minute_row->date_of_meeting);
		echo form_hidden('place_of_meeting',$minute_row->place_of_meeting);
		echo form_hidden('valid_upto',$minute_row->valid_upto);
		echo form_hidden('modification_value',$minute_row->modification_value);
		echo form_submit('editsubmit','Edit');
		echo form_close();
	?>