<script type="template" id="guest-details-tpl">
	<?php
/*		$ui = new UI();
		$guestdetailsRow = $ui->row()
					->id('guestdetailsRow')
					->open();
		$guestdetailsCol = $ui->col()->open();
			$guestdetailsBox = $ui->box()->title('Enter the details of Guest')->open();


						$ui->input()
						   ->id('name')
						   ->name('name')
						   ->label('Name')
						   ->placeholder('Enter Guest Name')
						   ->required()
						   ->show();



						$ui->select()
						   ->label('Gender')
						   ->name('gender')
						   ->id('gender')
						   ->addonLeft($ui->icon("bars"))
						   ->options(array(
								   $ui->option()->value('M')->text('Male'),
								   $ui->option()->value('F')->text('Female')))
								   ->required()
						   ->show();


						$ui->textarea()->name('address')->label('Address')->id('address')->required()->placeholder("Enter the Address")->show();


						$ui->select()
						   ->label('Room Preference')
						   ->name('room_preference')
						   ->id('room_preference')
						   ->addonLeft($ui->icon("bars"))
						   ->options(array(
								   $ui->option()->value('Double Bedded AC')->text('Double Bedded AC'),
								   $ui->option()->value('Double AC Suit')->text('Double AC Suit')))
								   ->required()
						   ->show();

		$guestdetailsBox->close();
		$guestdetailsCol->close();
	$guestdetailsRow->close();
*/	?>
</script>

<?php

	$ui = new UI();

	$row = $ui->row()->open();

	$col1 = $ui->col()
				 ->width(2)
	             ->open();
	$col1->close();

	$col2 = $ui->col()
				 ->width(8)
	             ->open();


	$box = $ui->box()
			 ->uiType('info')
			 ->title('EDC Room Allotment Form')
			 ->solid()
			 ->open();

		$form = $ui->form()
		   ->multipart()
		   ->action('edc_booking/room_allotment/insert_edc_allotment')
		   ->open();

     $ui->input()
			->placeholder('Application Number')
			->type('text')
			->label('Application Number')
			->name('app_num')
      ->value($app_num)
      //->readable()
		  ->show();

      $ui->input()
 		//	->placeholder('Check In Time')
 			->type('text')
 			->label('Check In Time')
 			->name('check_in')
      ->value($check_in)
       //->readable()
 		  ->show();

     $ui->input()
		//	->placeholder('Check Out Time')
			->type('text')
			->label('Check Out Time')
			->name('check_out')
      ->value($check_out)
      //->readable()
		  ->show();

     $ui->select()
			   ->name('building')
			   ->label('Select Building')
			   ->addonLeft($ui->icon("bars"))
			   ->options(array(
                     $ui->option()->value()->text('Select')->disabled(),
	                   $ui->option()->value('old')->text('Old'),
	                   $ui->option()->value('extension')->text('Extension')))
	       ->required()
			   ->show();
     $ui->select()
			   ->name('floor')
			   ->label('Select Floor')
			   ->addonLeft($ui->icon("bars"))
			   ->options(array(
	                   $ui->option()->value()->text('Select')->disabled()))
	       ->required()
			   ->show();
     $ui->select()
			   ->name('room')
			   ->label('Select Room')
			   ->addonLeft($ui->icon("bars"))
			   ->options(array(
	                   $ui->option()->value()->text('Select')->disabled()))
	       ->required()
			   ->show();

?>
<center>
<?
		$ui->button()
		   ->value('Submit')
		   ->uiType('primary')
		   ->submit()
		   ->name('submit')
		   ->show();
?>
</center>
<?
		$form->close();

	$box->close();

	$col2->close();

	$row->close();
?>
