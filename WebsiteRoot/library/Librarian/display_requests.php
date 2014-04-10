<?php
	require_once("../../Includes/Auth.php");
	auth();
	require_once("../../Includes/Layout.php");

	drawHeader("Account Functions");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">

.black_overlay{
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 2000px;
            background-color: black;
            z-index:1001;
            -moz-opacity: 0.8;
            opacity:.80;
            filter: alpha(opacity=80);
        }
        .white_content {
            display: none;
            position: absolute;
            top: 25%;
            left: 25%;
            width: 50%;
            height: auto;
            padding: 16px;
            border: 7px groove #000;
            background-color: white;
            z-index:1002;
            overflow: auto;
        }
</style>

</head>

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>
<div id="content">
<table>
	<?php
 	require('connect.php'); 
 	$count=0;
 	$extract = mysql_query("SELECT * from cselib_request_temp ") or die(mysql_error());
	
	
	if(mysql_num_rows($extract)==0 )
	{
		echo "<tr><td>NO ENTRY IN THIS SECTION</td></tr>";
	}
	else
{

		
				
	echo " 
  			<tr>
		    		<th width=225>Request No. </th>
		    		<th width=225>Employee Name </th>
		    		<th width=225>Book Name </th>
		   			<th width=225>Status</th>
		   			<th>Recieved Status</th>
			</tr>

 	";
	
	
				
	$i=0;
	while($row=mysql_fetch_assoc($extract))
	{
		$i++;
		$req_num=$row['request_num'];
		$emp_name=$row['emp_name'];
		$book_name=$row['book_name'];
		$status=$row['status'];
		$remarks=$row['remarks'];
		echo " <tr>
   
				<td>
				<a href = \"javascript:void(0)\" onclick = \"document.getElementById('light"; echo $i; echo"').style.display='block';document.getElementById('fade"; echo $i; echo "').style.display='block'\">$req_num</a>
				</td>
   			 	<td>$emp_name</td>
  			 	<td>$book_name</td>";
				 
				 if($status==1)
   				 echo "<td>Approved<br>	<b><h5>Remarks :<br> ".$remarks."</h5></b></td>";
				 if($status==0)
   				 echo "<td>Pending<br> <b><h5>Remarks :<br>".$remarks."</h5></b></td>";
				 if($status==2)
   				 echo "<td>Denied<br> <b><h5>Remarks :<br>".$remarks."</h5></b></td>";
				 
				 echo "	<td>
				 			<form action='delete_requests.php' method='get'>
								<label><input type='radio' name='status' value='approve'  />Recieved</label>
  
							<input name='req_num' style='visibility:hidden' type='text' value='"; echo $req_num; echo "'/>
							<input type='submit' value='Confirm'>
				 			</form>
				 		</td>";
				 
				 
       			echo " <div id=\"light"; echo $i; echo "\" class=\"white_content\">";
		
		
		
		
		
		{
				$design=$row['design'];
				$author=$row['author'];
				$publication=$row['publication'];
				$edition=$row['edition'];
				$no_copies=$row['no_copies'];
				$price=$row['price_unit'];
				$date=$row['date_request'];
				echo "<center><span class='style4'><u>BOOK DETAILS</u></span></center>";
				echo "<br><center>Request No.&emsp;:&emsp;<b>".$req_num."</b><br><br><b>".$design." ".$emp_name. " </b> has requested the book named <b> 
				".$book_name."</b> . <br><br> Date of Request :<b>".$date."</b><br><br>Author/publication &nbsp;:&nbsp;<b>".$author."</b> <b>(".$publication.")</b> <br><br>Edition : <b>".$edition."
				</b><br><br> Copies :<b>".$no_copies."</b><center>";
		
		}
		
		
		echo "<br><a href = \"javascript:void(0)\" onclick = \"document.getElementById('light"; echo $i; echo "').style.display='none';document.getElementById('fade"; echo $i; echo "').style.display='none'\"><center>Close</center></a></div>
        <div id=\"fade"; echo $i; echo "\" class=\"black_overlay\"></div>
				 
				
   
  </tr> ";
	}
	}
	?>
	</table>
</div>
	
</div>

</body>
</html>

<?php
drawFooter();
?>