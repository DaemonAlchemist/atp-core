$(function() {
	$(".small-placeholders").each(function(index, form){
		$(form).find("input[type!=checkbox][type!=file], textarea").each(function(index, elem){
			var name = $(elem).attr("name");
			var label = $("label[for=" + name + "]");
			$(elem).attr("placeholder", label.html());
			label.addClass("small-placeholder");
			label.css("visibility", "hidden");
			
			$(elem).keypress(function(){
				setTimeout(function(){
					var value = $(elem).val().trim();
					//alert(value);
					label.css("visibility", value != "" ? "visible" : "hidden");
				}, 100);
			});
		});
	});
});