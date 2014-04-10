<?php 
$num=$_GET['q'];

$i=1;
echo"<table>";
while($i<=$num)
{

echo "	
				<tr>
				<td><b>BOOK $i : </b><br>*Accession No.</h3></td>
				<td><input type='text' size='30' id='accesion_no' name='accession_no";echo $i; echo "'/></td>
				</tr>
	
";
$i=$i+1;
}
echo"</table>";
?>