<?php
	$ui = new UI();
	$outRow = $ui->row()->open();
	$column = $ui->col()->width(2)->open();
	$column->close();

	$column1 = $ui->col()->width(8)->open();
	$row = $ui->row()->open();
	$leftMargin = $ui->col()->width(1)->open();
			$leftMargin->close();
	$box = $ui->box()
			  ->id('publication_wrapper')
			  ->title('Add new Publication')
			  ->solid()
			  ->uiType('primary')
			  ->open();
	$form = $ui->form()->action('publication/publication/addPublication')->open();
	
	$inputRow1 = $ui->row()->open();
	$Col1 = $ui->col()->width(6)->open();
		$ui->input()->label('Title')->name('title')->required()->show();
	$Col1->close();
	$Col2 =  $ui->col()->width(6)->open();
		$ui->select()
		   ->label('Type of Publcation')
		   ->id('publication_type')
		   ->name('publication_type')
		   ->required()
		   ->options(array(
				$ui->option()->value()->text("Select"),
				$ui->option()->value(1)->text("National Journal"),
				$ui->option()->value(2)->text("International Journal"),
				$ui->option()->value(3)->text("National Conference"),
				$ui->option()->value(4)->text("International Conference"),
				$ui->option()->value(5)->text("Book"),
				$ui->option()->value(6)->text("Book Chapter")
			))
		   ->show();

	$Col2->close();
	$innerCol1 = $ui->col()->id('month_col')->width(6)->open();
		$ui->select()->label('Month')->name('month')->required()->options(array(
				$ui->option()->value()->text("Select"),
				$ui->option()->value("01")->text("January"),
				$ui->option()->value("02")->text("February"),
				$ui->option()->value("03")->text("March"),
				$ui->option()->value("04")->text("April"),
				$ui->option()->value("05")->text("May"),
				$ui->option()->value("06")->text("June"),
				$ui->option()->value("07")->text("July"),
				$ui->option()->value("08")->text("August"),
				$ui->option()->value("09")->text("September"),
				$ui->option()->value("10")->text("October"),
				$ui->option()->value("11")->text("November"),
				$ui->option()->value("12")->text("December")
			))->show();
	$innerCol1->close();
	$innerCol2 = $ui->col()->id('year_col')->width(6)->open();
		$ui->select()->label('Year')->name('year')->id('year')->required()
				->options(array($ui->option()->value('""')->text('Selectq1')))
				->show();
	$innerCol2->close();
	
	$innerColumn3 = $ui->col()->id("date_picker_one")->width(6)->open();
				$ui->datePicker()->label('Date')->id('date')
				   ->name('begin_date')->placeholder("dd-mm-yyyy")
				   ->dateFormat('dd-mm-yyyy')->show();
	$innerColumn3->close();
	$innerColumn4 = $ui->col()->id("isbn_first")->width(6)->open();
				$ui->input()->label('ISBN No.')->name('isbn_no')->show();
			$innerColumn4->close();
	$innerColumn3 = $ui->col()->id("date_picker_the")->width(6)->open();
				$ui->datePicker()->label('Begin date')->name('begin_date')->placeholder("dd-mm-yyyy")
						->dateFormat('dd-mm-yyyy')->show();
	$innerColumn3->close();
	$innerColumn4 = $ui->col()->id("date_picker_two")->width(6)->open();
				$ui->datePicker()->label('End date')->name('end_date')->placeholder("dd-mm-yyyy")
						->dateFormat('dd-mm-yyyy')->show();
	$innerColumn4->close();


	$inputRow1->close();
	

	$row2 = $ui->col()->id('pub_type')->width(12)->open();	
	
	$row2->close();

	$row3 = $ui->row()->open();
	?><center><?php
	$ui->button()->name('Submit')->value('Submit')->submit(true)->uiType('primary')->show();
	?></center><?php
	$row3->close();
	$form->close();
	$box->close();
	$row->close();

	$column1->close();
	$outRow->close();

?>
<script charset="utf-8">
	$("#publication_type").on('change', function() {
		get_publication_type(this.value);
		put_year();
		if (this.value == 1 || this.value == 2)
		{
			$('#year_col').show();
			$('#month_col').show();
			$('#date_picker_the').hide();
			$('#date_picker_two').hide();
			$('#isbn_first').hide();
		}
		else if(this.value==3||this.value==4)
		{
			$('#date_picker_one').hide();
			$('#year_col').hide();
			$('#month_col').hide();
			$('#date_picker_the').show();
			$('#date_picker_two').show();
			$('#isbn_first').hide();
		}
		else
		{
			$('#date_picker_one').show();
			$('#year_col').hide();
			$('#month_col').hide();
			$('#date_picker_the').hide();
			$('#date_picker_two').hide();
			$('#isbn_first').show();
		}
	});
	$(window).load(function(){
		$('#date_picker_one').hide();
		$('#date_picker_two').hide();
		$('#date_picker_the').hide();
		$('#isbn_first').hide();
		$('#year_col').hide();
		$('#month_col').hide();
	});
	//$("#date")
</script>