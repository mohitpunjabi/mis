<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$sno=$_GET['s'];
	$exam=$_GET['e'];
	$branch=$_GET['b'];
	$clgname=$_GET['c'];
	$year=$_GET['y'];
	$grade=$_GET['g'];
	$div=$_GET['d'];
	
	$updateedu_detail=mysql_query("update emp_education_details 
									set 
									exam='".clean(strtolower($exam))."',
									branch='".clean(strtolower($branch))."',
									institute='".clean(strtolower($clgname))."' ,
									year='".clean(strtolower($year))."' ,
									grade='".clean(strtolower($grade))."' ,
									division='".clean(strtolower($div))."' 
									where id='".$emp."' and sno=".$sno);

	if($updateedu_detail)
		notify($emp, "Details Edited", "Your educational details have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=3","success");
	
	$edu_detail=mysql_query("select * 
							from emp_education_details 
							where id='".$emp."' and  sno=".$sno);
							
	if(mysql_num_rows($edu_detail)!=0)
	{
		$row=mysql_fetch_row($edu_detail);
			echo '	<td>'.$sno.'</td>
			    	<td>'.strtoupper($row[2]).'</td>
			    	<td>'.strtoupper($row[3]).'</td>
			    	<td>'.strtoupper($row[4]).'</td>
			    	<td>'.$row[5].'</td>
			    	<td>'.strtoupper($row[6]).'</td>
			    	<td>'.ucwords($row[7]).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$sno.')">
						<input type="button" class="error" name="delete4[]" value="Delete" onClick="onclick_delete('.$sno.');" >
					</td>';
	}
	mysql_close();
?>