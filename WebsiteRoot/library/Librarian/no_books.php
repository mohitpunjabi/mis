<?php 
$num=$_GET['q'];

$i=1;
echo"<table>";
while($i<=$num)
{

echo "	
			<tr>
			<td width=200><b>BOOK $i : </b><br>*Accession No.</u></td>
			<td><input type='text' size='39' id='accession_no' name='accession_no";echo $i; echo "'/></td>
			</tr>
		
";
$i=$i+1;
}
echo"</table>";
?>