 <table>
	<tr>
		<th>Employee Id</th>
		<td><?= $emp_id?></td>
	</tr>
</table>
<h1>Educational Qualifications</h1>
<?php
	if($emp_education_details != FALSE)
	{
		echo '<table id="tbl4">
				<tr>
					 <th>S no.</th>
				     <th>Examination</th>
				     <th>Course(Specialization)</th>
				   	 <th>College/University/Institute</th>
				     <th>Year</th>
				     <th>Percentage/Grade</th>
				     <th>Class/Division</th>
					 <th>Edit/Delete</th>
				</tr>';
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
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.')" />
						<input type="button" class="error" name="delete4[]" value="Delete" onClick="onclick_delete('.$i.');" />
					</td>
			    </tr>';
			$i++;
		}
		echo '</table>';
	}
	else
		$this->notification->drawNotification("Empty","No educational qualifications found.","error");
?>

<input type="button" id='add_new' name="add_new" value="Add" onClick="onclick_add_new();"/><br>
<div id='addnew' style="display: none">
<h1>Add here</h1>
<?php  echo form_open('employee/edit/update_education_details/'.$emp_id,'onSubmit="return onclick_submit();"');   ?>
	<table id="tableid">
     <tr>
		 <th>S no.</th>
	     <th>Examination</th>
	     <th>Course(Specialization)</th>
	   	 <th>College/University/Institute</th>
	     <th>Year</th>
	     <th>Percentage/Grade</th>
	     <th>Class/Division</th>
    </tr>
	<tr id="addrow">
  	    	<td id="sno">1</td>
	        <td><select name="exam4[]" onChange="examination_handler(this);" >
            		<option disabled selected value="" >Select Examination</option>
            		<option value="non-matric">Non-Matric</option>
                    <option value="matric">Matric</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="graduation">Graduation</option>
                    <option value="post-graduation">Post Graduation</option>
                    <option value="doctorate">Doctorate</option>
                    <option value="post-doctorate">Post Doctorate</option>
                    <option value="others">Others</option>
                </select></td>
            <td><input type="text" name="branch4[]"/></td>
            <td><input type="text" name="clgname4[]"/></td>
            <td><input type="text" name="year4[]" /></td>
            <td><input type="text" name="grade4[]" /></td>
            <td><input type="text" name="div4[]"/></td>
    </tr>
</table>
<input type="button" name="add" value="Add More" onClick="onclick_add();" >
<br>
<input type="submit" name="submit4" value="Save" >
<?php echo form_close(); ?>
</div>
<a href= <?= site_url('employee/edit')?> ><button>Back</button></a>