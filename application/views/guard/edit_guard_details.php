
<script type="text/javascript">
$('.-mis-content').delegate(".flash-data.error-msg a.close-btn", 'click', function(e) {
		e.preventDefault();
		$(this).parent().remove();
	});
function showError(errorMessage, errorTarget) {
	
	var errorElement = $('<div class="flash-data error-msg"><a class="close-btn" href="#" style="position: absolute; right: 20px; z-index: 1000;">x</a><p style="opacity: ; top: 0px;" class="notification error">'+errorMessage+'</p></div>');
	$(errorTarget).prepend(errorElement);
	$(errorElement).css({
		"opacity": "0",
		"margin-top": "-20px"
	}).animate({
		opacity: "1",
		"margin-top": "0px"
	}, 500);
}
function readURL(input) {
	var allowedTypes = {
		"image/jpeg": true,
		"image/bmp": true,
		"image/png":true,
		"image/jpg":true,
		"image/gif":true
	};
        if (input.files && input.files[0]) {
			var file = input.files[0];
			var errorTarget = '.-mis-content';
			console.log(file);
			$(errorTarget).find(".flash-data.error-msg").remove();
			var error = false;
			if(!allowedTypes[file.type]) {
				showError('Invalid filetype.', errorTarget);
				error = true;
			}
			if(file.size > 1024*1024) {
				showError('Size is greater than 1MB.', errorTarget);
				error = true;
			}
			if(error) {
				input.value = null;
				$("#preview").attr("style", "");
			}
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').css({
						height: "60px", 
						width: "60px",
						"background-image": "url('"+e.target.result+"')",
						"background-size": "auto 100%",
						"background-position": "50% 50%",
						"background-repeat": "no-repeat"
					});
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php
$ui = new UI();
$headingBox = $ui->box()
				 ->uiType('info')
				 ->title('Edit the details of Guard')
				 ->solid()
				 ->open();
	$form = $ui->form()
		   ->multipart()
		   ->action('guard/manage_guard/edit')
		   ->open();
						  
	$registrationRow = $ui->row()
					->id('searchRow')
					->open();

			$registrationlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Registration Number';
            $registrationlabel->close();

            $registrationinput = $ui->col()
                              ->width(10)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  
							$ui->input()
							   ->id('Regnos')
							   ->name('Regnos')
							   ->value($details_of_a_guard['Regno'])
							   ->disabled()
							   ->show();	
		   $registrationinput->close();		
	$registrationRow->close();
	$guardRow = $ui->row()
					->id('guardRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Guard Name';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('firstname')
							   ->name('firstname')
							   ->value($details_of_a_guard['firstname'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
			$guardlabel = $ui->col()
                              ->width(3)
                              ->t_width(6)
                              ->m_width(12)
                              ->open();
                              $ui->input()
							   ->id('middlename')
							   ->name('middlename')
							   ->value($details_of_a_guard['middlename'])
							   ->show();

            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(3)
                              ->t_width(6)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('lastname')
							   ->name('lastname')
							   ->value($details_of_a_guard['lastname'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
	$guardRow->close();
	$fatherRow = $ui->row()
					->id('fatherRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Father\'s Name';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('fathersname')
							   ->name('fathersname')
							   ->value($details_of_a_guard['fathersname'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
			$guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Mobile Number';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('mobilenumber')
							   ->name('mobilenumber')
							   ->type('tel')
							   ->addonLeft($ui->icon("mobile"))
							   ->value($details_of_a_guard['mobilenumber'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
	$fatherRow->close();
	$dateRow = $ui->row()
					->id('dateRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Date of Birth';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->datePicker()
								 ->name('dateofbirth')
							   	 ->value($details_of_a_guard['dateofbirth'])
								 ->addonLeft($ui->icon("calendar"))
								 ->dateFormat('yyyy-mm-dd')
								 ->required()
								 ->show();
							  
			$guardinput->close();
			$guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Date of Joining';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->datePicker()
								 ->name('dateofjoining')
								 ->value($details_of_a_guard['dateofjoining'])
								 ->addonLeft($ui->icon("calendar"))
								 ->dateFormat('yyyy-mm-dd')
								 ->required()
								 ->show();
							  
			$guardinput->close();
	$dateRow->close();
	$addressRow = $ui->row()
					->id('addressRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Local Address';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('localaddress')
							   ->name('localaddress')
							   ->addonLeft($ui->icon("building"))
							   ->value($details_of_a_guard['localaddress'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
			$guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Permanent Address';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('permanentaddress')
							   ->name('permanentaddress')
							   ->addonLeft($ui->icon("building"))
							   ->value($details_of_a_guard['permanentaddress'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
	$addressRow->close();
	$photoRow = $ui->row()
					->id('photoRow')
					->open();

		    $guardlabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Qualification';
            $guardlabel->close();

            $guardinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
							  $ui->input()
							   ->id('qualification')
							   ->name('qualification')
							   ->addonLeft($ui->icon("book"))
							   ->value($details_of_a_guard['qualification'])
							   ->required()
							   ->show();
							  
			$guardinput->close();
			$photolabel = $ui->col()
                              ->width(2)
                              ->t_width(4)
                              ->m_width(12)
                              ->open();
                              echo 'Photo';
            $photolabel->close();
			$photoinput = $ui->col()
                              ->width(4)
                              ->t_width(8)
                              ->m_width(12)
                              ->open();
                 $ui->imagePicker()->name('photo')->id('photo')->required()->show();
				 echo '(*size less than 1 MB jpeg/bmp/png/jpg/gif)';
            $photoinput->close();

	$photoRow->close();
			
	$buttonRow = $ui->row()
					->open();
					
			$abuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(4)
                              ->open();
			$abuttonCol->close();
			$bbuttonCol = $ui->col()
                              ->width(2)
                              ->t_width(8)
                              ->m_width(4)
                              ->open();
							  
						$ui->button()
						   ->value('Save')
						   ->uiType('primary')
						   ->submit()
						   ->name('savesubmit')
						   ->show();
			$bbuttonCol->close();
			$cbuttonCol = $ui->col()
                              ->width(5)
                              ->t_width(2)
                              ->m_width(4)
                              ->open();
			$cbuttonCol->close();
	$buttonRow->close();
	$ui->input()
		   ->id('Regno')
		   ->name('Regno')
		   ->extras("type='hidden'")
		   ->value($details_of_a_guard['Regno'])
		   ->show();	
	$form->close();
$headingBox->close();	

?>