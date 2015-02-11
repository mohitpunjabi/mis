<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to T&P Cell</title>
  var base_url = <?php echo base_url(); ?>
</head>
<body>

<div id="container">
	<h1>Welcome to Training & Placement Cell!</h1>
  <center>
  <font face="Arial" size="3">
  <h3><b>Your CV</b></h3>
  <center>
  <h3>Project/Internship/Excursion/Training</h3>
  <table align="center">
    <tr>
      <th>Sl.No</th>
      <th>Place</th>
      <th>Project Title</th>
      <th>Duration</th>
      <th>Role</th>
      <th>Project Description</th>
    </tr>
    <?php 
      $i=1;
      foreach($projects as $row) { 
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td>
        <input disabled type="text" name="place<?php echo $i; ?>" value="<?php echo $row->place; ?>"/>
      </td>
      <td>
        <input disabled type="text" name="title<?php echo $i; ?>" value="<?php echo $row->title; ?>"/>
      </td>
      <td>
        <input disabled type="text" name="duration<?php echo $i; ?>" value="<?php echo $row->duration; ?>"/>
      </td>
      <td>
        <input disabled type="text" name="role<?php echo $i; ?>" value="<?php echo $row->role; ?>"/>
      </td>
      <td>
        <textarea disabled name="description<?php echo $i ?>" cols="40" rows="5"><?php echo $row->description; ?></textarea>
      </td>
      <td>
        <input id="editbutton_project<?php echo $i; ?>" type="button" name="editbutton" value="Edit" onclick="EditProject(<?php echo $i ?>)"/>
      </td>
    </tr>
    <?php $i++; } ?>
    </table>
    <h3>Academic/Co-Curricular Achievements</h3>
    <table align="center">
    <?php 
      foreach($achievements as $row) { ?>
      <tr>
        <td>
          <input disabled type="text" name="category<?php echo $i; ?>" value="<?php echo $row->category; ?>"/>
        </td>
         <td>
          <textarea disabled name="info<?php echo $i ?>" cols="40" rows="5"><?php echo $row->info; ?></textarea>
        </td>
        <td>
        <input id="editbutton_achievements<?php echo $i; ?>" type="button" name="editbutton" value="Edit" onclick="EditAchievements($row->category,$row->id)"></input>
      </td>
      </tr>
     <?php } ?>
    </table>
  </center>
  </font>
  </center>
</div>

</body>
</html>