<p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
<?php  echo form_open_multipart('student/student_add/insert_education_details','onSubmit="return onclick_submit();"');   ?>
<table>
	<tr>
		<th>Student Id</th>
		<td name="student_id"><?php echo $stu_id?></td>
	</tr>
</table>

<h1>Step 2 :Please fill up the Educational Qualificatoins</h1>
<table id="tableid">
     <tr>
     <th>S no.</th>
     <th>Examination</th>
     <th>Branch/Specialization</th>
   	 <th>School/College/University/Institute</th>
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
<input type="button" name="add" value="Add More" onClick="onclick_add();"/>
<br>
<input type="submit" name="submit4" value="Next" />
<br>
<br>