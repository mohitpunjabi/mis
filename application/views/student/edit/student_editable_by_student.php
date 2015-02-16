<?php  //echo form_open_multipart('student/student_editable_by_student/update_my_details','onSubmit="return form_validation();"');?>
<!--table width='90%'>
	<tr>
        <td>Email</td>
        <td><input type="email" name="email" required="required" value="<?php //echo $user_detail->email;?>"></td>
        <td>Alternate Email</td>
        <td><input type="email" name="alternate_email_id" id="alternate_email_id" value="<?php //echo $stu_detail->alternate_email_id?>"></td>
            
    </tr>
    <tr>
        <td>Mobile No</td>
        <td><input type="text" name="mobile" id="mobile" required="required" value="<?php //echo $user_other_detail->mobile_no;?>"></td>
        <td>Alternate Mobile No</td>
        <td><input type="text" name="alternate_mobile" id="alternate_mobile" value="<?php //echo $stu_detail->alternate_mobile_no;?>"></td>
    </tr>
    <tr>
        <td>Hobbies</td>
        <td><input type="text" name="hobbies" id="hobbies" value="<?php //echo $user_other_detail->hobbies;?>"></td>
        <td>Favourite Pass Time</td>
        <td><input type="text" name="favpast" id="favpast" value="<?php //echo $user_other_detail->fav_past_time;?>"></td>
    </tr>
    <tr>
        <td>
            Extra-Curricular Activities ( if any):      </td>
        <td>
            <input type="text" name="extra_activity" id="extra_activity" value="<?php //echo $stu_other_detail->extra_curricular_activity;?>"/>     </td>
        <td>
            Any other relevant information      </td>
        <td>
            <input type="text" name="any_other_information" id="any_other_information" value="<?php //echo $stu_other_detail->other_relevant_info;?>"/>      </td>
    </tr>
</table>
<center><input type = "submit" value="Update"/></center>
<?php //echo form_close(); ?>
<center><a href= <?= site_url()?> ><button>Back</button></a></center-->

<?php

    $ui = new UI();

        $form=$ui->form()
                 ->action('student/student_editable_by_student/update_my_details')
                 ->multipart()
                 ->id('form_submit')
                 ->open();


            $studenteditable_details = $ui->row()
                                  ->open();

                 $student_editable_details_box = $ui->box()
                                                  ->uiType('primary')
                                                  ->solid()
                                                  ->title('Editable Details')
                                                  ->open();

                    $editable_details_row_1 = $ui->row()
                                                 ->open();

                        $ui->input()
                           ->label('Email')
                           ->name('email')
                           ->type('email')
                           ->required()
                           ->value($user_detail->email)
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Alternate Email')
                           ->name('alternate_email_id')
                           ->id('alternate_email_id')
                           ->type('email')
                           ->value($stu_detail->alternate_email_id)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Mobile No.')
                           ->name('mobile')
                           ->id('mobile')
                           ->required()
                           ->value($user_other_detail->mobile_no)
                           ->required()
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Alternate Mobile No.')
                           ->name('alternate_mobile')
                           ->id('alternate_mobile')
                           ->value($stu_detail->alternate_mobile_no)
                           ->width(3)
                           ->show();


                    $editable_details_row_1 ->close();

                    $editable_details_row_2 = $ui->row()
                                                 ->open();

                        $ui->input()
                           ->label('Hobbies')
                           ->name('hobbies')
                           ->width(3)
                           ->id('hobbies')
                           ->value($user_other_detail->hobbies)
                           ->show();

                        $ui->input()
                           ->label('Favourite Pass Time')
                           ->name('favpast')
                           ->id('favpast')
                           ->value($user_other_detail->fav_past_time)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Extra-Curricular Activities ( if any):')
                           ->name('extra_activity')
                           ->id('extra_activity')
                           ->value($stu_other_detail->extra_curricular_activity)
                           ->width(3)
                           ->show();

                        $ui->input()
                           ->label('Any other relevant information')
                           ->name('any_other_information')
                           ->id('any_other_information')
                           ->value($stu_other_detail->other_relevant_info)
                           ->width(3)
                           ->show();


                    $editable_details_row_2 ->close();

                    $editable_details_row_3 = $ui->row()
                                                 ->open();

                        $editable_col_3_1 = $ui->col()
                                                ->width(5)
                                                ->open();
                        $editable_col_3_1->close();

                        $ui->input()
                           ->type('submit')
                           ->value('Update')
                           ->width(2)
                           ->show();

                    $editable_details_row_3 ->close();

                    $editable_details_row_4 = $ui->row()
                                                 ->open();

                        $editable_col_4_1 = $ui->col()
                                                ->width(11)
                                                ->open();

                        $editable_col_4_1->close();?>

                        <a href= <?= site_url()?> ><?php

                        $ui->button()
                           ->value('Back')
                           ->width(1)
                           ->show();?></a><?php

                    $editable_details_row_4 ->close();

                $student_editable_details_box->close();

            $studenteditable_details->close();

        $form->close();

?>