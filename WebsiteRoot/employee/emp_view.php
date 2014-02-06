<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	auth("deo");
	drawHeader("View Employee");
?>
<h1 class="page-head">Select Employee Id to view other employee details</h1> 	
<script type="text/javascript">
	
	function onclick_emp_id()
	{
		document.getElementById('search_eid').style.visibility="visible";
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
<form method="get" action="show_emp.php">
	<table align="center" >
    	<tr><th>Employee Id</th>
        	<td><select name="emp_id"  id="emp_id" >
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


		<tr id="search_eid" style="visibility: hidden">
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


    </table>
    <center><input type="submit" name="submit"/></center>
</form>
<br><br><br><br>
<?php
	mysql_close();
	drawFooter();
?>