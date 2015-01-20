<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>Add New Course Structure</b><br><br>
  <?php
  	$form_attrinutes = array("id"=>"add_course_form");
    echo form_open('course_structure/add/EnterNumberOfSubjects',$form_attrinutes);
  ?>
  <table id = "form_table">
    <tr>
      <td>
      <label for="course_name">Name of Course  </label>
      </td>
      <td>
        <select name="course" id="course_selection">
          <option value="0">Select Course</option>
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
    echo form_submit('submit', 'Add Course Structure');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
