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

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>

<?php
 
 
require("connect.php");
$design=$_POST['design'];
$no_books=$_POST['no_books'];
$date_issue=date("Y/m/d");

//insert into faculty records

if($design=="FACULTY")
{
	
	//get emp_id
    $name= $_POST['name'];
	$l='(';
	$r=')';
	$f=strpos($name,$l);
	$m=strpos($name,$r);
	$len=$m-$f;
	$id=substr($name,$f+1,$len-1);
	$i=1;
	while($i<=$no_books)
	{
		$accession_no=$_POST['accession_no'.$i];
		
		$select=mysql_query("select status,book_no,class_no from cselib_accession_numbers where accession_no='$accession_no'") or die(mysql_error());
		$row=mysql_fetch_assoc($select);
		$book_no=$row['book_no'];
		$class_no=$row['class_no'];
		$status=$row['status'];
		
		if($status==1)
		{
			echo "<center><h3>Book with accession no. $accession_no has <b>ALREADY BEEN ISSUED : </b></h3></center><br><br>";
			$show=mysql_query("select emp_name,date_issue from cselib_issued_book_faculty where accession_no='$accession_no'") or die(mysql_error());
			$resulting_rows=mysql_fetch_assoc($show);
			$employee_name=$resulting_rows['emp_name'];
			$date_of_issue=$resulting_rows['date_issue'];
			echo 	"	
					<center>
						<table>
							<tr>
								<th width=300>Employee Name</th>
								<th width=300>Date Of Issue</th>
							</tr>
							<tr>
								<td><center>$employee_name</center></td>
								<td><center>$date_of_issue</center></td>
							</tr>
						</table>
					</center>
					";
			$i++;
			continue;
		}
		if(mysql_num_rows($select)==0)
		{
			echo "NO SUCH BOOK IN THE LIBRARY<br>$accession_no IS INVALID ACCESSION NUM";
			$i++;
			continue;
		}
		
			
		$select=mysql_query("select category from cselib_books where book_no='$book_no' and call_no='$class_no'") or die(mysql_error());
		
		while($row=mysql_fetch_assoc($select))
		{
		
		
		$category=$row['category'];
		}

		$update=mysql_query("UPDATE cselib_books 
							set no_copies=no_copies-1 where book_no='$book_no' and call_no='$class_no'")
							 or die(mysql_error());
		
		
			
/*
		$select1=mysql_query("select no_copies 
							 from cselib_categories_books where category='$category'")
							 or die(mysql_error());
        if(mysql_num_rows($select1)==0)
		{
   			echo "book $book_no not present";
			$i=$i+1;
			continue;
		}
		while($row1=mysql_fetch_assoc($select1))
		{
			$count1=$row1['no_copies'];
		}
		$count1=$count1-1;
		$update=mysql_query("UPDATE cselib_categories_books 
							 set no_copies='$count1' where category='$category'") or die(mysql_error());
*/
		
		$query="INSERT INTO cselib_issued_book_faculty VALUES('$id','$name','$book_no','$class_no','$accession_no','$date_issue')";
		$result = mysql_query($query) or die("Error in Query '$query'".mysql_error());
		
		$update=mysql_query("UPDATE cselib_accession_numbers set status='1' where accession_no='$accession_no'");
		
		$i++;

	}
	
	echo "<h2>Database Updated<h2>";
}


if($design=="STUDENT")
{
	$i=1;
	$id=$_POST['student_id'];
	$extract=mysql_query("SELECT first_name,middle_name,last_name,branch_id from feedback_studentpersonal where admn_no='$id' ") or die(mysql_error());
	$row=mysql_fetch_assoc($extract);
	$branch=$row['branch_id'];
	$first=$row['first_name'];
	$middle=$row['middle_name'];
	$last=$row['last_name'];
	
	if($branch!="CSE")
	{
		echo "student does not belong to CSE";
		exit;
	}
	while($i<=$no_books)
	{
		$accession_no=$_POST['accession_no'.$i];
		
		$select=mysql_query("select status,book_no,class_no from cselib_accession_numbers where accession_no='$accession_no'") or die(mysql_error());
		$row=mysql_fetch_assoc($select);
		$book_no=$row['book_no'];
		$class_no=$row['class_no'];
		$status=$row['status'];
		
		if($status==1)
		{
			echo "<center><h3>Book with accession no. $accession_no has <b>ALREADY BEEN ISSUED</b> : </h3></center><br><br>";
			$show_2=mysql_query("select student_name,date_issue from cselib_issued_book_student where accession_no='$accession_no'") or die(mysql_error());
			$resulting_rows_2=mysql_fetch_assoc($show_2);
			$student_name=$resulting_rows_2['student_name'];
			$date_of_issue_2=$resulting_rows_2['date_issue'];
			echo 	"	
					<center>
						<table>
							<tr>
								<th width=300>Student Name</th>
								<th width=300>Date Of Issue</th>
							</tr>
							<tr>
								<td><center>$student_name</center></td>
								<td><center>$date_of_issue_2</center></td>
							</tr>
						</table>
					</center>
					";
			$i++;
			continue;
		}
		
		if(mysql_num_rows($select)==0)
		{
			echo "NO SUCH BOOK IN THE LIBRARY $accession_no IS INVALID ACCESSION NUM";
			$i++;
			continue;
		}
		
			
		$select=mysql_query("SELECT category from cselib_books where book_no='$book_no' and call_no='$class_no'") or die(mysql_error());
	
		while($row=mysql_fetch_assoc($select))
		{
		
		
		$category=$row['category'];
		}

		$update=mysql_query("UPDATE cselib_books 
							set no_copies=no_copies-1 where book_no='$book_no' and call_no='$class_no'")
							 or die(mysql_error());
		
		
			
/*
		$select1=mysql_query("select no_copies 
							 from cselib_categories_books where category='$category'")
							 or die(mysql_error());
        if(mysql_num_rows($select1)==0)
		{
   			echo "book $book_no not present";
			$i=$i+1;
			continue;
		}
		while($row1=mysql_fetch_assoc($select1))
		{
			$count1=$row1['no_copies'];
		}
		$count1=$count1-1;
		$update=mysql_query("UPDATE cselib_categories_books 
							 set no_copies='$count1' where category='$category'") or die(mysql_error());
*/
		$student_name=$first." ".$middle." ".$last;
		
		$query="INSERT INTO cselib_issued_book_student VALUES('$id','$student_name','$book_no','$class_no','$accession_no','$date_issue')";
		$result = mysql_query($query) or die("Error in Query '$query'".mysql_error());
		
		$update=mysql_query("update cselib_accession_numbers set status='1' where accession_no='$accession_no'");
		
		$i++;

	}
	
	echo "<h2>Database Updated</h2>";
}




?>
<br>
<br>
<h3><a href="issue_books.php">Issue more books</a></h3>

</body>
</html>

<?php
drawFooter();
?>