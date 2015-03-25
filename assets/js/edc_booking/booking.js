$(document).ready(function(){
	$("button").hide();
	$("select[name=no_of_guests]").change(function() {
		var html = $("#guest-details-tpl").html();
		var template = $(html);
		var numGuests = $(this).val();
		numGuests = parseInt(numGuests);
		//console.log(numGuests);
		var box = $("#get-guestdetailscol");
		box.find(".guest-details").remove();
		//console.log(box);
		for(var i=0; i<numGuests; i++) {
			var row = template.clone();
			row.addClass("guest-details");
			//console.log(row);
			row.find(".box-title").append('<span class="guest-no"> '+(i+1)+' </span>');
			row.find("#name").attr("name", "guest["+i+"][name]");
			row.find("#gender").attr("name", "guest["+i+"][gender]");
			row.find("#address").attr("name", "guest["+i+"][address]");
			row.find("#room_preference").attr("name", "guest["+i+"][room_preference]");
			box.append(row);
		}
		$("button").show();
	});
});