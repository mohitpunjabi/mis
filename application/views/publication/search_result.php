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