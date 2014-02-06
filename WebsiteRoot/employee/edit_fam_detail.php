<?php
	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$e=$_GET['e'];
	$fam_detail=mysql_query("select * 
							from emp_family_details 
							where id='".$emp."' and sno=".$e);

	if(mysql_num_rows($fam_detail)!=0)
	{
		$row=mysql_fetch_row($fam_detail);
		if($row[8]=="Active")
			$style="background:#DFD";
		else
			$style="background:#FDD";
		echo '
					<td>'.$e.'</td>
			    	<td>'.$row[2].'</td>
			    	<td>'.$row[3].'</td>
					<td><input type="date" id="dob'.$e.'" name="dob'.$e.'" value="'.$row[7].'" /></td>
			    	<td><input type="text" id="profession'.$e.'" name="profession'.$e.'" value="'.$row[4].'" /></td>
			    	<td><textarea rows=4 cols=25 id="address'.$e.'" name="address'.$e.'" >'.$row[5].'</textarea></td>
					<td><input type="text" id="active'.$e.'" name="active'.$e.'" style="'.$style.'" value="'.$row[8].'" onClick="change_act(this)" readonly /></td>
			    	<td><img src="Images/'.$emp.'/'.$row[6].'" name="image3[]" width="145" height="150"/></td>
					<td>
						<input type="button" name="save" value="Save" onClick="onclick_save('.$e.')"><br>
					</td>
				';
	}
	mysql_close();
?>