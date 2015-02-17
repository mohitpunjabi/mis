
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
		"image/bmp": true
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
