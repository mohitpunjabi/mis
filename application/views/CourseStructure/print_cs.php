<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center><h3>Course Structure for  
  <?php
  echo "all session variables are ".var_dump($CS_session);
  echo "All session variables = <br>".var_dump($CS_session); 
    $db=$this->load->database();
    $course_id=strtok($aggr_id,"_");
    $branch_id=strtok("_");
    $session=strtok("_");
    $course_query="SELECT name,duration FROM courses WHERE id='".$course_id."'";
    $result_course=$this->db->query($course_query);
    $row=$result_course->result();
    $course_name=$row[0]->name;
    $course_duration=$row[0]->duration;
    echo $course_name." ";
    $branch_query="SELECT name FROM branches WHERE id='".$branch_id."'";
    $result_branch=$this->db->query($branch_query);
    $row=$result_branch->result();
    $branch_name=$row[0]->name;
    echo "(".$branch_name.")"."<br>";
    echo "Applicable for the Session "."20".$session[0].$session[1]."-20".$session[2].$session[3];
  ?>
  </h3>
  <?php
      for($counter=1;$counter<=2*$course_duration;$counter++)
      {
        echo "<h3>Subjects for Semester". $counter."<br></h3>";
        $query_subjects="SELECT * FROM course_structure WHERE semester=".$counter." AND aggr_id='".$aggr_id."' ORDER BY sequence";
        $result_subjects=$this->db->query($query_subjects);
        $count=1;
  ?>
  <table border="1">
    <tr>
      <th>Sl. No</th>
      <th>Subject ID</th>
      <th>Subject Name</th>
      <th>Lecture</th>
      <th>Tutorial</th>
      <th>Practical</th>
      <th>Credit Hours</th>
      <th>Contact Hours</th>
      <th>Elective</th>
      <th>Type</th>
    </tr>
  <?php
        foreach($result_subjects->result() as $row)
        {
  ?>
          <tr>
            <td><?php echo $count;$count++;?></td>
            <td><?php echo $row->subject_id; ?></td>
  <?php
        $query_details="SELECT * FROM subjects WHERE id='".$row->subject_id."'";
        $result_details=$this->db->query($query_details);
        $subject=$result_details->result();
  ?>
            <td><?php echo $subject[0]->name;?></td>
            <td><?php echo $subject[0]->lecture;?></td>
            <td><?php echo $subject[0]->tutorial;?></td>
            <td><?php echo $subject[0]->practical;?></td>
            <td><?php echo $subject[0]->credit_hours;?></td>
            <td><?php echo $subject[0]->contact_hours;?></td>
            <td><?php 
                  if($subject[0]->elective==0) echo "No";
                  else echo "Yes";
                  ?>
            </td>
            <td><?php 
                  if($subject[0]->type==0) echo "Theory";
                  if($subject[0]->type==1) echo "Practical";
                  if($subject[0]->type==2) echo "Sessional";
                  if($subject[0]->type==3) echo "Non-Contact";
                ?>
            </td>
          </tr>
  <?php
        }
  ?>
  </table>
  <?php
      }
  ?>
  </table>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>