<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	drawHeader("Edit Student");

	drawNotification("Please select Student Admission Number and Form to edit", "");

	if(isset($_POST['submit']))
	{
		 $stuId = $_POST['stu_id'];
		$_SESSION['EDIT_STU']=$stuId;
		
		$form_name = $_POST['form_name'];
		if($form_name==0){
			header('Location: edit_stu_profile_pic.php');
		}
		else if($form_name==1){
			header('Location: edit_student_basic_details.php');
		}
		else if($form_name==2){
			header('Location: edit_student_admission_details.php');
		}
		else if($form_name==3){
			header('Location: edit_stu_admn_fee_detail.php');
		}
		
		
	}
	
?>
<script type="text/javascript">
	
	function onclick_stu_id()
	{
		document.getElementById('search_sid').style.display="table-row";
	}
	
	function onclick_stuname()
	{
		var tr=document.getElementById('student');
		var dept=document.getElementById('stu_dept').value;
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		 	xmlhttp=new XMLHttpRequest();
		}
		else
	  	{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
	  	{
	  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
			    tr.innerHTML=xmlhttp.responseText;
		    }
	  	}
		xmlhttp.open("GET","AJAX_stu_name_by_dept.php?dept="+dept,true);
		xmlhttp.send();
		tr.innerHTML = "<th>Student name</th><td><i class=\"loading\"></i></td>";
	}
	
	function onclick_stu_nameid()
	{
		var stu_name_id=document.getElementById('stu_name_id').value;
		document.getElementById('stu_id').value=stu_name_id;
	}
</script>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	<table align="center" >
    	<tr><th>Student Admission Number</th>
        	<td><input type="text" name="stu_id"  id="stu_id" />
        	<a onClick="onclick_stu_id();" >Don't remember Student Id</a>
            </td>
        </tr>


		<tr id="search_sid" style="display:none;">
	    	<th>Department</th>
				<td>
                <select id="stu_dept" onchange="onclick_stuname();">
                	<option disabled="disabled" selected="selected">Select Student Department</option>
                <?php
                    $stu_dept=mysql_query("select id,name from departments where type='academic'");
                    while($row=mysql_fetch_row($stu_dept))
                    {
                        echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                    }
                ?>
                </select>
        	    </td>
	    </tr>
		<tr id="student"></tr>
		
		<tr><th>Select Form</th>
        	<td><select name="form_name">
        	<?php
				echo '<option value="0">Change profile picture</option>';
				echo '<option value="1">Basic Details</option>';
				//echo '<option value="2">Admission/Fee Details</option>';
				//echo '<option value="3">Academic Details</option>';
				
			?>	
            </select></td>
        </tr>
 
    </table><center><input type="submit" name="submit"/></center>
</form>
<?php
	mysql_close();
	drawFooter();
?>
