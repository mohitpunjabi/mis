<div id="container">
	<h1>Welcome to Publication Record Page!</h1>
  <center>
  <font face="Arial" size="3">
    <b>Add New Publication</b><br><br>
    <?php
    	$form_attrinutes = array("id"=>"add_publication_form","method"=>"post");
      echo form_open('publication/publication/addpublication',$form_attrinutes);
    ?>
    <div id="publication_wrapper">
      <fieldset>
        <legend>Details</legend>
        <table id="details_table">
          <tr>
            <td>Enter Title of The Paper *</td>
            <td><input type="text" name="title" required="true"></td>
          </tr>
          <tr>
            <td>Types of the Publication</td>
            <td>
              <select name="publication_type" id="publication_type">
                <option value="0">Select Type</option>
                <?php
                  foreach($prk_types as $type){
                    echo "<option value='".$type->type_id."'>".$type->type_name."</option>";  
                  } 
                ?>
              </select>
            </td>
          </tr>
        </table>
      </fieldset>
    </div>  
    <?php
    echo form_submit('submit', 'Add Publication');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
