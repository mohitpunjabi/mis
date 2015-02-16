$.fn.extend({
	showLoading: function() {
		return this.each(function() {
				$(this).append('<div class="overlay"></div><div class="loading-img"></div>');
		});
	},
	hideLoading: function() {
		return this.each(function() {
				$(this).find('div.overlay, div.loading-img').remove();
		});
	}
});

$(document).ready(function() {
	$(".-mis-menu-authtype .role").click(function(e) {
//		alert();
		$(".notification-drawer").removeClass("closed");
		$(this).next(".notification-drawer").addClass("closed");
		e.stopImmediatePropagation();
	});
});