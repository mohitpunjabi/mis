    <p><?php echo $error; ?></p>
    <table>
    	<tr>
            <th>Employee Id</th>
            <td><?= $add_emp_id ?></td>
        </tr>
    </table>

    <h1>Step 3 :Please fill up the details of the dependent family members</h1>
	<?= form_open_multipart('employee/add/insert_family_details/'.$add_emp_id,'onSubmit="return onclick_submit();"'); ?>
    <table id="tableid">
        <tr>
            <th align="center">S no.</th>
            <th>Name</th>
            <th>Relationship</th>
            <th>Date of Birth</th>
            <th>Profession</th>
            <th>Present Postal Address</th>
            <th>Active/Inactive</th>
            <th colspan="2">Photograph</th>
        </tr>
            <tr id="addrow">
            <td align="center" id="sno">1</td>
            <td align="center"><input type="text" name="name3[]"/></td>
            <td align="center">
            <select name="relationship3[]" >
                <option value="" disabled="disabled" selected="selected">Choose One</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Spouse">Spouse</option>
                <option value="Son">Son</option>
                <option value="Daughter">Daughter</option>
            </select>
        </td>
        <td>
            <input type="date" name="dob3[]" max="<?php echo date("Y-m-d",time());?>" >
        </td>
        <td align="center"><input type="text" name="profession3[]"/></td>
        <td align="center"><textarea rows=4 cols=25 name="addr3[]"></textarea></td>
        <td align="center">
            <input type="text" name="active3[]" value="Active" style="background:#DFD" onClick="change_act(this)" readonly  />
        </td>
        <td align="center">
            <input type="file" name="photo3[]" ><br>
            <input type="button" value="preview" name="preview3[]" onClick="preview_pic(this);"><br>
        </td>
        <td><img src="<?= base_url() ?>assets/images/employee/noProfileImage.png" name="view_photo3[]" width="145" height="150"/></td>
        </tr>
    </table>
    <input type="button" name="add" value="Add More" onClick="onclick_add();"/>
    <br>
    <input type="submit" name="submit3" value="Next" />
    <?php echo form_close(); ?>