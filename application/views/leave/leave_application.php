
			
			<?php
			if($set==TRUE)
			{
				
				if($var==TRUE)
					$this->notification->drawNotification('',$desc,'success');
				else
					$this->notification->drawNotification('',$desc,'error');
			}
			echo "<br><br>";
			 $user_name=$this->session->userdata('name');
			 $descp="Welcome ".$user_name."<br>Please enter what kind of leave you want to take and its period.</br>";
			 $descp2="<br><h3 class='page-head' align='center'>$descp</align></h3></br>";
			 echo $descp2;
			 echo "<br>";
			 ?>
			 
			
			 <table border="1" align="center">
			 <?php
			 $auth_id=$this->session->userdata('auth');
			 if($auth_id[1]=='ft'){
			 $categories = array(
							  '$'=>'--Please Select--',
							  'Casual Leave'=>'Casual Leave',
							  'Restricted Holidays'=>'Restricted Holidays',
							  'Earned Leave'=>'Earned Leave',
							  'Commuted Leave'=>'Commuted Leave',
			 'Vacation Leave'=>'Vacation Leave');}
			 else{
				 $categories = array(
							  '$'=>'--Please Select--',
							  'Casual Leave'=>'Casual Leave',
							  'Restricted Holidays'=>'Restricted Holidays',
							  'Earned Leave'=>'Earned Leave',
			 'Commuted Leave'=>'Commuted Leave');}
			 
			 $possibilities = array(
								'$'=>'--Please Select--',
								'yes'=>'Yes',
								'no'=>'No');
			 
			$js = 'onchange="javascript:
											if(this.value == \'Casual Leave\'){
												document.getElementById(\'pp\').style.display=\'\';}
												
											else{
												document.getElementById(\'pp\').style.display=\'none\';}
								"
						';
						
			$js2 ='onchange="javascript:
											if(this.value == \'yes\'){
												document.getElementById(\'leave_station_pp\').style.display=\'\';
												document.getElementById(\'leave_station_date\').style.display=\'\';
												document.getElementById(\'leave_station_time\').style.display=\'\';
												document.getElementById(\'return_station_date\').style.display=\'\';
												document.getElementById(\'return_station_time\').style.display=\'\';
												document.getElementById(\'address\').style.display=\'\';}
												
											else{
												document.getElementById(\'leave_station_pp\').style.display=\'none\';
												document.getElementById(\'leave_station_date\').style.display=\'none\';
												document.getElementById(\'leave_station_time\').style.display=\'none\';
												document.getElementById(\'return_station_date\').style.display=\'none\';
												document.getElementById(\'return_station_time\').style.display=\'none\';
											document.getElementById(\'address\').style.display=\'none\';}
								"
						';
			 $desc=$_SERVER['PHP_SELF'];
			 echo("<form action=$desc name='leave' method='POST'>");?>
			 <tr><td>Leave Type</td><td><?php echo form_dropdown('leave_type',$categories,$leave_name,$js); ?></td></tr>
			<?php
			 echo("</select></td></tr>");?>
			
			 <tr id='pp' style=<?php echo $desc_leave ?>><td>Purpose Of Casual Leave</td>
			 <td><input type='text' name='purpose_reason' value='<?php echo $leave_reason?>' method='POST' ></td></tr>
             <tr><td>Starting Period </td>            <td>  <input type='date' name='from' value=<?php echo $submit_leave_from?> method='POST' > </td></tr>
             <tr><td>Ending Period  </td>               <td> <input type='date' name='to' value=<?php echo $submit_leave_to?> method='POST'></td></tr>
			 <tr><td>Request For Permission To Leave Station</td><td><?php echo form_dropdown('avail_leave_station',$possibilities, $avail_leave_st,$js2);?></td></tr>
			 <tr id='leave_station_pp' style=<?php echo $desc_avail ?>>
			 <td> Purpose Of Leaving Station</td>
			 <td> <input type='text' name='leave_station_purpose' value= '<?php echo $avail_reason ?>' method='POST'></td>
			 </tr>
			 <tr id='leave_station_date' style=<?php echo $desc_avail ?>>
			 <td> Proposed Date Of Leaving Station </td>
			 <td> <input type='date' name='leave_st_date' value=<?php echo $avail_date_st?> method='POST'></td></tr>
			 
			 <tr id='leave_station_time' style=<?php echo $desc_avail ?>>
			 <td> Proposed Time Of Leaving Station </td>
			 <td> <input type='time' name='leave_st_time' value=<?php echo $avail_time_st?> method='POST'></td></tr>
			 
			 <tr id='return_station_date' style=<?php echo $desc_avail ?>>
			 <td> Proposed Date Of Returning To Station </td>
			 <td> <input type='date' name='return_st_date' value=<?php echo $avail_date_end?> method='POST'></td></tr>
			 
			 <tr id='return_station_time' style=<?php echo $desc_avail ?>>
			 <td> Proposed Time Of Returning To Station </td>
			 <td> <input type='time' name='return_st_time' value=<?php echo $avail_time_end?> method='POST'></td></tr>
			 
			 <tr id='address' style=<?php echo $desc_avail ?>>
			 <td> Address During Absence From Station</td>
			 <td> <input type='text' name='absence_address' value='<?php echo $avail_add?>' method='POST'></td></tr>
			 
             <tr><td><input type='submit' name='submit' value='Submit Leave Request' align='center'></td></tr>
             </center>
			 </form>
			 </table>
			 <br><br><br>
			 
 
      
</body>
</html>