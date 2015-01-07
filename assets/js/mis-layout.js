$(document).ready(function() {
	$(".notification").css({
		"opacity": "0",
		"top": "-20px"
	}).animate({
		opacity: "1",
		top: "0px"
	}, 500);


	$(".-mis-navbar ul > li").mouseenter(function(e) {
		$(this).find("> ul").css({
			"opacity": "0",
			"right": "-100%"
		}).animate({
			opacity: "1",
			right: "-105%"
		}, 200);
	});
});