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
      ->disabled()
		  ->show();

     	 $ui->input()
 			->type('text')
 			->label('Check In Time')
//<<<<<<< HEAD
 			->name('check_in_display')
      		->value($check_in_display)
       		->disabled()
 		  	->show();

     	 $ui->input()
			->type('text')
			->label('Check Out Time')
			->name('check_out_display')
      		->value($check_out_display)
      		->disabled()
		  	->show();
		
		 $ui->input()
 			->type('hidden')
 			->name('check_in')
 			->id('check_in')
      		->value($check_in)
       		->show();
       		//->readable();

     	 $ui->input()
			->type('hidden')
//=======
/*			->id('check_in')
 			->name('check_in')
      ->disabled()
      ->value($check_in)
       //->readable()
 		  ->show();
		//	date('j M Y g:i A', strtotime(
     $ui->input()
		//	->placeholder('Check Out Time')
			->type('text')
			->label('Check Out Time')
			->id('check_out')*/
//>>>>>>> c13560e48283ab260875fb12bbde488ce6c45b34
			->name('check_out')
<<<<<<< HEAD
      ->disabled()
      ->value($check_out)
      //->readable()
		  ->show();
=======
      		->id('check_out')
      		->value($check_out)
      		->show();
>>>>>>> 01ba07d63552f05b54a28bc1c67775b3b019cc5e

			if($single_AC+$double_AC+$suite_AC-$total_alloc_rooms <= 0)
			{
				$total_room = 'No room left to be allocated.';
			}
			else
			{
				$total_room = $single_AC+$double_AC+$suite_AC-$total_alloc_rooms;
			}
			$ui->input()
		//	->placeholder('Check Out Time')
			->type('text')
			->label('Total room to be allocated')
			->name('room_total')
      ->disabled()
			->value($total_room)
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
     /*$ui->select()
			   ->name('floor')
			   ->label('Select Floor')
			   ->addonLeft($ui->icon("bars"))
			   ->options(array(
	                   $ui->option()->value()->text('Select')->disabled()))
	       ->required()
			   ->show();*/
		$floor_box = $ui->row()
										->open();
			$col4 = $ui->col()
								 ->name('floor')
						 		 ->id('floor')
								 ->width(12)
					       ->open();
			$col1->close();

		 $floor_box->close();

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
			 ->id('room_alloc_button')
		   ->value('Submit')
		   ->uiType('primary')
		   ->submit()
		   ->name('submit')
			 //->extras('disabled = true')
		   ->show();
?>
</center>
<?
		$form->close();

	$box->close();

	$col2->close();

	$row->close();
?>
