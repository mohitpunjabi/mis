	<br><h1 class="page-head" align = 'center'><?= $page_head_title ?></h1><br>
    <table align="center" >
        <tr><th>Select Authorization</th>
            <td>
                <select name="auth_id" id="auth_id" name="auth_id" onchange="onchange_auth();">
                <?php
                    foreach($auths as $auth)
                    {
                        echo '<option value="'.$auth->id.'">'.ucwords($auth->type).'</option>';
                    }
                ?>
                </select>
            </td>
        </tr>
        <th>Department</th>
            <td>
                <select name="dept_id" id="dept_id" onchange="onchange_auth();">
                <option value="all" selected="selected">Select User Department</option>
                <?php
                    if($departments)
                    {
                        foreach($departments as $row)
                        {
                           echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }
                    }
                    else
                        echo '<option value="none" disabled >No departments</option>';
                ?>
                </select>
            </td>
        </tr>
    </table>
<br>
<div id ="view_users"></div>