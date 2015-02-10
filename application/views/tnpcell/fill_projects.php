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
    echo form_open('tnpcell/cv/save_projects');
  ?>
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
    <?php for($counter=1;$counter<=5;$counter++) { ?>
    <tr>
      <td><?php echo $counter; ?></td>
      <td>
        <input type="text" name="place<?php echo $counter;?>"/>
      </td>
      <td>
        <input type="text" name="title<?php echo $counter;?>"/>
      </td>
      <td>
        <input type="text" placeholder="In weeks" name="duration<?php echo $counter; ?>"/>
      </td>
      <td>
        <input type="text" name="role<?php echo $counter;?>"/>
      </td>
      <td>
        <textarea name="description<?php echo $counter;?>" cols="40" rows="5"></textarea>
      </td>
    </tr>
    <?php } ?>
    </table>
    <?php
    echo form_submit('submit', 'Next');
    echo form_close();
    ?>
  </center>
  </font>
  </center>
</div>

</body>
</html>