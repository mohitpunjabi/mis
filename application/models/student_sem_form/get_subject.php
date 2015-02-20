<?php
class Get_subject extends CI_Model
{
	var $table_subject = 'subjects';
	var $table_course_branch = 'course_branch';
	var $eleSubject = 'stu_sem_reg_subject';
	var $fee = 'stu_sem_reg_fee';
	var $result = 'result_status';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function getSubject($course_id,$branch_id,$semster){
		$query="SELECT 
  `course_structure`.`sequence`,
  `subjects`.`id`,
  `subjects`.`subject_id`,
  `subjects`.`name`
FROM
  `dept_course`
  INNER JOIN `course_branch` ON (`dept_course`.`course_branch_id` = `course_branch`.`course_branch_id`)
  INNER JOIN `course_structure` ON (`dept_course`.`aggr_id` = `course_structure`.`aggr_id`)
  INNER JOIN `subjects` ON (`course_structure`.`id` = `subjects`.`id`)
WHERE
  `course_branch`.`course_id` = '".$course_id."' AND 
  `course_branch`.`branch_id` = '".$branch_id."' AND 
  `course_structure`.`semester` = '".$semster."' AND
   `course_structure`.`sequence` REGEXP '^[0-9]+$' AND
   `course_structure`.`aggr_id`='btech_cse_2012_2013' order by `course_structure`.`sequence`";
		$data['subjects']= $this->db->query($query)->result_array();
		 
		 return $data;
	}
	
	// Get Elective Subject From Corse Structure //
	function getElective($course_id,$branch_id,$semster){
	$query =	"SELECT   `subjects`.`id`, `subjects`.`subject_id`, `subjects`.`name`,  `course_structure`.`sequence`
		 FROM
		  `elective_offered`
		  INNER JOIN `subjects` ON (`elective_offered`.`id` = `subjects`.`id`)
		  INNER JOIN `course_structure` ON (`elective_offered`.`aggr_id` = `course_structure`.`aggr_id`)
		  AND (`elective_offered`.`id` = `course_structure`.`id`)
		  INNER JOIN `dept_course` ON (`course_structure`.`aggr_id` = `dept_course`.`aggr_id`)
		  INNER JOIN `course_branch` ON (`dept_course`.`course_branch_id` = `course_branch`.`course_branch_id`)
		WHERE
		  `course_branch`.`course_id` = '".$course_id."' AND 
		  `course_branch`.`branch_id` = '".$branch_id."' AND 
		  `course_structure`.`semester` = '".$semster."'";
		
	   $data['ele']=$this->db->query($query)->result_array();
	
	   return $data;
		
	}
	
	// Get Subject and fee Details for Registration During form Filling//
	function getConfirm($id){
		$data['ele'] =$this->db->query("select * from stu_sem_reg_subject join subjects on stu_sem_reg_subject.sub_id = subjects.id where stu_sem_reg_subject.sem_form_id='".$id."'")->result_array();
		$data['fee'] =$this->db->get_where($this->fee,array('form_id'=>$id))->result_array();
		return $data;
		}
		
	
}
?>