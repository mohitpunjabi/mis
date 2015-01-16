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
 	//echo "all session variables are = ".var_dump($CS_session);
    $course_name=$CS_session['course_name'];
    $course_duration=$CS_session['duration'];
    $branch_name=$CS_session['branch_name'];
    $aggr_id= $CS_session['aggr_id'];
    $session=$CS_session['session'];
    echo $CS_session['course_name']." ";
    echo "(".$branch_name.")"."<br>";
    echo "Applicable for the Session "."20".$session[0].$session[1]."-20".$session[2].$session[3];
  ?>
  </h3>
  <?php
  	if($CS_session["semester"] != 0)
	{
		$start_semester = $CS_session["semester"];
		$course_duration = 1;
		$end_semester = $start_semester;
	}
	else
	{
		$start_semester = 1;
		$end_semester = 2*$course_duration;
	}	
		
      for($semester=$start_semester;$semester<=$end_semester;$semester++)
      {
        echo "<h3>Subjects for Semester". $semester."<br></h3>";
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
        for($i=1;$i<=$subjects["count"][$semester];$i++)
        {
            if(isset($subjects["group_details"][$semester][$i]->group_id))
			{
				echo "<tr><td colspan='10' style = 'text-align:center;font-size:20px;'>".$subjects["group_details"][$semester][$i]->elective_name."</td></tr>";
				$group_id = $subjects["group_details"][$semester][$i]->group_id;
				for($j = 0;$j<$subjects["elective_count"][$group_id];$j++)
				{
					
		?>
                    <tr>
                        <td><?php echo $subjects["sequence_no"][$semester][$i+$j]?></td>
                        
                        <td><?php echo $subjects["subject_details"][$semester][$i+$j]->subject_id; ?></td>
                        <td><?php echo $subjects["subject_details"][$semester][$i+$j]->name;?></td>
                        <td><?php echo $subjects["subject_details"][$semester][$i+$j]->lecture;?></td>
                        <td><?php echo $subjects["subject_details"][$semester][$i+$j]->tutorial;?></td>
                        <td><?php echo $subjects["subject_details"][$semester][$i+$j]->practical;?></td>
                        <td><?php echo $subjects["subject_details"][$semester][$i+$j]->credit_hours;?></td>
                        <td><?php echo $subjects["subject_details"][$semester][$i+$j]->contact_hours;?></td>
                        <td>
                            <?php 
                                  if($subjects["subject_details"][$semester][$i+$j]->elective==0) 
                                     echo "No";
                                  else 
                                    echo "Yes";
                              ?>
                        </td>
                        <td>
                            <?php 
                              if($subjects["subject_details"][$semester][$i+$j]->type=="Theory") echo "Theory";
                              if($subjects["subject_details"][$semester][$i+$j]->type=="Practical") echo "Practical";
                              if($subjects["subject_details"][$semester][$i+$j]->type=="Sessional") echo "Sessional";
                              if($subjects["subject_details"][$semester][$i+$j]->type =="Non-Contact") echo "Non-Contact";
                            ?>
                        </td>
                    </tr>
         <?php
				}//for closed..
				$i = $j+$i-1;
				}//if closed.
				else
				{
		 ?>
                  <tr>
                    <td><?php echo $subjects["sequence_no"][$semester][$i]?></td>
                    
                    <td><?php echo $subjects["subject_details"][$semester][$i]->subject_id; ?></td>
                    <td><?php echo $subjects["subject_details"][$semester][$i]->name;?></td>
                    <td><?php echo $subjects["subject_details"][$semester][$i]->lecture;?></td>
                    <td><?php echo $subjects["subject_details"][$semester][$i]->tutorial;?></td>
                    <td><?php echo $subjects["subject_details"][$semester][$i]->practical;?></td>
                    <td><?php echo $subjects["subject_details"][$semester][$i]->credit_hours;?></td>
                    <td><?php echo $subjects["subject_details"][$semester][$i]->contact_hours;?></td>
                    <td>
                        <?php 
                              if($subjects["subject_details"][$semester][$i]->elective==0) 
                                 echo "No";
                              else 
                                echo "Yes";
                          ?>
                    </td>
                    <td>
                        <?php 
                          if($subjects["subject_details"][$semester][$i]->type=="Theory") echo "Theory";
                          if($subjects["subject_details"][$semester][$i]->type=="Practical") echo "Practical";
                          if($subjects["subject_details"][$semester][$i]->type=="Sessional") echo "Sessional";
                          if($subjects["subject_details"][$semester][$i]->type =="Non-Contact") echo "Non-Contact";
                        ?>
                    </td>
                  </tr>
  		 <?php
				}//else closed
           }//inner for loop 
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