 <?php $ui = new UI();

    $upRow = $ui->row()->open();
        $col = $ui->col()->open();
            $box = $ui->box("show_details")->title('Last 5 Year Stay Details')->uiType('primary')->open();
            	if($emp_last5yrstay_details != FALSE) {
	                $table = $ui->table()->id('tbl5')->responsive()->bordered()->striped()->open();
	                    echo '<thead valign="middle" ><tr align="center">
				              	<th rowspan=2>S no.</th>
								<th colspan=2>Duration</th>
								<th rowspan=2>Residential Address</th>
								<th rowspan=2>Name of District Headquarters</th>
								<th rowspan=2>Edit/Delete</th>
	                    	</tr>
	                    	<tr align="center">
	                        	<th>From</th>
	                        	<th>To</th>
	                    	</tr></thead><tbody>';
	                    $i=1;
	                    foreach($emp_last5yrstay_details as $row)
						{
							echo '<tr name=row[] align="center">
									<td>'.$i.'</td>
							    	<td>'.date('d M Y', strtotime($row->from)).'</td>
							    	<td>'.date('d M Y', strtotime($row->to)).'</td>
							    	<td>'.$row->res_addr.'</td>
							    	<td>'.ucwords($row->dist_hq_name).'</td>
							    	<td>';
	                                	$ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.')"')->show();
	                                    $ui->button()->flat()->id('delete5'.$i)->name("delete5[]")->uiType("danger")->value("Delete")->icon($ui->icon("trash-o"))->extras('onClick="onclick_delete('.$i.');"')->show();
	                        echo   '</td></tr>';
							$i++;
						}
	                    echo'</tbody>';
	                $table->close();
	            }
	            else
	            	$ui->callout()->title('Empty')->desc('No Stay Details Found.')->uiType('danger')->show();
            $box->close();
        $col->close();
    $upRow->close();

$form = $ui->form()->id('stay_details')->action('employee/edit/update_last_5yr_stay_details/'.$emp_id)->open();
    $row = $ui->row()->open();
        $col = $ui->col()->width(12)->open();
            $box = $ui->box()->uiType('primary')->title('Add Last 5 Year Stay Details')->tooltip("Click Add after entering following details")->open();
                $row11 = $ui->row()->open();
                	$ui->input()->name("addr5")->label('Residential Address')->width(12)->t_width(12)->show();
                $row11->close();
                $row12 = $ui->row()->open();
                	$date=date("Y-m-d", time());
	                $newdate = strtotime ( '-5 year' , strtotime ( $date ) ) ;

                    $ui->datePicker()->name('from5')
                                    ->id('from51')
                                    ->dateFormat('dd-mm-yyyy')
                                    ->addonRight($ui->icon("calendar"))
                                    ->placeholder("dd-mm-yyyy")
                                    ->label('From')->width(3)->t_width(3)
                                    ->extras('max="'.date('d-m-Y').'" min="'.date('d-m-Y',$newdate).'"')
                                    ->show();
                    $ui->datePicker()->name('to5')
                                    ->id('to51')
                                    ->dateFormat('dd-mm-yyyy')
                                    ->addonRight($ui->icon("calendar"))
                                    ->placeholder("dd-mm-yyyy")
                                    ->label('To')->width(3)->t_width(3)
                                    ->extras('max="'.date('d-m-Y').'" min="'.date('d-m-Y',$newdate).'"')
                                    ->show();
                    $ui->input()->name("dist5")->label('Name of District Headquarters')->width(6)->t_width(6)->show();
                $row12->close();
            $box->close();
        $col->close();
    $row->close();
    $ui->button()->classes('pull-right')->submit()->id('add_btn')->name('submit')->value("Add")->large()->uiType('primary')->icon($ui->icon("plus"))->show();
    $ui->button()->value('Back')->id('back_btn')->name('back')->large()->uiType('primary')->icon($ui->icon("arrow-left"))->show();
    echo "<br />";
$form->close();
?>