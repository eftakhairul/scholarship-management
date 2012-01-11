$(function () {
	
	// Preload images
	$.preloadCssImages();
	
	
	// Navigation dropdown fix for IE6
	if(jQuery.browser.version.substr(0,1) < 7) {
		$('#header #nav li').hover(
			function() { $(this).addClass('iehover'); },
			function() { $(this).removeClass('iehover'); }
		);
	}
	
	// IE6 PNG fix
	$(document).pngFix();
		
});