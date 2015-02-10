<div id="print">
<?php

$ui = new UI();
$headingBox = $ui->box()
				 ->id('compDutyChartBox')
				 ->uiType('info')
				 ->title('Complete Duty Chart')
				 ->solid()
				 ->open();
	
	$table = $ui->table()
				->id('compDutyChartTable')
				->responsive()
				->hover()
				->bordered()
				->striped()
				->sortable()
				->paginated()
				->searchable()
				->open();
?>
		<thead>
            <tr>
                <th><center>Duty Date</center></th>
				<th><center>Guard Name</center></th>
				<th class="print-no-display">Photo</th>
				<th><center>Post Name</center></th>
				<th><center>Shift</center></th>
            </tr>
		</thead>

        <tfoot>
            <tr>
                <th><center>Duty Date</center></th>
				<th><center>Guard Name</center></th>
				<th class="print-no-display">Photo</th>
				<th><center>Post Name</center></th>
				<th><center>Shift</center></th>
            </tr>
        </tfoot>	
<?php	
	$table->close();
$headingBox->close();				 
				 
?>
</div>