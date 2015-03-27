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
		   ->action('edc_booking/booking/insert')
		   ->open();
				 	
		$ui->select()
		   ->name('purpose')
		   ->label('Purpose')
		   ->addonLeft($ui->icon("bars"))
		   ->options(array(
                   $ui->option()->value('official')->text('Official'),
                   $ui->option()->value('personal')->text('Personal')))
           ->required()
		   ->show();	

		$ui->textarea()->label('Purpose of Visit')->name('purpose')->placeholder("Enter the purpose")->required()->show();	
			  
		$ui->input()
			->placeholder('Name')
			->type('text')
			->label('Accomodation Required for (Name)')
			->name('name')
			->required ()
		    ->show();

		$ui->input()
			->placeholder('Designation')
			->type('text')
			->label('Designation')
			->name('designation')
			->required ()
		    ->show();

		$ui->datePicker()
			 ->label ('Check-In-Date-Time')
			 ->name('checkin')
		   	 ->placeholder("Select Check-In-Date-Time")
			 ->addonLeft($ui->icon("calendar"))
			 ->dateFormat('yyyy-mm-dd')
			 ->required()
			 ->show();
		
			  
		$ui->datePicker()
			 ->label ('Check-Out-Date-Time')	
			 ->name('checkout')
		   	 ->placeholder("Select Check-Out-Date-Time")
			 ->addonLeft($ui->icon("calendar"))
			 ->dateFormat('yyyy-mm-dd')
			 ->required()
			 ->show();

		  
		$ui->select()
		   ->label('Number of Rooms Required')
		   ->name('no_of_guests')
		   ->addonLeft($ui->icon("bars"))
		   ->options(array(
	               $ui->option()->value('0')->text('0')->disabled()->selected(),
	               $ui->option()->value('1')->text('1'),
				   $ui->option()->value('2')->text('2'),
				   $ui->option()->value('3')->text('3'),
				   $ui->option()->value('4')->text('4'),
				   $ui->option()->value('5')->text('5'),
				   $ui->option()->value('6')->text('6')))
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