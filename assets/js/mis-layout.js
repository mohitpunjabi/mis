var notifsShowing = 4;

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

	$(".counter.active").css({
		opacity: "0",
	})
	.animate({
		opacity: "1",
		top: "3px"
	}, 100)
	.animate({
		top: "7px"
	}, 100)
	.animate({
		opacity: "1",
		top: "3px"
	}, 100)
	.animate({
		top: "7px"
	}, 100)
	.animate({
		opacity: "1",
		top: "3px"
	}, 100)
	.animate({
		top: "7px"
	}, 100);

	$(".notification-drawer").append("<center><br /><a href='#' id='loadOlderNotifs'>Load older notifications</a><br /></center>");
	
	$("#loadOlderNotifs").click(function(e) {
		notifsShowing += 10;
		loadMoreNotifications();
		e.stopImmediatePropagation();
	});
	
	function loadMoreNotifications() {
		var $readNotifs = $(".notification-drawer .read .-mis-notification-link");
		$readNotifs.show();
		if($readNotifs.length >= notifsShowing) {
			for(var i = notifsShowing; i < $readNotifs.length; i++)
				$($readNotifs[i]).hide();
		}
		else
			$("#loadOlderNotifs").hide();
	}

	loadMoreNotifications();

	$(".-mis-menu-authtype > .counter").click(function(e) {
		$(".notification-drawer").hide();
		$(this).parent().find(".notification-drawer").fadeIn("fast");
		e.stopImmediatePropagation();
	});

	$(window).click(function() {
		$(".notification-drawer").fadeOut("fast");
	});	

});