<?php
class Basic_model extends CI_Model{
	var $table_prk_types = 'prk_types';
	var $table_prk_record = 'prk_record';
	var $table_prk_ism_author = 'prk_ism_author';
	var $table_prk_other_author = 'prk_other_author';
	var $table_departments = 'departments';
	var $table_user_details = 'user_details';

	public function search($data){
		//$query='';
		$basic_query = 'select rec.begin_date as begin_date,rec.rec_id as rec_id,rec.title as title,rec.name as name,rec.type_id as type, types.type_name as type_name ,rec.no_of_authors as no_of_authors,rec.other_authors as other_authors from prk_record as rec join prk_types as types on rec.type_id = types.type_id where rec.no_of_approval = rec.no_of_authors ';
		if($data['dept_id'] == 'all'){
			
		}
		else{
			$basic_query = 'select rec.begin_date as begin_date,rec.rec_id as rec_id,rec.title as title,rec.name as name,rec.type_id as type, types.type_name as type_name ,rec.no_of_authors as no_of_authors,rec.other_authors as other_authors from prk_record as rec join prk_types as types on rec.type_id = types.type_id join prk_ism_author as ism_auth on ism_auth.rec_id = rec.rec_id where rec.no_of_approval = rec.no_of_authors AND ism_auth.emp_id in (select id from user_details where dept_id="'.$data["dept_id"].'") ';

			if($data['emp_id'] != false){
				if($data['emp_id']!='all')
				$basic_query .= ' AND ism_auth.emp_id ='.$data["emp_id"].' ';
			}
		}
		if($data['type_id'] != 'all'){
			$basic_query .= ' AND rec.type_id = '.$data['type_id'].' ';
		}
		if(!empty($data['begin_date'])){
			$basic_query .= ' AND DATE(rec.begin_date) >= "'.$data["begin_date"].'" ';
		}
		if(!empty($data['end_date'])){
			$basic_query .= ' AND DATE(rec.begin_date) <= "'.$data["end_date"].'" ';
		}
		$basic_query .= ' order by types.type_sequence ASC';
		//return $basic_query;
		$query = $this->db->query($basic_query);
		return $query->result();
	}

	public function get_prk_types($type_id=''){
		if($type_id ==''){
			$query = $this->db->get($this->table_prk_types);
			return $query->result();
		}
		else{
			$query = $this->db->get_where($this->table_prk_types,array('type_id'=>$type_id));
			return $query->result();
		}
	}

	public function get_all_departments(){
		$this->db->select(array('id','name'));
		$query = $this->db->get_where($this->table_departments,array('type'=>'academic'));
		return $query->result();
	}

	public function approve_user_pub($rec_id,$emp_id){

		$this->db->where('rec_id',$rec_id);
		$this->db->where('emp_id',$emp_id);
		$this->db->update($this->table_prk_ism_author,array('notify_status'=>1));
		return true;
	} 

	public function get_pub_detail_by_rec_id($rec_id=''){
		$query = $this->db->get_where($this->table_prk_record,array('rec_id'=>$rec_id));
		return $query->result();
	}

	public function get_all_approved_user_pub($emp_id){
		$query = $this->db->query("SELECT rec.rec_id as rec_id,rec.title as title,rec.name as name,rec.type_id as type,rec.no_of_authors as no_of_authors,rec.other_authors as other_authors from prk_record as rec join prk_ism_author as auth ON auth.rec_id = rec.rec_id where rec.no_of_authors = rec.no_of_approval AND auth.emp_id = {$emp_id}");
		return $query->result();
	}

	public function get_not_approved_user_pub($emp_id){
		$query = $this->db->query("SELECT rec.rec_id as rec_id,rec.title as title,rec.name as name,rec.type_id as type,rec.no_of_authors as no_of_authors,rec.other_authors as other_authors from prk_record as rec join prk_ism_author as auth ON auth.rec_id = rec.rec_id where auth.notify_status = 0 AND auth.emp_id = {$emp_id}");
		return $query->result();
	}

	public function get_ism_author_detail_by_pub($rec_id){
		$query = $this->db->query(" SELECT auth.id as id, concat(auth.salutation,' ',auth.first_name,' ',auth.middle_name,' ',auth.last_name) as name from prk_record as rec join prk_ism_author as ia on ia.rec_id = rec.rec_id join user_details as auth on auth.id = ia.emp_id where rec.rec_id = '{$rec_id}'");
		return $query->result();
	}

	public function get_other_author_detail_by_pub($rec_id){
		$query = $this->db->query("select concat(first_name,' ',middle_name,' ',last_name) as name from prk_other_author where rec_id = '{$rec_id}'");
		return $query->result();
	}

	public function get_emp_by_dept($dept){
		$this->db->select(array('id',"concat(salutation,' ',first_name,' ',middle_name,' ',last_name) as name"));
		$query= $this->db->get_where($this->table_user_details,array('dept_id'=>$dept));
		return $query->result();
	}

	public function insert_publication_record($data){
		$query = $this->db->insert($this->table_prk_record,$data);
		return true;
	}

	public function update_publication_record($data){
		$this->db->where('rec_id',$data['rec_id']);
		$this->db->update($this->table_prk_record,$data);
		return true;
	}

	public function insert_ism_authors($data){
		$query = $this->db->insert_batch($this->table_prk_ism_author,$data);
		return true;
	}

	public function update_ism_authors($data){
		$this->db->where('rec_id',$data['rec_id']);
		$this->db->update($this->table_prk_ism_author,array('notify_status'=>'0'));
		$this->db->where('rec_id',$data['rec_id']);
		$this->db->where('emp_id',$data['current_user_emp_id']);
		$this->db->update($this->table_prk_ism_author,array('notify_status'=>'1'));
		return true;
	}

	public function insert_other_authors($data){
		$query = $this->db->insert_batch($this->table_prk_other_author,$data);
		return true;
	}
}
?>
