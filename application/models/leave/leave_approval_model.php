<?php

class Leave_Approval_Model extends CI_Model
{
	function get_auth_type_logged_in()
	{
		$user_id=$this->session->userdata('id');
		$query=$this->db->query("SELECT * from user_auth_types where id='$user_id'");
		if($query->num_rows()==0)
			return "NULL";
		else
		{
			foreach($query->result() as $row)
			{
				return $row->auth_id;
			}
		}
	}
	
	function get_dept($user_id)
	{
		$query=$this->db->query("SELECT * from user_details where id='$user_id'");
		foreach($query->result() as $row)
		$user_dept=$row->dept_id;
		return $user_dept;
	}
	
	function get_auth_type_normal($user_id)
	{
		$query=$this->db->query("SELECT * from emp_basic_details where id='$user_id'");
		foreach($query->result() as $row)
		$user_auth=$row->auth_id;
		return $user_auth;
	}
	
	function get_auth_type_special($user_id)
	{
		$query=$this->db->query("SELECT * from user_auth_types where id='$user_id'");
		if($query->num_rows()==0)
			return "NULL";
		else
		{
			foreach($query->result() as $row)
			{
				return $row->auth_id;
			}
		}
	}
	
	function is_authorized()
	{
		if($this->get_auth_type_logged_in()=="NULL")
			return FALSE;
		return TRUE;
	}
	
	function index_approved($leave_index)
	{
		$user_id=$this->session->userdata('id');
		$user_normal_auth_type_arr=$this->session->userdata('auth');
		$user_normal_auth_type=$user_normal_auth_type_arr[1];
		$query=$this->db->query("SELECT * from leave_details where leave_id='$leave_index'");
		foreach($query->result() as $row)
		{
			$leave_name=$row->leave_type;
			$leave_period=$row->period;
			if($leave_name='Casual Leave' || $leave_name='Restricted Holidays'||($leave_name=='Earned Leave' && $leave_period<=10))
			{
				$nest_query=$this->db->query("UPDATE leave_details SET leave_status=99 where leave_id='$leave_index'");
			}
			else
			{
				$leave_app_normal_auth=$this->get_auth_type_normal($row->emp_id);
				$leave_app_special_auth=$this->get_auth_type_special($row->emp_id);
				if($leave_app_normal_auth=='ft')
				{
					if($leave_app_special_auth=='NULL')
					{
						if($row->leave_status==1)
						$nest_query=$this->db->query("UPDATE leave_details SET leave_status=2 where leave_id='$leave_index'");
						else
						$nest_query=$this->db->query("UPDATE leave_details SET leave_status=99 where leave_id='$leave_index'");
					}
					else if($leave_app_special_auth=='hod')
					$nest_query=$this->db->query("UPDATE leave_details SET leave_status=99 where leave_id='$leave_index'");
				}
				else
				{
					if($leave_app_special_auth=='NULL')
					{
						if($row->leave_status<=4)
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=($row->leave_status + 1) where leave_id='$leave_index'");
						else
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=99 where leave_id='$leave_index'");
					}
					else if($leave_app_special_auth=='hod')
					{
						if($row->leave_status<=3)
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=($row->leave_status + 1) where leave_id='$leave_index'");
						else
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=99 where leave_id='$leave_index'");
					}
					else if($leave_app_special_auth=='est_ar')
					{
						if($row->leave_status<=2)
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=($row->leave_status + 1) where leave_id='$leave_index'");
						else
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=99 where leave_id='$leave_index'");
					}
					else if($leave_app_special_auth=='dr')
					{
						if($row->leave_status<=1)
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=($row->leave_status + 1) where leave_id='$leave_index'");
						else
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=99 where leave_id='$leave_index'");
					}
					else if($leave_app_special_auth=='reg')
					$nest_query=$this->db->query("UPDATE leave_details SET leave_status=99 where leave_id='$leave_index'");
				}
			}
		}
	}
	
	function index_disapproved($leave_index)
	{
		$user_id=$this->session->userdata('id');
		$user_normal_auth_type_arr=$this->session->userdata('auth');
		$user_normal_auth_type=$user_normal_auth_type_arr[1];
		$query=$this->db->query("SELECT * from leave_details where leave_id='$leave_index'");
		foreach($query->result() as $row)
		{
			$leave_name=$row->leave_type;
			$leave_period=$row->period;
			if(0==1);
			else
			{
				$leave_app_normal_auth=$this->get_auth_type_normal($row->emp_id);
				$leave_app_special_auth=$this->get_auth_type_special($row->emp_id);
				if($leave_app_normal_auth=='ft')
				{
					if($leave_app_special_auth=='NULL')
					{
						if($row->leave_status==1)
						$nest_query=$this->db->query("UPDATE leave_details SET leave_status=3 where leave_id='$leave_index'");
						else
						$nest_query=$this->db->query("UPDATE leave_details SET leave_status=4 where leave_id='$leave_index'");
					}
					else if($leave_app_special_auth=='hod')
					$nest_query=$this->db->query("UPDATE leave_details SET leave_status=2 where leave_id='$leave_index'");
				}
				else
				{
					if($leave_app_special_auth=='NULL')
					{
						if($row->leave_status<=5)
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=($row->leave_status + 5) where leave_id='$leave_index'");
					}
					else if($leave_app_special_auth=='hod')
					{
						if($row->leave_status<=4)
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=($row->leave_status + 4) where leave_id='$leave_index'");
					}
					else if($leave_app_special_auth=='est_ar')
					{
						if($row->leave_status<=3)
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=($row->leave_status + 3) where leave_id='$leave_index'");
					}
					else if($leave_app_special_auth=='dr')
					{
						if($row->leave_status<=2)
							$nest_query=$this->db->query("UPDATE leave_details SET leave_status=($row->leave_status + 2) where leave_id='$leave_index'");
						
					}
					else if($leave_app_special_auth=='reg')
					$nest_query=$this->db->query("UPDATE leave_details SET leave_status=2 where leave_id='$leave_index'");
				}
			}
		}
		if($leave_name=='Earned Leave')
		{
			$nest_query=$this->db->query("SELECT * from leave_balance where emp_id='$user_id'");
			foreach($nest_query->result() as $row)
			$earned_leave_bal=$row->earned_leave_bal;
			$earned_leave_bal+=($row->period);
			$query=$this->db->query("UPDATE leave_balance SET earned_leave_bal='$earned_leave_bal' where emp_id='$user_id'");
		}
	}
	
	function add_remarks()
	{
		$leave_id=$this->session->userdata('leave_id');
		$leave_comment=$this->sessio->userdata('comments');
		$query=$this->db->query("UPDATE leave_details SET remarks='$leave_comment' where leave_id='$leave_id'");
	}
	
	function approved_leave_comment($leave_index)
	{
		$query=$this->db->query("SELECT * from leave_details where leave_id='$leave_index'");
		foreach($query->result() as $row)
		{
			$leave_app_id=$row->emp_id;
			$nest_query=$this->db->query("SELECT * from user_details where id='$leave_app_id'");
			foreach($nest_query->result() as $row2)
			{
				$salutation=$row2->salutation;
				$first_name=$row2->first_name;
				$middle_name=$row2->middle_name;
				$last_name=$row2->last_name;
				$desc[0]="You have approved the ".$row->leave_type." of ".$salutation." ".$first_name." ".$middle_name." ".$last_name." for the period ".$row->leave_from." to ".$row->leave_to;
			}
			$user_auth=$this->get_auth_type_normal($leave_app_id);
			$user_special_auth=$this->get_auth_type_special($leave_app_id);
			$desc[1]="";
			if($user_auth=='ft')
			{
				if($user_special_auth=='NULL')
				{
					if($row->leave_status==2)
						$desc[1]="This leave request will be forwarded to director for further approval.";
				}
			}
			else if($user_auth=='nftn' || $user_auth=='nfta')
			{
				if($user_special_auth=='NULL')
				{
					if($row->leave_status==2)
						$desc[1]="This leave request will be forwarded to assistant registrar for further approval.";
					else if($row->leave_status==3)
						$desc[1]="This leave request will be forwarded to departmental deputy registrar for further approval.";
					else if($row->leave_status==4)
						$desc[1]="This leave request will be forwarded to registrar for further approval.";
					else if($row->leave_status==5)
						$desc[1]="This leave request will be forwarded to director for further approval.";
				}
				else if($user_special_auth=='hod')
				{
					if($row->leave_status==2)
						$desc[1]="This leave request will be forwarded to departmental deputy registrar for further approval.";
					else if($row->leave_status==3)
						$desc[1]="This leave request will be forwarded to registrar for further approval.";
					else if($row->leave_status==4)
						$desc[1]="This leave request will be forwarded to director for further approval.";
				}
				else if($user_special_auth=='est_ar')
				{
					if($row->leave_status==2)
						$desc[1]="This leave request will be forwarded to registrar for further approval.";
					else if($row->leave_status==3)
						$desc[1]="This leave request will be forwarded to director for further approval.";
				}
				else if($user_special_auth=='dr')
				{
					if($row->leave_status==2)
						$desc[1]="This leave request will be forwarded to director for further approval.";
				}
			}
		}
		$acc_comm=$desc[0].$desc[1];
		return $acc_comm;
	}
	
	
	function disapproved_leave_comment($leave_id,$remarks)
	{
		$this->index_disapproved($leave_id);
		$query=$this->db->query("UPDATE leave_details SET remarks='$remarks' where leave_id='$leave_id'");
		$query=$this->db->query("SELECT * from leave_details where leave_id='$leave_id'");
		foreach($query->result() as $row)
		{
			$leave_app_id=$row->emp_id;
			$nest_query=$this->db->query("SELECT * from user_details where id='$leave_app_id'");
			foreach($nest_query->result() as $row2)
			{
				$salutation=$row2->salutation;
				$first_name=$row2->first_name;
				$middle_name=$row2->middle_name;
				$last_name=$row2->last_name;
				$desc="You have disapproved the ".$row->leave_type." of ".$salutation." ".$first_name." ".$middle_name." ".$last_name." for the period ".$row->leave_from." to ".$row->leave_to." for the following reason:<br>".$row->remarks;
			}
		}
		return $desc;
	}
}