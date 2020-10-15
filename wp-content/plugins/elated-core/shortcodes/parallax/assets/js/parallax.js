(function($) {
    'use strict';
	
    $(window).load(function() {
	    eltdfInitParallax();
	    if(eltdf.body.hasClass('wpb-js-composer')) {
		    window.vc_rowBehaviour(); //call vc row behavior on load, this is for parallax on row since it is not loaded after some other shortcodes are loaded
	    }
    });
	
	/*
	 ** Init parallax shortcode
	 */
	function eltdfInitParallax(){
		var parallaxHolder = $('.eltdf-parallax-holder');
		
		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					speed = parallaxElement.data('parallax-speed')*0.4;
				
				parallaxElement.parallax('50%', speed);
			});
		}
	}

})(jQuery);