<?php 

require("connect.php");
$num=$_GET['q'];

$select=mysql_query("SELECT first_name,last_name,middle_name,id from user_details where dept_id='CSE'") or die(mysql_error());

echo "<table> <tr><td width=200>*EMPLOYEE NAME : </td>";
echo "<td><select name='name' id='menu'>";

while($row=mysql_fetch_assoc($select))
{
$first=$row['first_name'];
$middle=$row['middle_name'];
$last=$row['last_name'];
$emp_id=$row['id'];

echo "	 
	  	<option>$first $middle $last($emp_id)</option>";
}       
   echo " </select> </td></tr></div>";


?>