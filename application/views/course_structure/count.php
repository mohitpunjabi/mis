<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center>		
  
  <?php 
 // echo "aggr id = ".$CS_session['aggr_id'];
  echo "<h3>".$CS_session['course_name']." (".$CS_session['branch'].") for Session "."20".$CS_session['session'][0].$CS_session['session'][1]."-20".$CS_session['session'][2].$CS_session['session'][3]."</h3>"; ?>
  <h3>Enter number of subjects for Sem <?php echo $CS_session['sem']; ?></h3>
  <?php
    echo form_open('course_structure/add/EnterSubjects');
  ?>
  <table>
    <tr>
      <td>
      <?php
      	//echo $_SESSION['duration'];
	  ?>
        <label for="count_core">Number of Core Subjects</label>
      </td>
      <td>
        <input type="text" name="count_core" id = "count_core"/>
      </td>
    </tr>
    <tr>
      <td>
        <label for="count_elective">Number of Elective Subjects</label>
      </td>
      <td>
        <input type="text" name="count_elective"/>
      </td>
    </tr>
    </table>
      <input type="hidden" name="aggr_id" value="<?php echo $CS_session['aggr_id']; ?>">
      <input type="hidden" name="sem" value="<?php echo $CS_session['sem']; ?>">
      <input type="hidden" name="duration" value="<?php echo $CS_session['duration']; ?>">
      <input type="hidden" name="course_name" value="<?php echo $CS_session['course_name']; ?>">
      <input type="hidden" name="branch" value="<?php echo $CS_session['branch']; ?>">
      <input type="hidden" name="session" value="<?php echo $CS_session['session']; ?>">
    <?php
    echo form_submit('submit', 'Submit');
    echo form_close();
    ?>
  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
