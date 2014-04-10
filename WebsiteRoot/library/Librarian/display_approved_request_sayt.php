<style type="text/css">
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
            border: 7px groove #000;
            background-color: white;
            z-index:1002;
            overflow: auto;
        }
</style>
<div id="content">
<table align="center">
<?php
// Fill up array with names

//get the q parameter from URL
$q=$_GET["q"];
$t=0;
require("connect.php");
$select=mysql_query("SELECT * from cselib_request_details where emp_name like '%$q%'") or die(mysql_error());
if(mysql_num_rows($select)==0 )
  {
    echo "<tr><td>NO ENTRY IN THIS SECTION</td></tr>";
  }
  else
  {

    
        
  echo " 
        <tr>
        
        <th width=400>Request No.</td>
          <th width=400>Employee Name</td>
          <th width=400>Book Name</td>
        
      </tr>

  ";
  
  
        
  $i=0;
  while($row=mysql_fetch_assoc($select))
  {
    $i++;
    $req_num=$row['request_num'];
    $emp_name=$row['emp_name'];
    $book_name=$row['book_name'];
        
    echo " <tr>
   
        <td>
        <center>
        <a href = \"javascript:void(0)\" onclick = \"document.getElementById('light"; echo $i; echo"').style.display='block';document.getElementById('fade"; echo $i; echo "').style.display='block'\">$req_num</a>
        </center>
        </td>
          
        <td><center>$emp_name</center></td>
          <td><center>$book_name</center></td>";
         
         
        
         
         
       echo " <div id=\"light"; echo $i; echo "\" class=\"white_content\">";
    
    
    
    
    
    {
        $design=$row['design'];
        $author=$row['author'];
        $publication=$row['publication'];
        $edition=$row['edition'];
        $no_copies=$row['no_copies'];
        $price=$row['price_unit'];
        $date=$row['date_request'];
        echo "<center><span class='style4'><u>BOOK DETAILS</u></span></center>";
        echo "<br><center>Request No.&emsp;:&emsp;<b>".$req_num."</b><br><br><b>".$design." ".$emp_name. " </b> has requested the book named <b> 
        ".$book_name."</b> . <br><br> Date of Request :<b>".$date."</b><br><br>Author/publication &nbsp;:&nbsp;<b>".$author."</b> <b>(".$publication.")</b> <br><br>Edition : <b>".$edition."
        </b><br><br> Copies :<b>".$no_copies."</b><center>";
    
    }
    
    
    echo "<br><a href = \"javascript:void(0)\" onclick = \"document.getElementById('light"; echo $i; echo "').style.display='none';document.getElementById('fade"; echo $i; echo "').style.display='none'\"><center>Close</center></a></div>
        <div id=\"fade"; echo $i; echo "\" class=\"black_overlay\"></div>
         
        
   
  </tr> ";
  }
}

?>
</table>
</div>