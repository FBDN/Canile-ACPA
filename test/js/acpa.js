/**
 * 
 */
var ACPA =(function($){
	var that = {};
 that.init = function(){
	$.getScript("js/jquery.twitterfeed.js",function(){ $("#tweets").twitterFeed();});
	$.getScript("//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js");
	$.getScript("//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js");
	$.getScript("//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js",function(){$('.lazy').lazy();});
	$(function(){
		$('.nav-link').filter(function(){
			return this.href==location.href;
			}
		).addClass('active').siblings().removeClass('active');
		$('.nav-link').on("click",function(){
			$('.nav-link').removeClass('active');
			$(this).addClass('active');
		});
	});
	
  };
	return that.init();
})(jQuery);