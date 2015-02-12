<script>
$(document).ready(function(){
	$('select[name="mode"]').change(function(){
		var value  = this.value;
		if(value==''){
			return;
		}
		$("#postname, #date, #rangeofdates, #rangeofdates_postname, #rangeofdates_guard").hide();
		$("#" + value).show();
	});
	$('select[name="mode"]').val("<?php if(isset($mode)) echo $mode; ?>").trigger('change');
	$('select[name="postname"]').val("<?php if(isset($postname)) echo $postname;?>");
	$('select[name="postnamer"]').val("<?php if(isset($postnamer)) echo $postnamer;?>");
	$('select[name="guardname"]').val("<?php if(isset($guardname)) echo $guardname;?>");
	$('#selectdate').val("<?php if(isset($selectdate)) echo $selectdate; else echo date("Y-m-d");?>");
	$('#fromdate').val("<?php if(isset($fromdate)) echo $fromdate; else echo date("Y-m-d");?>");
	$('#fromdateg').val("<?php if(isset($fromdateg)) echo $fromdateg; else echo date("Y-m-d");?>");
	$('#fromdatep').val("<?php if(isset($fromdatep)) echo $fromdatep; else echo date("Y-m-d");?>");
	$('#todate').val("<?php if(isset($todate)) echo $todate; else echo date("Y-m-d");?>");
	$('#todateg').val("<?php if(isset($todateg)) echo $todateg; else echo date("Y-m-d");?>");
	$('#todatep').val("<?php if(isset($todatep)) echo $todatep; else echo date("Y-m-d");?>");
});
</script>
<script>
// JavaScript Document
$(document).ready(function() {
	$("#postDutyChartBox").hide();
	$("#postsubmit").click(function(){
		//alert(document.getElementById("post_id").value);
		// Show the loading gif before sending the request
		$("#postDutyChartBox").show();
		var div = document.getElementById("post-div");
		var mylist = document.getElementById("post_id");
		// document.getElementById("demo").value = mylist.options[mylist.selectedIndex].text;
		div.innerHTML = '( '+mylist.options[mylist.selectedIndex].text+' )';
		$("#postDutyChartBox").showLoading();
		$.ajax({
			url: site_url("guard/home/loadpostDutyChart/" + document.getElementById("post_id").value)
		}).done(function(userData) {
			// Process the data
			(function() {
				var users = eval(userData);
				var $usersTable = $("#postDutyChartTable").dataTable();
				var data = [];
				for(var i = 0; i < users.length; i++) {
					data[i] = [
						'<div class="photo-zoom" data-photo-url="'+ base_url() +'assets/images/guard/' + users[i].photo +'" style="height: 40px; width: 100%; min-width: 40px; background-image: url(\''+ base_url() +'assets//images//guard//' + users[i].photo +'\'); background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;" class="print-no-display"></div>',
						'<center>'+users[i].firstname +' ' + users[i].lastname+'</center>',				
						'<center>'+users[i].shift.toUpperCase()+'</center>',
						//moment(users[i].date,"DD MM YYYY"),
						'<center>'+users[i].date+'</center>'
					];
				}

				$usersTable.fnAddData(data);
			})();
		}).always(function() {
			// Hide the loading gif, when request is complete.
			$("#postDutyChartBox").hideLoading();
		});
	});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var showPhoto = function () {
		this.div = $('<div style="border: 2px solid #aaa; position: fixed; height: 300px; width: 300px; min-width: 60px;  background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;"></div>');
		return this;
	}
	showPhoto.prototype = {
		show: function(imageUrl, x, y, xoffset, yoffset, size, screen) {
			var top = y-yoffset;
			if (top + 200 > window.innerHeight) {
				top -= 120;
			}
			this.div.css({
				"background-image": "url('"+imageUrl+"')",
				"top": (top)+"px",
				"left": (x+61-xoffset)+"px",
				"height": "200px",
				"width": parseInt(200*size.width/size.height)+"px"
			});
			$(document.body).append(this.div);
		},
		hide: function() {
			this.div.detach();
		}
	}
	var photo = new showPhoto();
	$("#postDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
		e.preventDefault();
		console.log(e);
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$("#postDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
});
</script>
<?php 
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Welcome to Guard Tracking System')
				 ->solid()
				 ->open();
			  
	$searchRow = $ui->row()
					->id('searchRow')
					->open();

			$searchlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Search Assigned Duties';
                $searchlabel->close();

                $searchinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  $ui->select()
								 ->name('mode')
								 ->addonLeft($ui->icon("list"))
								 ->options(array($ui->option()->value('')->text('Select Mode')->disabled(),
                                            $ui->option()->value('postname')->text('By Post Name'),
                                            $ui->option()->value('date')->text('By a Date'),
                                            $ui->option()->value('rangeofdates')->text('By a Range of Dates'),
                                            $ui->option()->value('rangeofdates_postname')->text('By a Range of Dates for a Postname'),
                                            $ui->option()->value('rangeofdates_guard')->text('By a Range of Dates for a Guard')))
								 ->required()
								 ->show();
                
				$searchinput->close();

					
	$searchRow->close();
	echo '<div id="postname" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
						 
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/home')
						   ->open();
				
					$postnamelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select the postname to get details of guards';
					$postnamelabel->close();
					
					$postnameinput = $ui->col()
								    ->width(4)
									->t_width(4)
									->m_width(12)
									->open();
									
									$postname_array = array();
									if($postnames === False)
										$postname_array[] = $ui->option()->value('')->text('No Postname');
									
									else
									{
										$postname_array[] = $ui->option()->value('')->text('Select Postname')->disabled();
										foreach ($postnames as $row)
										{
											$postname_array = array_values($postname_array);
											$postname_array[] = $ui->option()->value($row->post_id)->text($row->postname);
										}
									}
									$ui->select()
									   ->name('postname')
									   ->id('post_id')
									   ->addonLeft($ui->icon("building"))
									   ->options($postname_array)
									   ->required()
									   ->show();
																	   
					$postnameinput->close();        	
				
					$buttoncol = $ui->col()
									->width(4)
									->t_width(8)
									->m_width(12)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->name('postsubmit')
						   ->id('postsubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();		
		$selectqueryRow->close();
	echo '</div>';
	echo '<div id="date" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
		
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/home')
						   ->open();
				
				$datelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select a date to get guards list';
				$datelabel->close();
				$dateinput = $ui->col()
								->width(4)
								->t_width(4)
								->m_width(12)
								->open();
							

							$ui->datePicker()
							->name('selectdate')
							->placeholder("Enter the date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();		
																	   
					$dateinput->close();        	
				
					$buttoncol = $ui->col()
									->width(4)
									->t_width(8)
									->m_width(12)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('datesubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();
				
	    $selectqueryRow->close();
	echo '</div>';
	echo '<div id="rangeofdates" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
		
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/home')
						   ->open();
				
				$rangelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select Range to get Guard\'s Duty';
				$rangelabel->close();
				$rangefrominput = $ui->col()
									 ->width(2)
									 ->t_width(2)
									 ->m_width(6)
									 ->open();
							

							$ui->datePicker()
							->name('fromdate')
							->placeholder("From Date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();		
				
				$rangefrominput->close();			
							
							
				$rangetoinput = $ui->col()
								   ->width(2)
								   ->t_width(2)
								   ->m_width(6)
								   ->open();			
							
							$ui->datePicker()
							->name('todate')
							->placeholder("To Date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();
							
				$rangetoinput->close();        	
				
					$buttoncol = $ui->col()
									->width(4)
									->t_width(8)
									->m_width(12)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('rangesubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();
				
	    $selectqueryRow->close();
	echo '</div>';
	echo '<div id="rangeofdates_guard" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
		
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/home')
						   ->open();
				
					$rangelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select Range to get Guard\'s Duty';
					$rangelabel->close();
					
					$rangefrominput = $ui->col()
									 ->width(2)
									 ->t_width(2)
									 ->m_width(6)
									 ->open();
							

							$ui->datePicker()
							->name('fromdateg')
							->placeholder("From Date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();		
				
					$rangefrominput->close();			
							
							
					$rangetoinput = $ui->col()
								   ->width(2)
								   ->t_width(2)
								   ->m_width(6)
								   ->open();			
							
							$ui->datePicker()
							->name('todateg')
							->placeholder("To Date")
							->addonLeft($ui->icon("calendar"))
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();
							
					$rangetoinput->close();        	
				
					$guardcol = $ui->col()
									->width(3)
									->t_width(6)
									->m_width(9)
									->open();
						$guardname_array = array();
									if($guardnames === False)
										$guardname_array[] = $ui->option()->value('')->text('No Guardname');
									
									else
									{
										$guardname_array[] = $ui->option()->value('')->text('Select Guardname')->disabled();
										foreach ($guardnames as $row)
										{
											$guardname_array = array_values($guardname_array);
											$guardname_array[] = $ui->option()->value($row->Regno)->text($row->firstname.' '.$row->lastname);
										}
									}
									$ui->select()
									   ->name('guardname')
									   ->addonLeft($ui->icon("user"))
									   ->options($guardname_array)
									   ->required()
									   ->show();
		
					
					$guardcol->close();
					
					$buttoncol = $ui->col()
									->width(1)
									->t_width(2)
									->m_width(3)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('rangeguardsubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();
				
	    $selectqueryRow->close();
		
	echo '</div>';
	echo '<div id="rangeofdates_postname" style="display: none;">';
		$selectqueryRow = $ui->row()
						 ->id('selectqueryRow')
						 ->open();
		
				$form = $ui->form()
						   ->multipart()
						   ->action('guard/home')
						   ->open();
				
					$rangelabel = $ui->col()
									  ->width(4)
									  ->t_width(8)
                                      ->m_width(12)
                                      ->open();
                                      echo 'Select Range to get Guard\'s Duty';
					$rangelabel->close();
					
					$rangefrominput = $ui->col()
									 ->width(2)
									 ->t_width(2)
									 ->m_width(6)
									 ->open();
							

							$ui->datePicker()
							->name('fromdatep')
							->addonLeft($ui->icon("calendar"))
							->placeholder("From Date")
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();		
				
					$rangefrominput->close();			
							
							
					$rangetoinput = $ui->col()
								   ->width(2)
								   ->t_width(2)
								   ->m_width(6)
								   ->open();			
							
							$ui->datePicker()
							->name('todatep')
							->addonLeft($ui->icon("calendar"))
							->placeholder("To Date")
							->dateFormat('yyyy-mm-dd')
							->required()
							->show();
							
					$rangetoinput->close();        	
				
					$postnamecol = $ui->col()
									->width(3)
									->t_width(6)
									->m_width(9)
									->open();
						$postname_array = array();
									if($postnames === False)
										$postname_array[] = $ui->option()->value('')->text('No Postname');
									
									else
									{
										$postname_array[] = $ui->option()->value('')->text('Select Postname')->disabled();
										foreach ($postnames as $row)
										{
											$postname_array = array_values($postname_array);
											$postname_array[] = $ui->option()->value($row->post_id)->text($row->postname);
										}
									}
									$ui->select()
									   ->name('postnamer')
									   ->addonLeft($ui->icon("building"))
									   ->options($postname_array)
									   ->required()
									   ->show();
		
					
					$postnamecol->close();
					
					$buttoncol = $ui->col()
									->width(1)
									->t_width(2)
									->m_width(3)
									->open();
						$ui->button()
						   ->value('Submit')
						   ->uiType('primary')
						   ->submit()
						   ->name('rangepostsubmit')
						   ->show();
			
					$buttoncol->close();
				
				$form->close();
				
	    $selectqueryRow->close();
	echo '</div>';
$headingBox->close();

?>

<?
$headingBox = $ui->box()
				 ->id('postDutyChartBox')
				 ->uiType('info')
				 ->title('Details of Guards at post <div style="float:right; margin-left:10px;" id="post-div"></div>')
				 ->solid()
				 ->open();
	
	$table = $ui->table()
				->id('postDutyChartTable')
				->responsive()
				->hover()
				->bordered()
				->striped()
				->sortable()
				->paginated()
				->searchable()
				->open();
?>
		<thead>
            <tr>
                <th class="print-no-display" width="30px">Photo</th>
				<th><center>Guard Name</center></th>
				<th><center>Shift</center></th>
				<th><center>Duty Date</center></th>
            </tr>
		</thead>

        <tfoot>
            <tr>
				<th class="print-no-display" width="30px">Photo</th>
				<th><center>Guard Name</center></th>
				<th><center>Shift</center></th>
				<th><center>Duty Date</center></th>
            </tr>
        </tfoot>	
<?php
	$table->close();
$headingBox->close();

?>