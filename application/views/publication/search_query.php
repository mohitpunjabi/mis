<div id="container">
	<h1>Welcome to Publication Record Page!</h1>
  <center>
  <font face="Arial" size="3">
    <b>Search Publication</b><br><br>
    <?php
    	$form_attrinutes = array("id"=>"search_publication_form","method"=>"post");
      echo form_open('publication/publication/search_result',$form_attrinutes);
    ?>
    <div id="publication_wrapper">
      <table id="search_table">
        <tr>
          <td>Department</td>
          <td>
            <select name="dept_id" id="search_department">
              
            </select>
          </td>
        </tr>
        <!-- <tr id="search_faculty_wrapper">
          <td>Faculty</td>
          <td>
            <select name="emp_id" id="search_faculty">
            </select>
          </td>
        </tr> -->
        <tr>
          <td>Type of Publication</td>
          <td>
            <select name="publication_type" id="publication_type">
              <option value="all" selected="selected">All Type</option>
              <?php
                foreach($prk_types as $type){
                  echo "<option value='".$type->type_id."'>".$type->type_name."</option>";  
                } 
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Start Date</td>
          <td><input type="date" name="begin_date"></td>
        </tr>
        <tr>
          <td>End Date</td>
          <td><input type="date" name="end_date"></td>
        </tr>
      </table>
    </div>  

    <?php
    echo form_submit('submit', 'Search');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
