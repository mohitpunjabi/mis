<?php

class Leave_application_notification_model extends CI_Model
{
	function modify_date($date)
	{
		$month=date("m",strtotime($date));
		$year=date("Y",strtotime($date));
		$day=date("d",strtotime($date));
		$desc=$day."-".$month."-".$year;
		return $desc;
	}
	
	function session_variables()
	{
		$desc[0]=$this->session->userdata['id'];
		$query=$this->db->query("SELECT * from emp_basic_details where id='$desc[0]'");
		foreach($query->result() as $row)
		$desc[1]=$row->designation;
		return $desc;
	}
	
	function get_leave_id($emp_id,$desg,$leave_name,$start_date,$end_date)
	{
		$query=$this->db->query("SELECT * from leave_details where emp_id='$emp_id' and leave_type='$leave_name' and leave_from='$start_date' and leave_to='$end_date'");
		foreach($query->result() as $row)
		return $row->leave_id;
	}
	
	function insert_leave_station_details($leave_id,$leave_date,$leave_time,$return_date,$return_time,$leave_purpose,$address)
	{
		$this->db->query("INSERT into leave_station_details VALUES('$leave_id','$leave_date','$leave_time','$return_date','$return_time','$leave_purpose','$address')");
	}
	
	function insert_purpose_details($leave_id,$purpose)
	{
		$this->db->query("INSERT into leave_purpose VALUES('$leave_id','$purpose')");
	}
	
	function insert($emp_id,$desg,$leave_name,$start_date,$end_date,$period,$leave_st)
	{
		$this->db->query("INSERT into leave_details VALUES('','$emp_id','$desg','$leave_name','$start_date','$end_date','$period','$leave_st','')");
	}
	
	function check_overlap($leave_from,$leave_to)
	{
		$user_id=$this->session->userdata('id');
		$query=$this->db->query("SELECT * from vacation_leave_dates");
		foreach($query->result() as $row)
		{
			$start_date=$row->start_date;
			$end_date=$row->end_date;
			if(!(strtotime($start_date)>strtotime($leave_to) || strtotime($end_date)<strtotime($leave_from)))
			{
				$description="Your leave approval period clashes with the vacation leave period between ".$this->modify_date($start_date)." and ".$this->modify_date($end_date);
				$desc[0]=FALSE;
				$desc[1]=$description;
				return $desc;
			}
		}
		$desc[0]=TRUE;
		return $desc;
	}
	
	function check_leave_validity($leave_type,$leave_from,$leave_to)
	{
		$user_id=$this->session->userdata('id');
		$today = date("Y-m-d", strtotime('today'));
		$check=1;
		if(strtotime($leave_from)>strtotime($leave_to)){
			$check=0;
		$description="Your ending date should be after starting date";}
		else if(strtotime($leave_from)<=strtotime($today)){
			$check=0;
		$description="Your starting date should be after today's date";}
		else
		{
			
			$connect = mysqli_connect("localhost","root","") or die ("mysql_error()");
			$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status!=0");
			foreach($query->result() as $row)
			{
				$start_date=$row->leave_from;
				$end_date=$row->leave_to;
				$leave_name=$row->leave_type;
				$leave_st=$row->leave_status;
				if($leave_st=='99')
					$leave_desc="approved ";
				else
					$leave_desc="pending ";
				if(!(strtotime($leave_to)<strtotime($start_date) || strtotime($leave_from)>strtotime($end_date))){
					$check=0;
				$description="Your leave request is clashing with your ".$leave_desc.$leave_name." from ".$this->modify_date($start_date)." to ".$this->modify_date($end_date);}
			}
		}
		if($check==0)
		{
			$desc[0]=FALSE;
			$desc[1]=$description;
		}
		else
		{
			$desc[0]=TRUE;
		}
		return $desc;
	}
	
	function check_casual_leave($leave_from,$leave_to)
	{
		$diff=strtotime($leave_to)-strtotime($leave_from);
		$period = floor($diff/ (60*60*24))+1;
		$timestamp=strtotime($leave_from);
		$count=0;
		while($timestamp<=strtotime($leave_to))
		{
			if(date('l',$timestamp)=='Saturday' || date('l',$timestamp)=='Sunday')
				$count++;
			$timestamp+=(86400);
		}
		$period-=$count;
		$user_id=$this->session->userdata('id');
		if($period>5){
			$description="You can apply for casual leave for maximum 5 days at stretch";
			$desc[0]=FALSE;
			$desc[1]=$description;
			return $desc;
		}
		$remaining_period=8;
		$year=date("Y",strtotime($leave_from));
		$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Casual Leave' and leave_status!=0");
		foreach($query->result() as $row)
		{
			$leave_year=date("Y",strtotime($row->leave_from));
			if($leave_year==$year)
			$remaining_period=$remaining_period-($row->period);
		}
		if($remaining_period<$period){
			$description="You cannot take a "."Casual Leave of ".$period." days. "."Your Casual Leave balance is ".$remaining_period." days.";
			$desc[0]=FALSE;
			$desc[1]=$description;
			return $desc;
		}
		$desc[0]=TRUE;
		return $desc;
	}
	
	
	
	function check_earned_leaves($leave_from,$leave_to)
	{
		$diff=strtotime($leave_to)-strtotime($leave_from);
		$period = floor($diff/ (60*60*24))+1;
		$user_id=$this->session->userdata('id');
		$year_today=date('Y',strtotime('today'));
		$month_today=date('m',strtotime('today'));
		$query=$this->db->query("SELECT * from leave_balance where emp_id='$user_id'");
		if($query->num_rows()==0)
		{
			$query=$this->db->query("SELECT * from emp_basic_details where id='$user_id'");
			foreach($query->result() as $row)
			$date_of_join=$row->joining_date;
			$year_of_join=date('Y',strtotime($date_of_join));
			$month_of_join=date('m',strtotime($date_of_join));
			$leave_rel_balance=($year_today-$year_of_join)*30;
			if($leave_rel_balance>300)
				$leave_rel_balance=300;
			if($leave_rel_balance<15)
				$leave_rel_balance=15;
			$today=date("Y-m-d",strrotime('today'));
			$query=$this->db->query("INSERT into leave_balance VALUES('$user_id','$leave_rel_balance','$today')");
		}
		else
		{
			foreach($query->result() as $row)
			{
				$modify_date=$row->last_update;
				$earned_leave_bal=$row->earned_leave_bal;
				$modify_month=date('m',strtotime($modify_date));
				$modify_year=date('Y',strtotime($modify_date));
				while($modify_year<$year_today)
				{
					if($modify_month<6)
					{
						if($earned_leave_bal>300)
							$earned_leave_bal=300;
						$earned_leave_bal=$earned_leave_bal + 15;
						$modify_month=7;
					}
					else
					{
						if($earned_leave_bal>300)
							$earned_leave_bal=300;
						$earned_leave_bal+=15;
						$vac_leave_tot=0;
						$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Vacation Leave' and leave_status!=0");
						foreach($query->result() as $row)
						{
							$start_date=$row->leave_from;
							$vac_leave_yr=date('Y',strtotime($start_date));
							if($vac_leave_yr==$modify_year)
								$vac_leave_tot+=($row->period);
						}
						$val=60-$vac_leave_tot;
						$val=floor($val/2);
						$earned_leave_bal+=$val;
						$modify_month=1;
						$modify_year++;
					}
				}
				if($month_today>6)
				{
					if($earned_leave_bal>300)
						$earned_leave_bal=300;
					$earned_leave_bal+=15;
				}
				$query=$this->db->query("UPDATE leave_balance SET earned_leave_bal='$earned_leave_bal' where emp_id='$user_id'");
				$auth=$this->session->userdata('auth');
				if($auth[1]=='ft')
					$max_period=60;
				else
					$max_period=120;
				if($period>$max_period)
				{
					$description="The Earned Leave you requested for extends over a period of ".$period." days. You can take an Earned Leave of maximum ".$max_period." days";
					$desc[0]=FALSE;
					$desc[1]=$description;
					return $desc;
				}
				else if($earned_leave_bal<$period)
				{
					$description="Your earned leave balance is ".$earned_leave_bal." The Earned Leave which you requested extends over a period of ".$period." days";
					$desc[0]=FALSE;
					$desc[1]=$description;
					return $desc;
				}
				$earned_leave_bal-=$period;
				$query=$this->db->query("UPDATE leave_balance SET earned_leave_bal='$earned_leave_bal' where emp_id='$user_id'");
				$desc[0]=TRUE;
				return $desc;
			}
		}
	}
	
	/*function check_earned_leave($leave_from,$leave_to)
	{
		$diff=strtotime($leave_to)-strtotime($leave_from);
		$period = floor($diff/ (60*60*24))+1;
		$user_id=$this->session->userdata('id');
		$query=$this->db->query("SELECT * from emp_basic_details where emp_id='$user_id'");
		foreach($query->result() as $row)
		$date_of_join=$row->joining_date;
		$year_of_join=date('Y',strtotime($date_of_join));
		$month_of_join=date('m',strtotime($date_of_join));
		$year_today=date('Y',strtotime('today'));
		$month_today=date('m',strtotime('today'));
		$leave_rel_balance=0;
		if($year_today==$year_of_join)
		{
			$add=(floor)(6-$month_of_join)*5;
			$add=(floor)($add/2);
			if(month_today<=6);
			else
			{
				if($month_of_join<=6)
				{
					$add=$add+15;
				}
				else
				{
					$add=(12-month_of_join)*5;
					$add=(floor)$add/2;
				}
			}
			$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Earned Leave'");
			while($query->result() as $row)
			{
				$add=$add-$row->period;
			}
			$leave_rel_balance=$add;
		}
		else
		{
			if($month_of_join<=6)
			{
				$add = (floor) ((6-month_of_join)*5)/2 + 15;
			}
			else
			{
				$add=(floor) ((12-month_of_join)*5)/2;
			}
			$rem_year=$year_today-$year_of_join-1;
			$add=$add+(15*$rem_year);
			if($month_today>6)
				$add=$add+15;
			$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Earned Leave'");
			while($query->result() as $row)
			{
				$add=$add-$row->period;
			}
			if($add>300)
				$add=300;
			$add=$add+15;
			$leave_rel_balance=$add;
		}
		$auth=$this->session->userdata('auth');
		if($auth[1]=='ft')
			$max_period=60;
		else
			$max_period=120;
		if($period>$max_period);
		{
			$description="The Earned Leave you requested for extends over a period of ".$period." days. You can take an Earned Leave of maximum ".$max_period." days";
			return FALSE;
		}
		else if($leave_rel_balance<$period)
		{
			$description="Your earned leave balance is ".$leave_rel_balance." The Earned Leave which you requested extends over a period of ".$period." days";
			return FALSE;
		}
		return TRUE;
	}*/
	
	
	
	function check_commuted_leave($leave_from,$leave_to)
	{
		$diff=strtotime($leave_to)-strtotime($leave_from);
		$period = floor($diff/ (60*60*24))+1;
		$user_id=$this->session->userdata('id');
		$query=$this->db->query("SELECT * from emp_basic_details where id='$user_id'");
		foreach($query->result() as $row)
		$date_of_join=$row->joining_date;
		$year_of_join=date('Y',strtotime($date_of_join));
		$month_of_join=date('m',strtotime($date_of_join));
		$year_today=date('Y',strtotime('today'));
		$month_today=date('m',strtotime('today'));
		$total_half_pay_leave = floor(((12-month_of_join)*20)/12) + ($year_today-$year_of_join-1)*20;
		$total_commuted_leave_period=0;
		$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Commuted Leave' and leave_status!=0");
		foreach($query->result() as $row)
		{
			$total_commuted_leave_period=$total_commuted_leave_period+$row->period;
		}
		$rem_half_pay=$total_half_pay_leave-(2*$total_commuted_leave_period);
		if($rem_half_pay<2*$period)
		{
			$rem_comm=floor($rem_half_pay/2);
			$description="You cannot take Commuted Leave for a period of ".$period." days. Your half-pay leave balance is ".$rem_half_pay." days. You can take Commuted Leave of maximum ".$rem_comm." days.";
			$desc[0]=FALSE;
			$desc[1]=$description;
			return $desc;
		}
		else if($total_commuted_leave_period+$period>240)
		{
			$remm_comm=240-$total_commuted_leave_period;
			$description="Commuted Leave granted during entire service is limited to 240 days. You can take a Commuted Leave for a maximum period of ".$rem_comm." days.Your Commuted Leave request extends over a period of ".$period." days";
			$desc[0]=FALSE;
			$desc[1]=$description;
			return $desc;
		}
		$desc[0]=TRUE;
		return $desc;
	}
	
	
	
	function check_vacation_leave($leave_from,$leave_to)
	{
		$flag=0;
		$query=$this->db->query("SELECT * from vacation_leave_dates");
		foreach($query->result() as $row)
		{
			$start_date=$row->start_date;
			$end_date=$row->end_date;
			if(strtotime($leave_from)>=strtotime($start_date) && strtotime($leave_to)<=strtotime($end_date))
			{
				$desc[0]=TRUE;
				return $desc;
			}
		}
		$description="The period between ".$this->modify_date($leave_from)." and ".$this->modify_date($leave_to)." is not a vacation period. You can apply for vacation leave only during vacations.";
		$desc[0]=FALSE;
		$desc[1]=$description;
		return $desc;
	}
	
	
	
	function check_restricted_holiday($leave_from,$leave_to)
	{
		if($leave_from!=$leave_to)
		{
			$description="The period of a restricted holiday leave cannot exceed 1 day";
			$desc[0]=FALSE;
			$desc[1]=$description;
			return $desc;
		}
		else
		{
			$flag=FALSE;
			$query=$this->db->query("SELECT * from restricted_holidays");
			foreach($query->result() as $row)
			{
				if($row->holiday_date==$leave_from)
					$flag=TRUE;
			}
			if($flag==FALSE)
			{
				$description=" The day ".$this->modify_date($leave_from)." is not a restricted holiday.";
				$desc[0]=FALSE;
				$desc[1]=$description;
				return $desc;
			}
			else
			{
				$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Restricted Holiday' and leave_status!=0");
				$rh_count=0;
				$leave_app_year=date('Y',strtotime($leave_from));
				foreach($query->result() as $row)
				{
					$holiday_date=$row->leave_from;
					$holiday_year=date('Y',strtotime($holiday_date));
					if($hoilday_year==$leave_app_year)
						$rh_count=$rh_count+1;
				}
				if(rh_count==2)
				{
					$description="You have already applied for 2 restricted hoildays in the year ".$leave_app_year." You cannot apply for any more Restricted Holiday this year";
					$desc[0]=FALSE;
					$desc[1]=$description;
					return $desc;
				}
			}
			$desc[0]=TRUE;
			return $desc;
		}
	}
	
	function check_acceptable_leave($leave_type,$leave_from,$leave_to)
	{
		$desc=$this->check_leave_validity($leave_type,$leave_from,$leave_to);
		if($desc[0]==FALSE)
		{
			return $desc;
		}
		else
		{
			$desc=$this->check_overlap($leave_from,$leave_to);
			if($desc[0]==FALSE && $leave_type!='Vacation Leave')
				return $desc;
			if($leave_type=='Casual Leave')
			{
				$desc=$this->check_casual_leave($leave_from,$leave_to);
				return $desc;
			}
			else if($leave_type=='Earned Leave')
			{
				$desc=$this->check_earned_leaves($leave_from,$leave_to);
				return $desc;
			}
			else if($leave_type=='Restricted Holidays')
			{
				$desc=$this->check_restricted_holiday($leave_from,$leave_to);
				return $desc;
			}
			else if($leave_type=='Commuted Leave')
			{
				$desc=$this->check_commuted_leave($leave_from,$leave_to);
				return $desc;
			}
			else 
			{
				$desc=$this->check_vacation_leave($leave_from,$leave_to);
				return $desc;
			}
		}
	}
	
}
?>