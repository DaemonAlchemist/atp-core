var ATP = ATP || {};

ATP.partial = function(selector) {
	return $(selector).html();
};

ATP.template = function(options) {
	return Mustache.render($("#" + options.selector).html(), options.view, options.partials);
};
