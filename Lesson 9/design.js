$("document").ready(function() {
	//$("button").append('<svg width="100%" height="100%" overflow="hidden"><defs></defs><g><ellipse rx="20" ry="20" stroke="none" fill="white" class="ripple" fill-opacity="0.5" ></ellipse></g></svg>')

	$("button, .button").click(function(e) {
		var box = this;

		var x = e.pageX;
        var y = e.pageY;
        var clickY = y - $(this).offset().top;
        var clickX = x - $(this).offset().left;

        $(this).find("svg").remove();

        var setX = parseInt(clickX);
		var setY = parseInt(clickY);	

		$(this).append('<svg><circle cx="' + setX + '" cy="' + setY + '" r="' + 0 + '"></circle></svg>');

		var c = $(box).find("circle");
		console.log(c);
		c.animate({
			"r" : Math.sqrt(Math.pow($(box).outerWidth(), 2) + Math.pow($(box).outerHeight(), 2)).toFixed(2)
		}, {
			easing: "easeOutQuad",
			duration: 400,
			step : function(val){
				c.attr("r", val);
			}
		});
		c.animate({
			opacity: 0
		}, 'slow');

		return false;
	});
});	