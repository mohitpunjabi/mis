<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>View/Print Course Structure</b><br><br>
  <?php
  	$form_attrinutes = array("id"=>"add_course_form");
    echo form_open('course_structure/view/ViewCourseStructure',$form_attrinutes);
  ?>
  <table id = "form_table">
   <tr>
      <td>
      <label for="dept_name">Department  </label>
      </td>
      <td>
        <select name="dept" id="dept_selection">
          <option value="0">Select Department</option>
          <?php 
            foreach ($result_dept as $row) {
              echo "<option value='".$row->id."' >".$row->name."</option>"; 
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
    echo form_submit('submit', 'View Course Structure');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
