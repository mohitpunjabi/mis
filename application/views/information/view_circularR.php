    <p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
	<h2>Circular Details</h2>
	<table width='90%'>
		<tr><th colspan=2></th></tr>
		<tr>
			<td width='20%'>
    			Circular ID
            </td>
			<td width='28%'>
	        	<?php 
				echo $circular_row->circular_id;
				?>
			</td>
		</tr>
		<tr>
			<td width='20%'>
    			Circular Number
            </td>
			<td width='28%'>
	        	<?php 
				echo $circular_row->circular_no;
				?>
			</td>
		</tr>
		<tr>
			<td width='20%'>
    			Circular Category
	        </td>
	        <td width='30%'>
			<?php
				if($circular_row->circular_cat == 'all') echo 'All';
				else if($circular_row->circular_cat == 'stu') echo 'Student';
				else echo 'Employee';
			?>
	   	    </td>
		</tr>
		<tr>
			<td width ="20%">
				Circular Subject
			</td>
			<td width="30%">
				<?php
					echo $circular_row->circular_sub;
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Circular File
			</td>
			<td width="30%">
				<?php
				echo '<a href="'.base_url().'assets/files/information/circular/'.$circular_row->circular_path.'" title="download file">'.$circular_row->circular_path.'</a>';
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Posted on/ Edited on 
			</td>
			<td width="30%">
				<?php
					echo date_format(date_create($circular_row->posted_on),"d M Y");
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Valid Upto 
			</td>
			<td width="30%">
				<?php
					echo date_format(date_create($circular_row->valid_upto),"d M Y");
				?>
			</td>
		</tr>
		<tr>
			<td width ="20%">
				Modification Status 
			</td>
			<td width="30%">
				<?php
					if( $circular_row->modification_value == 0) echo 'Unmodified';
					else echo '<font color="red">Modified Version '.$circular_row->modification_value.'</font>';
				?>
			</td>
		</tr>
	 </table> 