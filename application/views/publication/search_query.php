<?php
	$ui = new UI();

	$column = $ui->col()->width(2)->open();
	$column->close();


	$column1 = $ui->col()->width(8)->open();
		$box = $ui->box()->uiType('primary')->solid()->title('Search Publications')->open();
		$form_attrinutes = array("id"=>"search_publication_form","method"=>"post");
		$form = $ui->form()->action('publication/publication/search_result',$form_attrinutes)->open();
			$table = $ui->table()->hover()->bordered()->open();

				?>
					<tr>
						<th>Department</th>
						<th>
							<?php
								$ui->select()
									->name('department_name')
									->id('department_name')
									->options(array($ui->option()->value('""')->text('Select')))
									->show();
							?>
						</th>
					</tr>
					<tr>
						<th>Faculty</th>
						<th>
							<?php
								$ui->select()
									->name('faculty_name')
									->id('faculty_name')
									->options(
										//$ui->option()->value("all")->text("All"),
										array($ui->option()->value('""')->text('Select')))
									->show();
							?>
						</th>
					</tr>
					<tr>
						<th>Type of Publication</th>
						<th>
							<?php
								$ui->select()
									->name('type_of_pub')
									->id('type_of_pub')
									->options(array(
										$ui->option()->value("all")->text("All"),
										$ui->option()->value(1)->text("National Journal"),
										$ui->option()->value(2)->text("International Journal"),
										$ui->option()->value(3)->text("National Conference"),
										$ui->option()->value(4)->text("International Conference"),
										$ui->option()->value(5)->text("Others")
									))
									->show();
							?>
						</th>
					</tr>
					<tr>
						<th>Start Date</th>
						<th>
							<?php
							$ui->datePicker()->label('Date')
							   ->name('start_date')->placeholder("Enter the date")
							   ->dateFormat('dd-mm-yyyy')->show();
							?>
						</th>
					</tr>
					<tr>
						<th>End Date</th>
						<th>
							<?php
							$ui->datePicker()->label('Date')
							   ->name('end_date')->placeholder("Enter the date")
							   ->dateFormat('dd-mm-yyyy')->show();
							?>
						</th>
					</tr>
				<?php


			$table->close();
		$row = $ui->row()->open(); 
		?><center><?php
			$ui->button()->name('Submit')->value('Submit')->submit(true)->uiType('primary')->show();
		?></center><?php
		$row->close();
		$form->close();
		$box->close();
	$column1->close();
?>
<script charset="utf-8">
	$(document).ready(function() {
		get_dept_query("abc"); // or $(this).val()
	});
	$("#department_name").on('change', function() {
		find_faculty_query(this.value,"abc"); // or $(this).val()
	});
</script>
