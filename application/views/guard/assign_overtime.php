<script>
$(document).ready(function(){
	$('#get_guards').click(function(){
		showGuards();
	});
	$('#minutes_to').change(function(){
		$('#get_guards').show();
	});
	$('#minutes_from').change(function(){
		$('#get_guards').show();
	});
	$('#hours_to').change(function(){
		$('#get_guards').show();
	});
	$('#hours_from').change(function(){
		$('#get_guards').show();
	});
});

function showGuards()
{
	var post_id= document.getElementById('post_id').value;
	var date= document.getElementById('date').value;
	var hours_from= document.getElementById('hours_from').value;
	var minutes_from= document.getElementById('minutes_from').value;
	var hours_to= document.getElementById('hours_to').value;
	var minutes_to= document.getElementById('minutes_to').value;
	var from_time = parseFloat(hours_from) + parseFloat(minutes_from);
	var to_time = parseFloat(hours_to) + parseFloat(minutes_to);
	var range = from_time + to_time;
	
	if(post_id == "")
	{
		alert("Fill post name");
		$("#post_id").focus();
	}
	else if(hours_from == "")
	{	
		alert("Fill from hours");
		$("#hours_from").focus();
	}
	else if(minutes_from == "")
	{	
		alert("Fill from minutes");
		$("#minutes_from").focus();
	}
	else if(hours_to == "")
	{	
		alert("Fill to hours");
		$("#hours_to").focus();
	}
	else if(minutes_to == "")
	{	
		alert("Fill to minutes");
		$("#hours_to").focus();
	}
	else if(!(from_time >=21.0 && to_time <= 8.0) && from_time > to_time)
	{
		alert("Time Range Invalid");
		document.getElementById('hours_from').value="";
		document.getElementById('hours_to').value="";
		document.getElementById('minutes_from').value="";
		document.getElementById('minutes_to').value="";
		$("#hour_from").focus();
	}
	else if(to_time - from_time >= 8.0 )
	{
		alert("Sorry, you are not allowed to assign duty for more than 8 hours.");
		document.getElementById('hours_from').value="";
		document.getElementById('hours_to').value="";
		document.getElementById('minutes_from').value="";
		document.getElementById('minutes_to').value="";
		$("#hour_from").focus();
	}
	else 
	{
		//alert(post_id + " " + date + " " + range);
		var xmlhttp;
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		  
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("guard-div").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("POST",site_url("guard/get_guards/index/" + post_id + "/" + date + "/" + from_time + "/" + to_time + "/" + range),true);
		xmlhttp.send();
		$("#get_guards").hide();
		return false;
	}
}	

</script>

<?php
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Assign Overtime Duty to a Guard')
				 ->solid()
				 ->open();
	
	$form = $ui->form()
		   ->multipart()
		   ->action('guard/over_time/assign_to_a_guard')
		   ->open();
						  
	$postRow = $ui->row()
					->id('searchRow')
					->open();

			$postlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Select Post Name';
                $postlabel->close();

                $postinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  $postname_array = array();
									if($posts === False)
										$postname_array[] = $ui->option()->value('')->text('No Postname');
									
									else
									{
										$postname_array[] = $ui->option()->value('')->text('Select Postname')->disabled();
										foreach ($posts as $row)
										{
											$postname_array = array_values($postname_array);
											$postname_array[] = $ui->option()->value($row['post_id'])->text($row['postname']);
										}
									}
									$ui->select()
									   ->name('post_id')
									   ->id('post_id')
									   ->addonLeft($ui->icon("building"))
									   ->options($postname_array)
									   ->required()
									   ->show();
                
				$postinput->close();		
	$postRow->close();
	
	$dateRow = $ui->row()
					->id('dateRow')
					->open();

			$datelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
										echo 'Select a date';
			$datelabel->close();
			$dateinput = $ui->col()
							->width(4)
							->t_width(4)
							->m_width(12)
							->open();
						

						$ui->datePicker()
						->name('date')
						->id('date')
						->placeholder("Enter the date")
						->addonLeft($ui->icon("calendar"))
						->dateFormat('yyyy-mm-dd')
						->required()
						->extras("min='date('yyyy-mm-dd')'")
						->show();		
																   
			$dateinput->close();        	

	$dateRow->close();
	$fromRow = $ui->row()
					->id('fromRow')
					->open();
		
			$fromlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'From Time';
                $fromlabel->close();

                $frominput = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(6)
                              ->open();
							  	$ui->select()
									   ->name('hours_from')
									   ->id('hours_from')
									   ->addonLeft($ui->icon("clock-o"))
									   ->options(array($ui->option()->value('')->text('Hours')->disabled()->selected(),
                                            $ui->option()->value(0)->text(0),$ui->option()->value(1)->text(1),$ui->option()->value(2)->text(2),
											$ui->option()->value(3)->text(3),$ui->option()->value(4)->text(4),$ui->option()->value(5)->text(5),
											$ui->option()->value(6)->text(6),$ui->option()->value(7)->text(7),$ui->option()->value(8)->text(8),
											$ui->option()->value(9)->text(9),$ui->option()->value(10)->text(10),$ui->option()->value(11)->text(11),
											$ui->option()->value(12)->text(12),$ui->option()->value(13)->text(13),$ui->option()->value(14)->text(14),
											$ui->option()->value(15)->text(15),$ui->option()->value(16)->text(16),$ui->option()->value(17)->text(17),
											$ui->option()->value(18)->text(18),$ui->option()->value(19)->text(19),$ui->option()->value(20)->text(20),
											$ui->option()->value(21)->text(21),$ui->option()->value(22)->text(22),$ui->option()->value(23)->text(23)))
                                       ->required()
									   ->show();
				$frominput->close();
			    $fromMinCol = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(6)
                              ->open();

								$ui->select()
									   ->name('minutes_from')
									   ->id('minutes_from')
									   ->options(array($ui->option()->value('')->text('Minutes')->disabled()->selected(),
                                            $ui->option()->value(.0)->text(00),
											$ui->option()->value(.5)->text(30)))
                                            ->required()
									   ->show();	   
				$fromMinCol->close();	
				$freeCol = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();	
				$freeCol->close();
	$fromRow->close();
	$toRow = $ui->row()
					->id('toRow')
					->open();
		
			$tolabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'To Time';
                $tolabel->close();

                $toinput = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(6)
                              ->open();
							  	$ui->select()
									   ->name('hours_to')
									   ->id('hours_to')
									   ->addonLeft($ui->icon("clock-o"))
									   ->options(array($ui->option()->value('')->text('Hours')->disabled()->selected(),
                                            $ui->option()->value(0)->text(0),$ui->option()->value(1)->text(1),$ui->option()->value(2)->text(2),
											$ui->option()->value(3)->text(3),$ui->option()->value(4)->text(4),$ui->option()->value(5)->text(5),
											$ui->option()->value(6)->text(6),$ui->option()->value(7)->text(7),$ui->option()->value(8)->text(8),
											$ui->option()->value(9)->text(9),$ui->option()->value(10)->text(10),$ui->option()->value(11)->text(11),
											$ui->option()->value(12)->text(12),$ui->option()->value(13)->text(13),$ui->option()->value(14)->text(14),
											$ui->option()->value(15)->text(15),$ui->option()->value(16)->text(16),$ui->option()->value(17)->text(17),
											$ui->option()->value(18)->text(18),$ui->option()->value(19)->text(19),$ui->option()->value(20)->text(20),
											$ui->option()->value(21)->text(21),$ui->option()->value(22)->text(22),$ui->option()->value(23)->text(23)))
                                            ->required()
									   ->show();
				$toinput->close();
			    $toMinCol = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(6)
                              ->open();

								$ui->select()
									   ->name('minutes_to')
									   ->id('minutes_to')
									   ->options(array($ui->option()->value('')->text('Minutes')->disabled()->selected(),
                                            $ui->option()->value(.0)->text(00),
											$ui->option()->value(.5)->text(30)))
                                            ->required()
									   ->show();	   
				$toMinCol->close();	
				$freeCol = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();	
				$freeCol->close();
	$toRow->close();
	$buttonRow = $ui->row()
					->open();
					
			$abuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(2)
                              ->open();
			$abuttonCol->close();
			$bbuttonCol = $ui->col()
                              ->width(2)
                              ->t_width(8)
                              ->m_width(8)
                              ->open();
							  
						$ui->button()
						   ->value('Get Available Guards')
						   ->uiType('primary')
						   ->name('get_guards')
						   ->id('get_guards')
						   ->show();
			$bbuttonCol->close();
			$cbuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(2)
                              ->open();
			$cbuttonCol->close();
	$buttonRow->close();
	echo '<div id="guard-div">
	</div>';
	$form->close();
$headingBox->close();	

?>
</center>