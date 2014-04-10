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

<table align="center">

<?php 
	
	require("connect.php");
	$design=$_POST['design'];

	if($design=="FACULTY")
	{
		$name=$_POST['name'];
		$l='(';
		$r=')';
		$f=strpos($name,$l);
		$m=strpos($name,$r);
		$len=$m-$f;
		$id=substr($name,$f+1,$len-1);
		$select=mysql_query("	SELECT book_name,date_issue,accession_no
								from cselib_issued_book_faculty as ibf,cselib_books as cb
								where ibf.book_no=cb.book_no and emp_id='$id' ") 
		or die(mysql_error());
		//if(mysql_fetch_assoc($select)==0)	echo "<div class='notification'><h3>No Books Issued So Far</h3></div>";
		//else
		{
			echo 	"	
						<tr>
							<th width=250>Book Name</th>
							<th width=250>Date Of Issue</th>
							<th width=250 >Accession No</th>
							<th width=250>Return</th>
						</tr>
					";

			while($row=mysql_fetch_assoc($select))
			{
				$book_name=$row['book_name'];
				$date_issue=$row['date_issue'];
				$acc_no=$row['accession_no'];

				echo 	"
							<tr>
							<form action='returnbooks.php' method='post'>
								<td><center>$book_name</center></td>
								<td><center>$date_issue</center></td>
								<td><center>$acc_no</center></td>
								<td>
									<center>
										<input type='hidden' value='".$acc_no."' name='acc_no'/> 
										<input type='submit' value='Return' />
									</center>
								</td>
							</form>
							</tr>
						";
			}
		}


	}

	if($design=="STUDENT")
	{
		$id=$_POST['student_id'];
		$select=mysql_query("	SELECT book_name,date_issue,accession_no
								from cselib_issued_book_student as ibs,cselib_books as cb
								where ibs.book_no=cb.book_no and student_id='$id' ") 
		or die(mysql_error());

		//if(mysql_fetch_assoc($select)==0)	echo "<div class='notification'><h3>No Books Issued So Far</h3></div>";
		//else
		{
			echo 	"	
						<tr>
							<th width=250>Book Name</th>
							<th width=250>Date Of Issue</th>
							<th width=250 >Accession No</th>
							<th width=250>Return</th>
						</tr>
					";

			while($row=mysql_fetch_assoc($select))
			{
				$book_name=$row['book_name'];
				$date_issue=$row['date_issue'];
				$acc_no=$row['accession_no'];

				echo 	"
							<tr>
							<form action='return_books_3.php' method='post'>
								<td><center>$book_name</center></td>
								<td><center>$date_issue</center></td>
								<td><center>$acc_no</center></td>
								<td>
									<center>
										<input type='hidden' value='".$acc_no."' name='acc_no'/> 
										<input type='submit' value='Return' />
									</center>
								</td>
							</form>
							</tr>
						";
			}
		}

	}

?>

 </table>


 <?php
drawFooter();
?>e