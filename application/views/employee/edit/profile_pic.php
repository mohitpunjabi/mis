<?php $ui = new UI();

$form = $ui->form()->multipart()->action('employee/edit/update_profile_pic/'.$emp_id)->open();
$row = $ui->row()->open();
    $col = $ui->col()->width(6)->open();
        $profile_box = $ui->box()->uiType('primary')->solid()->title('Change Profile Picture')->open();

                echo '<center><div class="form-group"  >
                        <label class="control-label"  for="view_photo"  >Profile Picture</label><div class="input-group">';
                if($photopath == FALSE || $photopath == "")
                    echo '<img src="'.base_url().'assets/images/employee/noProfileImage.png" id="view_photo" width="145" height="150"/>';
                else
                    echo '<img id="view_photo" src="'.base_url().'assets/images/'.$photopath.'"  height="150" />';
                echo '</div></div></center>';

            $row2 = $ui->row()->open();
                $ui->imagePicker()->width(12)->label("Select New Picture<span style= \"color:red;\"> *</span>")->required()->id('photo')->name('photo')->show();
            $row2->close();

            echo '<a href="'.site_url('employee/edit').'">';
            $ui->button()->value("Back")->large()->uiType('primary')->icon($ui->icon("arrow-left"))->show();
            echo '</a>';
            $ui->button()->submit()->classes("pull-right")->value('Save')->name('submit')->large()->uiType('primary')->icon($ui->icon("floppy-o"))->show();
            echo "<br />";
        $profile_box->close();
    $col->close();
$row->close();
$form->close();