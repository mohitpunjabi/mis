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
</head>

<script>
function printDiv()
{
  var divToPrint=document.getElementById("content");
  newWin= window.open("");
  newWin.document.write(divToPrint.outerHTML);
  newWin.print();
  newWin.close();
}

function popUp(div){
	DIV = document.createElement("DIV");
	DIV.className = div.className;
	DIV.id = div.id;
	DIV.style.position = "absolute";
	DIV.style.top = "100px";
	DIV.style.padding="50px";
	DIV.style.backgroundColor="#dfefef";
	DIV.style.left = "400px";
	DIV.style.zIndex = "10000";
	DIV.innerHTML = div.innerHTML;
	document.body.appendChild(DIV);
	DIV.style.display = "block";
}
</script>

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>

<div id="content">
<table width=100%>
	<?php
	@session_start();
	$emp_id=$_SESSION['SESS_USERNAME'];
 	require('connect.php');
 	$count=0;
 	
	$extract = mysql_query("SELECT * from cselib_request_temp where emp_id='$emp_id'") or die(mysql_error());
	
	if(mysql_num_rows($extract)==0 )
	{
		echo "<tr><td>NO ENTRY IN THIS SECTION<br><br></td></tr>";
		
	}
	else
{

		
	echo "<span><h3>Requests<br><br></h3></span>";			
	echo " 
  			<tr>
		    
			<th>Request No.</th>
    		<th>Employee Name</th>
    		<th>Book Name</th>
   			<th>Status</th>
   
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
				
				 <a href = \"javascript:void(0)\" onclick = \"popUp(document.getElementById('light"; echo $i; echo"'))\"><center>$req_num</center></a></td>
   			 	
				
				<td><center>$emp_name</center></td>
  			 	 <td><center>$book_name</center></td>";
				 
				 if($status==1)
   				 echo "<td><center>Approved</center><br> <b><font size='1px' ><center>Remarks:</center>&nbsp;<center>".$remarks."</center></font></b></td>";
				 if($status==0)
   				 echo "<td><center>Pending</center><br> <b><font size='1px' ><center>Remarks:</center>&nbsp; <center>".$remarks."</center></font></b></td>";
				 if($status==2)
   				 echo "<td><center>Denied </center><br> <b><font size='1px' ><center>Remarks:</center>&nbsp; <center>".$remarks."</center></font></b></td>";
				 
				 
       echo " <div id=\"light"; echo $i; echo "\" style=\"display:none\" class=\"white_content\">";
		
		
		
		
		
		{
				$design=$row['design'];
				$author=$row['author'];
				$publication=$row['publication'];
				$edition=$row['edition'];
				$no_copies=$row['no_copies'];
				$price=$row['price_unit'];
				$date=$row['date_request'];
				echo "<center ><span><h3>BOOK DETAILS</h3></span></center>";
				echo "
				<br><center>Request No.&emsp;:&emsp;<b>".$req_num."</b><br><br><b>".$design." ".$emp_name. " </b> has requested the book named <b> 
				".$book_name."</b> . <br><br> Date of Request :<b>".$date."</b><br><br>Author/publication &nbsp;:&nbsp;<b>".$author."</b> <b>(".$publication.")</b> <br><br>Edition : <b>".$edition."
				</b><br><br> Copies :<b>".$no_copies."</b></center>";
		
		}
		
		
		echo "<br><a href = \"javascript:void(0)\" onclick = \"this.parentNode.parentNode.removeChild(this.parentNode);\"><center>Close</center></a></div>
        <div id=\"fade"; echo $i; echo "\" class=\"black_overlay\"></div>
				 
				
   
  </tr> ";
	}
}
	?>
	</table>
	</div>
	
	<br>
	<br>
	<center><input class="button-style" type="button" value="PRINT" onclick="printDiv()"/></center>
	
</body>
</html>

<?php
drawFooter();
?>