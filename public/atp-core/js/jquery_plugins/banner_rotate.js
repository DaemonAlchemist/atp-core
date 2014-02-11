;(function ( $, window, document, undefined ) {
    var pluginName = "bannerRotate";
    var defaults = {
		bannerDisplayTime: 10000,
		bannerFadeTime: 800
	};

    function Plugin( element, options ) {
        this.element = element;

        this.options = $.extend( {}, defaults, options );

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Plugin.prototype = {

        init: function() {
			var elem = $(this.element);
			var options = this.options;
			
			//Hide banners on first load
			elem.children().addClass("banner").hide();
			elem.children(':first-child').addClass("banner-displayed");
			elem.children(':first-child').show();
			
			//Add buttons
			var bannerCount = elem.children().length;
			elem.append("<div class=\"banner-buttons\"></div>");
			var buttons = elem.find(".banner-buttons");
			for(var i=1; i<=bannerCount; i++) {
				buttons.append("<a href=\"#\" class=\"banner-button\">" + i + "</a>");
			}
			buttons.children(":first-child").addClass("active");
			
			var rotatorFunc = function() {
				//Disable buttons while transition is happening
				buttons.find("a").addClass("disabled");
			
				//Get current banner and button
				var curBanner =  elem.find(".banner-displayed");
				var curButton = elem.find(".banner-buttons a.active");
				
				//Update banner index
				curBannerIndex++;
				
				//Get next banner
				if(curBannerIndex > bannerCount) curBannerIndex = 1;
				var nextBanner = elem.find(".banner:nth-child("+curBannerIndex+")");
				var nextButton = elem.find(".banner-buttons a:nth-child("+curBannerIndex+")");
				
				//Fade transition between banners
				curBanner.removeClass("banner-displayed");
				curBanner.fadeOut({
					duration: options.bannerFadeTime,
					complete: function(){
						nextBanner.fadeIn({
							duration: options.bannerFadeTime,
							complete: function(){
								nextBanner.addClass("banner-displayed");
								buttons.find("a").removeClass("disabled");
							}
						});
					}
				});
				
				//Update button styles
				curButton.removeClass("active");
				nextButton.addClass("active");
			};
			
			var curBannerIndex = 1;
			var rotator = null;
			buttons.find("a").click(function(evt){
				//Don't do anything if the link is disabled
				if($(this).hasClass("disabled")) return false;
			
				//Get index of selected banner
				var index = parseInt($(this).html());
				curBannerIndex = index - 1;
				if(curBannerIndex == 0) curBannerIndex = bannerCount;
				
				//Show new banner and reset rotator
				clearInterval(rotator);
				rotatorFunc();
				rotator = setInterval(rotatorFunc, options.bannerDisplayTime);
				return false;
			});
			
			//Rotate banners
			rotator = setInterval(rotatorFunc, options.bannerDisplayTime);
        },
    };

    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin( this, options ));
            }
        });
    };

})( jQuery, window, document );
