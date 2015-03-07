<?php
	$ui = new UI();

	for ($i=0; $i<=10; $i++)
		$str[$i]="";
	$num = 0;
	for ($i=0; $i<=10; $i++)
		$current_num[$i]=1;
	for ($i=0; $i<sizeof($publications); $i++)
	{
		$type = $publications[$i]['type_id'];
		$j=$i+1;
		$no_of_ism_authors = $publications[$i]['no_of_authors'] - $publications[$i]['other_authors'];
		$no_of_authors = $publications[$i]['no_of_authors'];
		$str[$type] .= "<tr><td>".$current_num[$type]++.". </td><td> ";
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
		else if ($type==3 || $type==4)
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
		else if ($type == 5)
		{
			$str[$type] .= "authored the book titled ".$publications[$i]['title']." published by ";
			$str[$type] .= $publications[$i]['publisher']." which is currently in its ";
			if ($publications[$i]['edition']%10 == 1)
				$str[$type] .= $publications[$i]['edition']."st edition.";
			else if ($publications[$i]['edition']%10 == 2)
				$str[$type] .= $publications[$i]['edition']."nd edition.";
			else if ($publications[$i]['edition']%10 == 3)
				$str[$type] .= $publications[$i]['edition']."rd edition.";
			else
				$str[$type] .= $publications[$i]['edition']."th edition.";
		}
		else if ($type == 6)
		{
			$str[$type] .= " authored the chapter titled ".$publications[$i]['chapter_name']." in the book ";
			$str[$type] .= $publications[$i]['title']." which is published by ".$publications[$i]['publisher'];
			$str[$type] .= "and is in its ";
			if ($publications[$i]['edition']%10 == 1)
				$str[$type] .= $publications[$i]['edition']."st edition.";
			else if ($publications[$i]['edition']%10 == 2)
				$str[$type] .= $publications[$i]['edition']."nd edition.";
			else if ($publications[$i]['edition']%10 == 3)
				$str[$type] .= $publications[$i]['edition']."rd edition.";
			else
				$str[$type] .= $publications[$i]['edition']."th edition.";
		}
		$str[$type] .= "</td></tr>";
	}
	
	$column1 = $ui->col()->width(12)->open();
	$tabBox1 = $ui->tabBox()
				   ->tab("all", "All",true)
				   ->tab("national_journal", "National Journal")
				   ->tab("international_journal", "International Journal")
				   ->tab("national_conference","National Conference")
				   ->tab("international_conference","International Conference")
				   ->tab("books","Books")
				   ->tab("book_chapter","Book Chapter")
				   ->tab("search","Search")
				   ->open();

	
	$allPublication = $ui->tabPane()->id("all")->active()->open();

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
						?><th colspan="4">Books</th><?php
					}
					else if ($i==6){
						?><th colspan="4">Book Chapters</th><?php
					}
					echo $str[$i]; 
				}
		$table->close();

	$allPublication->close();

	$nationalJournal = $ui->tabPane()->id("national_journal")->open();

		$table = $ui->table()->hover()->bordered()->open();
			echo $str[1];
		$table->close();

	$nationalJournal->close();

	$internationalJournal = $ui->tabPane()->id("international_journal")->open();

		$table = $ui->table()->hover()->bordered()->open();
			echo $str[2];
		$table->close();

	$internationalJournal->close();

	$nationalConference = $ui->tabPane()->id("national_conference")->open();

		$table = $ui->table()->hover()->bordered()->open();
			echo $str[3];
		$table->close();

	$nationalConference->close();

	$internationalConference = $ui->tabPane()->id("international_conference")->open();

		$table = $ui->table()->hover()->bordered()->open();
			echo $str[4];
		$table->close();

	$internationalConference->close();

	$books = $ui->tabPane()->id("books")->open();

		$table = $ui->table()->hover()->bordered()->open();
			echo $str[5];
		$table->close();

	$books->close();

	$book_chapter = $ui->tabPane()->id("book_chapter")->open();

		$table = $ui->table()->hover()->bordered()->open();
			echo $str[6];
		$table->close();

	$book_chapter->close();

	$search = $ui->tabPane()->id("search")->open();
		$box = $ui->box()->uiType('primary')->solid()->title('Search Publications')->open();
		$form_attrinutes = array("id"=>"search_publication_form","method"=>"post");
		$form = $ui->form()->action('publication/publication/search_result',$form_attrinutes)->open();
			$table = $ui->table()->hover()->bordered()->open();

				?>
					<tr>
						<th>Department</th>
						<th>
							<?php
								$ui->select()
									->name('department_name')
									->id('department_name')
									->options(array($ui->option()->value('""')->text('Select')))
									->show();
							?>
						</th>
					</tr>
					<tr>
						<th>Faculty</th>
						<th>
							<?php
								$ui->select()
									->name('faculty_name')
									->id('faculty_name')
									->options(
										//$ui->option()->value("all")->text("All"),
										array($ui->option()->value('""')->text('Select')))
									->show();
							?>
						</th>
					</tr>
					<tr>
						<th>Type of Publication</th>
						<th>
							<?php
								$ui->select()
									->name('type_of_pub')
									->id('type_of_pub')
									->options(array(
										$ui->option()->value("all")->text("All"),
										$ui->option()->value(1)->text("National Journal"),
										$ui->option()->value(2)->text("International Journal"),
										$ui->option()->value(3)->text("National Conference"),
										$ui->option()->value(4)->text("International Conference"),
										$ui->option()->value(5)->text("Others")
									))
									->show();
							?>
						</th>
					</tr>
					<tr>
						<th>Start Date</th>
						<th>
							<?php
							$ui->datePicker()->label('Date')
							   ->name('start_date')->placeholder("Enter the date")
							   ->dateFormat('dd-mm-yyyy')->show();
							?>
						</th>
					</tr>
					<tr>
						<th>End Date</th>
						<th>
							<?php
							$ui->datePicker()->label('Date')
							   ->name('end_date')->placeholder("Enter the date")
							   ->dateFormat('dd-mm-yyyy')->show();
							?>
						</th>
					</tr>
				<?php


			$table->close();
		$row = $ui->row()->open(); 
		?><center><?php
			$ui->button()->name('Submit')->value('Submit')->submit(true)->uiType('primary')->show();
		?></center><?php
		$row->close();
		$form->close();
		$box->close();

	$search->close();

	$tabBox1->close();
	$column1->close();
?>

<script charset="utf-8">
	$(document).ready(function() {
		get_dept_query("abc"); // or $(this).val()
	});
	$("#department_name").on('change', function() {
		find_faculty_query(this.value,"abc"); // or $(this).val()
	});
</script>