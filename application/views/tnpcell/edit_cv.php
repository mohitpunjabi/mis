<?php
	$ui = new UI();
    $outer_row = $ui->row()->id('or')->open();
    $column1 = $ui->col()->width(12)->t_width(6)->m_width(12)->open();
    
    echo '<h3><b><center>Your CV</b></center>';
    echo 'Project/Internship/Excursion/Training</h3>';    
    $table = $ui->table()->responsive()->hover()->bordered()->open();
							echo '
								  <tr>
									<th>Sl.No</th>
                  <th>Title</th>
                  <th>Place</th>
                  <th>Duration</th>
                  <th>Role</th>
                  <th>Description</th>
								  </tr>';
    $i=1;
    foreach($projects as $row) {
              echo '
								  <tr> 
									<td>';
                  echo $i;
              echo '
									</td>
									<td>';
                  $ui->input()->name("title".$i)->value($row->title)->disabled()->show();
              echo '
									</td>
									<td>';
                  $ui->input()->name("place".$i)->value($row->place)->disabled()->show();
              echo '
									</td>
									<td>';
                  $ui->input()->name("duration".$i)->value($row->duration." weeks")->disabled()->show();
              echo '
									</td>
									<td>';
                  $ui->input()->name("role".$i)->value($row->role)->disabled()->show();
              echo '
									</td>
									<td>';
                  $ui->input()->name("description".$i)->value($row->description)->disabled()->show();
              echo '
									</td>
									<td>  ';
              $ui->button()
                 ->value('Edit')
                 ->uiType('primary')
                 ->id("editbutton")
                 ->icon($ui->icon("edit"))
                 ->extras(' onclick = EditProject(\''.$i.'\') ')
                 ->name('edit')
                 ->show();
              echo ' </td>
                </tr>';
		$i++;
    }
    $table->close();
	  echo '<h3>Awards & Achievements</h3>';
     $table2 = $ui->table()->responsive()->hover()->bordered()->open();
     $i=1;
     foreach($achievements as $row) {
        echo '
              <tr>
              <td>  ';
              $ui->input()->name("category".$i)->value($row->category)->disabled()->show();
        echo ' </td>
               <td>  ';
              $ui->input()->name("info".$i)->value($row->info." weeks")->disabled()->show();
        echo ' </td>
                <td> ';
                $ui->button()
                 ->value('Edit')
                 ->uiType('primary')
                 ->id("editbutton")
                 ->icon($ui->icon("edit"))
                 ->extras(' onclick = EditAchievements(\''.$i.'\') ')
                 ->name('edit')
                 ->show();
        echo ' </td>
                </tr>';
      $i++;
     }
     $table2->close();
		$column1->close();
	$outer_row->close();
?>