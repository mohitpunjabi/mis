<?php
foreach($floor_array as $row)
{
  //print_r($row);
?>
  <option type="text" value="<?php echo $row['floor']; ?>" ><?php echo $row['floor']; ?></option>
<?php
}
?>
