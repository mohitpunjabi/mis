<?php
  require_once("../../Includes/Auth.php");
  auth();
  require_once("../../Includes/Layout.php");

	drawHeader("Account Functions");
?>

<?php

require("connect.php");

if(isset($_GET['req_num']) && isset($_GET['status']))
{
$remark=$_GET['remarks'];
$req_num=$_GET['req_num'];
$status=$_GET['status'];


if($status=="approve")
{
	$update=mysql_query("UPDATE cselib_request_temp set status='1' where request_num='$req_num'") or die(mysql_error());
	$insert=mysql_query("INSERT into cselib_request_details(select request_num,emp_id,emp_name,design,dept,book_name,author,publication,edition,source,no_copies,price_unit,currency,date_request from request_temp where request_num='$req_num')") or die(mysql_error());
	$delete=mysql_query("DELETE from cselib_request_temp where status = 1") or die(mysql_error());

}
else if($status=="deny")
{
	
	$update=mysql_query("UPDATE cselib_request_temp set status='2' where request_num='$req_num'") or die(mysql_error());
	$update=mysql_query("UPDATE cselib_request_temp set remarks='$remark' where request_num='$req_num'") or die(mysql_error());
}
}
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
  var divToPrint=document.getElementById("book_table");
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
	document.getElementById("popup").appendChild(DIV);
	DIV.style.display = "block";
}
</script>

	<script type="text/javascript">     
						$(document).ready(function() { 
                        $('#d').change(function(){     
							if($('#d').val() === 'deny' ||$('#d').val() === 'Others' )     
								{$('#s').show();}     
								else    
								   {$('#s').hide();}
								});

							$('#a').change(function(){     
							if($('#a').val() === 'approve' ||$('#a').val() === 'Others' )     
								{$('#s').hide();}     
								else    
								   {$('#s').show();}
								});
						
						$('#d').change(function(){     
							if($('#d').val() === 'deny' ||$('#d').val() === 'Others' )     
								{$('#box').show();}     
								else    
								   {$('#box').hide();}
								});

							$('#a').change(function(){     
							if($('#a').val() === 'approve' ||$('#a').val() === 'Others' )     
								{$('#box').hide();}     
								else    
								   {$('#box').show();}
								});
					});     
	</script> 

	<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>
<div>

<table width=100%>
<?php 

require("connect.php");

$select=mysql_query("SELECT * from cselib_request_temp where status='0'") or die(mysql_error());
if(mysql_num_rows($select)==0)
{
	echo "<center>NO REQUESTS</center>";
}
else
{

		
				
	echo " 
  			<tr>
		    
			<th>Request No.</th>
    		<th>Employee Name</th>
    		<th>Book Name </th>
   			<th>Permission</th>
			<th>Book Status</th>
			</tr>

 	";
	
				
	$i=0;
	while($row=mysql_fetch_assoc($select))
	{
		$i++;
		$req_num=$row['request_num'];
		$emp_name=$row['emp_name'];
		$book_name=$row['book_name'];
		
		echo " <tr>
   
				<td width='200' valign='top' align='left'>$req_num</td>
   			 	<td width='200' valign='top' align='left'>$emp_name</td>
  			 	 <td width='200' valign='top' align='left'>$book_name</td>
   				 <td width='200' valign='top' align='left'>
					<form action='hodapproval.php' method='get'>
<div id='s' style='display:none'>Remarks<br><textarea name='remarks' rows='2' id='box' style='display:none'></textarea></br></div>
    				<label><input type='radio' name='status' value='approve' id='a' />
    					Approve</label><br />
  					
  					<label>
					
    				<input type='radio' name='status'   value='deny' id='d' />
    					Deny</label>
  					<br />
					
					<input name='req_num' style='visibility:hidden' type='text' value='"; echo $req_num; echo "'/>
					<input type='submit' value='Confirm'>
				 </form><br>
				 
				 
				 
				 
				 
		
			    <a href = \"javascript:void(0)\" onclick = \"popUp(document.getElementById('light"; echo $i; echo"'))\">Details</a></td>
			    <td><center><a href = \"javascript:void(0)\" onclick = \"popUp(document.getElementById('light2"; echo $i; echo"'))\">Status</a></td></center></td>";
		
		
		 echo " <div id=\"light2"; echo $i; echo "\" style=\"display:none\" class=\"white_content\">";
		
		
		{
			$pend=mysql_query("SELECT * from cselib_request_temp where status='0' and book_name='$book_name' and request_num<>'$req_num' ") or die(mysql_error());
			$app=mysql_query("SELECT * from cselib_request_details where book_name='$book_name' ") or die(mysql_error());
			$lib=mysql_query("SELECT * from cselib_books where book_name='$book_name' ") or die(mysql_error());
			$row1=mysql_fetch_assoc($pend);
			$row2=mysql_fetch_assoc($app);
			$row3=mysql_fetch_assoc($lib);
			$pend_req_name=$row1['emp_name'].'('.$row1['emp_id'].')';
			$pend_copy=$row1['no_copies'];
			$app_req_name=$row2['emp_name'].'('.$row2['emp_id'].')';
			$app_copy=$row2['no_copies'];
			$avail_copy=$row3['no_copies'];
			echo 	"
						<center>
							Already Pending Requests : <br>
							".$pend_req_name." : ".$pend_copy."	<br>
							Already Approved Requests : <br>
							".$app_req_name." : ".$app_copy."	<br>
							Available Copies : ".$avail_copy."	<br>
						</center>
					";
		}
		
		echo "<br/><a href = \"javascript:void(0)\" onclick = \"this.parentNode.parentNode.removeChild(this.parentNode);\"><center>Close</center></a>
        <div id=\"fade"; echo $i; echo "\" class=\"black_overlay\"></div>";





        echo " <div id=\"light"; echo $i; echo "\" style=\"display:none; margin:auto;\" class=\"white_content\" >";
		
		
		{
				$design=$row['design'];
				$author=$row['author'];
				$publication=$row['publication'];
				$edition=$row['edition'];	
				$no_copies=$row['no_copies'];
				$price=$row['price_unit'];
				$date=$row['date_request'];
				echo "<center><span class='style4'><u><h3>BOOK DETAILS</h3></u></span></center>";
				echo "<br><center>Request No.&emsp;:&emsp;<b>".$req_num."</b><br><br><b>".$design." ".$emp_name. " </b> has requested the book named <b> 
				".$book_name."</b> . <br><br> Date of Request :<b>".$date."</b><br><br>Author/publication &nbsp;:&nbsp;<b>".$author."</b> <b>(".$publication.")</b> <br><br>Edition : <b>".$edition."
				</b><br><br> Copies :<b>".$no_copies."</b><center>";
		
		}
		
		echo "<br/><a href = \"javascript:void(0)\" onclick = \"this.parentNode.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode.parentNode);\"><center>Close</center></a>
        <div id=\"fade"; echo $i; echo "\" class=\"black_overlay\"></div>
		

  </tr> ";
	}
}
?>
</table>
</div>
		
</div>
<center id="popup">
</center>


</body>
</html>

<?php
drawFooter();
?>