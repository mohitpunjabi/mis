$(document).ready(function() {
	$(".notification").css({
		"opacity": "0",
		"top": "-20px"
	}).animate({
		opacity: "1",
		top: "0px"
	}, 500);
});