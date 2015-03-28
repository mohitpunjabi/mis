<?php
	$ui = new UI();
//echo form_open('complaint/register_complaint/insert');   	
	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->solid()
			  ->title("Application No. : ".$app_num)
			  ->uiType('primary')
			  ->open();

		$table = $ui->table()->hover()
					->open();
?>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?>Registered On</th>
				<td><?= $app_date ?></td>
			</tr>
			<? if ($auth == 'emp' && $purpose == 'Official') { ?>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> HOD Approval</th>
				<td>
					<? 
				  			if ($hod_status == "Approved") 
				  				echo "Approved on ".$hod_action_timestamp; 
				  			else if ($hod_status == "Rejected") 
				  				echo "Rejected on ".$hod_action_timestamp;
				  			else
				  				echo $hod_status; 
				  		?>
				</td>
			</tr>
			<? } ?>

			<? if ($auth == 'stu') { ?>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> DSW Approval</th>
				<td>
					<? 
				  			if ($dsw_status == "Approved") 
				  				echo "Approved on ".$dsw_action_timestamp; 
				  			else if ($dsw_status == "Rejected") 
				  				echo "Rejected on ".$dsw_action_timestamp;
				  			else 
				  				echo $dsw_status; 
				  		?>
				</td>
			</tr>
			<? } ?>

			<tr>
				<th><? $ui->icon("clock-o")->show() ?> PCE Approval</th>
				<td>
					<? 
				  			if ($pce_status == "Approved") 
				  				echo "Approved on ".$pce_action_timestamp; 
				  			else if ($pce_status == "Rejected") 
				  				echo "Rejected on ".$pce_action_timestamp;
				  			else
				  				echo $pce_status; 
				  		?>
				</td>
			</tr>
			<tr>
				<th>Purpose</th>
				<td><?= $purpose ?></td>
			</tr>
			<tr>
				<th>Purpose of Visit</th>
				<td><?= $purpose_of_visit ?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?= $name ?></td>
			</tr>
			<tr>
				<th>Designation</th>
				<td><?= $designation ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Check In</th>
				<td><?= $check_in ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Check Out</th>
				<td><?= $check_out ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Number of Guests</th>
				<td><?= $no_of_guests ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Guest in Single AC Rooms (Prefered)</th>
				<td><?= $single_AC ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Guest in Double AC Rooms (Prefered)</th>
				<td><?= $double_AC ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Guest in Suite AC Rooms (Prefered)</th>
				<td><?= $suite_AC ?></td>
			</tr>
			<? if ($school_guest == '1') { ?>
				<tr>
					<th><? $ui->icon("clock-o")->show() ?> Whether School Guest?</th>
					<td><?= $school_guest ?></td>
				</tr>
				<tr>
					<th><? $ui->icon("clock-o")->show() ?> File Path</th>
					<td><a href="<?= site_url('../assets/files/edc_booking/'.$file_path) ?>"><?= $file_path?></a></td>
				</tr>
<?
			}

			if ($deny_reason) {
?>
				<tr>
					<th>Reason of Rejection</th>
					<td>
						<?= $deny_reason ?>
					</td>
				</tr>
<?
			}
		$table->close();
	$box->close();	
	$column2->close();
	
	$row->close();
?>
<?/*	$box = $ui->box()
			  ->solid()
			  ->title("Application No. : ".$app_num)
			  ->uiType('primary')
			  ->open();
	
		$inputRow1 = $ui->row()->open();
			$c1 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> Registered On</strong><br/>
				  <sapn><?= $app_date ?></span></p><?
			$c1->close();
			$c2 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> HOD Approval </strong><br/>
				  <span>
				  		<? 
				  			if ($hod_approved_status == "Approved") 
				  				echo "Approved on ".$hod_approved_timestamp; 
				  			else if ($hod_approved_status == "Rejected") 
				  				echo "Rejected on ".$hod_approved_timestamp;
				  			else
				  				echo "Pending"; 
				  		?>
				  </span></p><?
			$c2->close();
			$c3 = $ui->col()->width(4)->open();
				?><p><strong> <? $ui->icon("clock-o")->show() ?> PCE Approval </strong><br/>
				  <span>
				  		<? 
				  			if ($pce_approved_status == "Approved") 
				  				echo "Approved on ".$pce_approved_timestamp; 
				  			else if ($pce_approved_status == "Rejected") 
				  				echo "Rejected on ".$pce_approved_timestamp;
				  			else
				  				echo "Pending"; 
				  		?>
				  </span></p><?
			$c3->close();
		$inputRow1->close();
		

		$inputRow2 = $ui->row()->open();
			$c1 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> Check In</strong><br/>
				  <sapn><?= $check_in ?></span></p><?
			$c1->close();
			$c2 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> Check Out</strong><br/>
				  <span><?= $check_out ?></span></p><?
			$c2->close();
			$c3 = $ui->col()->width(4)->open();
				?><p><strong> Purpose </strong></br><?
				?><span><?= $purpose ?></span></p><?
			$c3->close();
		$inputRow2->close();


		$inputRow3 = $ui->row()->open();
			$c1 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> Amount Deposited</strong><br/>
				  <sapn><?= $amount_deposited ?></span></p><?
			$c1->close();
			$c2 = $ui->col()->width(4)->open();
				?><p><strong> Payment made by Name </strong><br/>
				  <span><?= $amount_name ?></span></p><?
			$c2->close();
			
			if ($deny_reason) {
				$c3 = $ui->col()->width(4)->open();
					?><p><strong> Reason of Rejection </strong><br/>
					  <span><?= $deny_reason ?>
					  </span></p><?
				$c3->close();
			}
		$inputRow3->close();
?>
<center><a href="<?php echo site_url("edc_booking/guest_details/get_guests/".$app_num);?>"><strong>Guest Details<strong></a></center>
<?

	$box->close();
*/	
