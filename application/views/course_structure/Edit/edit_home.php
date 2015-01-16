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
  <font face="Arial" size="3">
  <b>Edit Existing Course Structure</b><br><br>
  <?php
  	$form_attrinutes = array("id"=>"add_course_form");
    echo form_open('CourseStructure/edit/EditCourseStructure',$form_attrinutes);
  ?>
  <table id = "form_table">
    <tr>
      <td>
      <label for="course_name">Name of Course  </label>
      </td>
      <td>
        <select name="course" id="course_selection">
          <option value="">Select Course</option>
          <?php 
            foreach ($result_course as $row) {
              echo "<option value='".$row->id."' data-duration='".$row->duration."' >".$row->name."</option>"; 
            }
          ?>
        </select>
      </td>
    </tr>
    <!--
        <?php 
          echo form_dropdown('branch', $branch_options,'Select');
        ?>
	    <?php
          echo form_dropdown('session',$sess_options,'Select');
        ?>
        <?php
          echo form_dropdown('sem',$sem_options,'Select');
        ?>
     -->  
    </table>
    <?php
    echo form_submit('submit', 'Edit Course Structure');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
<script type="text/javascript" src="<?= base_url() ?>assets/js/CourseStructure/add.js"></script>
</html>