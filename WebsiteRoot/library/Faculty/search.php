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
<script type="text/javascript">
function search_as_you_type(str)
		{
		var xmlhttp;
		if (str.length==0)
		  { 
		  document.getElementById("ajx").innerHTML="";
		  return;
		  }
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if(xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    document.getElementById("ajx").innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","search_ajx.php?q="+str,true);
		xmlhttp.send();
		}
	</script>
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
</script>

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>

<p>&nbsp;&nbsp;</p>
<center>
<form method="post" action="search.php">
	<input type="text" size=100 name="textfield" placeholder="Search For A Book Here ..." onkeyup="search_as_you_type(this.value)">
<input type="submit" value="Search" />
</form>
</center>
<p>&nbsp;&nbsp;</p>
<div id="ajx" style="padding:30px;"></div>

<div id="content">
<table width=100%>
	<?php
	
 	require('connect.php'); 
 	$search=$_POST['textfield'];
	$count=0;
 	
	$extract = mysql_query("SELECT * from cselib_books where book_name like '%$search%' or author_name like '%$search%' or book_publication like '%$search%' ") or die(mysql_error());
	$extract2 = mysql_query("SELECT * from cselib_books where book_name like '%$search%' or author_name like '%$search%' or book_publication like '%$search%' ") or die(mysql_error());
	$row2=mysql_fetch_assoc($extract2);
	$no_copies=$row2['no_copies'];

	if(mysql_num_rows($extract)==0 )
	{
		echo "<tr><td><h3>NO BOOK FOUND<br><br></h3></td></tr>";
	}
	else if($no_copies==0)
	{
		$if=mysql_query("	SELECT emp_id,emp_name,book_no,book_name,no_copies 
							FROM (select book_no,book_name,no_copies from cselib_books where no_copies=0) as a
							NATURAL JOIN (select emp_id,emp_name,book_no from cselib_issued_book_faculty) as b
							where book_name like '%$search%' ") or die(mysql_error());;
		$is=mysql_query("	SELECT student_id,student_name,book_no,book_name,no_copies 
							FROM (select book_no,book_name,no_copies from cselib_books where no_copies=0) as a
							NATURAL JOIN (select student_id,student_name,book_no from cselib_issued_book_student) as b
							where book_name like '%$search%' ") or die(mysql_error());

		if(mysql_num_rows($if)!=0)
		{
			echo "Book issued by Employee<br>";
			echo '<tr><th>Employee name</th>
					<th>Employee Id</th>
					<th>Book No</th>
					<th>Book name</th></tr>';
			while($row=mysql_fetch_row($if))
			{
				echo '<tr><td>'.$row[1].'</td>
						<td>'.$row[0].'</td>
						<td>'.$row[2].'</td>
						<td>'.$row[3].'</td>
						</tr>';
			}
		}
		else  
			echo "No such book issued by employee<br>";

		if(mysql_num_rows($is)!=0)
		{
			echo "Book issued by Student<br>";
			echo '<tr><th>Student name</th>
					<th>Student Id</th>
					<th>Book No</th>
					<th>Book name</th></tr>';
			while($row=mysql_fetch_row($is))
			{
				echo '<tr><td>'.$row[1].'</td>
						<td>'.$row[0].'</td>
						<td>'.$row[2].'</td>
						<td>'.$row[3].'</td>
						</tr>';
			}
		}
		else  
			echo "No such book issued by Student";
	}
	else
	{

		
	echo "<span><h3>Search Results<br><br></h3></span>";			
	echo " 
  			<tr>
		    
			<th>Sr. No.</th>
    		<th>Book Name</th>
    		<th>Book No.</th>
   			<th>Author</th>
   			<th>Publication</th>
			</tr>

 	";
	
	
	while($row=mysql_fetch_assoc($extract))
	{
		$count++;
		$book_no=$row['book_no'];
		$book_name=$row['book_name'];
		$author_name=$row['author_name'];
		$publication=$row['book_publication'];
		
		echo " <tr>
   
				<td><center>$count</center></td>
   			 	<td><center>$book_name</center></td>
  			 	 <td><center>$book_no</center></td>
				 <td><center>$author_name</center></td>
  			 	 <td><center>$publication</center></td>
		
				 
				
   
  </tr> ";
	}
}
	?>
	</table>
	</div>
	<br>
	<br>
	<center><input class="button-style" type="button" value="PRINT" onclick="printDiv()"/></center
	
</body>
</html>

<?php
drawFooter();
?>