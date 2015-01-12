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
	
	$(".-mis-menu-authtype > .role").click(function() {
		$(this).parent().toggleClass("collapsed");
	});

	$(".counter").css({
		opacity: "0",
	})
	.animate({
		opacity: "1",
		top: "3px"
	}, 200)
	.animate({
		top: "7px"
	}, 200);

	$(".-mis-menu-authtype > .counter").click(function(e) {
		$(".notification-drawer").hide();
		$(this).parent().find(".notification-drawer").fadeIn("fast");
		e.stopImmediatePropagation();
	});

	$(window).click(function() {
		$(".notification-drawer").fadeOut("fast");
	});	

});