<?php $ui = new UI();
$row = $ui->row()->open();
	$col = $ui->col()->open();
		$box = $ui->box()->title('Query By '.$query_by)->open();
			$row1 = $ui->row()->open();
				$ui->select()->width(6)->label('Select '.$query_by)->id('query')->name('display_employee')->options($options)->extras('onChange="ajax(\''.$query_by.'\');"')->show();
			$row1->close();
			$row2 = $ui->row()->open();
				$col2 = $ui->col()->open();
					$table = $ui->table()->id('display_employee')->bordered()->condensed()->sortable()->paginated()->open();
					$table->close();
				$col2->close();
				//echo '<div id = "display_employee">''</div>';
			$row2->close();
		$box->close();
	$col->close();
$row->close();

?>
<!-- <h1 class="page-head" align="center">Query By <?= $query_by ?></h1>
<br>
<table align = "center">
<tr><th>Select <?= $query_by ?></th>
	<td>
		<?= $select ?>
    </td>
</table>
<br>
<div align ="center" id = "display_employee"></div> -->