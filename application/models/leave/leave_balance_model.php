<?php

class Leave_balance_model extends CI_Model
{
	function commuted_leave_balance()
	{
		$connect=mysqli_connect('localhost','root','');
		$user_id=$this->session->userdata('id');
		$query=$this->db->query("SELECT * from emp_basic_details where id='$user_id'");
		foreach($query->result() as $row)
		$date_of_join=$row->joining_date;
		$year_of_join=date("Y",strtotime($date_of_join));
		$month_of_join=date("Y",strtotime($date_of_join));
		$year_today=date("Y",strtotime('today'));
		$month_today=date("m",strtotime('today'));
		$total_half_pay_leave = floor(((12-month_of_join)*20)/12) + ($year_today-$year_of_join-1)*20;
		$total_commuted_leave_period=0;
		$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Commuted Leave' and leave_status!=0");
		foreach($query->result() as $row)
		{
			$total_commuted_leave_period=$total_commuted_leave_period+$row->period;
		}
		$rem_half_pay=$total_half_pay_leave-(2*$total_commuted_leave_period);
		$rem_comm = floor($rem_half_pay/2);
		if(240-$total_commuted_leave_period<$rem_comm)
			$rem_comm=240-$total_commuted_leave_period;
		$res[0]=$rem_half_pay;
		$res[1]=$rem_comm;
		return $res;
	}
	
	function casual_leave_balance()
	{
		$connect=mysqli_connect('localhost','root','');
		$user_id=$this->session->userdata('id');
		$year_today=date("Y",strtotime('today'));
		$tot=8;
		$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Casual Leave' and leave_status!=0");
		foreach($query->result() as $row)
		{
			$leave_year=date("Y",strtotime($row->leave_from));
			if($leave_year==$year_today)
				$tot=$tot-($row->period);
		}
		return $tot;
	}
	
	function restricted_leave_balance()
	{
		$connect=mysqli_connect('localhost','root','');
		$user_id=$this->session->userdata('id');
		$year_today=date("Y",strtotime('today'));
		$rem=0;
		$query=$this->db->query("SELECT * from restricted_holidays");
		foreach($query->result() as $row)
		{
			$leave_date=$row->holiday_date;
			if(strtotime($leave_date)>strtotime('today'))
				$rem++;
		}
		$tot=2;
		$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Restricted Leave' and leave_status!=0");
		foreach($query->result() as $row)
		{
			$leave_year=date("Y",strtotime($row->leave_from));
			if($leave_year==$year_today)
				$tot-=($row->period);
		}
		if($rem<$tot)
			$tot=$rem;
		return $tot;
		
	}
	
	function earned_leave_balance()
	{
		$connect=mysqli_connect('localhost','root','');
		$user_id=$this->session->userdata('id');
		$query=$this->db->query("SELECT * from leave_balance where emp_id='$user_id'");
		if($query->num_rows()==0)
		{
			$query=$this->db->query("SELECT * from emp_basic_details where id='$user_id'");
			foreach($query->result() as $row)
			$date_of_join=$row->joining_date;
			$year_of_join=date("Y",strtotime($date_of_join));
			$month_of_join=date("m",strtotime($date_of_join));
			$year_today=date("Y",strtotime('today'));
			$month_today=date("m",strtotime('today'));
			$leave_rel_balance=($year_today-$year_of_join)*30;
			if($leave_rel_balance>300)
				$leave_rel_balance=300;
			if($leave_rel_balance<15)
				$leave_rel_balance=15;
			$today=date("Y-m-d",strtotime('today'));
			$query=$this->db->query("INSERT into leave_balance VALUES('$user_id','$leave_rel_balance','$today')");
			return $leave_rel_balance;
		}
		else{
		foreach($query->result() as $row)
		return $row->earned_leave_bal;}
	}
	
	function vacation_leave_balance()
	{
		$connect=mysqli_connect('localhost','root','');
		$user_id=$this->session->userdata('id');
		$year_today=date("Y",strtotime('today'));
		$tot=60;
		$tot_remaining_vacation=0;
		$query=$this->db->query("SELECT * from vacation_leave_dates");
		foreach($query->result() as $row)
		{
				$start_date=$row->start_date;
				$end_date=$row->end_date;
				$today=date("Y-m-d",strtotime('today'));
				$leave_year=date("Y",strtotime($start_date));
				$year_today=date("Y",strtotime($today));
				if($leave_year==$year_today){
				$period=floor((strtotime($end_date)-strtotime($start_date))/(60*60*24))+1;
				if(strtotime($start_date)>strtotime($today))
					$tot_remaining_vacation+=($period);
				else if(strtotime($end_date)<=strtotime($today));
				else
				{
					$addend=floor((strtotime($end_date)-strtotime($today))/(60*60*24))+1;
					$tot_remaining_vacation+=$addend;
				}}
		}
		$tot_taken_vacation=0;
		$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_type='Vacation Leave' and leave_status!=0");
		foreach($query->result() as $row)
		{
			$start_date=$row->leave_from;
			$end_date=$row->leave_to;
			$today=date("Y-m-d",strtotime('today'));
				$leave_year=date("Y",strtotime($start_date));
				$year_today=date("Y",strtotime($today));
				if($leave_year==$year_today){
				$period=floor((strtotime($end_date)-strtotime($start_date))/(60*60*24))+1;
				if(strtotime($start_date)>strtotime($today))
					$tot_taken_vacation+=($period);
				else if(strtotime($end_date)<=strtotime($today));
				else
				{
					$addend=floor((strtotime($end_date)-strtotime($today))/(60*60*24))+1;
					$tot_taken_vacation+=$addend;
				}}	
		}
		return $tot_remaining_vacation-$tot_taken_vacation;
	}
	
	
	
	function get_leave_balance()
	{
		$connect=mysqli_connect('localhost','root','');
		$desc[0]=$this->casual_leave_balance();
		$desc[1]=$this->restricted_leave_balance();
		$desc[2]=$this->earned_leave_balance();
		$temp=$this->commuted_leave_balance();
		$desc[3]=$temp[0];
		$desc[4]=$temp[1];
		$desc[5]=$this->vacation_leave_balance();
		return $desc;
	}
}