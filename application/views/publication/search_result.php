<div id="container">
  <h1>Welcome to Searh Publications Page!</h1>
  <center>
  <font face="Arial" size="3">
  <b>Search Result for Publications</b><br><br>
  
  <div>
    <table>
      <?php
        $type=0;
        for($i=0;$i<sizeof($publications);){
          $type = $publications[$i]['type_id'];
          echo "<th>".$publications[$i]['type_name']."</th>";
          while($i < sizeof($publications) && $type == $publications[$i]['type_id']){
            echo "<tr>";
            echo " <td>";
            
            /*
            * Start of the name of the authors
            */            
            $str ='<strong>';
            $no_of_ism_authors = $publications[$i]['no_of_authors'] - $publications[$i]['other_authors'];
            foreach ($publications[$i]['authors']['ism'] as $key=>$auth) {
              if($publications[$i]['other_authors'] > 0){
                if($key == 0){//handles both single author and first author in Multiple authors
                  $str .= $auth->name." ";
                }
                if($key != 0 ){
                  $str .= " ,".$auth->name." ";
                }
              }
              else{
                if($key == 0){//handles both single author and first author in Multiple authors
                  $str .= $auth->name." ";
                }
                if($key != 0 && $publications[$i]['no_of_authors'] > 1){
                  if($key < $no_of_ism_authors - 1)
                    $str .= " ,".$auth->name." ";
                  else{
                    $str .= " & ".$auth->name." ";
                  }
                }
              }
            }
            if($publications[$i]['other_authors']>0){
              foreach ($publications[$i]['authors']['others'] as $key=>$auth) {
                if($key < $publications[$i]['other_authors']-1)
                  $str .= " ,".$auth->name." ";
                else{
                  $str .= " & ".$auth->name."";
                }
              }  
            }
            $str .="</strong>";
            echo $str;

            /*
            * Start of the title of the Publication
            */
            echo ",<strong>\"".$publications[$i]['title']."\"</strong> Published in the ";
            
            /*
            * Start of the Parts based on the Publications Type
            */
            if($publications[$i]['type_id'] < 3){// National & international Journal
              echo ",".$publications[$i]['type_name'].", ".$publications[$i]['name'];  
            }
            else{

            }
            echo "</tr>";
            $i++;
          }
        }
      ?>
    </table>
  </div>

  </font>
  </center>
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
