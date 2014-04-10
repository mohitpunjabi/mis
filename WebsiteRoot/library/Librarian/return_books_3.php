
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

</head


<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>

<div class="notification">

<?php
 
 
require("connect.php");
$countfaculty=0;
$countstudent=0;
$date_return=date('Y/m/d');
{

		
		$accession_no=$_POST['acc_no'];
		


		$select=mysql_query("SELECT emp_id,book_no,class_no from cselib_issued_book_faculty
 							where accession_no='$accession_no'") or die(mysql_error());

		$select2=mysql_query("SELECT student_id,book_no,class_no from cselib_issued_book_student 
							where accession_no='$accession_no'") or die(mysql_error());
	
		
		if(mysql_num_rows($select)==1)
		{
				$row=mysql_fetch_assoc($select);
				$book_no=$row['book_no'];
				$class_no=$row['class_no'];
				
				$select1=mysql_query("SELECT no_copies,category from cselib_books 
								where book_no='$book_no' and call_no='$class_no'") or die(mysql_error());
		
				while($row=mysql_fetch_assoc($select1))
				{
					$count=$row['no_copies'];
					$category=$row['category'];
				}
				$count=$count+1;
		
	//updating cselib_books
				$update=mysql_query("UPDATE cselib_books set no_copies='$count' 
									where book_no='$book_no' and call_no='$class_no'") or die(mysql_error());
		
	/*//updating category_book
				$select2=mysql_query("select no_copies from cselib_categories_books where category='$category'") or die(mysql_error());
	
				while($row=mysql_fetch_assoc($select2))
				{
						$count1=$row['no_copies'];
					
				}
				$count1=$count1+1;
				$update=mysql_query("update cselib_categories_books set no_copies='$count1' where category='$category'") or die(mysql_error());
		*/
				$delete=mysql_query("DELETE from cselib_issued_book_faculty 
									where book_no='$book_no' and class_no='$class_no' and accession_no='$accession_no'") or die(mysql_error());
	
				$update1=mysql_query("UPDATE cselib_accession_numbers set status='0' where accession_no='$accession_no'");
		}


	
		else if(mysql_num_rows($select2)==1)
		{
				$row=mysql_fetch_assoc($select2);
				$book_no=$row['book_no'];
				$class_no=$row['class_no'];
				$select3=mysql_query("SELECT no_copies,category from cselib_books 
							where book_no='$book_no' and call_no='$class_no'") or die(mysql_error());
		
				while($row=mysql_fetch_assoc($select3))
				{
					$count=$row['no_copies'];
					$category=$row['category'];
				}
				$count=$count+1;
		
	//updating cselib_books
				
				$update=mysql_query("UPDATE cselib_books set no_copies='$count' 
									where book_no='$book_no' and call_no='$class_no'") or die(mysql_error());
		
	//updating category_book
				/*$select3=mysql_query("select no_copies from cselib_categories_books where category='$category'") or die(mysql_error());
	
				while($row=mysql_fetch_assoc($select3))
				{
						$count1=$row['no_copies'];
					
				}
				$count1=$count1+1;
				$update=mysql_query("update cselib_categories_books set no_copies='$count1' where category='$category' ") or die(mysql_error());
		*/
				$delete=mysql_query("DELETE from cselib_issued_book_student
									where book_no='$book_no' and class_no='$class_no' and accession_no='$accession_no'") or die(mysql_error());
	
				$update1=mysql_query("UPDATE cselib_accession_numbers set status='0' where accession_no='$accession_no'");
			
		}
}




echo "<h2>Database Updated</h2>";

?>
</div>
<br>
<br>
<h3><a href="return_books.php">Return more books</a></h3>
<br>

</body>
</html>

<?php
drawFooter();
?>