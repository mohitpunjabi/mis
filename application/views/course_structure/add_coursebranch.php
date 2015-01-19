<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>Add Course Branch Mapping</b><br><br>
  <?php
  	$form_attrinutes = array("id"=>"add_course_form");
    echo form_open('course_structure/add_coursebranch/add',$form_attrinutes);
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
    <tr>
      <td>
      <label for="branch_name">Name of Branch  </label>
      </td>
      <td>
        <select name="branch" id="branch_selection">
          <option value="">Select Branch</option>
          <?php 
            foreach ($result_branch as $row) {
              echo "<option value='".$row->id."' data-duration='".$row->duration."' >".$row->name."</option>"; 
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
      <label for="year">Year</label>
      </td>
      <td>
        <select name="year" id="year_selection">
          <option value="">Select Year</option>
          <?php 
            for($counter=10;$counter<=20;$counter++) 
            {
              $ss=$counter.($counter+1);
              $sess= '20'.$counter."-".'20'.($counter+1);
              echo "<option value='".$ss."' data-duration='".$ss."' >".$sess."</option>";
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label for="dept">Department running the course</label>
      </td>
      <td>
        <select name="dept" id="dept">
          <option value="">Select Department</option>
          <?php
            foreach ($result_dept as $row) {
              echo "<option value='".$row->id."' data-duration='".$row->duration."' >".$row->name."</option>"; 
            }
          ?>
      </td>
    </tr>
    </table>
    <?php
    echo form_submit('submit', 'Add Course Structure');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
