<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>Map courses run by department.</b><br><br>
  <?php
  	$form_attrinutes = array("id"=>"add_course_form");
    echo form_open('course_structure/map_dept/add',$form_attrinutes);
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
      <label for="branch_name">Select Branch  </label>
      </td>
      <td>
        <select name="branch" id="branch_selection">
          <option value="">Select Branch</option>
          <?php 
            foreach ($result_branch as $row) {
              echo "<option value='".$row->id."' >".$row->name."</option>"; 
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
      <label for="session_name">Select Session</label>
      </td>
      <td>
        <select name="session" id="branch_selection">
          <option value="">Select Session</option>
          <?php 
            for($i=1;$i<=10;$i++) {
              echo "<option value = '".(intval($i)+intval('10')).(intval($i)+intval('11'))."' >20".(intval($i)+intval('10'))."-20".(intval($i)+intval('11'))."</option>"; 
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
      <label for="dept_name">Select Department </label>
      </td>
      <td>
        <select name="dept" id="dept_selection">
          <option value="">Select Branch</option>
          <?php 
            foreach ($result_dept as $row) {
              echo "<option value='".$row->id."' >".$row->name."</option>"; 
            }
          ?>
        </select>
      </td>
    </tr>
    
    </table>
    <?php
    echo form_submit('submit', 'Map Department');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
