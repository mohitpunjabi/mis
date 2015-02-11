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
        <?php echo $row->place; ?>
      </td>
      <td>
        <?php echo $row->title; ?>
      </td>
      <td>
        <?php echo $row->duration; ?>
      </td>
      <td>
        <?php echo $row->role; ?>
      </td>
      <td>
        <?php echo nl2br($row->description); ?>
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
          <?php echo $row->category ?>
        </td>
         <td>
          <?php echo nl2br($row->info) ?>
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