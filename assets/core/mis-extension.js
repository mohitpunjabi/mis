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