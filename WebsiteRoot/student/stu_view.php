<?php
	require_once('../Includes/SessionAuth.php');
	require_once("../Includes/FeedbackLayout.php");
	require_once("connectDB.php");
	drawHeader("View Student");
	if($_SESSION['SESS_AUTH']!="DO")
	{
		header("location: ../Includes/SessionAuthFail.php");
		exit();
	}
?>
<h1 class="page-head">Select Student Admission Number to view other Student details</h1> 	
<script type="text/javascript">
	
	function onclick_stu_id()
	{
		document.getElementById('search_sid').style.visibility="visible";
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
<form method="get" action="show_student.php">
	<table align="center" >
    	<tr><th>Student Admission Number</th>
        	<td><select name="stu_id"  id="stu_id" >
        	<?php
				$stu_detail=mysql_query("select admn_no from stu_details");
				while($row=mysql_fetch_row($stu_detail))
				{
					echo '<option value="'.$row[0].'">'.$row[0].'</option>';
				}
			?>
            </select>
        	<a onClick="onclick_stu_id();" >Don't remember Student Id</a>
            </td>
        </tr>


		<tr id="search_sid" style="visibility: hidden">
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


    </table>
    <center><input type="submit" name="submit"/></center>
</form>
<br><br><br><br>
<?php
	mysql_close();
	drawFooter();
?>