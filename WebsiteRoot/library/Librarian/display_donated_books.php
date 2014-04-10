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
  var divToPrint=document.getElementById("content");
  newWin= window.open("");
  newWin.document.write(divToPrint.outerHTML);
  newWin.print();
  newWin.close();
}
</script>

</head>

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>
<p>&nbsp;&nbsp;</p>

<table align="center">
	<tr><td><a href="display_donated_books_faculty.php">LIST  BOOKS DONATED BY FACULTY</a></td></tr>
	<tr><td>&nbsp;&nbsp;</td></tr>
	<tr><td><a href="display_donated_books_student.php">LIST BOOKS DONATED BY STUDENTS</a></td></tr>
</table>
		
		
<?php
drawFooter();
?>