<?php
	$ui = new UI();
	
	$column = $ui->col()->width(2)->open();
	$column->close();
	for ($i=0; $i<=10; $i++)
		$str[$i]="";
	$num = 0;

	for ($i=0; $i<sizeof($publications); $i++)
	{
		$type = $publications[$i]['type_id'];
		$j=$i+1;
		$no_of_ism_authors = $publications[$i]['no_of_authors'] - $publications[$i]['other_authors'];
		$no_of_authors = $publications[$i]['no_of_authors'];
		$str[$type] .= "<tr><td>".$j.". </td><td> ";
		$count = 0;
		foreach ($publications[$i]['authors']['ism'] as $key=>$auth)
		{
			if ($count != $no_of_authors-2)
				$str[$type] .= $auth->name.", ";
			else
				$str[$type] .= $auth->name." & ";
			$count++;
		}
		if($publications[$i]['other_authors']>0)
		{
		    foreach ($publications[$i]['authors']['others'] as $key=>$auth)
		    {
				if ($count != $no_of_authors-2)
					$str[$type] .= $auth->name.", ";
				else
					$str[$type] .= $auth->name." & ";
				$count++;
			}  
		}
		$str[$type].= "\"".$publications[$i]['title']."\", ";
		if ($type==1 || $type==2)
		{
			$date="";
			for ($k=0; $k<10; $k++)
				$date .= $publications[$i]['begin_date'][$k];
			$str[$type] .= "Published in the ".$publications[$i]['name'].", Vol. ";
			$str[$type] .= $publications[$i]['vol_no']." in issue ";
			$str[$type] .= $publications[$i]['issue_no'].", ".$date.", ";
			$str[$type] .= "pp ".$publications[$i]['page_no'].".";
		}
		else if ($type==3 || $type==4 || $type==5)
		{
			$begin_date = "";
			$end_date = "";
			for ($k=0; $k<10; $k++){
				$begin_date .= $publications[$i]['begin_date'][$k];
				$end_date .= $publications[$i]['end_date'][$k];
			}
			$str[$type] .= "Published in the ".$publications[$i]['name'].", held at ";
			$str[$type] .= $publications[$i]['place']." during ".$begin_date;
			$str[$type] .= " to ".$end_date.", pp ".$publications[$i]['page_no'].".";
		}
		$str[$type] .= "</td></tr>";
	}
	$column1 = $ui->col()->width(8)->open();
		$box = $ui->box()->uiType('primary')->solid()->title('Search Publications')->open();
			$table = $ui->table()->hover()->bordered()->open();
			for ($i=1; $i<=5; $i++)
				if ($str[$i]!=""){
					if ($i==1){
						?><th colspan="4">National Journal</th><?php
					}
					else if ($i==2){
						?><th colspan="4">International Journal</th><?php
					}
					else if ($i==3){
						?><th colspan="4">National Conference</th><?php
					}
					else if ($i==4){
						?><th colspan="4">International Conference</th><?php
					}
					else if ($i==5){
						?><th colspan="4">Others</th><?php
					}
					echo $str[$i]; 
				}
			$table->close();
		$box->close();
	$column1->close();
	

?>

<!--
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
-->