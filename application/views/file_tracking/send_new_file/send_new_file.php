<?php echo form_open (); ?>
<?php
	$ui = new UI();

	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->title('File Details')
			  ->solid()	
			  ->uiType('primary')
			  ->open();

	$form=$ui->form()->multipart()->open();

	$inputRow1 = $ui->row()->open();
		 $ui->input()
			->placeholder('Enter file number')
			->type('text')
			->label('File Number')
			->uiType('info')
			->id('file_no')
			->name('file_no')
			->width(6)
		    ->show();
		 $ui->input()
			->placeholder('Enter file subject')
			->type('text')
			->label('File Subject')
			->uiType('info')
			->id('file_sub')
			->name('file_sub')
	 		->width(6)
		    ->show();
	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		 $ui->select()
			->label('Department Type')
			->name('type')
			->id('type')
			->options(array($ui->option()->value('""')->text('Select')->selected(),
							$ui->option()->value('academic')->text('Academic'),
							$ui->option()->value('nonacademic')->text('Non Academic')))
		    ->width(6)
		    ->show();
		 $ui->select()
			->label('Select Department')
			->name('department_name')
			->id('department_name')
			->options(array($ui->option()->value('""')->text('Select')->selected()))
	
			->width(6)
		   	->show();
	$inputRow2->close();

	$inputRow3 = $ui->row()->open();
     	 $ui->select()
			->label('Designation')
			->name('designation')
			->id('designation')
			->options(array($ui->option()->value('""')->text('Select')->selected()))
   			->width(6)
		   	->show();
		 $ui->select()
			->label('Employee Name')
			->name('emp_name')
			->id('emp_name')
			->options(array($ui->option()->value('""')->text('Select')->selected()))
		    ->width(6)
		    ->show();
	$inputRow3->close();

	$ui->textarea()
	   ->label('Remarks')
	   ->name('remarks')
	   ->id('remarks')
	   ->placeholder('Remarks')
	   ->type('text')
	   ->uiType('info')
	   ->show();
?>
<center>
<?php
	 $ui->button()
		->value('Submit')
		->id('submit')
		->uiType('primary')
		->submit()
		->name('submit')	
		->width(6)
		->show();
	
	$form->close();
	$box->close();
	
	$column2->close();
	
	$row->close();
?>
</center>
<div id="send_notification"></div>


<script charset="utf-8">
	$('#type').on('change', function() {
		get_departments(this.value); // or $(this).val()
	});
	$('#department_name').on('change', function() {
		get_designation_name(this.value); // or $(this).val()
	});
	$('#designation').on('change', function() {
		get_emp_name(this.value); // or $(this).val()
	});
	$( "#submit" ).click(function() {
		display_send_notification();
	});
</script>
