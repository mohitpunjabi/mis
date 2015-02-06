
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
<center><h2>Enter the Details of Guard</h2></center>
<table width="100%"><tr><th></th></tr></table>
	<?php  echo form_open_multipart('guard/manage_guard/edit');   ?>
<table width="100%">
			<tr>
            	<td>Registration Number</td>
            	<td><input type="text" placeholder="  Registration Number  "  id ="Regnos" name="Regnos"  required="required" value="<?php echo $details_of_a_guard['Regno']?>" disabled="disabled"/></td>
                <td>First name</td>
            	<td><input type="text" placeholder="First Name"  id ="firstname" name="firstname" required="required" value="<?php echo $details_of_a_guard['firstname']?>"/></td>            	
            </tr>
            <tr>
            	<td>Last name</td>
            	<td><input type="text" placeholder="Last Name" id ="lastname" name="lastname"  required="required" value="<?php echo $details_of_a_guard['lastname']?>"/><br></td>
            	<td>Father's name</td>
            	<td><input type="text" placeholder="Father's Name" id ="fathersname" name="fathersname" required="required" value="<?php echo $details_of_a_guard['fathersname']?>"/></td>         	    
            </tr> 
          	<tr>
            	<td>Qualification</td>
            	<td><input type="text" placeholder="Qualification"  id ="qualification" name ="qualification" required="required" value="<?php echo $details_of_a_guard['qualification']?>"/></td>
            	<td>Date of Birth</td>
            	<td><input type="date" value="<?php echo $details_of_a_guard['dateofbirth']?>" id ="dateofbirth" name="dateofbirth" max="<?php echo date('Y-m-d')?>"/></td>
            </tr>
        	<tr>
	            <td>Date of Joining</td>
           		<td><input type="date" value="<?php echo $details_of_a_guard['dateofjoining']?>" id ="dateofjoining" name="dateofjoining"/></td>
            	<td>Local Address</td>
           	    <td><input type="text" placeholder="Local Address"  id ="localaddress" name ="localaddress" required="required" value="<?php echo $details_of_a_guard['localaddress']?>"/></td>
            </tr>   
          	<tr>
            	<td>Permanent Address</td>
            	<td><input type="text" placeholder="Permanent Address" id ="permanentaddress" name="permanentaddress" required="required" value="<?php echo $details_of_a_guard['permanentaddress']?>"/></td>
	            <td>Mobile number</td>
            	<td><input type="text" placeholder="8051010684" id ="mobilenumber" name="mobilenumber" required="required" pattern="[789]{1}[0-9]{9}" value="<?php echo $details_of_a_guard['mobilenumber']?>"/></td>
            </tr>
           	<tr>
            	<td>Photo</td>
            	<td><input type="file" id = "photo" name="photo" onchange="readURL(this);"/></td>
            	<td colspan= "1"><div style ="color:336699;">(*size less than 1 MB jpeg/bmp/png/jpg/gif)</div></td>
				<?php echo '<td id ="preview" style="height: 60px; 
									width: 40px;
									background-image: url('.base_url().'assets/images/guard/'.$details_of_a_guard['photo'].');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
								"></td>';
				?>
           	</tr>
        	</table>
		<input type="text"  id ="Regno" name="Regno" value="<?php echo $details_of_a_guard['Regno']?>" hidden="hidden"/>
		<?php	echo form_submit('savesubmit','Save');
				echo form_close();
		?>