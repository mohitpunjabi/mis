<?php
	
	$ui = new UI();

	$col1 =  $ui->col()->width(2)->open();
	$col1->close();
	$begin_date = "";
	$end_date = "";
	for ($i = 0; $i<10; $i++){
		$begin_date .= $publication['begin_date'][$i];
		$end_date .= $publication['end_date'][$i];
	}
	$form_attrinutes = array("id"=>"edit_publication_form");
	$form = $ui->form()->action('publication/publication/submit_edit',$form_attrinutes)->open();
	$col2 = $ui->col()->width(8)->open();
		$box = $ui->box()->uiType('primary')->solid()->title('Edit Publication')->open();
			$table = $ui->table()->hover()->bordered()->open();
				?>
					<tr>
						<td>Title<td>
						<td><input type="text" name="title" value="<?php echo $publication['title']; ?>"></td>
					</tr>
				<?php
				?>
					<tr>
						<td>Name<td>
						<td><input type="text" name="publication_name" value="<?php echo $publication['name']; ?>"></td>
					</tr>
				<?php
				if (!empty($publication['place'])){
					?>
					<tr>
						<td>Place<td>
						<td><input type="text" name="venue" value="<?php echo $publication['place']; ?>"></td>
					</tr>
				<?php
				}
				if (!empty($publication['vol_no'])){
					?>
					<tr>
						<td>Volume No.<td>
						<td><input type="text" name="vol_no" value="<?php echo $publication['vol_no']; ?>"></td>
					</tr>
				<?php
				}
				if (!empty($publication['vol_no'])){
					?>
					<tr>
						<td>Issue No.<td>
						<td><input type="text" name="issue_no" value="<?php echo $publication['issue_no']; ?>"></td>
					</tr>
				<?php
				}
				if ($publication['type_id'] == '3' || $publication['type_id'] == '4'){
					?>
					<tr>
						<td>Begin Date<td>
						<td><input type="text" name="begin_date" value="<?php echo $begin_date; ?>"></td>
					</tr>
				<?php
				}
				else{
					?>
					<tr>
						<td>Date of Publications<td>
						<td><input type="text" name="begin_date" value="<?php echo $begin_date; ?>"></td>
					</tr>
				<?php
				}
				if ($publication['type_id'] == '3' || $publication['type_id'] == '4'){
					?>
					<tr>
						<td>End Date<td>
						<td><input type="text" name="end_date" value="<?php echo $end_date; ?>"></td>
					</tr>
				<?php
				}
				?>
					<tr>
						<td>Page Range<td>
						<td><input type="text" name="page_no" value="<?php echo $publication['page_no']; ?>"></td>
					</tr>
				<?php
				?>
					<tr>
						<td>Other Informations<td>
						<td><input type="text" name="other_info" value="<?php echo $publication['other_info']; ?>"></td>
					</tr>
				<?php
			$table->close();
			?><br><br><center><?php
				 $ui->button()
					->value('Edit')
					->submit(true)
					->id('Edit')
					->uiType('primary')
					->show();
					?></center>
					<?php
		$box->close();
	$col2->close();
	$form->close();	
?>