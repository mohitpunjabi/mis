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

<script>
function printDiv()
{
  var divToPrint=document.getElementById("oontent");
  newWin= window.open("");
  newWin.document.write(divToPrint.outerHTML);
  newWin.print();
  newWin.close();
}
</script>

</head>

<body class="body">
<div id="wrapper">
  <div id="header">
    <div id="logo"> <img src="ism logosmall.png" /> </div>
    <div id="heading"> <span class="style3">Computer Science &amp; Engineering<br />
      Indian School of Mines, Dhanbad<br />
      Department Library</span> <br />
    </div>	
  </div>
</div>

<div >
   <ul id="navigation" class="nav-main">
  
 	 <li><a href="">Edit</a></li>
  
     <li><a href="return_books.php">Book Return</a></li>
   	 <li><a href="issue_books.php">Issue Books </a></li>
     <li class="list"><a href="#">Add Books</a>
	
		<ul class="nav-sub">
		 <li><a href="add_books.php">Library</a></li>
		 <li><a href="add_donated_book.php">Donated Books</a></li>
   		</ul>
	</li>
	<li class="list"><a href="#">List Books</a>
			<ul class="nav-sub">
		 	<li><a href="all_books.php">All books</a></li>
		 	<li><a href="display_assets.php">Assets</a></li>
    		</ul>
	</li>
	
		<li class="list"><a href="#">History</a>
	  	
			<ul class="nav-sub">
    		<li><a href="display_issued_books.php">Issued Books</a></li>
			
			<li><a href="display_donated_books.php">Donated</a></li>
			<li><a href="display_requests.php">Requests</a></li>
			<li><a href="display_approved_requests.php">Approved Requests</a></li>
	  		</ul>
		</li>
	
		<li><a href="admin.php">Home</a></li>
  </ul>	
</div>


<p>&nbsp;</p>
<div id="page">

<div id="sidebar">
			<div id="tbox1">
			  <form method="post" action="search.php">
			  <input type="text" name="textfield" />
		      
			  <br>
		        <input type="submit" name="Submit" value="Search Book" class="button-style" />
		      </form>  
			</div>
</div>
<div id="content">
			
<table id="book_table" border="1px">


 <?php
 	session_start();
	$id=$_POST['id'];
	$design=$_POST['designation'];
 	$count=0;
	require("connect.php");
	if($design="faculty")
	{
	$extract = mysql_query("SELECT * FROM issued_book_faculty where emp_id='$id'");
	if(mysql_num_rows($extract)==0)
	{
		echo "<span class='style4'>No Books issued under the Employee</span>";
		
	}
	else
	{
	echo "<span class='style4'>Books Issued under      EMPLOYEE ID: $id</span><br><br><br>";
	
	
	 

	echo "

 
  
  
  	<tr>
    
			<td width='200' valign='left' align='center' ><u><b>Sr. no.</b></u> </td>
    		<td width='200' valign='left' align='center' ><u><b>Faculty Name</b></u> </td>
    		<td width='200' valign='left' align='center'><u><b>Book Name</b></u> </td>
   			 <td width='200' valign='left' align='center' ><u><b>Accession No.</b></u></td>
   
	</tr>

 	";
 
	
	
	while($row = mysql_fetch_assoc($extract))
	{
			$emp_id=$row["emp_id"];
			$book_no=$row["book_no"];
			$class_no=$row["class_no"];
			$accession_no=$row["accession_no"];

			//$select=mysql_query("Select emp_name from faculty_data where emp_id="$emp_id"");
			
			$select1=mysql_query("SELECT book_name from cselib_books where book_no='$book_no' and call_no='$class_no'");
			$row=mysql_fetch_assoc($select1);
			$book_name=$row['book_name'];			
			$count=$count+1;
		echo  "
 		 <tr>
  		  
			<td width='200' valign='left' align='center' >$count</td>
  			  <td width='200' valign='left' align='center' ></td>
   			 <td width='200' valign='left' align='center'>$book_name</td>
   			 <td width='200' valign='left' align='center' >$accession_no</td>
   
		</tr>";
		}
	
	}
	}
	else if($design=="mtech")
	{
		$extract = mysql_query("SELECT * FROM issued_book_student where emp_id='$id'");
	if(mysql_num_rows($extract)==0)
	{
		echo "<span class='style4'>No Books issued under the Student</span>";
		
	}
	else
	{
	echo "<span class='style4'><u><b>Books Issued</b></u></span><br>";
	
	
	 

	echo "

 
  
  
  	<tr>
    
			<td width='200' valign='left' align='center' ><u><b>Sr. no.</b></u> </td>
    		<td width='200' valign='left' align='center' ><u><b>Student Name</b></u> </td>
    		<td width='200' valign='left' align='center'><u><b>Book Name</b></u> </td>
   			 <td width='200' valign='left' align='center' ><u><b>Accession No.</b></u></td>
   
	</tr>

 	";
 
	
	
	while($row = mysql_fetch_assoc($extract))
	{
			$emp_id=$row["emp_id"];
			$book_no=$row["book_no"];
			$class_no=$row["class_no"];
			$accession_no=$row["accession_no"];

			//$select=mysql_query("Select emp_name from faculty_data where emp_id="$emp_id"");
			
			$select1=mysql_query("SELECT book_name from cselib_books where book_no='$book_no' and call_no='$class_no'");
			$row=mysql_fetch_assoc($select1);
			$book_name=$row['book_name'];			
			$count=$count+1;
		echo  "
 		 <tr>
  		  
			<td width='200' valign='left' align='center' >$count</td>
  			  <td width='200' valign='left' align='center' ></td>
   			 <td width='200' valign='left' align='center'>$book_name</td>
   			 <td width='200' valign='left' align='center' >$accession_no</td>
   
		</tr>";
		}
		}
		}
	
	?>


	




</table>
</div>

	
	
	
	
	<div id="print">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
 
 		 <tr>
  				  <td width="977" height="32">&nbsp;</td>
   				  <td width="132">&nbsp;</td>
 		 </tr>
 		 <tr>
  				  <td height="36">&nbsp;</td>
  				  <td valign="top"><input class="button-style" type="button" value="PRINT" onclick="printDiv()"/></td>
 		 </tr>
    	  <tr>
  				  <td height="36">&nbsp;</td>
				  <td>&nbsp;</td>
 		 </tr>
		</table>
	</div>	
		
</div>
<div id="footer">
		<p>Group 6</p>
	</div>


</body>
</html>

<?php
drawFooter();
?>