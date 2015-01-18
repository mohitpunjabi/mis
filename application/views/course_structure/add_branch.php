<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>Add a Branch</b><br><br>
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
    </table>
    <?php
    echo form_submit('submit', 'Add Branch');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
