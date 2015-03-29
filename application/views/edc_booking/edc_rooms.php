<?php
foreach($room_array as $row)
{
  //print_r($row);
  $ui = new UI();
  $ui->checkbox()
      ->name('room_list[]')
      ->width(1)
      ->value($row[0])
      ->show();
?>
  <!--<option type="text" value="<?php //echo $row[0]; ?>" ><?php //echo $row[1]; ?></option>-->

    <!--<input type="checkbox" name="room_list[]" value="564"/>-->

<?php
}
?>
