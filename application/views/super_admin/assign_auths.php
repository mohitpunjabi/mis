	<br><h1 class="page-head" align = 'center'><?= $page_head_title ?></h1><br>
	<?php  echo form_open('super_admin/admin/insert_auths');   ?>
    <table align="center" >
        <tr><th>Employee Id</th>
            <td>
                <select name="emp_id" id="emp_id">
                <?php
                    if($employees)
                    {
                        foreach($employees as $row)
                            echo '<option value="'.$row->id.'">'.$row->id.'</option>';
                    }
                    else
                        echo '<option value="" disabled >No employees</option>';
                ?>
                </select>
                <a onClick="onclick_emp_id();" >Don't remember Employee Id</a>
            </td>
        </tr>
        <tr id="search_eid" style="display:none">
                <th>Department</th>
                <td>
                    <select id="emp_dept" onchange="onclick_empname();">
                        <option disabled="disabled" selected="selected">Select Employee Department</option>
                   <?php
                        if($departments)
                        {
                            foreach($departments as $row)
                            {
                               echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                            }
                        }
                        else
                            echo '<option value="" disabled >No departments</option>';
                    ?>
                    </select>
                </td>
        </tr>

        <tr id="employee" style="display: none">
            <th>Employee name</th>
            <td>
                <select id="employee_select" onchange="onclick_emp_nameid();" >
                    <option value="" disabled="disabled">No Employee found</option>'
                </select>
            </td>
        </tr>

        <tr><th>Select Auth</th>
            <td><select name="auth">
            <?php
                foreach($auths as $auth)
                {
                    echo '<option value="'.$auth->id.'">'.ucwords($auth->type).'</option>';
                }
            ?>
            </select></td>
        </tr>
    </table>
    <center><input type="submit" name="submit"/></center>
<?php echo form_close(); ?>