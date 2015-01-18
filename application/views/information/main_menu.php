
<?php
$auths = array('dsw','dt','est_ar','exam_dr','hod');
/*
dsw -> Dean of student welfare
dt -> Director
est_ar  -> Assistant Registrar
exam_dr -> Exam deputy Registrar
hod -> Head of Department
*/
if($this->authorization->auth($auths)){
?>
	<h2><a href = "<?php echo site_url('information/post'); ?>" >Post Notice, Circular or Minute</a></h2>
	<br>
	<h2><a href = "<?php echo site_url('information/search_edit'); ?>" >Search(Edit) Notice, Circular or Minute</a></h2>
	<br>
	<h2><a href = "<?php echo site_url('information/search'); ?>" >Search Removed Notice, Circular or Minute</a></h2>
	<br>
	<h2><a href = "<?php echo site_url('information/search_prev'); ?>" >Search Previous Versions of Notice, Circular or Minute</a></h2>
	<br>
	<h2><a href = "<?php echo site_url('information/view'); ?>" >View Notice, Circular or Minute</a></h2>
<?php
}
else{?>
	<h2><a href = "<?php echo site_url('information/view'); ?>" >View Notice, Circular or Minute</a></h2>
<?php
}

	 //$password = 'p';
	 //$password = $this->authorization->strclean($password);
	// echo $password.'<br>';
	//$query=$this->db->query('select * from users');
	//foreach($query->result() as $row)
		//$this->db->query('update users set password = "'.$this->authorization->encode_password($password,$row->created_date).'" where id="'.$row->id.'"');
	// print_r($this->session->all_userdata());

?>