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
     /*$ui->select()
			   ->name('room')
			   ->label('Select Room')
			   ->addonLeft($ui->icon("bars"))
			   ->options(array(
	                   $ui->option()->value()->text('Select')->disabled()))
	       ->required()
			   ->show();*/

		$box = $ui->row()
							->id('room_container')
			        //->width(12)
			        //->t_width(8)
			        //->m_width(12)
			        ->open();

                    /* content */

		$box->close();

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
