var $ = jQuery.noConflict();
$(document).ready(function() {
		/* for top navigation */
		$(" #topnavigation ul ul ").css({display: "none"}); // Opera Fix
		$(" #topnavigation li").hover(function(){
		// $(this).find('ul:first').css({visibility: "visible",display: "none"}).slideDown(400); FITZ - removed this because it was jacked up (missing background, jerky animation)
		$(this).find('ul:first').css({visibility: "visible",display: "block"});
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
		});		
});