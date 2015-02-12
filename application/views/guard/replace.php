<script type="text/javascript">
$(document).ready(function() {
	var showPhoto = function () {
		this.div = $('<div style="position: fixed; z-index: 1000000; height: 300px; width: 300px; min-width: 60px;  background-size: auto 100%; background-position: 50% 50%; background-repeat: no-repeat;transition: all 0.5s cubic-bezier(.23,1.34,1,.93);"></div>');
		return this;
	}
	showPhoto.prototype = {
		show: function(imageUrl, x, y, xoffset, yoffset, size, screen) {
			if(arguments.length==6) {			
				var top = y-yoffset;
				if (top + 200 > window.innerHeight) {
					top -= 170;
				}
				this.div.css({
					"background-image": "url('"+imageUrl+"')",
					"top": (top)+"px",
					"left": (x+21-xoffset)+"px",
					width: 0,
					height: 0
					// "width": parseInt(200*size.width/size.height-1)+"px"
				});
			}
			$(document.body).append(this.div);
			var $this = this;
			(function() {
				setTimeout(function(){
					console.log($this);
					$this.div.css({
						"height": "150px",
						width: "150px"
					});
				}, 10);
			})();
		},
		hide: function() {
			var $this = this;
			(function() {
				setTimeout(function(){
					// console.log($this);
					$this.div.detach();
				}, 300);
			})();
			$this.div.css({
				"height": "0px",
				width: "0px"
			});
		}
	}
	var photo = new showPhoto();
	$(".photo-zoom").on("mouseenter", function(e) {
		e.preventDefault();
		var imageUrl = $(this).data('photo-url');
		// console.log(imageUrl);
		var image = document.createElement("img");
		image.src = imageUrl;
		
		image.onload = function() {
			photo.show(imageUrl, e.clientX, e.clientY, e.offsetX, e.offsetY, {height: this.height, width: this.width});
		};
	});
	$(".photo-zoom").on("mouseout", function(e) {
		e.preventDefault();
		photo.hide();
	});
});
</script>



<?php
if($shift == 'a') $shift = 'A';
if($shift == 'b') $shift = 'B';
if($shift == 'c') $shift = 'C';

$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Replace Guard ('.$guarddetails->firstname.' '.$guarddetails->lastname.')'.'<div style="height: 30px; 
									width: 30px;
									background-image: url('.base_url().'assets/images/guard/'.$guarddetails->photo.');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
									float: right;
									margin-left: 20px;
									border-radius: 30px;
									"
									data-photo-url="'.base_url().'assets/images/guard/'.$guarddetails->photo.'"
									class="print-no-display photo-zoom"></div>')
				 ->solid()
				 ->open();
	$form = $ui->form()
		   ->multipart()
		   ->action('guard/duties/replace')
		   ->open();
						  
	$guardRow = $ui->row()
					->id('searchRow')
					->open();

			$guardlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Guard Name';
                $guardlabel->close();

                $guardinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  $ui->input()
								 ->disabled()
								 ->value($guarddetails->firstname.' '.$guarddetails->lastname)
								 ->addonLeft($ui->icon("user"))
								 ->show();
		
							  //echo '<br>';
				$guardinput->close();		
	$guardRow->close();
	$postRow = $ui->row()
					->id('postRow')
					->open();

			$postlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Post Name';
                $postlabel->close();

                $postinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
								$ui->input()
								 ->disabled()
								 ->value($postname)
								 ->addonLeft($ui->icon("building"))
								 ->show();
								//echo $postname;
				$postinput->close();		
	$postRow->close();
	$shiftRow = $ui->row()
					->id('shiftRow')
					->open();

			$shiftlabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Duty Shift';
                $shiftlabel->close();

                $shiftinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
								$ui->input()
								 ->disabled()
								 ->value($shift)
								 ->addonLeft($ui->icon("bars"))
								 ->show();
				$shiftinput->close();		
	$shiftRow->close();
	$dateRow = $ui->row()
					->id('dateRow')
					->open();

			$datelabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Duty Date';
                $datelabel->close();

                $dateinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  		$ui->input()
									   ->value(date('d M Y',strtotime($date)+19800))
									   ->disabled()
									   ->addonLeft($ui->icon("calendar"))
									   ->show();
				$dateinput->close();		
	$dateRow->close();
	$replaceRow = $ui->row()
					 ->open();
				    $replacelabel = $ui->col()
                              ->width(4)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Replace By';
					$replacelabel->close();

					 $guardcol = $ui->col()
									->width(8)
									->t_width(8)
									->m_width(12)
									->open();
						$guardname_array = array();
									if($all_gaurds_at_same_shift === False)
										$guardname_array[] = $ui->option()->value('')->text('No Guardname');
									
									else
									{
										$guardname_array[] = $ui->option()->value('')->text('Select Guardname')->disabled();
										foreach ($all_gaurds_at_same_shift as $row)
										{
											$guardname_array = array_values($guardname_array);
											$guardname_array[] = $ui->option()->value($row->Regno)->text($row->firstname.' '.$row->lastname);
										}
									}
									$ui->select()
									   ->name('guard_id')
									   ->addonLeft($ui->icon("user"))
									   ->options($guardname_array)
									   ->required()
									   ->show();
		
					
					$guardcol->close();

	$replaceRow->close();
	$remarksRow = $ui->row()
					->id('remarksRow')
					->open();

			$remarkslabel = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                              echo 'Remarks';
                $remarkslabel->close();

                $remarksinput = $ui->col()
                              ->width(8)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
							  
							  		$ui->input()
									   ->id('remarks')
									   ->name('remarks')
									   ->placeholder('Enter Remarks')
									   ->addonLeft($ui->icon("book"))
									   ->required()
									   ->show();
				$remarksinput->close();		
	$remarksRow->close();
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
						   ->value('Save')
						   ->uiType('primary')
						   ->submit()
						   ->name('replace')
						   ->show();
			$bbuttonCol->close();
			$cbuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(2)
                              ->open();
			$cbuttonCol->close();
	$buttonRow->close();

		$ui->input()
		   ->id('date')
		   ->name('date')
		   ->extras("type='hidden'")
		   ->value($date)
		   ->show();
		$ui->input()
		   ->id('regno')
		   ->name('regno')
		   ->extras("type='hidden'")
		   ->value($regno)
		   ->show();
		$ui->input()
		   ->id('post_id')
		   ->name('post_id')
		   ->extras("type='hidden'")
		   ->value($post_id)
		   ->show();
		$ui->input()
		   ->id('shift')
		   ->name('shift')
		   ->extras("type='hidden'")
		   ->value($shift)
		   ->show();
	$form->close();
$headingBox->close();	

?>
</center>