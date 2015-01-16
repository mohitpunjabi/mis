<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>
-  <?php echo "<h3>".$CS_session['course_name']." (".$CS_session['branch'].") for Session "."20".$CS_session['session'][0].$CS_session['session'][1]."-20".$CS_session['session'][2].$CS_session['session'][3]."</h3>"; ?>
  <h3>
  Add elective courses for Semester 
  <?php 
  //echo "All Session variables are ".var_dump($CS_session);
    //echo $duration;
    //echo "<br>";
    echo $CS_session['sem'];
  ?>
  </h3>
  <?php 
    echo form_open('course_structure/add/Success');  
  ?>
  
      <?php 
	  $list_count = $CS_session['count_elective'];
	  if($CS_session['list_type'] == 1)
	  {
			$list_count = 1;
	  }
	  for($counter = 1;$counter<=$list_count;$counter++){ 
        if($options[$counter]>0)
        {
      ?> 
      <p>
      Enter details for Elective No <?php echo $counter;?> of Semester <?php echo $CS_session['sem']; ?>
      <table class="table table-condensed" style="width: auto">
      <tr>
        <td>Name</td>
        <td><input type="text" name="name<?php echo $counter;?>"/></td>
      </tr>
      <tr>
        <td>L</td>
        <td>
          <select name="L<?php echo $counter;?>">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>T</td>
        <td>
          <select name="T<?php echo $counter;?>">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>P</td>
        <td>
          <select name="P<?php echo $counter;?>">
            <?php for($i = 0; $i<=5; $i+=0.5){ ?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option> 
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
      	<td>
        	Credit Hours
        </td>
        <td>
          <input type="text" name="credit_hours<?php echo $counter;?>"/>
        </td>
      </tr>
      <tr>
        <td>Type</td>
        <td>
          <select name="type<?php echo $counter; ?>">
            <option value="Theory">Theory</option>
            <option value="Practical">Practical</option>
            <option value="Sessional">Sessional</option>
            <option value="Non-Contact">Non-Contact</option>
          </select>
        </td>
      </tr>
      <table>
        <tr>
          <th>Sl.No.</th>
          <th>Subject ID</th>
          <th>Subject Name</th>
        </tr>
        <?php for($i = 1;$i<=$options[$counter];$i++){ 
		echo '
          <tr>
            <td>';
			  echo '<select name="sequence'.$counter.'_'.$i.'"> ';
			  for($j = 1;$j<=$options[$counter];$j++)
			  {
			  		echo '<option value="'.$j.'">'.$j.'</option>';
			  }
			 echo '</select>';
			  ?>
            </td>
            <td>
              <input type="text" name="id<?php echo $counter.'_'.$i;?>"/>
            </td>
            <td>
              <input type="text" name="name<?php echo $counter.'_'.$i;?>"/>
            </td>
          </tr>
        <?php   } ?>
      </table>
      _________________________________________________________________________
      </table>
      <?php }
      } ?>
    </p>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <?php
    echo form_close(); 
  ?>  
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
