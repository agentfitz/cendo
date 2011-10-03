var $ = jQuery.noConflict();
$(document).ready(function() {
		/* for top navigation */
		$(" #topnavigation ul ul ").css({display: "none"}); // Opera Fix
		$(" #topnavigation li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible",display: "none"}).slideDown(400);
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
		});
		
		
});		 
	
