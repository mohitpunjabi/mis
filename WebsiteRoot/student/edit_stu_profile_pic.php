<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	auth('deo');
	drawHeader("Change Student Profile Picture");
	
	if(isset($_GET['error']))
	{
		drawNotification($_GET['error'],"", "error");
	}
	
	if(isset($_SESSION['EDIT_STU']))
		$stu_id = $_SESSION['EDIT_STU'];
	else
	{
		drawNotification("Student Admission No. not selected", "<a href='edit_student.php'>Click here</a> to select Student Admission Number.", "error");
		die();
	}
	
	//extracting photograph from database
	$stu_detail=mysql_query("select photopath 
							from user_details
							where id='".$stu_id."'");
	$row=mysql_fetch_assoc($stu_detail);
	$STU_PIC=$row['photopath'];
	
	
?>


<script type="text/javascript">
	function preview_pic()
	{
		var file=document.getElementById('photo').files[0];
		if(!file)
			alert("!! Select a file first !!");
      	else
		{
			oFReader = new FileReader();
        	oFReader.onload = function(oFREvent)
			{
				var dataURI = oFREvent.target.result;
				document.getElementById('view_photo').src = dataURI;
			};
			oFReader.readAsDataURL(file);
		}
	}
</script>
<center>
<h1>Change Sudent Profile picture</h1><hr/>
<form method = "post" action="updateSQL0.php" enctype="multipart/form-data">
<table>

   <tr>
   <th>Student Admission No : </th>
   <th><?php echo $stu_id ?></th>	
   <th colspan="">Change Profile Picture</th>
   </tr><tr/>
        <tr>
        	<td id="preview" colspan="2" align="center"><?php echo '<br><img src="Images/'.$stu_id.'/'.$STU_PIC.'" id="view_photo" width="145" height="150"/>'; ?></td>
        	<td align="center" >Click on choose file to select other picture<br>
            	<input type="file" name="photo" id="photo" />
                <br><input type="button" value="preview" onClick="preview_pic();">
            </td>
		</tr>
</table>
<br/><input type = "submit" name="submit" value="Save"/>
<?php
	echo '<a href="edit_student.php" style=""><input type="button" Value="Back" /></a>';
	
?>
<br/>
<input type="text" id="student_id" name="student_id" style="visibility:hidden;" value="<?php echo $stu_id; ?>" />
</form>
</center>
<?php 

drawFooter(); ?>

