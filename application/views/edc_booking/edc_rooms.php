<?php
  $ui = new UI();
  foreach($floor_room_array as $floor)
  {
    $box = $ui->box()
          ->uiType('primary')
          ->title($floor[0].' Floor')
          ->icon($ui->icon('edit'))
          ->open();


      $input_row = $ui->row()->open();
        unset($floor[0]);
        if(count($floor)==0)
        {
          $box = $ui->callout()
            ->title("Sorry!! No rooms available.")
            ->uiType("warning")
            ->show();
            continue;
        }
        foreach($floor as $row)
        {
          $row5 = $ui->col()->width(6)
                     ->open();
          $ui->checkbox()
              ->name('room_list[]')
              ->label($row[1].'-'.$row[2])
              ->value($row[0])
              ->show();

          $row5->close();
        }
        $input_row->close();


    $box->close();
  }
?>
