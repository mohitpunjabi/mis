<?php $ui = new UI();

    $upRow = $ui->row()->open();
        $col = $ui->col()->open();
            $box = $ui->box()->id('show_details')->title('Dependent Family Members Details')->uiType('primary')->open();
            	if($emp_family_details != FALSE) {
	                $table = $ui->table()->id('tbl3')->responsive()->condensed()->bordered()->striped()->open();
	                    echo '<thead valign="middle" ><tr align="center">
	                        <th align="center">S no.</th>
	                        <th>Name</th>
	                        <th>Relationship</th>
	                        <th>Date of Birth</th>
	                        <th>Profession</th>
	                        <th>Present Postal Address</th>
	                        <th>Active/Inactive</th>
	                        <th>Photograph</th>
	                        <th>Edit</th>
	                        </tr>
	                        </thead><tbody>';
	                    $i=1;
	                    foreach($emp_family_details as $row)
	                    {
	                        if($row->active_inactive=="Active")	$color="#00a65a";
	                        else 	$color="#f56954";
	                        echo '<tr name="row[]" align="center" >
	                                <td>'.$i.'</td>
	                                <td>'.ucwords($row->name).'</td>
	                                <td>'.$row->relationship.'</td>
	                                <td>'.date('d M Y', strtotime($row->dob)).'<br>(Age: '.floor((time() - strtotime($row->dob))/(365*24*60*60)).' years)</td>
	                                <td>'.ucwords($row->profession).'</td>
	                                <td>'.$row->present_post_addr.'</td>
	                                <td><b><font color="'.$color.'">'.$row->active_inactive.'</font></b></td>
	                                <td><img src="'.base_url().'assets/images/'.$row->photopath.'" height="150"/></td>
	                    			<td>';
	                                    $ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.',\''.$row->dob.'\',\''.$row->photopath.'\')"')->show();
	                        echo   '</td></tr>';
	                        $i++;
	                    }
	                    echo'</tbody>';
	                $table->close();
	            }
	            else
	            	$ui->callout()->title('Empty')->desc('No Family Detailss Found.')->uiType('danger')->show();
            $box->close();
        $col->close();
    $upRow->close();

$form = $ui->form()->id('emp_fam_details')->multipart()->action('employee/edit/update_prev_emp_details/'.$emp_id)->open();
    $row = $ui->row()->open();
        $col = $ui->col()->width(12)->open();
            $box = $ui->box()->uiType('primary')->title('Add Dependent Family Members Details')->tooltip("Click Add after entering following details")->open();
                $row11 = $ui->row()->open();
                    $ui->input()->name('name3')->label('Name')->placeholder('Enter Full Name')->width(6)->show();
                    $ui->select()->name('relationship3')->label('Relationship')->width(3)
                    ->options(array($ui->option()->value("")->text("Choose One")->disabled()->selected(),
                                    $ui->option()->value("Father")->text("Father"),
                                    $ui->option()->value("Mother")->text("Mother"),
                                    $ui->option()->value("Spouse")->text("Spouse"),
                                    $ui->option()->value("Son")->text("Son"),
                                    $ui->option()->value("Daughter")->text("Daughter")))->show();
                    $ui->datePicker()->name('dob3')
                                    ->dateFormat('dd-mm-yyyy')
                                    ->addonRight($ui->icon("calendar"))
                                    ->placeholder("dd-mm-yyyy")
                                    ->label('DOB')->width(3)->show();
                $row11->close();
                $row12 = $ui->row()->open();
                    $ui->input()->name("profession3")->placeholder("Enter Profession")->label('Profession')->width(4)->t_width(5)->show();
                    $ui->input()->name('active3')->label('Active/Inactive')->value('Active')
                    ->addonRight($ui->button()->icon($ui->icon('check')->id('icon'))->id('status_toggle')->uiType('success'))
                    ->extras('readonly')->width(3)->t_width(3)->show();
                $row12->close();
                $row13 = $ui->row()->open();
                    $ui->input()->name("addr3")->placeholder('Enter Present Postal Address')->label('Present Postal Address')->width(12)->t_width(12)->show();
                $row13->close();
                $row14 = $ui->row()->open();
                    $ui->imagePicker()->width(12)->label("Photograph")->required()->id('photo3')->name('photo3')->show();
                $row14->close();
            $box->close();
        $col->close();
    $row->close();
    $ui->button()->classes('pull-right')->submit()->id('add_btn')->name('submit')->value("Add")->large()->uiType('primary')->icon($ui->icon("plus"))->show();
    $ui->button()->value('Back')->id('back_btn')->name('back')->large()->uiType('primary')->icon($ui->icon("arrow-left"))->show();
    echo "<br />";
$form->close();
?>