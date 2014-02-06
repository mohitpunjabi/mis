<?php
	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$e=$_GET['e'];
	$stay_detail=mysql_query("select * 
							from emp_last5yrstay_details 
							where id='".$emp."' and sno=".$e);
							
	$date=date("Y-m-d", time()+(19800));
	$newdate = strtotime ( '-5 year' , strtotime ( $date ) ) ;
								
	if(mysql_num_rows($stay_detail)!=0)
	{
		$row=mysql_fetch_row($stay_detail);
	
			echo '	<td>'.$e.'</td>
	    			<td><input type="date" name="from'.$e.'" id="from'.$e.'" value="'.$row[2].'" max='.date("Y-m-d", time()+(19800)).' min='.date("Y-m-d", $newdate).' ></td>
					<td><input type="date" name="to'.$e.'" id="to'.$e.'" value="'.$row[3].'" max='.date("Y-m-d", time()+(19800)).' min='.date("Y-m-d", $newdate).' ></td>
        			<td><textarea rows=4 cols=30 name="addr'.$e.'" id="addr'.$e.'" >'.$row[4].'</textarea></td>
					<td align="center"><input type="text" size=30 name="dist'.$e.'" id="dist'.$e.'" value="'.$row[5].'" ></td>
					<td>
						<input type="button" name="save" value="Save" onClick="onclick_save('.$e.')">
						<input type="button" class="error" name="delete5[]" value="Delete" onClick="onclick_delete('.$e.');" >
					</td>';
	}
	mysql_close();
?>