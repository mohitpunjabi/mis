    <p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
	<h2>Notice Details</h2>
	<table width='90%'>
		<tr><th colspan=2></th></tr>
		<tr>
			<td width='20%'>
    			Notice ID
            </td>
			<td width='28%'>
	        	<?php 
				echo $notice_row->notice_id;
				?>
			</td>
		</tr>
		<tr>
			<td width='20%'>
    			Notice Number
            </td>
			<td width='28%'>
	        	<?php 
				echo $notice_row->notice_no;
				?>
			</td>
		</tr>
		<tr>
			<td width='20%'>
    			Notice Category
	        </td>
	        <td width='30%'>
			<?php
				if($notice_row->notice_cat == 'all') echo 'All';
				else if($notice_row->notice_cat == 'stu') echo 'Student';
				else echo 'Employee';
			?>
	   	    </td>
		</tr>
		<tr>
			<td width ="20%">
				Notice Subject
			</td>
			<td width="30%">
				<?php
					echo $notice_row->notice_sub;
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Notice File
			</td>
			<td width="30%">
				<?php
				echo '<a href="'.base_url().'assets/files/information/notice/'.$notice_row->notice_path.'" title="download file">'.$notice_row->notice_path.'</a>';
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Last Date 
			</td>
			<td width="30%">
				<?php
					echo date_format(date_create($notice_row->last_date),"d M Y");
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Posted on/ Edited on 
			</td>
			<td width="30%">
				<?php
					echo date_format(date_create($notice_row->posted_on),"d M Y");
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Modification Status 
			</td>
			<td width="30%">
				<?php
					$n = $notice_row->modification_value;
					if ($n == 0) echo 'Unmodified';
					else echo '<font color="red">Modified Version '.$n.'</font>';
				?>
			</td>
		</tr>
	 </table> 