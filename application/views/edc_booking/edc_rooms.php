<?php
  $ui = new UI();


  $t = $ui->table()->condensed()->open();

 	?>
 		<!--<tr>
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
 		</tr>-->
 	<?

  $t->close();
  /*$tabBox1 = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Select Rooms")
				   ->tab("double_ac", "Double Bedded AC")
				   ->tab("suite_ac", "Suite AC", true)
				   //->tab("settings", $ui->icon('gear'))
				   ->open();*/
  foreach($room_array as $room_type)
  {
      $room_type_box = $ui->box()->title($room_type['room_type'])->open();
      /*if($room_type['room_type']== 'Double Bedded AC')
      {
        $tab1 = $ui->tabPane()->id("double_ac")->active()->open();
      }
      else
      {
        $tab1 = $ui->tabPane()->id("suite_ac")->active()->open();
      }*/
      $t = $ui->table()->condensed()->open();
      foreach($floor_room_array as $floor)
      {
        ?>
        <tr>
          <th>
            <?php
              echo $floor[0].' Floor';
              unset($floor[0]);
            ?>
          </th>
          <?php
            foreach($floor as $row)
            {
              if($row[2] == $room_type['room_type'])
              {
                $output_str = "<td class=";
                if($row[3]==0)
                  $output_str .= "\"bg-danger\"";
                else
                  $output_str .= "\"bg-success\"";
                $output_str .= "align=\"center\">".$row[1];
                $output_str .= "<input type=\"checkbox\" value=\"";
                $output_str .= $row[0]."\"name=\"room_list[]\"></td>";
                echo $output_str;
              }
            }
          ?>
        </tr>
        <?php
      }
      $t->close();
      //$tab1->close();
      $room_type_box->close();
    }
    //$tabBox1->close();
?>
