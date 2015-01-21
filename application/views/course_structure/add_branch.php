<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>Add/Map a Branch</b><br><br>
  <?php
  	$form_attrinutes = array("id"=>"add_course_form");
    echo form_open('course_structure/add_branch/add',$form_attrinutes);
  ?>
  <table id = "form_table">
    <tr>
      <td>
      <label for="id">ID of Branch  </label>
      </td>
      <td>
        <input type="text" name="branch_id"></input>
      </td>
    </tr>
    <tr>
      <td>
      <label for="name">Name of Branch  </label>
      </td>
      <td>
        <input type="text" name="branch_name"></input>
      </td>
    </tr>
    <tr>
      <td>
      <label for="course_name">Select Course  </label>
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
      <label for="dept_name">Select Department </label>
      </td>
      <td>
        <select name="dept" id="dept_selection">
          <option value="">Offered By</option>
          <?php 
            foreach ($result_dept as $row) {
              echo "<option value='".$row->id."' >".$row->name."</option>"; 
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
      <label for="year">Session of Starting</label>
      </td>
      <td>
        <select name="year" id="year_selection">
          <option value="">Select Session</option>
          <?php 
            for($counter=1926;$counter<=date('Y');$counter++) 
            {
				$val = $counter."_".($counter+1);
              	echo "<option value='".$val."'>".$counter."-".($counter+1)."</option>";
            }
          ?>
        </select>
      </td>
    </tr>
    </table>
    <?php
    echo form_submit('submit', 'Add Branch');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
