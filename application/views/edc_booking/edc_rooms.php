<?php
  $ui = new UI();


  $t = $ui->table()->condensed()->open();

 	?>
 		<tr>
 			<th>First Floor</th>
 			<td class="bg-danger" align="center">1 <input type="checkbox" disabled checked></td>
 			<td class="bg-success" align="center">3 <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 		</tr>
 		<tr>
 			<th>Second Floor</th>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 		</tr>
 		<tr>
 			<th>Third Floor</th>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-success" align="center"> <input type="checkbox"></td>
 			<td class="bg-danger" align="center"> <input type="checkbox" disabled></td>
 		</tr>
 	<?

  $t->close();

  foreach($floor_room_array as $floor)
  {
    $box = $ui->box()
          ->uiType('primary')
          ->title($floor[0].' Floor')
          ->icon($ui->icon('edit'))
          ->open();

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
        $ui->checkbox()
            ->name('room_list[]')
            //->width(1)
            ->label($row[1].'-'.$row[2])
//            ->label ($row[1])  
            ->value($row[0])
            ->show();
      }

    $box->close();
  }
  /*foreach($room_array as $row)
  {
    //print_r($row);

    $ui->checkbox()
        ->name('room_list[]')
        ->width(1)
        ->value($row[0])
        ->show();
  }*/
?>
