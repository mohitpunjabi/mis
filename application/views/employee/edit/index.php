<h1 class="page-head">Please select Employee Id and Form to Edit Employee Details</h1>
<?php  echo form_open('employee/edit/edit_form');   ?>
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

        <tr><th>Select Form</th>
        	<td><select name="form_name">
        	<?php
				echo '<option value="0">Change profile picture</option>';
				echo '<option value="1">Basic Details</option>';
				echo '<option value="2">Previous Employment Details</option>';
				echo '<option value="3">Dependent Family Member Details</option>';
				echo '<option value="4">Educational Details</option>';
				echo '<option value="5">Last 5 Year Stay Details</option>';
			?>
            </select></td>
        </tr>
    </table>
    <center><input type="submit" name="submit"/></center>
<?php echo form_close(); ?>