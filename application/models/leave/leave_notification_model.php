<?php

class Leave_notification_model extends CI_Model
{
	function modify_date($date)
	{
		$month=date("m",strtotime($date));
		$year=date("Y",strtotime($date));
		$day=date("d",strtotime($date));
		$desc=$day."-".$month."-".$year;
		return $desc;
	}
	
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
	
	function get_name($user_id)
	{
		$nest_query=$this->db->query("SELECT * from user_details where id='$user_id'");
		foreach($nest_query->result() as $row2)
		{
			$salutation=$row2->salutation;
			$first_name=$row2->first_name;
			$middle_name=$row2->middle_name;
			$last_name=$row2->last_name;
			$desc=$salutation." ".$first_name." ".$middle_name." ".$last_name;
		}
		return $desc;
	}
	
	function get_dept($user_id)
	{
		$query=$this->db->query("SELECT * from user_details where id='$user_id'");
		foreach($query->result() as $row)
		$user_dept=$row->dept_id;
		return $user_dept;
	}
	
	function get_dept_name($user_id)
	{
		$dept_id=$this->get_dept($user_id);
		$query=$this->db->query("SELECT * from departments where id='$dept_id'");
		foreach($query->result() as $row)
		return $row->name;
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
	
	function hod_notifications()
	{
		$cnt=1;
		$user_dept=$this->session->userdata('dept_id');
		$query=$this->db->query("SELECT * from leave_details where leave_status=1");
		foreach($query->result() as $row)
		{
			$leave_applicant_id=$row->emp_id;
			$special_auth_type=$this->get_auth_type_special($row->emp_id);
			$nest_query=$this->db->query("SELECT * from user_details where id='$leave_applicant_id'");
			foreach($nest_query->result() as $row2)
			$leave_applicant_dept=$row2->dept_id;
			if($leave_applicant_dept==$user_dept && $special_auth_type=='NULL')
			{
				$desc[$cnt][0]=$row->emp_id;
				$desc[$cnt][1]=$leave_applicant_dept;
				$desc[$cnt][2]=$row->designation;
				$desc[$cnt][3]=$row->leave_type;
				$desc[$cnt][4]=$row->leave_from;
				$desc[$cnt][5]=$row->leave_to;
				$desc[$cnt][6]=$row->period;
				$desc[$cnt][7]=$this->get_name($row->emp_id);
				$desc[$cnt][8]=$this->get_dept_name($row->emp_id);
				$desc[$cnt][9]=$row->leave_id;
				$cnt+=1;
			}
		}
		$desc[0][0]=$cnt;
		return $desc;
	}
	
	function assistant_registrar_notifications()
	{
		$cnt=1;
		$query=$this->db->query("SELECT * from leave_details");
		foreach($query->result() as $row)
		{
			$user_auth=get_auth_type_normal($row->emp_id);
			if($user_auth=='nftn' || $user_auth=='nfta')
			{
				$user_special_auth=get_auth_type_special($row->emp_id);
				if( ($user_special_auth=='NULL' && $row->leave_status==2)  ||  ($user_special_auth='hod' && $row->leave_status==1))
				{
					$desc[$cnt][0]=$row->emp_id;
					$desc[$cnt][1]=get_dept($row->emp_id);
					$desc[$cnt][2]=$row->designation;
					$desc[$cnt][3]=$row->leave_type;
					$desc[$cnt][4]=$row->leave_from;
					$desc[$cnt][5]=$row->leave_to;
					$desc[$cnt][6]=$row->period;
					$desc[$cnt][7]=$this->get_name($row->emp_id);
					$desc[$cnt][8]=$this->get_dept_name($row->emp_id);
					$desc[$cnt][9]=$row->leave_id;
					$cnt+=1;
				}
			}
		}
		$desc[0][0]=$cnt;
		return $desc;
	}
	
	function deputy_registrar_notifications()
	{
		$cnt=1;
		$user_dept=$this->session->userdata('dept_id');
		$query=$this->db->query("SELECT * from leave_details");
		foreach($query->result() as $row)
		{
			$is_applicable=FALSE;
			$normal_auth_type=$this->get_auth_type_normal($row->emp_id);
			$special_auth_type=$this->get_auth_type_special($row->emp_id);
			$leave_app_dept=$this->get_dept($row->emp_id);
			if($row->leave_status==3 && $normal_auth_type!='ft' && $leave_app_dept==$user_dept && $special_auth_type=='NULL')
				$is_applicable=TRUE;
			if($row->leave_status==2 && $normal_auth_type!='ft' && $special_auth_type=='hod' && $leave_app_dept==$user_dept)
				$is_applicable=TRUE;
			if($row->leave_status==1 && $special_auth_type=='est_ar')
				$is_applicable=TRUE;
			if($is_applicable==TRUE)
			{
					$desc[$cnt][0]=$row->emp_id;
					$desc[$cnt][1]=$leave_app_dept;
					$desc[$cnt][2]=$row->designation;
					$desc[$cnt][3]=$row->leave_type;
					$desc[$cnt][4]=$row->leave_from;
					$desc[$cnt][5]=$row->leave_to;
					$desc[$cnt][6]=$row->period;
					$desc[$cnt][7]=$this->get_name($row->emp_id);
					$desc[$cnt][8]=$this->get_dept_name($row->emp_id);
					$desc[$cnt][9]=$row->leave_id;
					$cnt+=1;	
			}
		}
		$desc[0][0]=$cnt;
		return $desc;
	}
	
	function registrar_notifications()
	{
		$cnt=1;
		$query=$this->db->query("SELECT * from leave_details");
		foreach($query->result() as $row)
		{
			$is_applicable=FALSE;
			$normal_auth_type=$this->get_auth_type_normal($row->emp_id);
			$special_auth_type=$this->get_auth_type_special($row->emp_id);
			if($row->leave_status==4 && $normal_auth_type!='ft' && $special_auth_type=='NULL')
				$is_applicable=TRUE;
			if($row->leave_status==3 && $normal_auth_type!='ft' && $special_auth_type=='hod')
				$is_applicable=TRUE;
			if($row->leave_status==2 && $special_auth_type=='est_ar')
				$is_applicable=TRUE;
			if($row->leave_status==1 && $special_auth_type=='dr')
				$is_applicable=TRUE;
			if($is_applicable==TRUE)
			{
					$desc[$cnt][0]=$row->emp_id;
					$desc[$cnt][1]=$leave_app_dept;
					$desc[$cnt][2]=$row->designation;
					$desc[$cnt][3]=$row->leave_type;
					$desc[$cnt][4]=$row->leave_from;
					$desc[$cnt][5]=$row->leave_to;
					$desc[$cnt][6]=$row->period;
					$desc[$cnt][7]=$this->get_name($row->emp_id);
					$desc[$cnt][8]=$this->get_dept_name($row->emp_id);
					$desc[$cnt][9]=$row->leave_id;
					$cnt+=1;	
			}
		}
		$desc[0][0]=$cnt;
		return $desc;
	}
	
	function director_notifications()
	{
		$cnt=1;
		$query=$this->db->query("SELECT * from leave_details");
		foreach($query->result() as $row)
		{
			$is_applicable=FALSE;
			$normal_auth_type=$this->get_auth_type_normal($row->emp_id);
			$special_auth_type=$this->get_auth_type_special($row->emp_id);
			$leave_app_dept=$this->get_dept($row->emp_id);
			if($row->leave_status==1 &&(($normal_auth_type=='ft' && $special_auth_type=='hod' || $special_auth_type=='reg')))
				$is_applicable=TRUE;
			if($row->leave_status==2 && (($normal_auth_type=='ft' && $special_auth_type=='NULL')||($special_auth_type=='reg')))
				$is_applicable=TRUE;
			if($row->leave_status==3 && $special_auth_type=='est_ar')
				$is_applicable=TRUE;
			if($row->leave_status==2 && $normal_auth_type!='ft' && $special_auth_type=='hod')
				$is_applicable=TRUE;
			if($row->leave_status==1 && $normal_auth_type!='ft' && $special_auth_type=='NULL')
				$is_applicable=TRUE;
			if($is_applicable==TRUE)
			{
					$desc[$cnt][0]=$row->emp_id;
					$desc[$cnt][1]=$leave_app_dept;
					$desc[$cnt][2]=$row->designation;
					$desc[$cnt][3]=$row->leave_type;
					$desc[$cnt][4]=$row->leave_from;
					$desc[$cnt][5]=$row->leave_to;
					$desc[$cnt][6]=$row->period;
					$desc[$cnt][7]=$this->get_name($row->emp_id);
					$desc[$cnt][8]=$this->get_dept_name($row->emp_id);
					$desc[$cnt][9]=$row->leave_id;
					$cnt+=1;	
			}
			
		}
		$desc[0][0]=$cnt;
		return $desc;
	}
	
	function notifications()
	{
		if($this->is_authorized()==TRUE)
		{
			$auth_type=$this->get_auth_type_logged_in();
			$user_auth=$this->session->userdata('auth');
			if($auth_type=='hod')
				return $this->hod_notifications();
			else if($auth_type=='est_ar')
				return $this->assistant_registrar_notifications();
			else if($auth_type=='dr')
				return $this->deputy_registrar_notifications();
			else if($auth_type=='reg')
				return $this->registrar_notifications();
			else if($auth_type=='dt')
				return $this->director_notifications();
		}
	}
}