<?php
foreach($room_array as $row)
{
  //print_r($row);
?>
  <option type="text" value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>
<?php
}
?>
