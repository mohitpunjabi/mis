<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>Add a Course</b><br><br>
  <?php
  	$form_attrinutes = array("id"=>"add_course_form");
    echo form_open('course_structure/add_course/add',$form_attrinutes);
  ?>
  <table id = "form_table">
    <tr>
      <td>
      <label for="course_id">ID of Course  </label>
      </td>
      <td>
        <input type="text" name="course_id"></input>
      </td>
    </tr>
    <tr>
      <td>
      <label for="course_name">Name of Course  </label>
      </td>
      <td>
        <input type="text" name="course_name"></input>
      </td>
    </tr>
    <tr>
      <td>
        <label for="course_duration">Duration  </label>
      </td>
      <td>
        <select name="course_duration" id="duration_selection">
          <option value="">Select Duration</option>
          <?php 
            for ($i=1;$i<=5;$i++) {
              echo "<option value='".$i."' data-duration='".$i."' >".$i."</option>"; 
            }
          ?>
        </select>
      </td>
    </tr>
    </table>
    <?php
    echo form_submit('submit', 'Add Course');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
