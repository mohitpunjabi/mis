<?php

$cnt=$info[0][0];

echo("<div><div>	

 <table border=1>
<tr><th>Leave Type</th><th>Starting Period</th><th>Ending Period</th><th>Number of Days</th></tr>");


for($inc=1;$inc<$cnt;$inc++)
{
	$leave_type=$info[$inc][2];
	$leave_from=date('d-m-Y',strtotime($info[$inc][3]));
	$leave_to=date('d-m-Y',strtotime($info[$inc][4]));
	$leave_period=$info[$inc][5];
    echo("<tr><td>$leave_type</td><td>$leave_from</td><td>$leave_to</td><td>$leave_period</td></tr>");
}

 echo("</table></div><div>");
 ?>