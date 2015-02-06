<?php  echo form_open_multipart('student/student_editable_by_student/update_my_details','onSubmit="return form_validation();"');?>
<table width='90%'>
	<tr>
        <td>Email</td>
        <td><input type="email" name="email" required="required" value="<?php echo $user_detail->email;?>"></td>
        <td>Alternate Email</td>
        <td><input type="email" name="alternate_email_id" id="alternate_email_id" value="<?php echo $stu_detail->alternate_email_id?>"></td>
            
    </tr>
    <tr>
        <td>Mobile No</td>
        <td><input type="text" name="mobile" id="mobile" required="required" value="<?php echo $user_other_detail->mobile_no;?>"></td>
        <td>Alternate Mobile No</td>
        <td><input type="text" name="alternate_mobile" id="alternate_mobile" value="<?php echo $stu_detail->alternate_mobile_no;?>"></td>
    </tr>
    <tr>
        <td>Hobbies</td>
        <td><input type="text" name="hobbies" id="hobbies" value="<?php echo $user_other_detail->hobbies;?>"></td>
        <td>Favourite Pass Time</td>
        <td><input type="text" name="favpast" id="favpast" value="<?php echo $user_other_detail->fav_past_time;?>"></td>
    </tr>
    <tr>
        <td>
            Extra-Curricular Activities ( if any):      </td>
        <td>
            <input type="text" name="extra_activity" id="extra_activity" value="<?php echo $stu_other_detail->extra_curricular_activity;?>"/>     </td>
        <td>
            Any other relevant information      </td>
        <td>
            <input type="text" name="any_other_information" id="any_other_information" value="<?php echo $stu_other_detail->other_relevant_info;?>"/>      </td>
    </tr>
</table>
<center><input type = "submit" value="Update"/></center>
<?php echo form_close(); ?>
<center><a href= <?= site_url()?> ><button>Back</button></a></center>