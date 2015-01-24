<?php

class Leave_Status_Model extends CI_Model
{
	function approved_leave_status()
	{
		$today=date("Y-m-d",strtotime('today'));
		$user_id=$this->session->userdata('id');
		$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status=99");
		$cnt=1;
		foreach($query->result() as $row)
		{
			$start_date=$row->leave_from;
			if(strtotime('today')<strtotime($start_date))
			{
				$desc[$cnt][0]=$user_id;
				$desc[$cnt][1]=$row->designation;
				$desc[$cnt][2]=$row->leave_type;
				$desc[$cnt][3]=$row->leave_from;
				$desc[$cnt][4]=$row->leave_to;
				$desc[$cnt][5]=$row->period;
				$cnt+=1;
			}
		}
		$desc[0][0]=$cnt;
		return $desc;
	}
	
	
	
	function pending_leave_status()
	{
		$today=date("Y-m-d",strtotime('today'));
		$user_id=$this->session->userdata('id');
		$user_auth=$this->session->userdata('auth');
		if($user_auth[1]=='ft')
		{
			$query=$this->db->query("SELECT * from user_auth_types where id='$user_id'");
			if($query->num_rows()==0)
			{
				$cnt=1;
				$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status=1 or leave_status=2");
				foreach($query->result() as $row)
				{
					$start_date=$row->leave_from;
					if(strtotime($today)<strtotime($start_date))
					{
						$desc[$cnt][0]=$user_id;
						$desc[$cnt][1]=$row->designation;
						$desc[$cnt][2]=$row->leave_type;
						$desc[$cnt][3]=$row->leave_from;
						$desc[$cnt][4]=$row->leave_to;
						$desc[$cnt][5]=$row->period;
						if($row->leave_status==1)
							$desc[$cnt][6]="pending for approval by department HOD";
						else
							$desc[$cnt][6]="pending for approval by director";
						$cnt+=1;
					}
				}
				$desc[0][0]=$cnt;
				return $desc;
			}
			else
			{
				$cnt=1;
				foreach($query->result() as $row)
				{
					if($row->auth_id=='hod')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status=1");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								$desc[$cnt][6]="pending for approval by director";
								$cnt+=1;
							}
						}
						$desc[0][0]=$cnt;
						return $desc;
					}
				}
			}
		}
		else if($user_auth[1]=='nfta' || $user_auth[1]=='nftn')
		{
			$query=$this->db->query("SELECT * from user_auth_types where id='$user_id'");
			if($query->num_rows()==0)
			{
				$cnt=1;
				$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status>=1 and leave_status<=5");
				foreach($nest_query->result() as $row)
				{
					$start_date=$row->leave_from;
					if(strtotime($today)<strtotime($start_date))
					{
						$desc[$cnt][0]=$user_id;
						$desc[$cnt][1]=$row->designation;
						$desc[$cnt][2]=$row->leave_type;
						$desc[$cnt][3]=$row->leave_from;
						$desc[$cnt][4]=$row->leave_to;
						$desc[$cnt][5]=$row->period;
						if($row->leave_status==1)
							$desc[$cnt][6]="pending for approval by sectional HOD";
						else if($row->leave_status==2)
							$desc[$cnt][6]="pending for approval by assistant registrar";
						else if($row->leave_status==3)
							$desc[$cnt][6]="pending for approval by sectional deputy registrar";
						else if($row->leave_status==4)
							$desc[$cnt][6]="pending for approval by registrar";
						else
							$desc[$cnt][6]="pending for approval by director";
						$cnt++;
					}
				}
				$desc[0][0]=$cnt;
				return $desc;
			}
			else
			{
				$cnt=1;
				foreach($query->result() as $row)
				{
					if($row->auth_id=='hod')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status>=1 and leave_status<=4");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								if($row->leave_status==1)
									$desc[$cnt][6]="pending for approval by assistant registrar";
								else if($row->leave_status==2)
									$desc[$cnt][6]="pending for approval by sectional deputy registrar";
								else if($row->leave_status==3)
									$desc[$cnt][6]="pending for approval by registrar";
								else if($row->leave_status==4)
									$desc[$cnt][6]="pending for approval by director";
								$cnt++;
							}
						}
						$desc[0][0]=$cnt;
						
						return $desc;
					}
					else if($row->auth_id=='est_ar')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status>=1 and leave_status<=3");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								if($row->leave_status==1)
									$desc[$cnt][6]="pending for approval by sectional deputy registrar";
								else if($row->leave_status==2)
									$desc[$cnt][6]="pending for approval by registrar";
								else if($row->leave_status==3)
									$desc[$cnt][6]="pending for approval by director";
								$cnt++;
							}
						}
						$desc[0][0]=$cnt;
						return $desc;
					}
					else if($row->auth_id=='dr')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status>=1 and leave_status<=2");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								if($row->leave_status==1)
									$desc[$cnt][6]="pending for approval by registrar";
								else if($row->leave_status==2)
									$desc[$cnt][6]="pending for approval by director";
								$cnt++;
							}
						}
						$desc[0][0]=$cnt;
						return $desc;
					}
					else if($row->auth_id=='reg')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status=1");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								if($row->leave_status==1)
									$desc[$cnt][6]="pending for approval by director";
								$cnt++;
							}
						}
						$desc[0][0]=$cnt;
						return $desc;
					}
				}
			}
		}
	}
	
	
	function rejected_leave_status()
	{
		$today=date("Y-m-d",strtotime('today'));
		$user_id=$this->session->userdata('id');
		$user_auth=$this->session->userdata('auth');
		if($user_auth[1]=='ft')
		{
			$query=$this->db->query("SELECT * from user_auth_types where id='$user_id'");
			if($query->num_rows()==0)
			{
				$cnt=1;
				$query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status>=3 and leave_status<=4");
				foreach($query->result() as $row)
				{
					$start_date=$row->leave_from;
					if(strtotime($today)<strtotime($start_date))
					{
						$desc[$cnt][0]=$user_id;
						$desc[$cnt][1]=$row->designation;
						$desc[$cnt][2]=$row->leave_type;
						$desc[$cnt][3]=$row->leave_from;
						$desc[$cnt][4]=$row->leave_to;
						$desc[$cnt][5]=$row->period;
						if($row->leave_status==3)
							$desc[$cnt][6]="leave application rejected by department HOD";
						else
							$desc[$cnt][6]="leave application by director";
						$desc[$cnt][7]=$row->remarks;
						$cnt+=1;
					}
				}
				$desc[0][0]=$cnt;
				return $desc;
			}
			else
			{
				$cnt=1;
				foreach($query->result() as $row)
				{
					if($row->auth_id=='hod')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status=2");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								$desc[$cnt][6]="leave application rejected by director";
								$desc[$cnt][7]=$row->remarks;
								$cnt+=1;
							}
						}
						$desc[0][0]=$cnt;
						return $desc;
					}
				}
			}
		}
		else if($user_auth[1]=='nfta' || $user_auth[1]=='nftn')
		{
			$query=$this->db->query("SELECT * from user_auth_types where id='$user_id'");
			if($query->num_rows()==0)
			{
				$cnt=1;
				$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status>=6 and leave_status<=10");
				foreach($nest_query->result() as $row)
				{
					$start_date=$row->leave_from;
					if(strtotime($today)<strtotime($start_date))
					{
						$desc[$cnt][0]=$user_id;
						$desc[$cnt][1]=$row->designation;
						$desc[$cnt][2]=$row->leave_type;
						$desc[$cnt][3]=$row->leave_from;
						$desc[$cnt][4]=$row->leave_to;
						$desc[$cnt][5]=$row->period;
						if($row->leave_status==6)
							$desc[$cnt][6]="leave application rejected by sectional HOD";
						else if($row->leave_status==7)
							$desc[$cnt][6]="leave application rejected by assistant registrar";
						else if($row->leave_status==8)
							$desc[$cnt][6]="leave application rejected by sectional deputy registrar";
						else if($row->leave_status==9)
							$desc[$cnt][6]="leave application rejected by registrar";
						else
							$desc[$cnt][6]="leave application rejected by director";
						$desc[$cnt][7]=$row->remarks;
						$cnt++;
					}
				}
				$desc[0][0]=$cnt;
				return $desc;
			}
			else
			{
				$cnt=1;
				foreach($query->result() as $row)
				{
					if($row->auth_id=='hod')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status>=5 and leave_status<=8");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								if($row->leave_status==5)
									$desc[$cnt][6]="leave application rejected by assistant registrar";
								else if($row->leave_status==6)
									$desc[$cnt][6]="leave application rejected by sectional deputy registrar";
								else if($row->leave_status==7)
									$desc[$cnt][6]="leave application rejected by registrar";
								else if($row->leave_status==8)
									$desc[$cnt][6]="leave application rejected by director";
								$desc[$cnt][7]=$row->remarks;
								$cnt++;
							}
						}
						$desc[0][0]=$cnt;
						return $desc;
					}
					else if($row->auth_id=='est_ar')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status>=4 and leave_status<=6");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								if($row->leave_status==4)
									$desc[$cnt][6]="leave application rejected by sectional deputy registrar";
								else if($row->leave_status==5)
									$desc[$cnt][6]="leave application rejected by registrar";
								else if($row->leave_status==6)
									$desc[$cnt][6]="leave application rejected by director";
								$desc[$cnt][7]=$row->remarks;
								$cnt++;
							}
						}
						$desc[0][0]=$cnt;
						return $desc;
					}
					else if($row->auth_id=='dr')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status>=3 and leave_status<=4");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								if($row->leave_status==3)
									$desc[$cnt][6]="leave application rejected by registrar";
								else if($row->leave_status==4)
									$desc[$cnt][6]="leave application rejected by director";
								$desc[$cnt][7]=$row->remarks;
								$cnt++;
							}
						}
						$desc[0][0]=$cnt;
						return $desc;
					}
					else if($row->auth_id=='reg')
					{
						$nest_query=$this->db->query("SELECT * from leave_details where emp_id='$user_id' and leave_status=2");
						foreach($nest_query->result() as $row)
						{
							$start_date=$row->leave_from;
							if(strtotime($today)<strtotime($start_date))
							{
								$desc[$cnt][0]=$user_id;
								$desc[$cnt][1]=$row->designation;
								$desc[$cnt][2]=$row->leave_type;
								$desc[$cnt][3]=$row->leave_from;
								$desc[$cnt][4]=$row->leave_to;
								$desc[$cnt][5]=$row->period;
								if($row->leave_status==2)
									$desc[$cnt][6]="leave application rejected by director";
								$desc[$cnt][7]=$row->remarks;
								$cnt++;
							}
						}
						$desc[0][0]=$cnt;
						return $desc;
					}
				}
			}
		}
	}
}