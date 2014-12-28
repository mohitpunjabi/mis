<?php

class Users_model extends CI_Model
{
	var $table = 'users';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function update($data, $where)
	{
		$this->db->update($this->table,$data,$where);
	}

	function getUserById($id = '')
	{
		$query = $this->db->get_where($this->table,array('id'=>$id));
		if($query->num_rows() === 1)
			return $query->row();
		else
			return false;
	}

	function validate_user($user_id, $password)
	{
		$user_id = $this->authorization->strclean($user_id);
     	$password = $this->authorization->strclean($password);

     	$row = $this->getUserById($user_id);
		if($row !== false)
		{
			if(!$this->authorization->check_brute($user_id))
			{
				// Block account
				return false;
			}

			$password = $this->authorization->encode_password($password, $row->created_date);
			if($password == $row->password)
			{
				// Login Successful
				$user_id = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user_id);

				$query_setsession = $this->db->query("SELECT u . * , d.name AS dept_name, d.type AS dept_type
														FROM (
																SELECT *
																FROM users
																NATURAL JOIN user_details
																WHERE id =  '$user_id'
					  									) AS u, departments AS d
														WHERE u.dept_id = d.id");

				$data = $query_setsession->row();
				$this->set_session($user_id, $password, $data);
				return true;
			}
			else
			{
				//Incorrect Password
				$data = array('id'=>$user_id,'time'=>date('Y-m-d H:i:s'));
				$query = $this->db->insert("user_login_attempts",$data);
				return false;
			}
		}
		return false;
    }

	private function set_session($user_id, $password, $data)
	{
		$this->session->set_userdata( array( 'id'=>$user_id,
											'login_string'=> hash('sha512', $password . $this->input->user_agent()),
											'auth'=>array()));
		if($data)
		{
			$this->session->set_userdata( array('name'		=>ucwords($data->salutation.' '.
																	  $data->first_name.
																	  (($data->middle_name != '')? ' '.$data->middle_name: '').
																	  (($data->last_name != '')? ' '.$data->last_name: '')),
												'sex'		=> $data->sex,
												'category'	=> $data->category,
												'dob' 		=> $data->dob,
												'email'		=> $data->email,
												'photopath' => $data->photopath,
												'marital_status' => $data->marital_status,
												'physically_challenged' => $data->physically_challenged,
												'dept_id' 	=> $data->dept_id,
												'created_date' 	=> $data->created_date,
												'dept_name' => ucwords($data->dept_name),
												'dept_type' => $data->dept_type,
												'auth'	=> array($data->auth_id),
												'isLoggedIn'=>true ));
			if($data->auth_id == 'emp')
			{
				if($query = $this->db->query("SELECT auth_id,d.name as des_name
												FROM emp_basic_details AS e INNER JOIN designations AS d
												ON e.designation = d.id
												where e.id = '".$user_id."'"))
				{
					$row = $query->row();
					$this->session->set_userdata(array('designation' => ucwords($row->des_name)));
					$auths = $this->session->userdata('auth');
					array_push($auths, $row->auth_id);
					$this->session->set_userdata('auth',$auths);
				}
			}

			if($data->auth_id == 'stu')
			{
				if($query = $this->db->get_where("stu_academic",array('id'=>$user_id)))
				{
					$row = $query->row();
					$this->session->set_userdata(array( 'branch_id' => $row->branch_id,
														'course_id' => $row->course_id,
														'semester' 	=> $row->semester));
					$auths = $this->session->userdata('auth');
					array_push($auths, $row->auth_id);
					$this->session->set_userdata('auth',$auths);
				}
			}
		}

		if($query = $this->db->get_where("user_auth_types",array("id"=>$user_id)))
		{
			$auths = $this->session->userdata('auth');
			foreach($query->result() as $row)
				array_push($auths, $row->auth_id);
			$this->session->set_userdata('auth',$auths);
		}
	}
}

/* End of file users_model.php */
/* Location: mis/application/models/users_model.php */