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
<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>


<div class="notification">

 <?php
 
 	require("connect.php");

	//book details
	$book_no= $_REQUEST['book_no'];
	$book_name=$_REQUEST['book_name'];
	$author=$_REQUEST['author'];
	$publication=$_REQUEST['publication'];
	$class_no=$_REQUEST['class_no'];
	$no_copies=$_REQUEST['no_copies'];
	$date_arrival=$_REQUEST['date_arrival'];
	$category=$_REQUEST['category'];
	
	$i=1;

	if($category!="Other")
	{
		$select=mysql_query("SELECT no_copies from cselib_categories_books where category='$category'") or die(mysql_error());
		while($row=mysql_fetch_assoc($select))
		{
			$count=$row['no_copies'];
		}
		$count=$count+$no_copies;
		$update=mysql_query("UPDATE cselib_categories_books set no_copies='$count' where category='$category'") or die(mysql_error());

					while($i<=$no_copies)
					{
					$accession_no=$_REQUEST['accession_no'.$i];
					$insert=mysql_query("INSERT INTO cselib_accession_numbers
								VALUES('$book_no','$class_no','$accession_no',0)")  
								or die("BOOK ALREADY ADDED");
								$i=$i+1;
					}

					$insert1=mysql_query("INSERT INTO cselib_books
		                     VALUES('$book_no','$book_name','$author','$publication','$class_no','$date_arrival','$no_copies','$category')")  
							 or die("TRYING TO INSERT A DUPLICATE ENTRY");


				echo "<h2>Database Updated</h2>";
	}

	else
	{
		$other_cat=$_REQUEST['other_cat'];
		$insert=mysql_query("INSERT INTO cselib_categories_books
							VALUES('$other_cat','$no_copies')")
							or die("CATEGORY ALREADY EXISTS");

		while($i<=$no_copies)
					{
					$accession_no=$_REQUEST['accession_no'.$i];
					$insert=mysql_query("INSERT INTO cselib_accession_numbers
								VALUES('$book_no','$class_no','$accession_no',0)")  
								or die("BOOK ALREADY ADDED");
								$i=$i+1;
					}

					$insert1=mysql_query("INSERT INTO cselib_books
		                     VALUES('$book_no','$book_name','$author','$publication','$class_no','$date_arrival','$no_copies','$other_cat')")  
							 or die("TRYING TO INSERT A DUPLICATE ENTRY");


				echo "<h2>Database Updated</h2>";
	}

?>
</div>
<br>
<br> 
<h3><a href="add_books.php">Add more books</a></h3>
<br>

</body>
</html>

<?php
drawFooter();
?>