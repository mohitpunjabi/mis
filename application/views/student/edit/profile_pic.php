<h1>Change Student picture</h1>
<?php  echo form_open_multipart('student/student_edit/update_profile_pic/'.$stu_id);   ?>
<table>
    <tr>
        <th>Student Id</th>
        <td colspan="2">
                <input type="text" name="stu_id" id="stu_id" readonly value=<?php echo $stu_id;?>  >
        </td>
    </tr>
    <tr><th>Photograph</th>
        <td id="preview"><br>
        <?php
            if($photopath == FALSE || $photopath == "")
                echo '<img src="'.base_url().'assets/images/student/noProfileImage.png" id="view_photo" width="145" height="150"/>';
            else
                echo '<img src="'.base_url().'assets/images/'.$photopath.'" id="view_photo" width="145" height="150"/>';
        ?>
        </td>
        <td align="center">Click on choose file to select other picture<br>
            <input type="file" name="photo" id="photo" />
            <br>
            <input type="button" value="preview" onClick="preview_pic();">
        </td>
    </tr>
</table>
<input type = "submit" name="submit" value="Save"/>
<?= form_close() ?>
<a href= <?= site_url('student/student_edit')?> ><button>Back</button></a>