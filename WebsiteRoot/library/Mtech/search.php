<?php
include_once('../../Includes/FeedbackLayout.php');

	drawHeader("Account Functions");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<!--
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="add_books.css" rel="stylesheet" type="text/css" media="all" />
<style type="text/css">

.style3 {font-size: 1.5em}
.style4 {font-size: 16px}

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
            border: 10px groove #000;
            background-color: white;
            z-index:1002;
            overflow: auto;
        }
</style>
-->
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

<script type="text/javascript">
	function drp1()
	{
		document.getElementById("nav-sub1").style.display="block";
	}

	function drp2()
	{
		document.getElementById("nav-sub2").style.display="block";
	}

	function drp3()
	{
		document.getElementById("nav-sub3").style.display="block";
	}

	function drpoff()
	{
		document.getElementById("nav-sub1").style.display="none";
		document.getElementById("nav-sub2").style.display="none";
		document.getElementById("nav-sub3").style.display="none";	
	}

</script>

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

<style type="text/css">

#nav-sub1,
#nav-sub2,
#nav-sub3 {

	display: none;
	position: relative;
	list-style-type: none;
	padding:10px;
	z-index: 598;
	background: #00094a
	border-right: 1px solid #000;
	
}

</style>

</head>


<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>
<p>&nbsp;&nbsp;</p>
<body onclick="drpoff()">

<table>
	<tr>
		<td width=400><center><a href="student.php">Home</a></center></td>
		<td class="nav-main1" width=400><center><a href="" 

onmouseover="drp1()">List Books</a></center></td>
		<td width=400><center><a href="display_issued_books.php">Issued Books</a></center></td>
		
	</tr>
	<tr>
		<td></td>
		<td>
			<ul id="nav-sub1">
				<li align=center><a href="all_books.php">All 

Books</a></li>
				
	  			<li align=center><a 

href="display_assets.php">Assets</a></li>
			</ul>
		</td>
		<td>
			<!--<ul id="nav-sub2">
				<li align=center><a 

href="display_issued_books.php">Issued Books</a></li>
		 	<!--	<li align=center><a 

href="display_donated_books.php">Donated Books</a></li>
			</ul>-->
		</td>
		
	</tr>
</table>
<p>&nbsp;&nbsp;</p>
<div id="page">
<div id="sidebar">
			<div id="tbox1">
<center>
<form method="post" action="search.php">

<input type="text" size=100 name="textfield" placeholder="Search For A Book Here ..." onkeyup="search_as_you_type(this.value)">
<input type="submit" name="Submit" value="Search" class="button-style"/>
</form>
</center>
      
			</div>
</div>
<p>&nbsp;&nbsp;</p>
<div id="ajx" style="padding:30px;"></div>

<div id="content">
<table >
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
		echo "<br><tr><td width='200' colspan='4'><h3>NO BOOK FOUND</h3></td></tr><br>";
	}
	else if($no_copies==0)
	{
		$if=mysql_query("	SELECT emp_id,emp_name,book_no,book_name,no_copies 
							FROM (select book_no,book_name,no_copies from cselib_books where no_copies=0) as a
							NATURAL JOIN (select emp_id,emp_name,book_no from issued_book_faculty) as b
							where book_name like '%$search%' ") or die(mysql_error());;
		$is=mysql_query("	SELECT student_id,student_name,book_no,book_name,no_copies 
							FROM (select book_no,book_name,no_copies from cselib_books where no_copies=0) as a
							NATURAL JOIN (select student_id,student_name,book_no from issued_book_student) as b
							where book_name like '%$search%' ") or die(mysql_error());

		if(mysql_num_rows($if)!=0)
		{
			echo "Book issued by Employee<br>";
			echo '<tr><th width=250>Employee name</th>
					<th width=250>Employee Id</th>
					<th width=250>Book No</th>
					<th width=250>Book name</th></tr>';
			while($row=mysql_fetch_row($if))
			{
				echo '<tr><td><center>'.$row[1].'</td>
						<td><center>'.$row[0].'</td>
						<td><center>'.$row[2].'</td>
						<td><center>'.$row[3].'</td>
						</tr>';
			}
		}
		else  
			echo "No such book issued by employee<br>";

		if(mysql_num_rows($is)!=0)
		{
			echo "Book issued by Student<br>";
			echo '<tr><th width=250>Student name</th>
					<th width=250>Student Id</th>
					<th width=250>Book No</th>
					<th width=250>Book name</th></tr>';
			while($row=mysql_fetch_row($is))
			{
				echo '<tr><td><center>'.$row[1].'</td>
						<td><center>'.$row[0].'</td>
						<td><center>'.$row[2].'</td>
						<td><center>'.$row[3].'</td>
						</tr>';
			}
		}
		else  
			echo "No such book issued by Student";
	}
	else
	{

		
	echo "<br><span class='style4'><h3><b>SEARCH RESULTS:</b></h3></span><br>";			
	echo " 
  			<tr>
		    
			<th width='100' valign='left' align='center' ><b>Sr no.</b></th>
    		<th width='300' valign='left' align='center' ><b>Book Name</b></th>
    		<th width='300' valign='left' align='center' ><b>Book No.</b></th>
   			<th width='300' valign='left' align='center' ><b>Author(s)</b></th>
   			<th width='300' valign='left' align='center' ><b>Publication</b></th>
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
   
				<td><center>
				
				$count</td>
   			 	
				
				<td><center>$book_name</td>
  			 	 <td><center>$book_no</td>
				 <td><center>$author_name</td>
  			 	 <td><center>$publication</td>
		
				 
				
   
  </tr> ";
	}
}
	?>
	</table>
</div>
	<br>
	<div id="print">
		
 
 		 
  				  <td height="36">&nbsp;</td>
  				  <center><td valign="top"><input class="button-style" type="button" value="PRINT" onclick="printDiv()"/></td>
 		 </tr>
    	  
		
	</div>	
	
	
	
		
</div>


</body>
</html>

<?php
drawFooter();
?>