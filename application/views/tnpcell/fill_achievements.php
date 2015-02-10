<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to T&P Cell</title>
</head>
<body>

<div id="container">
	<h1>Welcome to Training & Placement Cell!</h1>
  <center>
  <font face="Arial" size="3">
  <h3><b>Add details to your CV</b></h3>
  <?php
    echo form_open('tnpcell/cv/save_achievements');
  ?>
  <h3>Academic/Co-Curricular Achievements</h3>
  <table align="center">
    <?php 
      $category =array("Research Papers Published", "Academic Achievements", "Co-curricular Achievements","Position of Responsibility","Skill-Set");
      for($i=1;$i<=5;$i++) { 
    ?>
    <tr>
      <td>
        <?php echo $i ?>
      </td>
      <td>
        <input type="text" name="category<?php echo $i ?>" value ="<?php echo $category[$i-1] ?>" placeholder="<?php echo $category[$i-1] ?>"/>
      </td>
      <td>
        <textarea name="information<?php echo $i ?>" cols="40" rows="5"></textarea>
      </td>
    </tr>
    <?php } ?>
    </table>
    <?php
    echo form_submit('submit', 'Save');
    echo form_close();
    ?>
  </font>
  </center>
</div>
</body>
</html>