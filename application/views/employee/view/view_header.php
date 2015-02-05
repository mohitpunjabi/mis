<?php $ui = new UI();

	echo '<div id="print" >';
	$head = $ui->row()->open();
		$h_col = $ui->col()->width(12)->open();
			$box = $ui->box()->title('<center>Employee Id</center>')->solid()->uiType('primary')->open();
				echo '<center>'.$emp_id.'</center>';
			$box->close();
		$h_col->close();
	$head->close();
?>