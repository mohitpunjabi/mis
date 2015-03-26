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

		$inputRow1 = $ui->row()->open();
			$c1 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> Registered On</strong><br/>
				  <sapn><?= $app_date ?></span></p><?
			$c1->close();
			$c2 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("user")->show() ?> Registerd By</strong><br/>
				  <span><?= $user ?></span></p><?
			$c2->close();
			$c3 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("mail-forward")->show() ?> Email ID</strong><br/>
				  <span><?= $email ?></span></p><?
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
		$inputRow3->close();


		$guestDetailsBox = $ui->box()
							  ->uiType('primary')	
							  ->solid()
							  ->title("Guest Details")
							  ->open();

				//table of guest details			  

		$guestDetailsBox ->close();

		if ($auth == 'hod')
			$form = $ui->form()->action('edc_booking/hod/hod_action/'.$app_num)->open();
		else if ($auth == 'pce')
			$form = $ui->form()->action('edc_booking/pce/pce_action/'.$app_num)->open();

		$inputRow4 = $ui->row()->open();

			$c1 = $ui->col()->width(1)->open();
			$c1->close();
		
			$c2 = $ui->col()->width(4)->open();
					$ui->select()
					   ->label('Approve OR Reject')
					   ->name('status')
					   ->required()
					   ->options(array( $ui->option()->value("Approved")->text('Approve'),
										$ui->option()->value("Rejected")->text('Reject'),
									  )
								)
					   ->show();
			$c2->close();

			$c3 = $ui->col()->width(1)->open();
			$c3->close();
		
			$c4 = $ui->col()->width(6)->open();
					$ui->textarea()->label('Reason for Rejection')->name("reason")->placeholder('Reason for Rejection')->show();
			$c4->close();
		$inputRow4->close();
?>
<center>
<?
		$ui->button()
			->value('Submit')
			->submit(true)
			->id('complaint')
			->uiType('primary')
			->show();

		$form->close();

	$box->close();
	
	$column2->close();
	
	$row->close();
?>
</center>