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
	
 	require('connect.php'); 
 	$count=0;
 	
	$extract = mysql_query("SELECT * from cselib_request_temp order by book_name") or die(mysql_error());
	
	if(mysql_num_rows($extract)==0 )
	{
		echo "<tr><td width='200' colspan='4'>NO ENTRY IN THIS SECTION<br><br></td></tr>";
		
	}
	else
{

		
	echo "<span><h3><center>Requests:</center></h3><br><br></span>";			
	echo " 
  			<tr>
		    <th>Request No.</th>
    		<th>Employee Name</th>
    		<th>Book Name</th>
			<th>Author</th>
			<th>Publication</th>
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
		$author=$row['author'];
		$publication=$row['publication'];
		$status=$row['status'];
		
		echo " <tr>
   
				<td>
				
				 
   			 	
				<a href = \"javascript:void(0)\" onclick = \"popUp(document.getElementById('light"; echo $i; echo"'))\">$req_num</a></td>";
				
				 
				 
       
	   
	   echo " <div id=\"light"; echo $i; echo "\" style=\"display:none\" class=\"white_content\">";
		
		
		
		
		
		
				$design=$row['design'];
				
				$edition=$row['edition'];
				$no_copies=$row['no_copies'];
				$price=$row['price_unit'];
				$date=$row['date_request'];
				echo "<center><span class='style4'><u>BOOK DETAILS</u></span></center><br>";
				echo "<center><span class='style4'>Request No. :".$req_num."<br><br>Name of Indentor:".$emp_name. "<br><br>Designation :".$design."<br><br>
				Book Name :".$book_name."<br><br>Author :".$author."<br><br> Publication :".$publication."<br><br> Edition :".$edition."
				<br><br> no_copies".$no_copies."<br><br> Price/unit :".$price."<br><br> Date of Request:".$date."</span></center>";
		
		
		
		
		
		
		echo "<br><a href = \"javascript:void(0)\" onclick = \"this.parentNode.parentNode.removeChild(this.parentNode);\"><center>Close</center></a></div>
        <div id=\"fade"; echo $i; echo "\" class=\"black_overlay\"></div>
			
			<td width='200' valign='top' align='center'>$emp_name</td>
  			 	 <td width='200' valign='top' align='center'>$book_name</td>
				 <td width='200' valign='top' align='center'>$author</td>
  			 	 <td width='200' valign='top' align='center'>$publication</td>";
				 if($status==1)
   				 echo "<td width='200' valign='top' align='center'>Approved</td>";
				 if($status==0)
   				 echo "<td width='200' valign='top' align='center'>Pending</td>";
				 if($status==2)
   				 echo "<td width='200' valign='top' align='center'>Denied</td>";	 
				
   
  "</tr> ";
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
