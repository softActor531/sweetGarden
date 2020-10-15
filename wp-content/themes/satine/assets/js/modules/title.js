(function($) {
    "use strict";

    var title = {};
    eltdf.modules.title = title;

    title.eltdfOnDocumentReady = eltdfOnDocumentReady;
    title.eltdfOnWindowLoad = eltdfOnWindowLoad;
    title.eltdfOnWindowResize = eltdfOnWindowResize;
    title.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    initTitleFullHeight();
	    eltdfParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdfOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
	    initTitleFullHeight();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdfOnWindowScroll() {

    }

    /*
     **	Title image with parallax effect
     */
    function eltdfParallaxTitle(){
        if($('.eltdf-title.eltdf-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.eltdf-title.eltdf-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.eltdf-title.eltdf-has-parallax-background.eltdf-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(eltdf.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+eltdfGlobalVars.vars.eltdfAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltdf.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(eltdf.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+eltdfGlobalVars.vars.eltdfAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltdf.scroll + 'px auto'});
            });
        }
    }
	
	function initTitleFullHeight() {
		var title = $('.eltdf-title');
		
		if(title.length > 0 && title.hasClass('eltdf-title-full-height')) {
			var titleHolder = title.find('.eltdf-title-holder');
			var titleMargin = parseInt($('.eltdf-content').css('margin-top'));
			var titleHolderPadding = parseInt(titleHolder.css('padding-top'));
			if(eltdf.windowWidth > 1024) {
				if(titleMargin < 0) {
					title.css("height", eltdf.windowHeight);
					title.attr("data-height", eltdf.windowHeight);
					titleHolder.css("height", eltdf.windowHeight);
					if(titleHolderPadding > 0) {
						titleHolder.css("height", eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight);
					}
				} else {
					title.css("height", eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight);
					title.attr("data-height", eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight);
					titleHolder.css("height", eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight);
				}
			} else {
				title.css("height", eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMobileHeaderHeight);
				title.attr("data-height", eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMobileHeaderHeight);
				titleHolder.css("height", eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMobileHeaderHeight);
			}
		}
	}

})(jQuery);
