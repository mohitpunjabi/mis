<?php $ui = new UI();

    $upRow = $ui->row()->open();
        $col = $ui->col()->open();
            $box = $ui->box()->id('show_details')->title('Previous Employment Details')->uiType('primary')->open();
				if($emp_prev_exp_details != FALSE) {
	                $table = $ui->table()->id('tbl2')->responsive()->condensed()->bordered()->striped()->open();
	                    echo '<thead valign="middle" ><tr align="center">
	                        <th rowspan="2" >S no.</th>
	                        <th rowspan="2">Full address of Employer</th>
	                        <th rowspan="2">Position held</th>
	                        <th colspan="2">Organization</th>
	                        <th rowspan="2">Pay Scale</th>
	                        <th rowspan="2">Remarks</th>
	                        <th rowspan="2">Edit/Delete</th>
	                    </tr>
	                    <tr align="center">
	                        <th>From</th>
	                        <th>To</th>
	                    </tr></thead><tbody>';
	                    $i=1;
	                    foreach($emp_prev_exp_details as $row) {
	                        if($row->remarks == "") $remarks='NA';
	                        else    $remarks = $row->remarks;
	                        echo '<tr name="row[]" align="center">
	                                <td>'.$row->sno.'</td>
	                                <td>'.ucwords($row->address).'</td>
	                                <td>'.ucwords($row->designation).'</td>
	                                <td>'.date('d M Y', strtotime($row->from)).'</td>
	                                <td>'.date('d M Y', strtotime($row->to)).'</td>
	                                <td>'.$row->pay_scale.'</td>
	                                <td>'.ucfirst($remarks).'</td>
	                        		<td>';
	                                    $ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.',\''.$row->from.'\',\''.$row->to.'\',\''.$joining_date.'\')"')->show();
	                                    $ui->button()->flat()->id('delete2'.$i)->name("delete2[]")->uiType("danger")->value("Delete")->icon($ui->icon("trash-o"))->extras('onClick="onclick_delete('.$i.');"')->show();
	                        echo   '</td></tr>';
	                        $i++;
	                    }
	                    echo'</tbody>';
	                $table->close();
	            }
	            else
	            	$ui->callout()->title('Empty')->desc('No Employment Details Found.')->uiType('danger')->show();
            $box->close();
        $col->close();
    $upRow->close();

$form = $ui->form()->id('prev_emp_details')->action('employee/edit/update_prev_emp_details/'.$emp_id)->open();
    $row = $ui->row()->open();
        $col = $ui->col()->width(12)->open();
            $box = $ui->box()->uiType('primary')->title('Add Previous Employment Details')->tooltip("Click Add after entering following details")->open();
                $row11 = $ui->row()->open();
                    $ui->input()->name('addr2')->label('Full address of Employer')->width(12)->show();
                $row11->close();
                $row12 = $ui->row()->open();
                    $ui->datePicker()->name('from2')
                                    ->id('from21')
                                    ->dateFormat('dd-mm-yyyy')
                                    ->addonRight($ui->icon("calendar"))
                                    ->placeholder("dd-mm-yyyy")
                                    ->label('From')->width(3)->t_width(4)
                                    ->extras('max="'.date('d-m-Y',strtotime($joining_date)).'"') //max not working
                                    ->show();
                    $ui->datePicker()->name('to2')
                                    ->id('to21')
                                    ->dateFormat('dd-mm-yyyy')
                                    ->addonRight($ui->icon("calendar"))
                                    ->placeholder("dd-mm-yyyy")
                                    ->label('To')->width(3)->t_width(4)
                                    ->extras('max="'.date('d-m-Y',strtotime($joining_date)).'"') //max not working
                                    ->show();
                $row12->close();
                $row13 = $ui->row()->open();
                    $ui->input()->name("designation2")->label('Position Held')->width(3)->t_width(12)->show();
                    $ui->input()->name("payscale2")->label('Pay Scale')->width(3)->t_width(12)->show();
                    $ui->input()->name('reason2')->label('Remarks')->width(6)->t_width(12)->show();
                $row13->close();
            $box->close();
        $col->close();
    $row->close();
    $ui->button()->classes('pull-right')->submit()->id('add_btn')->name('submit')->value("Add")->large()->uiType('primary')->icon($ui->icon("plus"))->show();
    $ui->button()->value('Back')->id('back_btn')->name('back')->large()->uiType('primary')->icon($ui->icon("arrow-left"))->show();
    echo "<br />";
$form->close();
?>