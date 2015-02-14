<div id="print">
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
	$("#dateDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
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
	$("#dateDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	$("#tomorrowDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
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
	$("#tomorrowDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
	
	
	$("#compDutyChartTable").delegate(".photo-zoom", "mouseenter", function(e) {
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
	$("#compDutyChartTable").delegate(".photo-zoom", "mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
});
</script>
<div id="print">
<?php

$ui = new UI();
$tabsRow = $ui->row()->open();

		$tabBox = $ui->tabBox()
				   ->icon($ui->icon("th"))
				   ->title("Duty Chart")
				   ->tab("today", $ui->icon("bars")."Today Chart", true)
				   ->tab("tomorrow", $ui->icon("bars")."Tomorrow Chart")
				   ->tab("complete", $ui->icon("bars")."Complete Chart")
				   ->open();
			
			
			$tab1 = $ui->tabPane()->id("today")->active()->open();
				if(count($details_of_guards_at_a_date_today)==0)
				{
					$box = $ui->callout()
							  ->title("Empty List")
							  ->desc("There is no duty for any guard today.")
							  ->uiType("info")
							  ->show();
				}
				else
				{	
							$table = $ui->table()
										->id('dateDutyChartTable')
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
										<th><center>Post Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Replace</center></th>
										<th><center>Remove</center></th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<th class="print-no-display" width="30px">Photo</th>
										<th><center>Guard Name</center></th>
										<th><center>Post Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Replace</center></th>
										<th><center>Remove</center></th>
									</tr>
								</tfoot>	
						<?php	
							$table->close();
				}
				$tab1->close();
			
				$tab1 = $ui->tabPane()->id("tomorrow")->open();
					if(count($details_of_guards_at_a_date_tomorrow)==0)
					{
						$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("There is no duty for any guard tomorrow.")
								  ->uiType("info")
								  ->show();
					}
					else
					{
						$table = $ui->table()
										->id('tomorrowDutyChartTable')
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
										<th><center>Post Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Replace</center></th>
										<th><center>Remove</center></th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<th class="print-no-display" width="30px">Photo</th>
										<th><center>Guard Name</center></th>
										<th><center>Post Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Replace</center></th>
										<th><center>Remove</center></th>
									</tr>
								</tfoot>	
						<?php	
							$table->close();
					}
				$tab1->close();
				$tab1 = $ui->tabPane()->id("complete")->open();
					if(count($details_of_guards_at_a_date_today)==0)
					{
						$box = $ui->callout()
								  ->title("Empty List")
								  ->desc("There is no duty for any guard today.")
								  ->uiType("info")
								  ->show();
					}
					else
					{	
								$table = $ui->table()
											->id('compDutyChartTable')
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
										<th><center>Post Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Duty Date</center></th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<th class="print-no-display" width="30px">Photo</th>
										<th><center>Guard Name</center></th>
										<th><center>Post Name</center></th>
										<th><center>Shift</center></th>
										<th><center>Duty Date</center></th>
									</tr>
								</tfoot>	
							<?php	
							$table->close();
						}
				$tab1->close();
	   $tabBox->close();
$tabsRow->close();
				 
?>
</div>