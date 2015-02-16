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
<!--
<div id="container">
	<h1>Welcome to Publication Record Page!</h1>
  <center>
  <font face="Arial" size="3">
	<b>Search Publication</b><br><br>
	<?php
		$form_attrinutes = array("id"=>"search_publication_form","method"=>"post");
	  echo form_open('publication/publication/search_result',$form_attrinutes);
	?>
	<div id="publication_wrapper">
	  <table id="search_table">
		<tr>
		  <td>Department</td>
		  <td>
			<select name="dept_id" id="search_department">
			  
			</select>
		  </td>
		</tr>
		<!-- <tr id="search_faculty_wrapper">
		  <td>Faculty</td>
		  <td>
			<select name="emp_id" id="search_faculty">
			</select>
		  </td>
		</tr> -->
		<!--<tr>
		  <td>Type of Publication</td>
		  <td>
			<select name="publication_type" id="publication_type">
			  <option value="all" selected="selected">All Type</option>
			  <?php
				foreach($prk_types as $type){
				  echo "<option value='".$type->type_id."'>".$type->type_name."</option>";  
				} 
			  ?>
			</select>
		  </td>
		</tr>
		<tr>
		  <td>Start Date</td>
		  <td><input type="date" name="begin_date"></td>
		</tr>
		<tr>
		  <td>End Date</td>
		  <td><input type="date" name="end_date"></td>
		</tr>
	  </table>
	</div>  

	<?php
	echo form_submit('submit', 'Search');
	echo form_close();
	?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
-->
