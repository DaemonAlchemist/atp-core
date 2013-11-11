var ATP = ATP || {};

ATP.partial = function(options) {
	Mustache.compilePartial(options.name, $(options.selector).html());
};

ATP.template = function(options) {
	if(typeof ATP.template.templates == 'undefined') {
		ATP.template.templates = {};
	}
	
	if(typeof ATP.template.templates[options.selector] == 'undefined') {
		ATP.template.templates[options.selector] = Mustache.compile($(options.selector).html());
	}

	return ATP.template.templates[options.selector](options.substitutions, options.partials);
};
