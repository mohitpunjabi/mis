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
		$ui->input()
		   ->label('Title of Paper')
		   ->name('title')
		   ->required()
		   ->show();
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
				$ui->option()->value(5)->text("Others")
			))
		   ->show();

	$Col2->close();
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
		get_publication_type(this.value); // or $(this).val()
	});
</script>
<!--<div id="container">
	<h1>Welcome to Publication Record Page!</h1>
  <center>
  <font face="Arial" size="3">
	<b>Add New Publication</b><br><br>
	<?php
		$form_attrinutes = array("id"=>"add_publication_form","method"=>"post");
	  echo form_open('publication/publication/addpublication',$form_attrinutes);
	?>
	<div id="publication_wrapper">
	  <fieldset>
		<legend>Details</legend>
		<table id="details_table">
		  <tr>
			<td>Enter Title of The Paper *</td>
			<td><input type="text" name="title" required="true"></td>
		  </tr>
		  <tr>
			<td>Types of the Publication</td>
			<td>
			  <select name="publication_type" id="publication_type">
				<option value="0">Select Type</option>
				<?php
				  foreach($prk_types as $type){
					echo "<option value='".$type->type_id."'>".$type->type_name."</option>";  
				  } 
				?>
			  </select>
			</td>
		  </tr>
		</table>
	  </fieldset>
	</div>  
	<?php
	echo form_submit('submit', 'Add Publication');
	echo form_close();
	?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>-->
