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
  <center>		
  
  <?php 
 // echo "aggr id = ".$CS_session['aggr_id'];
  echo "<h3>".$CS_session['course_name']." (".$CS_session['branch'].") for Session "."20".$CS_session['session'][0].$CS_session['session'][1]."-20".$CS_session['session'][2].$CS_session['session'][3]."</h3>"; ?>
  <h3>Enter number of subjects for Sem <?php echo $CS_session['sem']; ?></h3>
  <?php
    echo form_open('CourseStructure/add/EnterSubjects');
  ?>
  <table>
    <tr>
      <td>
      <?php
      	//echo $_SESSION['duration'];
	  ?>
        <label for="count_core">Number of Core Subjects</label>
      </td>
      <td>
        <input type="text" name="count_core" id = "count_core"/>
      </td>
    </tr>
    <tr>
      <td>
        <label for="count_elective">Number of Elective Subjects</label>
      </td>
      <td>
        <input type="text" name="count_elective"/>
      </td>
    </tr>
    </table>
      <input type="hidden" name="aggr_id" value="<?php echo $CS_session['aggr_id']; ?>">
      <input type="hidden" name="sem" value="<?php echo $CS_session['sem']; ?>">
      <input type="hidden" name="duration" value="<?php echo $CS_session['duration']; ?>">
      <input type="hidden" name="course_name" value="<?php echo $CS_session['course_name']; ?>">
      <input type="hidden" name="branch" value="<?php echo $CS_session['branch']; ?>">
      <input type="hidden" name="session" value="<?php echo $CS_session['session']; ?>">
    <?php
    echo form_submit('submit', 'Submit');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>