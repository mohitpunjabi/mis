<?php $ui = new UI();

    $upRow = $ui->row()->open();
        $col = $ui->col()->open();
            $box = $ui->box()->id('show_details')->title('Educational Qualifications')->uiType('primary')->open();
                if($emp_education_details != FALSE) {
	                $table = $ui->table()->id('tbl4')->responsive()->bordered()->striped()->open();
	                    echo '<thead valign="middle" ><tr align="center">
	                        <th align="center">S no.</th>
	                        <th>Examination</th>
	                        <th>Course(Specialization)</th>
	                        <th>College/University/Institute</th>
	                        <th>Year</th>
	                        <th>Percentage/Grade</th>
	                        <th>Class/Division</th>
	                        <th>Edit/Delete</th>
	                        </tr>
	                        </thead><tbody>';
	                    $i=1;
	                    foreach($emp_education_details as $row)
	                    {
	                        echo '<tr name="row[]" align="center">
	                                <td>'.$i.'</td>
	                                <td>'.strtoupper($row->exam).'</td>
	                                <td>'.strtoupper($row->branch).'</td>
	                                <td>'.strtoupper($row->institute).'</td>
	                                <td>'.$row->year.'</td>
	                                <td>'.strtoupper($row->grade).'</td>
	                                <td>'.ucwords($row->division).'</td>
	                            	<td>';
	                                	$ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.')"')->show();
	                                    $ui->button()->flat()->id('delete4'.$i)->name("delete4[]")->uiType("danger")->value("Delete")->icon($ui->icon("trash-o"))->extras('onClick="onclick_delete('.$i.');"')->show();
	                        echo   '</td></tr>';
	                        $i++;
	                    }
	                    echo'</tbody>';
	                $table->close();
	            }
	            else
	            	$ui->callout()->title('Empty')->desc('No Educational Qualifications Found.')->uiType('danger')->show();
            $box->close();
        $col->close();
    $upRow->close();

$form = $ui->form()->id('emp_education_details')->action('employee/edit/update_education_details/'.$emp_id)->open();
    $row = $ui->row()->open();
        $col = $ui->col()->width(12)->open();
            $box = $ui->box()->uiType('primary')->title('Add Educational Qualifications')->tooltip("Click Add after entering following details")->open();
                $row11 = $ui->row()->open();

                    $ui->select()->name('exam4')->label('Examination')->width(4)->t_width(4)
                                ->options(array($ui->option()->value("")->text("Choose One")->disabled()->selected(),
                                                $ui->option()->value("non-matric")->text("Non-Matric"),
                                                $ui->option()->value("matric")->text("Matric"),
                                                $ui->option()->value("intermediate")->text("Intermediate"),
                                                $ui->option()->value("graduation")->text("Graduation"),
                                                $ui->option()->value("post-graduation")->text("Post Graduation"),
                                                $ui->option()->value("doctorate")->text("Doctorate"),
                                                $ui->option()->value("post-doctorate")->text("Post Doctorate"),
                                                $ui->option()->value("others")->text("Others")))
                                ->show();
                    $ui->input()->name('clgname4')->label('College/University/Institute')->placeholder('Enter College / University / Institute Attended')->width(8)->t_width(8)->show();
                $row11->close();
                $row12 = $ui->row()->open();
                    $ui->input()->name('branch4')->label('Course(Specialization)')->placeholder('Enter Course with Specalization')->width(5)->t_width(5)->show();
                    $ui->input()->name("year4")->placeholder("Enter Year")->label('Year')->width(2)->t_width(2)->show();
                    $ui->input()->name('grade4')->placeholder("Enter Percentage/Grade")->label('Percentage/Grade')->width(3)->t_width(3)->show();
                    $ui->input()->name('div4')->placeholder("Enter Class/Division")->label('Class/Division')->width(2)->t_width(2)->show();
                $row12->close();
            $box->close();
        $col->close();
    $row->close();
    $ui->button()->classes('pull-right')->submit()->id('add_btn')->name('submit')->value("Add")->large()->uiType('primary')->icon($ui->icon("plus"))->show();
    $ui->button()->value('Back')->id('back_btn')->name('back')->large()->uiType('primary')->icon($ui->icon("arrow-left"))->show();
    echo "<br />";
$form->close();
?>