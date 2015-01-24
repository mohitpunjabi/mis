<?php
echo("<br><br><div id='k1' style='float:left;margin-left:02px;'>");
echo("<table border='1'>
<tr><th>Leave Type</th><th>Balance Due</th></tr>
<tr><td>Casual Leave</td><td>$casual</td></tr>
<tr><td>Restricted Holidays</td><td>$rh</td></tr>
<tr><td>Earned Leave</td><td>$earned</td></tr>
<tr><td>Half-Pay Leave</td><td>$half_pay</td></tr>
<tr><td>Commuted Leave</td><td>$commuted</td></tr>");
$auth=$this->session->userdata('auth');
if($auth[1]=='ft')
echo("<tr><td>Vacation Leave</td><td>$vacation</td></tr>
</table>");
?>