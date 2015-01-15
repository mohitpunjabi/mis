<p><?php if($error!="")  $this->notification->drawNotification('',$error,'error'); ?></p>
<?php  echo form_open_multipart('student/add/insert_basic_details');   ?>

<?php
	/*echo '<table>
				<tr>
					<th>Student Id</th>
					<td>'.$_SESSION['ADD_STU_ID'].'</td>
				</tr></table>' ;*/
?>
<div id="print" >
<h1>Step 2 :Please fill up the Educational Qualificatoins</h1>
<table id="tableid">
     <tr>
     <th>S no.</th>
     <th>Examination</th>
     <th>Branch/Specialization</th>
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
<input type="button" name="add" value="Add More" onClick="onclick_add();"/>
<br>
<input type="submit" name="submit4" value="Next" />
</div>
<br>
<br>
<center><button onclick="printContent('print')" >PRINT</button></center>