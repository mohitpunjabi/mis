<div id="container">
	<h1>Welcome to Edit Publications Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>Edit Publications - <?php echo $publication['rec_id']; ?></b><br><br>
  
  <div>
    <?php
      $form_attrinutes = array("id"=>"edit_publication_form");
      echo form_open('publication/publication/submit_edit',$form_attrinutes);
    ?>
    <table>
      <tr>
        <td>Title</td>
        <td><input type="text" name="title" value="<?php echo $publication['title']; ?>"></td>
      </tr>
      <tr>
        <td>Name</td>
        <td><input type="text" name="publication_name" value="<?php echo $publication['name']; ?>"></td>
      </tr>
      <?php
      if(!empty($publication['place'])){?>
        <tr>
          <td>Place</td>
          <td><input type="text" name="venue" value="<?php echo $publication['place']; ?>"></td>
        </tr>
      <?php } ?>
      <?php
      if(!empty($publication['vol_no'])){?>
        <tr>
          <td>Volume No.</td>
          <td><input type="text" name="vol_no" value="<?php echo $publication['vol_no']; ?>"></td>
        </tr>
      <?php } ?>
      <?php
      if(!empty($publication['issue_no'])){?>
        <tr>
          <td>Issue No.</td>
          <td><input type="text" name="issue_no" value="<?php echo $publication['issue_no']; ?>"></td>
        </tr>
      <?php } ?>
      <?php
      if($publication['type_id'] == '3' || $publication['type_id'] == '4'){?>
      <tr>
        <td>Begin Date</td>
        <td><input type="text" name="begin_date" value="<?php echo $publication['begin_date']; ?>"></td>
      </tr>
      <?php }
      else{ ?>
        <tr>
          <td>Date of Publication</td>
          <td><input type="text" name="begin_date" value="<?php echo $publication['begin_date']; ?>"></td>
        </tr>
      <?php
      }
      if($publication['type_id'] == '3' || $publication['type_id'] == '4'){?>
      <tr>
        <td>End Date</td>
        <td><input type="text" name="end_date" value="<?php echo $publication['end_date']; ?>"></td>
      </tr>
      <?php } ?>
      <tr>
        <td>Page Range</td>
        <td><input type="text" name="page_no" value="<?php echo $publication['page_no']; ?>"></td>
      </tr>
      <tr>
        <td>Other Information</td>
        <td><input type="text" name="other_info" value="<?php echo $publication['other_info']; ?>"></td>
      </tr>
    </table>
    <?php
    echo form_submit('submit', 'Edit');
    echo form_close();
    ?>
  </div>

  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
