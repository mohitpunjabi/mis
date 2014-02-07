<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	auth("deo");
	require_once("connectDB.php");
	drawHeader("Edit Employee");

	echo '<h1 class="page-head">Please select Employee Id and Form to Edit Employee Details</h1>'; 	
	if(isset($_POST['submit']))
	{
		$_SESSION['EDIT_EMP']=$empId = $_POST['emp_id'];
		$form_name = $_POST['form_name'];
		if($form_name==0){
			header('Location: edit_profile_pic.php?emp_id='.$empId);
		}
		else if($form_name==1){
			header('Location: edit_basic_detail.php?emp_id='.$empId);
		}
		else if($form_name==2){
			header('Location: edit_prev_emp_detail.php?emp_id='.$empId);
		}
		else if($form_name==3){
			header('Location: edit_dependent_family_member.php?emp_id='.$empId);
		}
		else if($form_name==4){
			header('Location: edit_educational_details.php?emp_id='.$empId);
		}
		else if($form_name==5){
			header('Location: edit_stay_detail.php?emp_id='.$empId);
		}
	}
	
?>
<script type="text/javascript">
	
	function onclick_emp_id()
	{
		document.getElementById('search_eid').style.display="table-row";
	}
	
	function onclick_empname()
	{
		var tr=document.getElementById('employee');
		var dept=document.getElementById('emp_dept').value;
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
		xmlhttp.open("GET","AJAX_emp_name_by_dept.php?dept="+dept,true);
		xmlhttp.send();
		tr.innerHTML = "<th>Employee name</th><td><i class=\"loading\"></i></td>";
	}
	
	function onclick_emp_nameid()
	{
		var emp_name_id=document.getElementById('emp_name_id').value;
		document.getElementById('emp_id').value=emp_name_id;
	}
</script>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	<table align="center" >
    	<tr><th>Employee Id</th>
        	<td>
                <select name="emp_id" id="emp_id">
                <?php
                    $emp_detail=mysql_query("select id from emp_basic_details");
                    while($row=mysql_fetch_row($emp_detail))
                    {
                        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                    }
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
        	            $emp_dept=mysql_query("select id,name from departments");
                	    while($row=mysql_fetch_row($emp_dept))
            	        {
                    	    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
	                    }
	                ?>
	                </select>
	           </td>
	   	 </tr>
        
		<tr id="employee"></tr>

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
</form>
<?php
	mysql_close();
	drawFooter();
?>
