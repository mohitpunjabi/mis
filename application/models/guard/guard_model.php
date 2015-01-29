<?php

class Guard_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function get_postnames()
	{
		$table = 'guard_post';
		$this->db->select('post_id,postname');
		$query = $this->db->get($table);
		
		return $query->result();
	}
	
	function get_guardnames()
	{
		$table = 'guard_guards';
		$query = $this->db->get($table);
		
		return $query->result();
	}
	
	function get_details_of_guard_at_a_post($post_id)
	{
		$this->db->where('guard_duty.post_id',$post_id);
		$query = $this->db->select("guard_duty.*, guard_post.postname as postname, guard_guards.firstname as firstname, guard_guards.lastname as lastname, guard_guards.photo as photo")
						  ->from('guard_duty')
						  ->join("guard_guards", "guard_guards.Regno = guard_duty.Regno")
						  ->join("guard_post", "guard_post.post_id = guard_duty.post_id")
						  ->order_by("guard_duty.date", "desc")
						  ->get();

		return $query->result();
	}
	
	function get_details_of_guard_at_a_date($date)
	{
		$this->db->where('date',$date);
		$query = $this->db->select("guard_duty.*, guard_post.postname as postname, guard_guards.firstname as firstname, guard_guards.lastname as lastname, guard_guards.photo as photo")
						  ->from('guard_duty')
						  ->join("guard_guards", "guard_guards.Regno = guard_duty.Regno")
						  ->join("guard_post", "guard_duty.post_id = guard_post.post_id")
						  ->order_by("guard_duty.date", "desc")
						  ->get();

		return $query->result();
	}
	
	function get_guards_with_duties()
	{
		$date = date("Y-m-d");
		$query = "SELECT t.* , guard_post.postname AS postname
				  FROM (
						SELECT DISTINCT guard_guards.Regno AS Regno, firstname, lastname,photo, guard_duty.post_id AS post_id, guard_duty.shift AS shift
						FROM guard_guards
						LEFT JOIN guard_duty 
						ON guard_guards.Regno = guard_duty.Regno
						AND date = '$date'
						)t
				  LEFT JOIN guard_post 
				  ON t.post_id = guard_post.post_id";
		$query = $this->db->query($query);
		
		return $query->result_array();
	}
	
	function get_details_of_guard_in_a_range($fromdate, $todate, $regno)
	{
		
		$where = "date between '$fromdate' and '$todate'";
		$this->db->where($where);
		$this->db->where('guard_guards.Regno',$regno);
		$query = $this->db->select("guard_duty.*, guard_post.postname as postname, guard_guards.firstname as firstname, guard_guards.lastname as lastname, guard_guards.photo as photo")
						  ->from('guard_duty')
						  ->join("guard_guards", "guard_guards.Regno = guard_duty.Regno")
						  ->join("guard_post", "guard_duty.post_id = guard_post.post_id")
						  ->order_by("guard_duty.date","asc")
						  ->get();
						 
		return $query->result();
	}
	
	function get_details_of_guards_in_a_range($fromdate, $todate)
	{
		
		$where = "date between '$fromdate' and '$todate'";
		$this->db->where($where);
		$query = $this->db->select("guard_duty.*, guard_post.postname as postname, guard_guards.firstname as firstname, guard_guards.lastname as lastname, guard_guards.photo as photo")
						  ->from('guard_duty')
						  ->join("guard_guards", "guard_guards.Regno = guard_duty.Regno")
						  ->join("guard_post", "guard_duty.post_id = guard_post.post_id")
						  ->order_by("guard_duty.date","desc")
						  ->get();
						 
		return $query->result();
	}
	
	
	function get_details_of_guard_at_a_post_in_a_range($fromdate, $todate, $postname)
	{
		$where = "date between '$fromdate' and '$todate'";
		$this->db->where($where);
		$this->db->where('guard_duty.post_id',$postname);
		$query = $this->db->select("guard_duty.*, guard_post.postname as postname, guard_guards.firstname as firstname, guard_guards.lastname as lastname, guard_guards.photo as photo")
						  ->from('guard_duty')
						  ->join("guard_guards", "guard_guards.Regno = guard_duty.Regno")
						  ->join("guard_post", "guard_duty.post_id = guard_post.post_id")
						  ->order_by("guard_duty.date","desc")
						  ->get();
						 
		return $query->result();
	}
	
	function add_guard($data)
	{
		$guard = $this->get_details_of_a_guard($data['Regno']);
		if(count($guard) == 0 )
		{
			$this->db->insert('guard_guards',$data);
			return true;
		}
		else return false;
	}

	function add_post($data)
	{
		$this->db->insert('guard_post',$data);
	}

	function get_guards()
	{
		$query = $this->db->get('guard_guards');
		return $query->result_array();
	}
	
	function get_max_post_id()
	{
		$this->db->select_max('post_id');
		$query = $this->db->get('guard_post');
		
		$this->db->select_max('post_id');
		$query2 = $this->db->get('guard_post_archive');
		
		if($query->row()->post_id == NULL && $query2->row()->post_id == NULL)
			return 	$query->row();
		else if($query->row()->post_id > $query2->row()->post_id)
			return $query->row();
		else
			return $query2->row();
	}
	
	
	function get_duty_of_a_guard($Regno)
	{
		$this->db->where('date',date("Y-m-d"));
		$this->db->where('Regno',$Regno);
		$query = $this->db->get('guard_duty');
		
		return $query->result_array();
	}
	
	function get_all_tomorrow_duties()
	{
		$date = date('Y-m-d',strtotime(date("Y-m-d"))+86400);
		$this->db->where('date',$date);
		$query = $this->db->get('guard_duty');
		
		return $query->result_array();
	}
	
	function get_all_today_duties()
	{
		$this->db->where('date',date("Y-m-d"));
		$query = $this->db->get('guard_duty');
		
		return $query->result_array();
	}
	
	function insert_into_duty($data)
	{
		$this->db->insert('guard_duty',$data);
	}
	
	function get_posts()
	{
		$query = $this->db->get('guard_post');
		return $query->result_array();
	}
	
	function get_personal_details_of_guards()
	{
		$query = $this->db->order_by("added_on","desc")
						  ->get('guard_guards');
				 
		return $query->result();
	}
	
	
	function get_available_guards()
	{
		$date = date("Y-m-d",strtotime(date("Y-m-d"))+86400);
		$ans = "select Regno from guard_duty where date='$date'";
		
		$this->db->where("Regno NOT IN ($ans)");
		$query = $this->db->select('*')
						  ->from('guard_guards')
						  ->get();
						 
		return $query->result();
	
	}
	
	function get_personal_details_of_guards_archive()
	{
		$query = $this->db->order_by("added_on","desc")
					  ->get('guard_guards_archive');
				 
		return $query->result();
	}
	
	function insert_into_archive($data)
	{
		$this->db->insert('guard_guards_archive',$data);
	}
	
	function add_into_archive($data)
	{
		$this->db->insert('guard_post_archive',$data);
	}
	
	
	function get_details_of_a_guard($regno)
	{
		$this->db->where('Regno',$regno);
		$query = $this->db->get('guard_guards');
		
		return $query->row_array();
	}
	
	function get_details_of_a_postname($post_id)
	{
		$this->db->where('post_id',$post_id);
		$query = $this->db->get('guard_post');
		
		return $query->row_array();
	}
	
	function delete($regno)
	{
		$this->db->where('Regno',$regno);
		$this->db->delete('guard_guards');
	}
	
	function remove($post_id)
	{
		$this->db->where('post_id',$post_id);
		$this->db->delete('guard_post');
	}
	
	
	function update_guard($data)
	{
		$this->db->where('Regno',$data['Regno']);
		$this->db->update('guard_guards',$data);
	}
	
	function update_post($data)
	{
		$this->db->where('post_id',$data['post_id']);
		$this->db->update('guard_post',$data);
	}
	
	function get_all_duties_chart()
	{
		$query = $this->db->select("guard_duty.*, guard_post.postname as postname, guard_guards.firstname as firstname, guard_guards.lastname as lastname, guard_guards.photo as photo")
						  ->from('guard_duty')
						  ->join("guard_guards", "guard_guards.Regno = guard_duty.Regno")
						  ->join("guard_post", "guard_duty.post_id = guard_post.post_id")
						  ->order_by("guard_duty.date","desc")
						  ->get();
						 
		return $query->result();
	}
	
	function get_tomorrow_duties_chart()
	{
		$this->db->where('date',date("Y-m-d",strtotime(date("Y-m-d"))+86400));
		$query = $this->db->select("guard_duty.*,guard_post.postname as postname, guard_guards.firstname as firstname, guard_guards.lastname as lastname, guard_guards.photo as photo")
						  ->from('guard_duty')
						  ->join("guard_guards", "guard_guards.Regno = guard_duty.Regno")
						  ->join("guard_post", "guard_duty.post_id = guard_post.post_id")
						  ->order_by("guard_duty.date","desc")
						  ->get();
						 
		return $query->result();
	}
	
	function get_today_duties_chart()
	{
		$this->db->where('date',date("Y-m-d"));
		$query = $this->db->select("guard_duty.*,guard_post.postname as postname, guard_guards.firstname as firstname, guard_guards.lastname as lastname, guard_guards.photo as photo")
						  ->from('guard_duty')
						  ->join("guard_guards", "guard_guards.Regno = guard_duty.Regno")
						  ->join("guard_post", "guard_duty.post_id = guard_post.post_id")
						  ->order_by("guard_duty.date","desc")
						  ->get();
						 
		return $query->result();
	}
	
	function get_details_of_posts()
	{
		$query = $this->db->from('guard_post')
				 ->order_by("added_on","desc")
				 ->get();
		
		return $query->result();
	}
	
	
	function get_all_guards_at_same_shift_post($shift, $date)
	{
		$this->db->where('date',$date);
		$this->db->where('shift !=',$shift);
		$query = $this->db->select('guard_guards.Regno as Regno, guard_guards.firstname as firstname, guard_guards.lastname as lastname')
						  ->from('guard_duty')
						  ->join("guard_guards", "guard_guards.Regno = guard_duty.Regno")
						  ->get();
				
		return $query->result();
	}
	
	function update_duty($data, $regno)
	{
		$this->db->where('date',$data['date']);
		$this->db->where('post_id',$data['post_id']);
		$this->db->where('shift',$data['shift']);
		$this->db->where('Regno',$regno);
		$this->db->update('guard_duty',$data);
	}
	
	function get_postname_of_a_post_id($post_id)
	{
		$this->db->where('post_id',$post_id);
		$query = $this->db->select('postname')
				 ->from('guard_post')
				 ->get();
		return $query->row();
	}
	
	function get_details_of_posts_archive()
	{
		$query = $this->db->from('guard_post_archive')
				 ->order_by("removed_on","desc")
				 ->get();
		
		return $query->result();
	}
}

?>
