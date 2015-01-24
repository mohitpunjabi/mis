<div id="container">
	<h1>Welcome to Edit Publications Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>Edit Publications</b><br><br>
  
  <div>
    <table>
      <tr>
        <th>Title</th>
        <th>Name</th>
        <th>Authors</th>
        <th>Edit</th>
      </tr>
      <?php
        for($i=0;$i<sizeof($publications);$i++){
          echo "<tr>";
          echo " <td>".$publications[$i]['title']."</td>";
          echo " <td>".$publications[$i]['name']."</td>";
          $str ='<td>';
          foreach ($publications[$i]['authors']['ism'] as $auth) {
            $str .= " ".$auth->name."<br/>";
          }
          if($publications[$i]['other_authors']>0){
            foreach ($publications[$i]['authors']['others'] as $auth) {
              $str .= " ".$auth->name."<br/>";
            }  
          }
          echo $str;
          //echo " <td>".$publications[$i]['title']."</td>";
          echo " <td><a href='".base_url().'index.php/publication/publication/editpublication/'.$publications[$i]['rec_id']."'>Edit</a></td>";
          echo "</tr>";
        }
      ?>
    </table>
  </div>

  </font>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
