<?php  echo form_open_multipart('student/student_edit/update_education_details/'.$stu_id,'onSubmit="return education_validation();"');   ?>
<table>
	<tr>
		<th>Student Id</th>
		<td><?= $stu_id?></td>
		<td><?php echo $stu_type->auth_id;?></td>
		<input type="hidden" id="student_type" value="<?php echo $stu_type->auth_id;?>"/>
	</tr>
</table>
<h1>Educational Qualifications</h1>
<table align="center" id="tableid">
<?php
	if($stu_education_details != FALSE)
	{
		echo '<tr>
				 <th>S no.</th>
				 <th>Examination</th>
				 <th>Course(Specialization)</th>
				 <th>College/University/Institute</th>
				 <th>Year</th>
				 <th>Percentage/Grade</th>
				 <th>Class/Division</th>
			  </tr>';
		$i=1;
		foreach($stu_education_details as $row)
		{
			echo '<tr name="row[]" id="addrow" align="center">
					<td>'.$i.'</td>
					<td><input type="text" value="'.strtoupper($row->exam).'" name="exam4[]" /></td>
			    	<td><input type="text" value="'.strtoupper($row->branch).'" disabled name="branch4[]" /></td>
			    	<td><input type="text" value="'.strtoupper($row->institute).'" name="clgname4[]"/></td>
			    	<td><select name="year4[]">';
	                    $year = 1926;
	                    $last_year = date('Y');
	                	while($year <= $last_year)
	                	{
	                		if($row->year == $year)
		                    	echo '<option value="'.$year.'" selected>'.$year.'</option>';
		                    else
		                    	echo '<option value="'.$year.'">'.$year.'</option>';
	                    	$year++;
	                	}
	                echo'</select></td>
			    	<td><input type="text" value="'.strtoupper($row->grade).'" name="grade4[]"/></td>';?>
			    	<td><select name="div4[]">
		                <option value="first" <?php if($row->division=="first") echo "selected";?>>FIRST</option>
		                <option value="second" <?php if($row->division=="second") echo "selected";?>>SECOND</option>
		                <option value="third" <?php if($row->division=="third") echo "selected";?>>THIRD</option>
		                <option value="na" <?php if($row->division=="na") echo "selected";?>>NA</option>
		            </select></td>
			    <?php echo '</tr>';
			$i++;
		}
	}
	else
		$this->notification->drawNotification("Empty","No educational qualifications found.","error");
?>
</table>
<center><input type="button" name="add" id="add" value="Add More" onClick="onclick_add();"/></center>
<!--br>
<div id='addnew' style="display: none">
<h1>Add here</h1>
<?php//  echo form_open('student/student_edit/update_education_details/'.$stu_id,'onSubmit="return onclick_submit();"');   ?>
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
	        <td><input type="text" name="exam4[]"/></td>
            <td><input type="text" name="branch4[]"/></td>
            <td><input type="text" name="clgname4[]"/></td>
            <td><input type="text" name="year4[]" /></td>
            <td><input type="text" name="grade4[]" /></td>
            <td><input type="text" name="div4[]"/></td>
    </tr>
</table>
<input type="button" name="add" value="Add More" onClick="onclick_add();" >
<br-->
<center>
<input type="submit" name="submit4" value="Save" >
</center>
<?php echo form_close(); ?>
<!--/div-->
<center>
<a href= <?= site_url('student/student_edit')?> ><button>Back</button></a></center>