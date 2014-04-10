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
</style>

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
<div id="content">

<?php

require("connect.php");
$req_num=$_GET['req_num'];
$select=mysql_query("Select * from cselib_request_temp where request_num='$req_num'") or die(mysql_error());
$row=mysql_fetch_assoc($select);
$emp_name=$row['emp_name'];
$emp_id=$row['emp_id'];
$design=$row['design'];
$dept=$row['dept'];
$book_name=$row['book_name'];
$author=$row['author'];
$publication=$row['publication'];
$edition=$row['edition'];
$no_copies=$row['no_copies'];
$date_request=$row['date_request'];
$source=$row['source'];
$price_unit=$row['price_unit'];

echo "<div style='height:100%; width:100%;'>
  <div align='center' class='style1 style1 style5'>
    <img src='ism logosmall.png' align='center' width='83' height='65' /><br>INDIAN SCHOOL OF MINES<br>
      DHANBAD-826004(JHARKHAND)<br>
      CENTRAL LIBRARY<br>
      Ph. No.: 0326-2296516(O)<br>
      E-mail: librarian@ismlib.ac.in<br>
      Website: http://www.ismlib.ac.in </right> 
      </div>
  
 
  <div style='width:30%; float:left'>
   <table align='left' width='300'>
      <tr>
        <th width='215' scope='row'>Employment No. </th>
        <td width='185'><div align='center'><tt>$emp_id</tt></div></td>
      </tr>
      <tr>
        <th scope='row'>Name of Indentor </th>
        <td><div align='center'><tt>$emp_name</tt></div></td>
      </tr>
      <tr>
        <th scope='row'>Designation</th>
        <td><div align='center'><tt>$design</tt></div></td>
      </tr>
      <tr>
        <th scope='row'>Deptt./Centre</th>
        <td><div align='center'><tt>$dept</tt></div></td>
      </tr>
    </table>
 </div>
  <div style='width:30%; float:right'>
  <table align='right' width='300'>
      <tr>
        <th width='213' scope='row'>Memo No. </th>
        <td width='187'><div align='center'>................................</div></td>
      </tr>
      <tr>
        <th scope='row'>Control No. </th>
        <td><div align='center'>................................</div></td>
      </tr>
      <tr>
        <th scope='row'>Budget Head </th>
        <td><div align='center'><font size=2>PLAN/NON PLAN/PROJECT</font> </div></td>
      </tr>
    </table>
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  </div>


<div style='float:left'>

<table align='left' width='100%'>
       <tr>
	   <td colspan='2'><span class='style5'><strong>BOOK INFORMATION</strong></span></td>
	   </tr>
	    <tr>
          <th width='271' scope='row'><div align='left'>Title</div></th>
          <td width='821'><div align='center'><tt>$book_name</tt></div></td>
        </tr>
        <tr>
          <th scope='row'><div align='left'>Author</div></th>
          <td><div align='center'><tt>$author</tt></div></td>
        </tr>
        <tr>
          <th scope='row'><div align='left'>Edition/Year</div></th>
          <td><div align='center'><tt>$edition</tt></div></td>
        </tr>
        <tr>
          <th scope='row'><div align='left'>Publisher's Name </div></th>
          <td><div align='center'><tt>$publication</tt></div></td>
        </tr>
        <tr>
          <th scope='row'><div align='left'>Source of Selection </div></th>
          <td><div align='center'><tt>$source</tt></div></td>
        </tr>
        <tr>
          <th scope='row'><div align='left'>Unit Price </div></th>
          <td><div align='center'><tt>$price_unit</tt></div></td>
        </tr>
        <tr>
          <th scope='row'><div align='left'>Number of Copies </div></th>
          <td><div align='center'><tt>$no_copies</tt></div></td>
        </tr>
        <tr>
          <th height='49' scope='row'><div align='left'>Remarks</div></th>
          <td><div align='center'><tt></tt></div></td>
        </tr>
        <tr>
          <th scope='row'><div align='left'>Date</div></th>
          <td><div align='center'><tt>$date_request</tt></div></td>
	</tr>
				<tr>
					<th scope='row'><div align='left'>Signature of the Indentor</div></th>
					<td><div align='center'><tt></tt></div></td>
        </tr>
  </table>

</div>
  <br><br>
  <br>
  <div style=' overflow:hidden; #000000;'>
  <div class='style3' style='height:200px; width:33%; border: 1px solid #000000; float:left;'>
<center>
  <p class='style6'><u>RECOMMENDED</u></p>
  <br>
  <p class='style6'>(Signature of HOD/HOC)</p><br>
  <p class='style6'>(Seal)</p>
  </center>
</div>
 
  <div class='style3' style='height:200px; width:35%; left:30%; float:left; border: 1px solid #000000;'>
  


  <p class='style6'>The approx cost of indent is Rs.....................................<br>Submitted for approval please<br>........................................... <br>This requisition is approved<br><br />
  <p align='right' class='style6'> (Librarian/Registrar)</p>
  </div>
  
   <div class='style3' style=' height:200px; width:30%; float:right;  border: 1px solid #000000;'>

  <p class='style6'><b><u>Project</u></b> </p>
  <p class='style6'>1. Project No............................<br>2. Name of P.I. .....................................................................<br>
  Recommended<p align='right' class='style6'> (Signature of PI)</p>
  </div>

</div>

  
  <div style='border: 1px solid #000000;'>
  <p><font size=4><u>FOR OFFICE USE ONLY</u></font></p>
  Order No.: CL/.............................................................................................................../  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Date...................................... <br>
P.R. No.: ......................................................................................................................./  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;Date...................................... <br><br>
Vendor'sName:.....................................................................................................................................<br>
<br>
Bill No.:................................................................................Date..............................................................<br>Amount(in Rs.)...................................................................................................................<br>
<br />Number of copies received .............................................................................................................................................................................................................................   <br>
<hr />
</div>
	
	"
	
?>		
</div>

<br>
<br>

<center><input class="button-style" type="button" value="PRINT" onclick="printDiv()"/></center>

		</table>
	</div>	
	

	
	
	
		
</div>

</body>
</html>

<?php
drawFooter();
?>
