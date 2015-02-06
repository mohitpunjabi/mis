<?php echo form_open (); ?>
<?php
	$ui = new UI();

	$ui->callout()
		->title("This is just a small example")
		->uiType("warning")
		->desc('This example shows only a handful of the UI options. ' .
					'See the <a href="http://172.16.8.5/wiki/index.php/UI_Library">UI Library wiki</a> for a detailed list of options. ' .
				'Help us build this page by adding more example codes.')
		->show();
		$outer_row = $ui->row()
										->open();
			$outer_column = $ui->col()
												 ->width(8)
												 ->t_width(8)
												 ->m_width(12)
												 ->open();

				$form=$ui->form()->multipart()->open();
				$column1 = $ui->col()
											->width(6)
											->t_width(8)
											->m_width(12)
											->open();
				$ui->input()
						->placeholder('Enter file number')
						->type('text')
						->label('File Number')
						->uiType('info')
						->id('file_no')
						->name('file_no')
						->show();
				$column1->close();
				$column2 = $ui->col()
											->width(6)
											->t_width(8)
											->m_width(12)
											->open();
				$ui->input()
						->placeholder('Enter file subject')
						->type('text')
						->label('File Subject')
						->uiType('info')
						->id('file_sub')
						->name('file_sub')
						->show();
				$column2->close();

				$column3 = $ui->col()
											->width(6)
											->t_width(8)
											->m_width(12)
											->open();
				$ui->select()
						->label('Department Type')
						->name('type')
						->id('type')
						->options(array($ui->option()->value('""')->text('Select')->selected(),
														$ui->option()->value('academic')->text('Academic'),
														$ui->option()->value('nonacademic')->text('Non Academic')))
						->show();
				$column3->close();
				$column4 = $ui->col()
											->width(6)
											->t_width(8)
											->m_width(12)
											->open();
				$ui->select()
						->label('Select Department')
						->name('department_name')
						->id('department_name')
						->options(array($ui->option()->value('""')->text('Select')->selected()))
						->show();
				$column4->close();
				$column5 = $ui->col()
											->width(6)
											->t_width(8)
											->m_width(12)
											->open();
				$ui->select()
						->label('Designation')
						->name('designation')
						->id('designation')
						->options(array($ui->option()->value('""')->text('Select')->selected()))
						->show();
				$column5->close();
				$column6 = $ui->col()
											->width(6)
											->t_width(8)
											->m_width(12)
											->open();
				$ui->select()
						->label('Employee Name')
						->name('emp_name')
						->id('emp_name')
						->options(array($ui->option()->value('""')->text('Select')->selected()))
						->show();
				$column6->close();
				$column7 = $ui->col()
											->width(12)
											->t_width(8)
											->m_width(12)
											->open();
				$ui->textarea()
						->label('Remarks')
						->name('remarks')
						->id('remarks')
						->placeholder('Remarks')
						->type('text')
						->uiType('info')
						->show();
				$column7->close();
				$column8 = $ui->col()
											->width(6)
											->t_width(8)
											->m_width(12)
											->open();
				$ui->button()
					->value('Submit')
					->id('submit')
					->uiType('primary')
					->submit()
					->name('submit')
					->show();
				$column8->close();



				$form->close();
			$outer_column->close();

		$outer_row->close();
?>
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
