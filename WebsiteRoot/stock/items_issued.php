<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	auth('hod');
	drawHeader("Items Issued");

	drawNotification("Please select Employee", ""); 
?>
<br>
<?php
	$qry=mysql_query("select id,first_name,last_name from user_details where dept_id='cse'");
?>
<form method="post" action="issue_ch.php">
	<table align="center" >
    	<tr><th>Employee Name</th>
        	<td>
				<select name="emp_id" >
					<?php
						if(mysql_num_rows($qry)!=0)
							while($row=mysql_fetch_row($qry))
								echo "<option value='".$row[0]."'>".$row[1]." ".$row[2]." (".$row[0].")</option>";
						else
							echo "<option disabled=true value='none'>none</option>";
					?>
				</select>
			</td>
        </tr>
    </table>
    <center><input type="submit" name="submit"/></center>
</form>
<br><br>
<center><a href="self_items.php" >Click Here</a> for Items issued to you
<br>
<a href="everyone_item.php" >Click Here</a> for Items issued to everyone
</center>
<?php
	drawFooter();
	mysql_close();
?>

