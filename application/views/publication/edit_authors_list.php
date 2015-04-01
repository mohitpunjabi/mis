<?php
	$ui = new UI();
	$column = $ui->col()->width(2)->open();
	$column->close();
	
	$column1 = $ui->col()->width(8)->open();
		$box = $ui->box()->uiType('primary')->solid()->title('Edit Authors')->open();
		$table = $ui->table()->hover()->bordered()->open();
		
		$str = '';
		for ($i = 0; $i < sizeof($authors); $i++)
		{
			?><tr><?
			$name = $authors[$i]['name'];
			$id = $authors[$i]['emp_id'];
			if ($id != $own_emp_id){
				?><th><? echo $name; ?></th>
				<th><?php echo " <a href='".base_url().'index.php/publication/publication/deleteauthors/'.$id.'/'.$rec_id."'>Delete Author</a>"; ?></th><?
				?></tr><?
			}
		}
		$table->close();
		$box->close();
	$column1->close();
?>
