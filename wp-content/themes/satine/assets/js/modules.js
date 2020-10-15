(function($) {
    "use strict";

    window.eltdf = {};
    eltdf.modules = {};

    eltdf.scroll = 0;
    eltdf.window = $(window);
    eltdf.document = $(document);
    eltdf.windowWidth = $(window).width();
    eltdf.windowHeight = $(window).height();
    eltdf.body = $('body');
    eltdf.html = $('html, body');
    eltdf.htmlEl = $('html');
    eltdf.menuDropdownHeightSet = false;
    eltdf.defaultHeaderStyle = '';
    eltdf.minVideoWidth = 1500;
    eltdf.videoWidthOriginal = 1280;
    eltdf.videoHeightOriginal = 720;
    eltdf.videoRatio = 1.61;

    eltdf.eltdfOnDocumentReady = eltdfOnDocumentReady;
    eltdf.eltdfOnWindowLoad = eltdfOnWindowLoad;
    eltdf.eltdfOnWindowResize = eltdfOnWindowResize;
    eltdf.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdf.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(eltdf.body.hasClass('eltdf-dark-header')){ eltdf.defaultHeaderStyle = 'eltdf-dark-header';}
        if(eltdf.body.hasClass('eltdf-light-header')){ eltdf.defaultHeaderStyle = 'eltdf-light-header';}
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
        eltdf.windowWidth = $(window).width();
        eltdf.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdfOnWindowScroll() {
        eltdf.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch(true){
        case eltdf.body.hasClass('eltdf-grid-1300'):
            eltdf.boxedLayoutWidth = 1350;
            break;
        case eltdf.body.hasClass('eltdf-grid-1200'):
            eltdf.boxedLayoutWidth = 1250;
            break;
        case eltdf.body.hasClass('eltdf-grid-1000'):
            eltdf.boxedLayoutWidth = 1050;
            break;
        case eltdf.body.hasClass('eltdf-grid-800'):
            eltdf.boxedLayoutWidth = 850;
            break;
        default :
            eltdf.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    eltdf.modules.common = common;

    common.eltdfFluidVideo = eltdfFluidVideo;
    common.eltdfEnableScroll = eltdfEnableScroll;
    common.eltdfDisableScroll = eltdfDisableScroll;
    common.eltdfOwlSlider = eltdfOwlSlider;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;
    common.eltdfPrettyPhoto = eltdfPrettyPhoto;

    common.eltdfOnDocumentReady = eltdfOnDocumentReady;
    common.eltdfOnWindowLoad = eltdfOnWindowLoad;
    common.eltdfOnWindowResize = eltdfOnWindowResize;
    common.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfIconWithHover().init();
	    eltdfIEversion();
	    eltdfInitAnchor().init();
	    eltdfInitBackToTop();
	    eltdfBackButtonShowHide();
	    eltdfInitSelfHostedVideoPlayer();
	    eltdfSelfHostedVideoSize();
	    eltdfFluidVideo();
	    eltdfOwlSlider();
	    eltdfPreloadBackgrounds();
	    eltdfPrettyPhoto();
        eltdfInitCustomMenuDropdown();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdfOnWindowLoad() {
        eltdfSmoothTransition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
        eltdfSelfHostedVideoSize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdfOnWindowScroll() {
        
    }
	
	/*
	 * IE version
	 */
	function eltdfIEversion() {
		var ua = window.navigator.userAgent;
		var msie = ua.indexOf("MSIE ");
		
		if (msie > 0) {
			var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
			eltdf.body.addClass('eltdf-ms-ie'+version);
		}
		return false;
	}
	
	function eltdfDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('DOMMouseScroll', eltdfWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = eltdfWheel;
		document.onkeydown = eltdfKeydown;
	}
	
	function eltdfEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('DOMMouseScroll', eltdfWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function eltdfWheel(e) {
		eltdfPreventDefaultValue(e);
	}
	
	function eltdfKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				eltdfPreventDefaultValue(e);
				return;
			}
		}
	}
	
	function eltdfPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	/*
	 **	Anchor functionality
	 */
	var eltdfInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			
			$('.eltdf-main-menu .eltdf-active-item, .eltdf-mobile-nav .eltdf-active-item, .eltdf-fullscreen-menu .eltdf-active-item').removeClass('eltdf-active-item');
			anchor.parent().addClass('eltdf-active-item');
			
			$('.eltdf-main-menu a, .eltdf-mobile-nav a, .eltdf-fullscreen-menu a').removeClass('current');
			anchor.addClass('current');
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			
			$('[data-eltdf-anchor]').waypoint( function(direction) {
				if(direction === 'down') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("eltdf-anchor")+"']"));
				}
			}, { offset: '50%' });
			
			$('[data-eltdf-anchor]').waypoint( function(direction) {
				if(direction === 'up') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("eltdf-anchor")+"']"));
				}
			}, { offset: function(){
				return -($(this.element).outerHeight() - 150);
			} });
			
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];
			
			if(hash !== "" && $('[data-eltdf-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function($this) {
			var scrollAmount;
			var anchor = $('a');
			var hash = $this;
			if(hash !== "" && $('[data-eltdf-anchor="' + hash + '"]').length > 0 ) {
				var anchoredElementOffset = $('[data-eltdf-anchor="' + hash + '"]').offset().top;
				scrollAmount = $('[data-eltdf-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - eltdfGlobalVars.vars.eltdfAddForAdminBar;
				
				setActiveState(anchor);
				
				eltdf.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function() {
					//change hash tag in url
					if(history.pushState) { history.pushState(null, null, '#'+hash); }
				});
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offest
		 */
		var headerHeihtToSubtract = function(anchoredElementOffset){
			
			if(eltdf.modules.header.behaviour === 'eltdf-sticky-header-on-scroll-down-up') {
				eltdf.modules.header.isStickyVisible = (anchoredElementOffset > eltdf.modules.header.stickyAppearAmount);
			}
			
			if(eltdf.modules.header.behaviour === 'eltdf-sticky-header-on-scroll-up') {
				if((anchoredElementOffset > eltdf.scroll)){
					eltdf.modules.header.isStickyVisible = false;
				}
			}
			
			var headerHeight = eltdf.modules.header.isStickyVisible ? eltdfGlobalVars.vars.eltdfStickyHeaderTransparencyHeight : eltdfPerPageVars.vars.eltdfHeaderTransparencyHeight;
			
			if(eltdf.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function() {
			eltdf.document.on("click", ".eltdf-main-menu a, .eltdf-fullscreen-menu a, .eltdf-btn, .eltdf-anchor, .eltdf-mobile-nav a", function() {
				var scrollAmount;
				var anchor = $(this);
				var hash = anchor.prop("hash").split('#')[1];
				
				if(hash !== "" && $('[data-eltdf-anchor="' + hash + '"]').length > 0 ) {
					
					var anchoredElementOffset = $('[data-eltdf-anchor="' + hash + '"]').offset().top;
					scrollAmount = $('[data-eltdf-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - eltdfGlobalVars.vars.eltdfAddForAdminBar;
					
					setActiveState(anchor);
					
					eltdf.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function() {
						//change hash tag in url
						if(history.pushState) { history.pushState(null, null, '#'+hash); }
					});
					return false;
				}
			});
		};
		
		return {
			init: function() {
				if($('[data-eltdf-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					$(window).load(function() { checkActiveStateOnLoad(); });
				}
			}
		};
	};
	
	function eltdfInitBackToTop(){
		var backToTopButton = $('#eltdf-back-to-top'),
			footer = $('footer');
		backToTopButton.on('click',function(e){
			e.preventDefault();
			eltdf.html.animate({scrollTop: 0}, eltdf.window.scrollTop()/3, 'linear');
		});

		if (footer.length) {
            $(window).scroll(function(){
                var footerDistance = footer.offset().top - $(window).scrollTop() - eltdf.windowHeight - backToTopButton.height()/2;
                if (footerDistance < 0) {
                    backToTopButton.addClass('eltdf-light');
                } else {
                    backToTopButton.removeClass('eltdf-light');
                }
            });
        }
	}
	
	function eltdfBackButtonShowHide(){
		eltdf.window.scroll(function () {
			var b = $(this).scrollTop();
			var c = $(this).height();
			var d;
			if (b > 0) { d = b + c / 2; } else { d = 1; }
			if (d < 1e3) { eltdfToTopButton('off'); } else { eltdfToTopButton('on'); }
		});
	}
	
	function eltdfToTopButton(a) {
		var b = $("#eltdf-back-to-top");
		b.removeClass('off on');
		if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
	}
	
	function eltdfInitSelfHostedVideoPlayer() {
		var players = $('.eltdf-self-hosted-video');
		
		if(players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function eltdfSelfHostedVideoSize(){
		var selfVideoHolder = $('.eltdf-self-hosted-video-holder .eltdf-video-wrap');
		
		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.eltdf-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / eltdf.videoRatio;
				
				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function eltdfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    function eltdfSmoothTransition() {

        if (eltdf.body.hasClass('eltdf-smooth-page-transitions')) {

            //check for preload animation
            if (eltdf.body.hasClass('eltdf-smooth-page-transitions-preloader')) {
                var loader = $('body > .eltdf-smooth-transition-loader.eltdf-mimic-ajax');
                if(loader.find(".eltdf-satine-spinner-holder").length){
                	loader.addClass("eltdf-loaded");
                	setTimeout(function(){
                		loader.fadeOut(500);
                	},500);
                } else {
	                loader.fadeOut(500);
	                $(window).bind("pageshow", function (event) {
	                    if (event.originalEvent.persisted) {
	                        loader.fadeOut(500);
	                    }
	                });
                }
            }

            //check for fade out animation
            if(eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout')) {
                $('a').click(function (e) {
                    var a = $(this);

                    if ((a.parents('.eltdf-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove') || a.hasClass('eltdf-no-smooth-transitions')) {
                        return;
                    }

                    if (
                        e.which == 1 && // check if the left mouse button has been pressed
                        a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
                        (typeof a.data('rel') === 'undefined') && //Not pretty photo link
                        (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                        (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                    ) {
                        e.preventDefault();
                        $('.eltdf-wrapper-inner, #multiscroll-nav').fadeOut(1000, function () {
                            window.location = a.attr('href');
                        });
                    }
                });
            }
        }
    }
	
	/*
	 *	Preload background images for elements that have 'eltdf-preload-background' class
	 */
	function eltdfPreloadBackgrounds(){
		var preloadBackHolder = $('.eltdf-preload-background');
		
		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);
				
				if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function(){
							preloadBackground.removeClass('eltdf-preload-background');
						});
					}
				} else {
					$(window).load(function(){ preloadBackground.removeClass('eltdf-preload-background'); }); //make sure that eltdf-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function eltdfPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * return array
	 */
	function setLoadMoreAjaxData(container, action){
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var eltdfIconWithHover = function() {
		//get all icons on page
		var icons = $('.eltdf-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};

		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('border-color');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};

    /**
     * Init Owl Carousel
     */
    function eltdfOwlSlider() {
        var sliders = $('.eltdf-owl-slider');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this),
                    slideItemsNumber = slider.children().length,
                    numberOfItems = 1,
                    loop = true,
                    autoplay = true,
                    autoplayHoverPause = true,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 600,
                    margin = 0,
                    center = false,
                    autoWidth = false,
                    animateIn = false, // keyframe css animation
                    animateOut = false, // keyframe css animation
                    navigation = true,
                    pagination = false;

                if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false) {
                    numberOfItems = slider.data('number-of-items');
                }
                if (slider.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (slider.data('enable-autoplay') === 'no') {
                    autoplay = false;
                }
                if (slider.data('enable-autoplay-hover-pause') === 'no') {
                    autoplayHoverPause = false;
                }
                if (typeof slider.data('slider-speed') !== 'undefined' && slider.data('slider-speed') !== false) {
                    sliderSpeed = slider.data('slider-speed');
                }
                if (typeof slider.data('slider-speed-animation') !== 'undefined' && slider.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = slider.data('slider-speed-animation');
                }
                if (typeof slider.data('slider-margin') !== 'undefined' && slider.data('slider-margin') !== false) {
                    margin = slider.data('slider-margin');
                }
                if(slider.parent().hasClass('eltdf-normal-space')) {
                    margin = 30;
                } else if (slider.parent().hasClass('eltdf-small-space')) {
                    margin = 20;
                } else if (slider.parent().hasClass('eltdf-tiny-space')) {
                    margin = 10;
                }
                if (slider.data('enable-center') === 'yes') {
                    center = true;
                }
                if (slider.data('enable-auto-width') === 'yes') {
                    autoWidth = true;
                }
                if (typeof slider.data('slider-animate-in') !== 'undefined' && slider.data('slider-animate-in') !== false) {
                    animateIn = slider.data('slider-animate-in');
                }
                if (typeof slider.data('slider-animate-out') !== 'undefined' && slider.data('slider-animate-out') !== false) {
                    animateOut = slider.data('slider-animate-out');
                }
                if (slider.data('enable-navigation') === 'no') {
                    navigation = false;
                }
                if (slider.data('enable-pagination') === 'yes') {
                    pagination = true;
                }

                if(navigation && pagination) {
                    slider.addClass('eltdf-slider-has-both-nav');
                }

                if (slideItemsNumber <= 1) {
                    loop       = false;
                    autoplay   = false;
                    navigation = false;
                    pagination = false;
                }

                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2,
                    responsiveNumberOfItems3 = 3;

                if (numberOfItems < 3) {
                    responsiveNumberOfItems2 = numberOfItems;
                    responsiveNumberOfItems3 = numberOfItems;
                }

                slider.owlCarousel({
                    items: numberOfItems,
                    loop: loop,
                    autoplay: autoplay,
                    autoplayHoverPause: autoplayHoverPause,
                    autoplayTimeout: sliderSpeed,
                    autoplaySpeed: 650,
                    margin: margin,
                    center: center,
                    autoWidth: autoWidth,
                    animateIn : animateIn,
                    animateOut : animateOut,
                    dots: pagination,
                    nav: navigation,
                    navText: [
                        '<span class="eltdf-prev-icon"><span class="eltdf-icon-linear-icon lnr lnr-chevron-left"></span></span>',
                        '<span class="eltdf-next-icon"><span class="eltdf-icon-linear-icon lnr lnr-chevron-right"></span></span>'
                    ],
                    responsive: {
                        0: {
                            items: responsiveNumberOfItems1,
                            slideBy: responsiveNumberOfItems1,
                            margin: 0,
                            center: false,
                            autoWidth: false,
                        },
                        680: {
                            items: responsiveNumberOfItems1,
                            slideBy: responsiveNumberOfItems1,
                        },
                        768: {
                            items: responsiveNumberOfItems2,
                            slideBy: responsiveNumberOfItems2,
                        },
                        1024: {
                            items: numberOfItems,
                            slideBy: numberOfItems,
                        }
                    },
                    onInitialize: function () {
                        slider.css('visibility', 'visible');
                    }
                });
            });
        }
    }

    function eltdfInitCustomMenuDropdown() {

    	var menus = $('.eltdf-sidebar .widget_nav_menu .menu');


        var dropdownOpeners,
            currentMenu;


        if (menus.length) {
            menus.each(function () {

                currentMenu = $(this);

                dropdownOpeners = currentMenu.find('li.menu-item-has-children > a');

                if (dropdownOpeners.length) {
                    dropdownOpeners.each(function () {
                        var currentDropdownOpener = $(this);

                        if (currentDropdownOpener.parent().hasClass('current-menu-parent')) {
                            currentDropdownOpener.addClass('eltdf-custom-menu-active');
                        }

                        currentDropdownOpener.on('click', function (e) {
                            e.preventDefault();
                            var currentDropdownOpenerActive = $(this);
                            var dropdownToOpen = currentDropdownOpenerActive.parent().children('.sub-menu');

                            if (!currentDropdownOpenerActive.hasClass('eltdf-custom-menu-active')) {

                                if (!$(this).parent().parent().hasClass('sub-menu')) { //if first level
                                    dropdownOpeners.each(function () {

                                        $(this).removeClass('eltdf-custom-menu-active');
                                        $(this).parent().children('.sub-menu').slideUp();

                                    });
                                }

                                dropdownToOpen.slideDown();
                                currentDropdownOpenerActive.addClass('eltdf-custom-menu-active');
                            }

                            else {
                                if ($(this).parent().parent().hasClass('sub-menu')) {
                                    dropdownToOpen.slideUp();
                                    currentDropdownOpenerActive.removeClass('eltdf-custom-menu-active');
                                }
                            }
                        });
                    });
                }
            });
        }
    }

})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    eltdf.modules.blog = blog;

    blog.eltdfOnDocumentReady = eltdfOnDocumentReady;
    blog.eltdfOnWindowLoad = eltdfOnWindowLoad;
    blog.eltdfOnWindowResize = eltdfOnWindowResize;
    blog.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfInitAudioPlayer();
        eltdfInitBlogMasonryGallery();
        eltdfInitBlogMasonry();
        eltdfInitBlogListMasonry();
	    eltdfInitBlogSlider();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdfOnWindowLoad() {
	    eltdfInitBlogPagination().init();
	    eltdfInitBlogListShortcodePagination().init();
        eltdfInitBlogMasonryGalleryAppear();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
        eltdfInitBlogMasonry();
	    eltdfInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdfOnWindowScroll() {
	    eltdfInitBlogPagination().scroll();
	    eltdfInitBlogListShortcodePagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function eltdfInitAudioPlayer() {
        var players = $('audio.eltdf-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function eltdfResizeBlogItems(size,container){

        if(container.hasClass('eltdf-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.eltdf-post-size-default'),
                largeWidthMasonryItem = container.find('.eltdf-post-size-large-width'),
                largeHeightMasonryItem = container.find('.eltdf-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.eltdf-post-size-large-width-height');

			if (eltdf.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
        }
    }

    /**
    * Init Blog Masonry Layout
    */
    function eltdfInitBlogMasonry() {
	    var holder = $('.eltdf-blog-holder.eltdf-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.eltdf-blog-holder-inner'),
                    size = thisHolder.find('.eltdf-blog-masonry-grid-sizer').width();
			    
                eltdfResizeBlogItems(size, thisHolder);
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.eltdf-blog-masonry-grid-gutter',
						    columnWidth: '.eltdf-blog-masonry-grid-sizer'
					    }
				    });
                    masonry.css('opacity', '1');
                });
		    });
	    }
    }

    /**
     *  Init Blog Chequered
     */
    function eltdfInitBlogChequered(){
        var container = $('.eltdf-blog-holder.eltdf-blog-chequered');
        var masonry = container.children('.eltdf-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.eltdf-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }


    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function eltdfInitBlogMasonryGallery() {
        var blogList = $('.eltdf-blog-holder.eltdf-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.eltdf-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.eltdf-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                eltdfInitBlogMasonryGalleryAppear();
            });
        }
    }
	
	/**
	 *  Init Blog Slider shortcode
	 */
	function eltdfInitBlogSlider() {
		var blogSlider = $('.eltdf-blog-slider-holder .eltdf-blog-slider');
		
		if(blogSlider.length) {
			blogSlider.each(function(){
				var thisSlider = $(this);
				
				thisSlider.owlCarousel({
					responsive : {
						0: {
							loop: true,
							items: 1,
							center: false,
							margin: 0,
							dots: true,
							nav: false
						},
						1025: {
							loop: true,
							items: 2,
							startPosition: 1,
							center: true,
							margin: 15,
							dots: true,
							nav: true,
							navText: [
								'<span class="eltdf-prev-icon"><span class="arrow arrow_left"></span></span>',
								'<span class="eltdf-next-icon"><span class="arrow arrow_right"></span></span>'
							]
						}
					}
				});
			});
		}
	}

    /**
     *  Animate blog masonry gallery type
     */
    function eltdfInitBlogMasonryGalleryAppear() {
        var blogList = $('.eltdf-blog-holder.eltdf-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.eltdf-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('eltdf-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('eltdf-appeared');
                },{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});

            });
        }
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function eltdfInitBlogNarrowAppear() {
        var blogList = $('.eltdf-blog-holder.eltdf-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.eltdf-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('eltdf-appeared');
                    },{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('eltdf-appeared');
                },{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});

            });
        }
    }

	
	/**
	 * Initializes blog pagination functions
	 */
	function eltdfInitBlogPagination(){
		var holder = $('.eltdf-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.eltdf-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			if(!thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.eltdf-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('eltdf-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.eltdf-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('eltdf-showing');
				
				var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'satine_elated_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: ElatedAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('eltdf-blog-type-masonry')){
								eltdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                eltdfResizeBlogItems(thisHolderInner.find('.eltdf-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								eltdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								eltdfInitAudioPlayer();
								eltdf.modules.common.eltdfOwlSlider();
								eltdf.modules.common.eltdfFluidVideo();
                                eltdfInitBlogNarrowAppear();
                                eltdfInitBlogMasonryGalleryAppear();
                                eltdfInitBlogChequered();
							}, 400);
						});
						
						if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('eltdf-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.eltdf-blog-pag-load-more').hide();
			}
		};
		
		var eltdfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var eltdfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}
	
	/**
	 * Init blog list shortcode masonry layout
	 */
	function eltdfInitBlogListMasonry() {
		var holder = $('.eltdf-blog-list-holder.eltdf-bl-masonry');

		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.eltdf-blog-list');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.eltdf-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.eltdf-bl-grid-gutter',
							columnWidth: '.eltdf-bl-grid-sizer'
						}
					});
					
					masonry.css('opacity', '1');
				});
			});
		}
	}
	
	/**
	 * Init blog list shortcode pagination functions
	 */
	function eltdfInitBlogListShortcodePagination(){
		var holder = $('.eltdf-blog-list-holder');
		
		var initStandardPagination = function(thisHolder) {
			var standardLink = thisHolder.find('.eltdf-bl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.eltdf-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			if(!thisHolder.hasClass('eltdf-bl-pag-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.eltdf-blog-list'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('eltdf-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}
			
			if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll')) {
				thisHolder.addClass('eltdf-bl-pag-infinite-scroll-started');
			}
			
			var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.eltdf-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisHolder.hasClass('eltdf-bl-pag-standard-blog-list')) {
					loadingItem.addClass('eltdf-showing eltdf-standard-pag-trigger');
					thisHolder.addClass('eltdf-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('eltdf-showing');
				}
				
				var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'satine_elated_blog_shortcode_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: ElatedAjaxUrl,
					success: function (data) {
						if(!thisHolder.hasClass('eltdf-bl-pag-standard-blog-list')) {
							nextPage++;
						}
						
						thisHolder.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisHolder.hasClass('eltdf-bl-pag-standard-blog-list')) {
							eltdfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);
							
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('eltdf-bl-masonry')){
									eltdfInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									eltdfInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('eltdf-bl-masonry')){
									eltdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									eltdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('eltdf-bl-pag-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.eltdf-blog-pag-load-more').hide();
			}
		};
		
		var eltdfInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.eltdf-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.eltdf-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.eltdf-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.eltdf-bl-pag-next a');
			
			standardPagNumericItem.removeClass('eltdf-bl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('eltdf-bl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var eltdfInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisHolder.removeClass('eltdf-bl-pag-standard-blog-list-animate');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var eltdfInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisHolder.removeClass('eltdf-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};
		
		var eltdfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var eltdfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}
						
						if(thisHolder.hasClass('eltdf-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function($) {
    "use strict";

    var header = {};
    eltdf.modules.header = header;

    var mobileHeader = {};
    eltdf.modules.mobileHeader = mobileHeader;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour = '';

    header.eltdfOnDocumentReady = eltdfOnDocumentReady;
    header.eltdfOnWindowLoad = eltdfOnWindowLoad;
    header.eltdfOnWindowResize = eltdfOnWindowResize;
    header.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfHeaderBehaviour();
        eltdfSideArea();
        eltdfSideAreaScroll();
        eltdfFullscreenMenu();
        eltdfInitMobileNavigation();
        eltdfMobileHeaderBehavior();
        eltdfSetDropDownMenuPosition();
        eltdfDropDownMenu();
        eltdfSearch();
        eltdfVerticalMenu().init();
        eltdfInitTabbedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdfOnWindowLoad() {
        eltdfSetDropDownMenuPosition();
        eltdfInitDividedHeaderMenu();
        eltdfInitStickyDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
        eltdfInitDividedHeaderMenu();
        eltdfInitStickyDividedHeaderMenu();
        eltdfInitTabbedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdfOnWindowScroll() {
        
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function eltdfHeaderBehaviour() {

        var header = $('.eltdf-page-header'),
	        stickyHeader = $('.eltdf-sticky-header'),
            fixedHeaderWrapper = $('.eltdf-fixed-wrapper');
        
        var revSliderHeight =  0;
        if ($('.eltdf-slider').length) {
            revSliderHeight = $('.eltdf-slider').outerHeight();
        }

        var headerMenuAreaOffset = $('.eltdf-page-header').find('.eltdf-fixed-wrapper').length ? $('.eltdf-page-header').find('.eltdf-fixed-wrapper').offset().top - eltdfGlobalVars.vars.eltdfAddForAdminBar : 0;
		
        var stickyAppearAmount;
        var headerAppear;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case eltdf.body.hasClass('eltdf-sticky-header-on-scroll-up'):
                eltdf.modules.header.behaviour = 'eltdf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = eltdfGlobalVars.vars.eltdfTopBarHeight + eltdfGlobalVars.vars.eltdfLogoAreaHeight + eltdfGlobalVars.vars.eltdfMenuAreaHeight + eltdfGlobalVars.vars.eltdfStickyHeaderHeight;

                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        eltdf.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.eltdf-main-menu .second').removeClass('eltdf-drop-down-start');
                    }else {
                        eltdf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case eltdf.body.hasClass('eltdf-sticky-header-on-scroll-down-up'):
                eltdf.modules.header.behaviour = 'eltdf-sticky-header-on-scroll-down-up';

                if(eltdfPerPageVars.vars.eltdfStickyScrollAmount !== 0){
                    eltdf.modules.header.stickyAppearAmount = eltdfPerPageVars.vars.eltdfStickyScrollAmount;
                } else {
                    eltdf.modules.header.stickyAppearAmount = eltdfGlobalVars.vars.eltdfTopBarHeight + eltdfGlobalVars.vars.eltdfLogoAreaHeight + eltdfGlobalVars.vars.eltdfMenuAreaHeight + revSliderHeight;
                }

                headerAppear = function(){
                    if(eltdf.scroll < eltdf.modules.header.stickyAppearAmount) {
                        eltdf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltdf-main-menu .second').removeClass('eltdf-drop-down-start');
                    }else{
                        eltdf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case eltdf.body.hasClass('eltdf-fixed-on-scroll'):
                eltdf.modules.header.behaviour = 'eltdf-fixed-on-scroll';
                var headerFixed = function(){

                    if(eltdf.scroll <= headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom', '0');
                    } else {
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom', fixedHeaderWrapper.outerHeight());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function eltdfSideArea() {

        var wrapper = $('.eltdf-wrapper'),
            sideMenuButtonOpen = $('a.eltdf-side-menu-button-opener'),
            cssClass = 'eltdf-right-side-menu-opened';

        wrapper.prepend('<div class="eltdf-cover"/>');

        var sideAreaClose = function() {
            eltdf.body.removeClass(cssClass);
            sideMenuButtonOpen.removeClass('opened');
        }

        var sideAreaOpen = function() {
            sideMenuButtonOpen.addClass('opened');
            eltdf.body.addClass(cssClass);

            $('.eltdf-wrapper .eltdf-cover').click(function() {
                eltdf.body.removeClass('eltdf-right-side-menu-opened');
                sideMenuButtonOpen.removeClass('opened');
            });

            var currentScroll = $(window).scrollTop();
            $(window).scroll(function() {
                if(Math.abs(eltdf.scroll - currentScroll) > 400){
                    sideAreaClose();
                }
            });
        }

        $('a.eltdf-side-menu-button-opener').click(function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {
                sideAreaOpen();
            }
        });

        $('a.eltdf-close-side-menu').click(function(e) {
            e.preventDefault();

            if(sideMenuButtonOpen.hasClass('opened')) {
                sideAreaClose();
            }
        });
    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function eltdfSideAreaScroll(){

        var sideMenu = $('.eltdf-side-area-inner');

        if(sideMenu.length){    
            sideMenu.niceScroll({ 
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0, 
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false, 
                horizrailenabled: false 
            });
        }
    }

    /**
     * Init Sticky Divided Header Menu
     */
    function eltdfInitStickyDividedHeaderMenu(){
        if(eltdf.body.hasClass('eltdf-header-divided')){
            //get left side menu width
            var menuArea = $('.eltdf-sticky-header'),
                menuAreaWidth = menuArea.width(),
	            menuAreaItem = $('.eltdf-main-menu > ul > li > a'),
	            menuItemPadding = 0,
	            logoArea = menuArea.find('.eltdf-logo-wrapper .eltdf-normal-logo'),
	            logoAreaWidth = 0;

            if(menuArea.children('.eltdf-grid').length) {
                menuAreaWidth = menuArea.children('.eltdf-grid').outerWidth();
            }

	        if(menuAreaItem.length) {
		        menuItemPadding = parseInt(menuAreaItem.css('padding-left'));
	        }

	        if(logoArea.length) {
		        logoAreaWidth = logoArea.width() / 2;
	        }

            var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - logoAreaWidth);

            $('.eltdf-sticky-header .eltdf-position-left').width(menuAreaLeftRightSideWidth);
			$('.eltdf-sticky-header .eltdf-position-right').width(menuAreaLeftRightSideWidth);

            menuArea.css('opacity',1);

            eltdfDropDownMenu();
            eltdfSetDropDownMenuPosition();

        }
    }

    /**
     * Init Divided Header Menu
     */
    function eltdfInitDividedHeaderMenu(){
        if(eltdf.body.hasClass('eltdf-header-divided')){
            //get left side menu width
            var menuArea = $('.eltdf-menu-area'),
                menuAreaWidth = menuArea.width(),
                menuAreaItem = $('.eltdf-main-menu > ul > li > a'),
                menuItemPadding = 0,
                logoArea = menuArea.find('.eltdf-logo-wrapper .eltdf-normal-logo'),
                logoAreaWidth = 0;

            if(menuArea.children('.eltdf-grid').length) {
                menuAreaWidth = menuArea.children('.eltdf-grid').outerWidth();
            }

            if(menuAreaItem.length) {
                menuItemPadding = parseInt(menuAreaItem.css('padding-left'));
            }

            if(logoArea.length) {
                logoAreaWidth = logoArea.width() / 2;
            }

            var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - logoAreaWidth);

            $('.eltdf-menu-area .eltdf-position-left').width(menuAreaLeftRightSideWidth);
            $('.eltdf-menu-area .eltdf-position-right').width(menuAreaLeftRightSideWidth);

            menuArea.css('opacity',1);

            eltdfDropDownMenu();
            eltdfSetDropDownMenuPosition();

        }
    }

    /**
     * Init Tabbed Header Menu
     */
    function eltdfInitTabbedHeaderMenu(){
        if(eltdf.body.hasClass('eltdf-header-tabbed')){

            var centerHeaderArea = $('.eltdf-position-center'),
                leftHeaderAreaWidth = $('.eltdf-position-left').width(),
                rightHeaderAreaWidth = $('.eltdf-position-right').width(),
                headerAreaPadding = 40; //20px on both side of header

            centerHeaderArea.width(eltdf.windowWidth - leftHeaderAreaWidth - rightHeaderAreaWidth - headerAreaPadding);
            centerHeaderArea.css('opacity',1);
        }
    }

    /**
     * Init Fullscreen Menu
     */
    function eltdfFullscreenMenu() {
        var popupMenuOpener = $( 'a.eltdf-fullscreen-menu-opener');

        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".eltdf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.eltdf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.eltdf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.eltdf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.eltdf-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.eltdf-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize perfectScrollbar
            popupMenuHolderOuter.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });


            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(eltdf.windowHeight);
            });

            if (eltdf.body.hasClass('eltdf-fade-push-text-right')) {
                cssClass = 'eltdf-push-nav-right';
                fadeRight = true;
            } else if (eltdf.body.hasClass('eltdf-fade-push-text-top')) {
                cssClass = 'eltdf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }


            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('eltdf-fm-opened')) {
                    popupMenuOpener.addClass('eltdf-fm-opened');
                    eltdf.body.addClass('eltdf-fullscreen-menu-opened');
                    eltdf.body.removeClass('eltdf-fullscreen-fade-out').addClass('eltdf-fullscreen-fade-in');
                    eltdf.body.removeClass(cssClass);
                    eltdf.modules.common.eltdfDisableScroll();
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) {
                            popupMenuOpener.removeClass('eltdf-fm-opened');
                            eltdf.body.removeClass('eltdf-fullscreen-menu-opened');
                            eltdf.body.removeClass('eltdf-fullscreen-fade-in').addClass('eltdf-fullscreen-fade-out');
                            eltdf.body.addClass(cssClass);
                            if(!eltdf.body.hasClass('page-template-full_screen-php')){
                                eltdf.modules.common.eltdfEnableScroll();
                            }
                            $("nav.eltdf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('eltdf-fm-opened');
                    eltdf.body.removeClass('eltdf-fullscreen-menu-opened');
                    eltdf.body.removeClass('eltdf-fullscreen-fade-in').addClass('eltdf-fullscreen-fade-out');
                    eltdf.body.addClass(cssClass);
                    eltdf.modules.common.eltdfEnableScroll();
                    $("nav.eltdf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function (e) {
                e.preventDefault();

                if ($(this).parent().hasClass('has_sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(450, 'easeInOutCubic', function () {
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {
                        $(this).parent().addClass('open_sub');
                        if($(this).parent().siblings().hasClass('open_sub')) {
                            $(this).parent().siblings().removeClass('open_sub').find('.sub_menu').slideUp(450, 'easeInOutCubic', function () {
                                submenu.slideDown(450, 'easeInOutCubic', function () {
                                });
                            });
                        }
                        else{
                            submenu.slideDown(450, 'easeInOutCubic', function (){});
                        }
                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.click(function (e) {
                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){
                    if (e.which == 1) {
                        popupMenuOpener.removeClass('eltdf-fm-opened');
                        eltdf.body.removeClass('eltdf-fullscreen-menu-opened');
                        eltdf.body.removeClass('eltdf-fullscreen-fade-in').addClass('eltdf-fullscreen-fade-out');
                        eltdf.body.addClass(cssClass);
                        $("nav.eltdf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                        });
                        eltdf.modules.common.eltdfEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

    function eltdfInitMobileNavigation() {
        var navigationOpener = $('.eltdf-mobile-header .eltdf-mobile-menu-opener');
        var navigationHolder = $('.eltdf-mobile-header .eltdf-mobile-nav');
        var dropdownOpener = $('.eltdf-mobile-nav .mobile_arrow, .eltdf-mobile-nav h6, .eltdf-mobile-nav a.eltdf-mobile-no-link');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                    navigationOpener.removeClass("eltdf-mobile-menu-opened");
                } else {
                    navigationHolder.slideDown(animationSpeed);
                    navigationOpener.addClass("eltdf-mobile-menu-opened");
                }
            });
        }

        //init scrollable menu
        var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
        var scrollHeight = navigationHolder.outerHeight() - mobileHeaderHeight > eltdf.windowHeight ?  eltdf.windowHeight - mobileHeaderHeight - 100 : navigationHolder.height();

        navigationHolder.height(scrollHeight);
        navigationHolder.perfectScrollbar({
            wheelSpeed: 0.6,
            suppressScrollX: true
        });


        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('eltdf-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('eltdf-opened');
                        }
                    }
                });
            });
        }

        $('.eltdf-mobile-nav a, .eltdf-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
                navigationOpener.removeClass("eltdf-mobile-menu-opened");
            }
        });
    }

    function eltdfMobileHeaderBehavior() {
        var mobileHeader = $('.eltdf-mobile-header'),
            mobileMenuOpener = mobileHeader.find('.eltdf-mobile-menu-opener'),
            mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
        
        if(eltdf.body.hasClass('eltdf-content-is-behind-header') && mobileHeaderHeight > 0 && eltdf.windowWidth <= 1024) {
            $('.eltdf-content').css('marginTop', -mobileHeaderHeight);
            $('.eltdf-title-wrapper').css('paddingTop', mobileHeaderHeight);
        }
        
        if(eltdf.body.hasClass('eltdf-sticky-up-mobile-header')) {
            var stickyAppearAmount,
                adminBar     = $('#wpadminbar');

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + eltdfGlobalVars.vars.eltdfAddForAdminBar;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('eltdf-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('eltdf-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('eltdf-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.eltdf-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function eltdfSetDropDownMenuPosition(){

        var menuItems = $(".eltdf-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = eltdf.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(eltdf.body.hasClass('eltdf-boxed')){
                menuItemFromLeft = eltdf.boxedLayoutWidth  - (menuItemPosition - (browserWidth - eltdf.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });
    }

    function eltdfDropDownMenu() {

        var menu_items = $('.eltdf-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {

                    var dropdown = $(this).find('.inner > ul');
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();
                    
                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });

                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    if(!eltdf.body.hasClass('eltdf-full-width-wide-menu')) {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = (eltdf.windowWidth - 2 * (eltdf.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    }else{
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = dropdown.offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', eltdf.windowWidth);

                        }
                    }
                }

                if(!eltdf.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(eltdf.body.hasClass('eltdf-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 300, function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 150, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('eltdf-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('eltdf-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
         $('.eltdf-drop-down ul li.wide ul li a').on('click', function(e) {
            if (e.which == 1){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            }
        });

        eltdf.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function eltdfSearch() {

        var searchOpener = $('a.eltdf-search-opener'),
            searchForm,
            searchClose,
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {
            //Check for type of search
            if ( eltdf.body.hasClass( 'eltdf-fullscreen-search' ) ) {

                var fullscreenSearchFade;

                searchClose = $( '.eltdf-fullscreen-search-close' );
                fullscreenSearchFade = true;
                eltdfFullscreenSearch( fullscreenSearchFade);

            } else if ( eltdf.body.hasClass( 'eltdf-slide-from-header-bottom' ) ) {

                eltdfSearchSlideFromHeaderBottom();

            } else if ( eltdf.body.hasClass( 'eltdf-search-covers-header' ) ) {

                eltdfSearchCoversHeader();

            } else if ( eltdf.body.hasClass( 'eltdf-search-slides-from-window-top' ) ) {

                searchForm = $('.eltdf-search-slide-window-top');
                searchClose = $('.eltdf-search-close');
                eltdfSearchWindowTop();
            }
        }

        /**
         * Search slides from window top type of search
         */
        function eltdfSearchWindowTop() {

            searchOpener.click( function(e) {
                e.preventDefault();

                var yPos = 0;
                if($('.title').hasClass('has_parallax_background')){
                    yPos = parseInt($('.title.has_parallax_background').css('backgroundPosition').split(" ")[1]);
                }

                if ( searchForm.height() == "0") {
                    $('.eltdf-search-slide-window-top input[type="text"]').focus();
                    //Push header bottom
                    eltdf.body.addClass('eltdf-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos + 50)+'px'
                    }, 150);
                } else {
                    eltdf.body.removeClass('eltdf-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos - 50)+'px'
                    }, 150);
                }

                $(window).scroll(function() {
                    if ( searchForm.height() != '0' && eltdf.scroll > 50 ) {
                        eltdf.body.removeClass('eltdf-search-open');
                        $('.title.has_parallax_background').css('backgroundPosition', 'center '+(yPos)+'px');
                    }
                });

                searchClose.click(function(e){
                    e.preventDefault();
                    eltdf.body.removeClass('eltdf-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos)+'px'
                    }, 150);
                });

            });
        }

        /**
         * Search covers header type of search
         */
        function eltdfSearchCoversHeader() {

            searchOpener.click(function (e) {
                e.preventDefault();
                var searchFormHeight,
                    searchFormHolder = $('.eltdf-search-cover .eltdf-form-holder-outer'),
                    searchForm,
                    searchFormLandmark; // there is one more div element if header is in grid

                if ($(this).closest('.eltdf-grid').length) {
                    searchForm = $(this).closest('.eltdf-grid').children().first();
                    searchFormLandmark = searchForm.parent();
                } else {
                    searchForm = $(this).closest('.eltdf-menu-area').children().first();
                    searchFormLandmark = searchForm;
                }

                if ($(this).closest('.eltdf-sticky-header').length > 0) {
                    searchForm = $(this).closest('.eltdf-sticky-header').children().first();
                    searchFormLandmark = searchForm;
                }
                if ($(this).closest('.eltdf-mobile-header').length > 0) {
                    searchForm = $(this).closest('.eltdf-mobile-header').children().children().first();
                    searchFormLandmark = searchForm.parent();
                }

                //Find search form position in header and height
                if (searchFormLandmark.parent().hasClass('eltdf-logo-area')) {
                    searchFormHeight = eltdfGlobalVars.vars.eltdfLogoAreaHeight;
                } else if (searchFormLandmark.parent().hasClass('eltdf-top-bar')) {
                    searchFormHeight = eltdfGlobalVars.vars.eltdfTopBarHeight;
                } else if (searchFormLandmark.parent().hasClass('eltdf-menu-area')) {
                    searchFormHeight = eltdfGlobalVars.vars.eltdfMenuAreaHeight;
                } else if (searchFormLandmark.parent().hasClass('eltdf-sticky-header')) {
                    searchFormHeight = eltdfGlobalVars.vars.eltdfStickyHeaderTransparencyHeight;
                } else if (searchFormLandmark.parent().hasClass('eltdf-mobile-header')) {
                    searchFormHeight = $('.eltdf-mobile-header-inner').height();
                }


                searchFormHolder.height(searchFormHeight);
                searchForm.stop(true).fadeIn(600);
                $('.eltdf-search-cover input[type="text"]').focus();
                $('.eltdf-search-close, .content, footer').click(function (e) {
                    e.preventDefault();
                    searchForm.stop(true).fadeOut(450);
                });
                searchForm.blur(function () {
                    searchForm.stop(true).fadeOut(450);
                });
            });

        }

        /**
         * Search slide from header bottom type of search
         */
        function eltdfSearchSlideFromHeaderBottom() {
	
	        searchOpener.click( function() {
		        var thisItem = $(this);

                var boxed = 0;
                if(eltdf.body.hasClass('eltdf-boxed') && eltdf.windowWidth > 1024){
                    boxed = $('.eltdf-wrapper-inner').offset().left;
                }

                var searchIconPosition = parseInt(eltdf.windowWidth - thisItem.offset().left - thisItem.outerWidth() - boxed);

		        if(!eltdf.body.hasClass('eltdf-search-opened')){
			        eltdf.body.addClass('eltdf-search-opened');
			        if(thisItem.parents('.eltdf-fixed-wrapper').length) {
				        thisItem.parents('.eltdf-fixed-wrapper').find('.eltdf-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if (thisItem.parents('.eltdf-sticky-header.header-appear').length) {
				        thisItem.parents('.eltdf-sticky-header.header-appear').find('.eltdf-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if(thisItem.parents('.eltdf-logo-area').length) {
				        thisItem.parents('.eltdf-page-header').find('.eltdf-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if(thisItem.parents('.eltdf-menu-area').children('.eltdf-slide-from-header-bottom-holder').length) {
                        thisItem.parents('.eltdf-menu-area').children('.eltdf-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
                    } else if (thisItem.parents('.eltdf-page-header').children('.eltdf-slide-from-header-bottom-holder').length) {
				        thisItem.parents('.eltdf-page-header').children('.eltdf-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if (thisItem.parents('.eltdf-mobile-header').length) {
				        thisItem.parents('.eltdf-mobile-header').find('.eltdf-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        }
			        setTimeout(function(){
				        $('.eltdf-slide-from-header-bottom-holder input').focus();
			        },400);
		        } else {
                    eltdf.body.removeClass('eltdf-search-opened');
                    $('.eltdf-slide-from-header-bottom-holder').fadeOut(0);
                }
	        });

            $(document).mouseup(function (e) {
                var container = $(".eltdf-search-opener, .eltdf-slide-from-header-bottom-holder");
                if (!container.is(e.target) && container.has(e.target).length === 0)  {
                    if(eltdf.body.hasClass('eltdf-search-opened')){
                        eltdf.body.removeClass('eltdf-search-opened');
                        $('.eltdf-slide-from-header-bottom-holder').fadeOut(0);
                    }
                }
            });

	        //Close on escape
	        $(document).keyup(function(e){
		        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                    if(eltdf.body.hasClass('eltdf-search-opened')){
                        eltdf.body.removeClass('eltdf-search-opened');
                        $('.eltdf-slide-from-header-bottom-holder').fadeOut(0);
                    }
		        }
	        });
        }

        /**
         * Fullscreen search fade
         */
        function eltdfFullscreenSearch( fade) {

            var searchHolder = $( '.eltdf-fullscreen-search-holder');

            searchOpener.click( function(e) {
                e.preventDefault();
                var samePosition = false,
                    closeTop = 0,
                    closeLeft = 0;
                if ( $(this).data('icon-close-same-position') === 'yes' ) {
                    closeTop = $(this).find('.eltdf-search-opener-wrapper').offset().top;
                    closeLeft = $(this).offset().left;
                    samePosition = true;
                }
                //Fullscreen search fade
                if ( fade ) {
                    if ( searchHolder.hasClass( 'eltdf-animate' ) ) {
                        eltdf.body.removeClass('eltdf-fullscreen-search-opened');
                        eltdf.body.addClass( 'eltdf-search-fade-out' );
                        eltdf.body.removeClass( 'eltdf-search-fade-in' );
                        searchHolder.removeClass( 'eltdf-animate' );
                        setTimeout(function(){
                            searchHolder.find('.eltdf-search-field').val('');
                            searchHolder.find('.eltdf-search-field').blur();
                        },300);
                        if(!eltdf.body.hasClass('page-template-full_screen-php')){
                            eltdf.modules.common.eltdfEnableScroll();
                        }
                    } else {
                        eltdf.body.addClass('eltdf-fullscreen-search-opened');
                        setTimeout(function(){
                            searchHolder.find('.eltdf-search-field').focus();
                        },900);
                        eltdf.body.removeClass('eltdf-search-fade-out');
                        eltdf.body.addClass('eltdf-search-fade-in');
                        searchHolder.addClass('eltdf-animate');
                        if (samePosition) {
                            searchClose.css({
                                'top' : closeTop - eltdf.scroll,
                                'left' : closeLeft
                            });
                        }
                        if(!eltdf.body.hasClass('page-template-full_screen-php')){
                            eltdf.modules.common.eltdfDisableScroll();
                        }
                    }
                    searchClose.click( function(e) {
                        e.preventDefault();
                        eltdf.body.removeClass('eltdf-fullscreen-search-opened');
                        searchHolder.removeClass('eltdf-animate');
                        setTimeout(function(){
                            searchHolder.find('.eltdf-search-field').val('');
                            searchHolder.find('.eltdf-search-field').blur();
                        },300);
                        eltdf.body.removeClass('eltdf-search-fade-in');
                        eltdf.body.addClass('eltdf-search-fade-out');
                        if(!eltdf.body.hasClass('page-template-full_screen-php')){
                            eltdf.modules.common.eltdfEnableScroll();
                        }
                    });

                    //Close on click away
                    $(document).mouseup(function (e) {
                        var container = $(".eltdf-form-holder-inner");
                        if (!container.is(e.target) && container.has(e.target).length === 0)  {
                            e.preventDefault();
                            eltdf.body.removeClass('eltdf-fullscreen-search-opened');
                            searchHolder.removeClass('eltdf-animate');
                            setTimeout(function(){
                                searchHolder.find('.eltdf-search-field').val('');
                                searchHolder.find('.eltdf-search-field').blur();
                            },300);
                            eltdf.body.removeClass('eltdf-search-fade-in');
                            eltdf.body.addClass('eltdf-search-fade-out');
                            if(!eltdf.body.hasClass('page-template-full_screen-php')){
                                eltdf.modules.common.eltdfEnableScroll();
                            }
                        }
                    });

                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                            eltdf.body.removeClass('eltdf-fullscreen-search-opened');
                            searchHolder.removeClass('eltdf-animate');
                            setTimeout(function(){
                                searchHolder.find('.eltdf-search-field').val('');
                                searchHolder.find('.eltdf-search-field').blur();
                            },300);
                            eltdf.body.removeClass('eltdf-search-fade-in');
                            eltdf.body.addClass('eltdf-search-fade-out');
                            if(!eltdf.body.hasClass('page-template-full_screen-php')){
                                eltdf.modules.common.eltdfEnableScroll();
                            }
                        }
                    });
                }
            });

            //Text input focus change
            $('.eltdf-fullscreen-search-holder .eltdf-search-field').focus(function(){
                $('.eltdf-fullscreen-search-holder .eltdf-field-holder .eltdf-line').css("width","100%");
            });

            $('.eltdf-fullscreen-search-holder .eltdf-search-field').blur(function(){
                $('.eltdf-fullscreen-search-holder .eltdf-field-holder .eltdf-line').css("width","0");
            });
        }
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var eltdfVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.eltdf-vertical-menu-area');

        /**
         * Resizes vertical area. Called whenever height of navigation area changes
         * It first check if vertical area is scrollable, and if it is resizes scrollable area
         */
        var resizeVerticalArea = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.getNiceScroll().resize();
            }
        };

        /**
         * Checks if vertical area is scrollable (if it has eltdf-with-scroll class)
         *
         * @returns {bool}
         */
        var verticalAreaScrollable = function() {
            return verticalMenuObject.hasClass('.eltdf-with-scroll');
        };

        /**
         * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
         */
        var initNavigation = function() {
            var verticalNavObject = verticalMenuObject.find('.eltdf-vertical-menu');

            dropdownFloat();

            /**
             * Initializes click toggle navigation type. Works the same for touch and no-touch devices
             */
            /**
             * Initializes floating navigation type (it comes from the side as a dropdown)
             */
            function dropdownFloat() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
                var allDropdowns = menuItems.find(' > .second, > ul');

                menuItems.each(function () {
                    var elementToExpand = $(this).find(' > .second, > ul');
                    var menuItem = this;

                    if (Modernizr.touch) {
                        var dropdownOpener = $(this).find('> a');

                        dropdownOpener.on('click tap', function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if (elementToExpand.hasClass('eltdf-float-open')) {
                                elementToExpand.removeClass('eltdf-float-open');
                                $(menuItem).removeClass('open');
                            } else {
                                if (!$(this).parents('li').hasClass('open')) {
                                    menuItems.removeClass('open');
                                    allDropdowns.removeClass('eltdf-float-open');
                                }

                                elementToExpand.addClass('eltdf-float-open');
                                $(menuItem).addClass('open');
                            }
                        });
                    } else {
                        //must use hoverIntent because basic hover effect doesn't catch dropdown
                        //it doesn't start from menu item's edge
                        $(this).hoverIntent({
                            over: function () {
                                elementToExpand.addClass('eltdf-float-open');
                                $(menuItem).addClass('open');
                            },
                            out: function () {
                                elementToExpand.removeClass('eltdf-float-open');
                                $(menuItem).removeClass('open');
                            },
                            timeout: 100
                        });
                    }
                });
            }
        };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.niceScroll({
                    scrollspeed: 60,
                    mousescrollstep: 40,
                    cursorwidth: 0,
                    cursorborder: 0,
                    cursorborderradius: 0,
                    cursorcolor: "transparent",
                    autohidemode: false,
                    horizrailenabled: false
                });
            }
        };

        var initHiddenVerticalArea = function() {
            var verticalLogo = $('.eltdf-vertical-area-bottom-logo');
            var verticalMenuOpener = verticalMenuObject.find('.eltdf-vertical-area-opener');
            var scrollPosition = 0;

            verticalMenuOpener.on('click tap', function() {
                if(isVerticalAreaOpen()) {
                    closeVerticalArea();
                } else {
                    openVerticalArea();
                }
            });

            $(window).scroll(function() {
                if(Math.abs($(window).scrollTop() - scrollPosition) > 400){
                    closeVerticalArea();
                }
            });

            /**
             * Closes vertical menu area by removing 'active' class on that element
             */
            function closeVerticalArea() {
                verticalMenuObject.removeClass('active');

                if(verticalLogo.length) {
                    verticalLogo.removeClass('active');
                }
            }

            /**
             * Opens vertical menu area by adding 'active' class on that element
             */
            function openVerticalArea() {
                verticalMenuObject.addClass('active');

                if(verticalLogo.length) {
                    verticalLogo.addClass('active');
                }
                scrollPosition = $(window).scrollTop();
            }

            function isVerticalAreaOpen() {
                return verticalMenuObject.hasClass('active');
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();

                    if(eltdf.body.hasClass('eltdf-header-vertical-closed')) {
                        initHiddenVerticalArea();
                    }

                }
            }
        };
    };

})(jQuery);
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

(function($) {
    'use strict';

    $(document).ready(function(){
	    eltdfInitAccordions();
    });
	
	/**
	 * Init accordions shortcode
	 */
	function eltdfInitAccordions(){
		var accordion = $('.eltdf-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('eltdf-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('eltdf-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.eltdf-title-holder'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitAnimationHolder();
	});
	
	/*
	 *	Init animation holder shortcode
	 */
	function eltdfInitAnimationHolder(){
		
		var elements = $('.eltdf-grow-in, .eltdf-fade-in-down, .eltdf-element-from-fade, .eltdf-element-from-left, .eltdf-element-from-right, .eltdf-element-from-top, .eltdf-element-from-bottom, .eltdf-flip-in, .eltdf-x-rotate, .eltdf-z-rotate, .eltdf-y-translate, .eltdf-fade-in, .eltdf-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfButton().init();
	});
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var eltdfButton = function() {
		//all buttons on the page
		var buttons = $('.eltdf-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('border-color'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitClientsCarousel();
	});
	
	/**
	 * Init clients carousel shortcode
	 */
	function eltdfInitClientsCarousel(){
		var carouselHolder = $('.eltdf-clients-carousel-holder');
		
		if(carouselHolder.length){
			carouselHolder.each(function(){
				
				var thisCarouselHolder = $(this),
					thisCarousel = thisCarouselHolder.children('.eltdf-cc-inner'),
					numberOfItems = 4,
					autoplay = true,
					autoplayTimeout = 5000,
					loop = true,
					speed = 650;
				
				if (typeof thisCarousel.data('number-of-items') !== 'undefined' && thisCarousel.data('number-of-items') !== false) {
					numberOfItems = parseInt(thisCarousel.data('number-of-items'));
				}
				
				if (typeof thisCarousel.data('autoplay') !== 'undefined' && thisCarousel.data('autoplay') !== false) {
					autoplay = thisCarousel.data('autoplay');
				}
				
				if (typeof thisCarousel.data('autoplay-timeout') !== 'undefined' && thisCarousel.data('autoplay-timeout') !== false) {
					autoplayTimeout = thisCarousel.data('autoplay-timeout');
				}
				
				if (typeof thisCarousel.data('loop') !== 'undefined' && thisCarousel.data('loop') !== false) {
					loop = thisCarousel.data('loop');
				}
				
				if (typeof thisCarousel.data('speed') !== 'undefined' && thisCarousel.data('speed') !== false) {
					speed = thisCarousel.data('speed');
				}
				
				if(numberOfItems === 1) {
					autoplay = false;
					loop = false;
				}
				
				var responsiveNumberOfItems1 = 1,
					responsiveNumberOfItems2 = 2,
					responsiveNumberOfItems3 = 3;
				
				if (numberOfItems < 3) {
					responsiveNumberOfItems1 = numberOfItems;
					responsiveNumberOfItems2 = numberOfItems;
					responsiveNumberOfItems3 = numberOfItems;
				}
				
				thisCarousel.owlCarousel({
					items: numberOfItems,
					autoplay: autoplay,
					autoplayTimeout: autoplayTimeout,
					autoplayHoverPause:true,
					loop: loop,
					smartSpeed: speed,
					nav: false,
					dots: false,
					responsive: {
						0: {
							items: responsiveNumberOfItems1,
						},
						600: {
							items: responsiveNumberOfItems2
						},
						768: {
							items: responsiveNumberOfItems3,
						},
						1025: {
							items: numberOfItems
						}
					}
				});

				thisCarousel.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitCountdown();
	});
	
	/**
	 * Countdown Shortcode
	 */
	function eltdfInitCountdown() {
		var countdowns = $('.eltdf-countdown'),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month - 1, day, hour, minute, 44),
					labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitCounter();
	});
	
	/**
	 * Counter Shortcode
	 */
	function eltdfInitCounter() {
		var counterHolder = $('.eltdf-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.eltdf-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('eltdf-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var customFont = {};
	eltdf.modules.customFont = customFont;
	
	customFont.eltdfCustomFontResize = eltdfCustomFontResize;
	
	
	customFont.eltdfOnDocumentReady = eltdfOnDocumentReady;
	customFont.eltdfOnWindowResize = eltdfOnWindowResize;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).resize(eltdfOnWindowResize);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfCustomFontResize();
	}
	
	/* 
	 All functions to be called on $(window).resize() should be in this function
	 */
	function eltdfOnWindowResize() {
		eltdfCustomFontResize();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function eltdfCustomFontResize(){
		var holder = $('.eltdf-custom-font-holder');
		
		if(holder.length){
			holder.each(function() {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
					
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1280') !== 'undefined' && thisItem.data('font-size-1280') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1280') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1280') !== 'undefined' && thisItem.data('line-height-1280') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1280') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if(smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if(smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1280px) {.eltdf-custom-font-holder."+itemClass+" { " + smallLaptopStyle + " } }";
					}
					if(ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.eltdf-custom-font-holder."+itemClass+" { " + ipadLandscapeStyle + " } }";
					}
					if(ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.eltdf-custom-font-holder."+itemClass+" { " + ipadPortraitStyle + " } }";
					}
					if(mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.eltdf-custom-font-holder."+itemClass+" { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitElementsHolderResponsiveStyle();
	});
	
	/*
	 **	Elements Holder responsive style
	 */
	function eltdfInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.eltdf-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.eltdf-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1280-1600') !== 'undefined' && thisItem.data('1280-1600') !== false) {
						largeLaptop = thisItem.data('1280-1600');
					}
					if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
						smallLaptop = thisItem.data('1024-1280');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('600-768') !== 'undefined' && thisItem.data('600-768') !== false) {
						ipadPortrait = thisItem.data('600-768');
					}
					if (typeof thisItem.data('480-600') !== 'undefined' && thisItem.data('480-600') !== false) {
						mobileLandscape = thisItem.data('480-600');
					}
					if (typeof thisItem.data('480') !== 'undefined' && thisItem.data('480') !== false) {
						mobilePortrait = thisItem.data('480');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1280px) and (max-width: 1600px) {.eltdf-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1024px) and (max-width: 1280px) {.eltdf-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 768px) and (max-width: 1024px) {.eltdf-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 600px) and (max-width: 768px) {.eltdf-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 480px) and (max-width: 600px) {.eltdf-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
						if(mobilePortrait.length) {
							responsiveStyle += "@media only screen and (max-width: 480px) {.eltdf-eh-item-content."+itemClass+" { padding: "+mobilePortrait+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css" data-type="satine_elated_shortcodes_custom_css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfShowGoogleMap();
	});
	
	/*
	 **	Show Google Map
	 */
	function eltdfShowGoogleMap(){
		var googleMap = $('.eltdf-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}

	
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				var locationMap;
			    if(typeof element.data('location-map') !== 'undefined' && element.data('location-map') !== false && element.data('location-map') === 'yes') {
			     	locationMap = true;
			    }
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "eltdf-map-"+ uniqueId;
				
				eltdfInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses, locationMap);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function eltdfInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data , locationMap){
		
		if(locationMap) {
			var mapStyles = [
		    {
		        "featureType": "water",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "color": "#e9e9e9"
		            },
		            {
		                "lightness": 17
		            }
		        ]
		    },
		    {
		        "featureType": "landscape",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "color": "#f5f5f5"
		            },
		            {
		                "lightness": 20
		            }
		        ]
		    },
		    {
		        "featureType": "road.highway",
		        "elementType": "geometry.fill",
		        "stylers": [
		            {
		                "color": "#ffffff"
		            },
		            {
		                "lightness": 17
		            }
		        ]
		    },
		    {
		        "featureType": "road.highway",
		        "elementType": "geometry.stroke",
		        "stylers": [
		            {
		                "color": "#ffffff"
		            },
		            {
		                "lightness": 29
		            },
		            {
		                "weight": 0.2
		            }
		        ]
		    },
		    {
		        "featureType": "road.arterial",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "color": "#ffffff"
		            },
		            {
		                "lightness": 18
		            }
		        ]
		    },
		    {
		        "featureType": "road.local",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "color": "#ffffff"
		            },
		            {
		                "lightness": 16
		            }
		        ]
		    },
		    {
		        "featureType": "poi",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "color": "#f5f5f5"
		            },
		            {
		                "lightness": 21
		            }
		        ]
		    },
		    {
		        "featureType": "poi.park",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "color": "#dedede"
		            },
		            {
		                "lightness": 21
		            }
		        ]
		    },
		    {
		        "elementType": "labels.text.stroke",
		        "stylers": [
		            {
		                "visibility": "on"
		            },
		            {
		                "color": "#ffffff"
		            },
		            {
		                "lightness": 16
		            }
		        ]
		    },
		    {
		        "elementType": "labels.text.fill",
		        "stylers": [
		            {
		                "saturation": 36
		            },
		            {
		                "color": "#333333"
		            },
		            {
		                "lightness": 40
		            }
		        ]
		    },
		    {
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "transit",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "color": "#f2f2f2"
		            },
		            {
		                "lightness": 19
		            }
		        ]
		    },
		    {
		        "featureType": "administrative",
		        "elementType": "geometry.fill",
		        "stylers": [
		            {
		                "color": "#fefefe"
		            },
		            {
		                "lightness": 20
		            }
		        ]
		    },
		    {
		        "featureType": "administrative",
		        "elementType": "geometry.stroke",
		        "stylers": [
		            {
		                "color": "#fefefe"
		            },
		            {
		                "lightness": 17
		            },
		            {
		                "weight": 1.2
		            }
		        ]
		    }
		];
		} else {
			var mapStyles = [
			{
				stylers: [
					{hue: color },
					{saturation: saturation},
					{lightness: lightness},
					{gamma: 1}
				]
			}
		];
		}
		
		var googleMapStyleId;

		
		if(customMapStyle === 'yes' || locationMap ){
			googleMapStyleId = 'eltdf-style';
		} else {
			googleMapStyleId = terrainTypeID;
		}
		
		if(wheel === 'yes'){
			wheel = true;
		} else {
			wheel = false;
		}
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles,
			{name: "Elated Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'eltdf-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('eltdf-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			eltdfInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function eltdfInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfIcon().init();
	});
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var eltdfIcon = function() {
		//get all icons on page
		var icons = $('.eltdf-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('eltdf-icon-animation')) {
				icon.appear(function() {
					icon.parent('.eltdf-icon-animation-holder').addClass('eltdf-icon-animation-show');
				}, {accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.eltdf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('border-color');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitIconList().init();
	});
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var eltdfInitIconList = function() {
		var iconList = $('.eltdf-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('eltdf-appeared');
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitImageGallery();
	});
	
	/**
	 * Init image gallery shortcode
	 */
	function eltdfInitImageGallery() {
		var galleries = $('.eltdf-image-gallery');
		
		if (galleries.length) {
			galleries.each(function () {
				var gallery = $(this).find('.eltdf-ig-slider'),
					numberOfItems = gallery.data('number-of-visible-items'),
					autoplay = gallery.data('autoplay'),
					animation = (gallery.data('animation') === 'slide') ? false : gallery.data('animation'),
					navigation = (gallery.data('navigation') === 'yes'),
					pagination = (gallery.data('pagination') === 'yes');
				
				//Responsive breakpoints
				var items = numberOfItems;
				
				var responsiveItems1 = 4;
				var responsiveItems2 = 3;
				var responsiveItems3 = 2;
				var responsiveItems4 = 1;
				
				if (items < 3) {
					responsiveItems1 = items;
					responsiveItems2 = items;
				}
				
				if (items < 2) {
					responsiveItems3 = items;
				}
				
				gallery.owlCarousel({
					autoplay: true,
					autoplayTimeout: autoplay * 1000,
					loop: true,
					smartSpeed: 600,
					animateIn : animation, //fade, fadeUp, backSlide, goDown
					nav: navigation,
					dots: pagination,
					navText: [
						'<span class="eltdf-prev-icon"><span class="eltdf-icon-arrow ion-ios-arrow-thin-left"></span></span>',
						'<span class="eltdf-next-icon"><span class="eltdf-icon-arrow ion-ios-arrow-thin-right"></span></span>'
					],
					responsive:{
						1201:{
							items: items
						},
						769:{
							items: responsiveItems1
						},
						601:{
							items: responsiveItems2
						},
						481:{
							items: responsiveItems3
						},
						0:{
							items: responsiveItems4
						}
					}
				});
				
				gallery.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
        eltdfInitMessages();
        eltdfInitMessageHeight();
    });

/*
 **	Function to close message shortcode
 */
function eltdfInitMessages(){
    var message = $('.eltdf-message');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            thisMessage.find('.eltdf-close').click(function(e){
                e.preventDefault();
                $(this).parent().parent().fadeOut(500);
            });
        });
    }
}

/*
 **	Init message height
 */
function eltdfInitMessageHeight(){
    var message = $('.eltdf-message.eltdf-with-icon');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            var textHolderHeight = thisMessage.find('.eltdf-message-text-holder').height();
            var iconHolderHeight = thisMessage.find('.eltdf-message-icon-holder').height();

            if(textHolderHeight > iconHolderHeight) {
                thisMessage.find('.eltdf-message-icon-holder').height(textHolderHeight);
            } else {
                thisMessage.find('.eltdf-message-text-holder').height(iconHolderHeight);
            }
        });
    }
}

})(jQuery);
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
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitPieChart();
	});
	
	/**
	 * Init Pie Chart shortcode
	 */
	function eltdfInitPieChart() {
		var pieChartHolder = $('.eltdf-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.eltdf-pc-percentage'),
					barColor = '#25abd1',
					trackColor = '#f7f7f7',
					lineWidth = 3,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.eltdf-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitProgressBars();
	});
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function eltdfInitProgressBars(){
		var progressBar = $('.eltdf-progress-bar');
		
		if(progressBar.length){
			progressBar.each(function() {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.eltdf-pb-content'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function() {
					eltdfInitToCounterProgressBar(thisBar, percentage);
					
					thisBarContent.css('width', '0%');
					thisBarContent.animate({'width': percentage+'%'}, 2000);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function eltdfInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.eltdf-pb-percent');
		
		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitTabs();
	});
	
	/*
	 **	Init tabs shortcode
	 */
	function eltdfInitTabs(){
		var tabs = $('.eltdf-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.eltdf-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.eltdf-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		eltdfInitVerticalSplitSlider();
	});
	
	/*
	 **	Vertical Split Slider
	 */
	function eltdfInitVerticalSplitSlider() {
		var slider = $('.eltdf-vertical-split-slider');
		
		if (slider.length) {
			if (eltdf.body.hasClass('eltdf-vss-initialized')) {
				eltdf.body.removeClass('eltdf-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(eltdf.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (eltdf.body.hasClass('eltdf-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (eltdf.body.hasClass('eltdf-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.eltdf-vss-ms-section',
				leftSelector: '.eltdf-vss-ms-left',
				rightSelector: '.eltdf-vss-ms-right',
                loopTop: true,
                loopBottom: true,
				afterRender: function () {
					eltdfCheckVerticalSplitSectionsForHeaderStyle($('.eltdf-vss-ms-left .eltdf-vss-ms-section:last-child').data('header-style'), defaultHeaderStyle);
					eltdf.body.addClass('eltdf-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if (contactForm7.length) {
						contactForm7.each(function(){
							var thisForm = $(this);
							
							thisForm.find('.wpcf7-submit').off().on('click', function(e){
								e.preventDefault();
								wpcf7.submit(thisForm);
							});
						});
					}// this function need to be initialized after initVerticalSplitSlide
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="eltdf-vss-responsive"></div>'),
						leftSide = slider.find('.eltdf-vss-ms-left > div'),
						rightSide = slider.find('.eltdf-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.eltdf-vss-responsive .eltdf-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'eltdf-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof eltdfButton === "function") {
						eltdfButton().init();
					}
					
					if (typeof eltdfInitElementsHolderResponsiveStyle === "function") {
						eltdfInitElementsHolderResponsiveStyle();
					}
					
					if (typeof eltdfShowGoogleMap === "function") {
						eltdfShowGoogleMap();
					}
					
					if (typeof eltdfInitProgressBars === "function") {
						eltdfInitProgressBars();
					}
					
					if (typeof eltdfInitTestimonials === "function") {
						eltdfInitTestimonials();
					}
				},
				onLeave: function (index, nextIndex, direction) {
					eltdfCheckVerticalSplitSectionsForHeaderStyle($($('.eltdf-vss-ms-left .eltdf-vss-ms-section')[$(".eltdf-vss-ms-left .eltdf-vss-ms-section").length - nextIndex]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (eltdf.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (eltdf.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function eltdfCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			eltdf.body.removeClass('eltdf-light-header eltdf-dark-header').addClass('eltdf-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			eltdf.body.removeClass('eltdf-light-header eltdf-dark-header').addClass('eltdf-' + default_header_style + '-header');
		} else {
			eltdf.body.removeClass('eltdf-light-header eltdf-dark-header');
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    eltdf.modules.portfolio = portfolio;

    portfolio.eltdfOnDocumentReady = eltdfOnDocumentReady;
    portfolio.eltdfOnWindowLoad = eltdfOnWindowLoad;
    portfolio.eltdfOnWindowResize = eltdfOnWindowResize;
    portfolio.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitPortfolioSlider();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfInitPortfolioMasonry();
        eltdfInitPortfolioFilter();
        initPortfolioSingleMasonry();
        eltdfInitPortfolioListAnimation();
	    eltdfInitPortfolioPagination().init();
        eltdfPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function eltdfOnWindowResize() {
        eltdfInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {
	    eltdfInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function eltdfInitPortfolioListAnimation(){
        var portList = $('.eltdf-portfolio-list-holder.eltdf-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.eltdf-pl-inner'),
                	articles = thisPortList.find('article'),
                    rewindCalc = 0,
                    cycle = 0,
                    delay = 250,
                    yOffset = eltdfGlobalVars.vars.eltdfElementAppearAmount;

                articles.each(function() {
                    var article = $(this);

                    if (article.offset().top == articles.first().offset().top) { //find the number of articles in the same row
                        rewindCalc ++;
                    }

                    article.appear(function(){
                        if (cycle == rewindCalc) {
                            cycle = 0;
                        }

                        setTimeout(function(){
    		            	showItem(article);
                        }, cycle*delay);

                        cycle++;
                    }, {accX: 0, accY: yOffset});
                });
            });

			//show item function
			var showItem = function(article) {
				article.addClass('eltdf-item-show');

				article.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				    article.addClass('eltdf-item-shown');
				});
			}
        }
    }

    /**
     * Initializes portfolio list
     */
    function eltdfInitPortfolioMasonry(){
        var portList = $('.eltdf-portfolio-list-holder.eltdf-pl-masonry');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this),
                    masonry = thisPortList.children('.eltdf-pl-inner'),
                    size = thisPortList.find('.eltdf-pl-grid-sizer').width();
                
                eltdfResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.eltdf-pl-grid-gutter',
                        columnWidth: '.eltdf-pl-grid-sizer'
                    }
                });

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Blog Items
     */
    function eltdfResizePortfolioItems(size,container){

        if(container.hasClass('eltdf-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.eltdf-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.eltdf-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.eltdf-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.eltdf-pl-masonry-large-width-height');

            if (eltdf.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function eltdfInitPortfolioFilter(){
        var filterHolder = $('.eltdf-portfolio-list-holder .eltdf-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.eltdf-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.eltdf-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('eltdf-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.eltdf-pl-filter:first').addClass('eltdf-pl-current');
	            
	            if(thisPortListHolder.hasClass('eltdf-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.eltdf-pl-filter').click(function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.eltdf-pl-filter').removeClass('eltdf-pl-current');
                    thisFilter.addClass('eltdf-pl-current');

                    if(portListHasLoadMore && !portListHasArtciles) {
                        eltdfInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.eltdf-pl-inner').isotope({ filter: filterValue });
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function eltdfInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {

        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.eltdf-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'eltdf_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.eltdf-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('eltdf-showing eltdf-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                        if(portListHasArtciles) {
                            setTimeout(function() {
                                eltdfResizePortfolioItems(thisPortListInner.find('.eltdf-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('eltdf-showing eltdf-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('eltdf-showing eltdf-filter-trigger');
                            eltdfInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function eltdfInitPortfolioPagination(){
		var portList = $('.eltdf-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.eltdf-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.eltdf-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			if(!thisPortList.hasClass('eltdf-pl-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.eltdf-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('eltdf-pl-pag-infinite-scroll')) {
				thisPortList.addClass('eltdf-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.eltdf-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
					loadingItem.addClass('eltdf-showing eltdf-standard-pag-trigger');
					thisPortList.addClass('eltdf-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('eltdf-showing');
				}
				
				var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'eltdf_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: ElatedAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('eltdf-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
							eltdfInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('eltdf-pl-masonry')){
                                    eltdfResizePortfolioItems(thisPortListInner.find('.eltdf-pl-grid-sizer').width(), thisPortList);
									eltdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('eltdf-pl-gallery') && thisPortList.hasClass('eltdf-pl-has-filter')) {
									eltdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									eltdfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('eltdf-pl-masonry')){
									eltdfInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('eltdf-pl-gallery') && thisPortList.hasClass('eltdf-pl-has-filter')) {
									eltdfInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
								} else {
									eltdfInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisPortList.hasClass('eltdf-pl-infinite-scroll-started')) {
							thisPortList.removeClass('eltdf-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.eltdf-pl-load-more-holder').hide();
			}
		};
		
		var eltdfInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.eltdf-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.eltdf-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.eltdf-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.eltdf-pl-pag-next a');
			
			standardPagNumericItem.removeClass('eltdf-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('eltdf-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var eltdfInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisPortList.removeClass('eltdf-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				eltdfInitPortfolioListAnimation();
			}, 400);
		};
		
		var eltdfInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisPortList.removeClass('eltdf-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			eltdfInitPortfolioListAnimation();
		};
		
		var eltdfInitAppendIsotopeNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				eltdfInitPortfolioListAnimation();
			}, 400);
		};
		
		var eltdfInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing');
			thisPortListInner.append(responseHtml);
			eltdfInitPortfolioListAnimation();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('eltdf-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('eltdf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('eltdf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			}
		};
	}

    /**
     * Initializes portfolio slider
     */
    function eltdfInitPortfolioSlider(){
        var portSlider = $('.eltdf-portfolio-slider-holder');
	
	    if(portSlider.length) {
		    portSlider.each(function () {
			    var thisPortSlider = $(this),
				    portHolder = thisPortSlider.children('.eltdf-portfolio-list-holder'),
				    portSlider = portHolder.children('.eltdf-pl-inner'),
				    numberOfItems = 4,
				    margin = 0,
				    marginLabel,
				    sliderSpeed = 5000,
				    loop = true,
				    padding = false,
				    navigation = true,
				    pagination = true;
			
			    if (typeof portHolder.data('number-of-columns') !== 'undefined' && portHolder.data('number-of-columns') !== false) {
				    numberOfItems = portHolder.data('number-of-columns');
			    }
			
			    if (typeof portHolder.data('space-between-items') !== 'undefined' && portHolder.data('space-between-items') !== false) {
				    marginLabel = portHolder.data('space-between-items');
				
				    if (marginLabel === 'normal') {
                        margin = 30;
                    } else if (marginLabel === 'small') {
					    margin = 20;
				    } else if (marginLabel === 'tiny') {
                        margin = 10;
                    } else {
					    margin = 0;
				    }
			    }
			
			    if (typeof portHolder.data('slider-speed') !== 'undefined' && portHolder.data('slider-speed') !== false) {
				    sliderSpeed = portHolder.data('slider-speed');
			    }
			    if (typeof portHolder.data('enable-loop') !== 'undefined' && portHolder.data('enable-loop') !== false && portHolder.data('enable-loop') === 'no') {
				    loop = false;
			    }
			    if (typeof portHolder.data('enable-padding') !== 'undefined' && portHolder.data('enable-padding') !== false && portHolder.data('enable-padding') === 'yes') {
				    padding = true;
			    }
			    if (typeof portHolder.data('enable-navigation') !== 'undefined' && portHolder.data('enable-navigation') !== false && portHolder.data('enable-navigation') === 'no') {
				    navigation = false;
			    }
			    if (typeof portHolder.data('enable-pagination') !== 'undefined' && portHolder.data('enable-pagination') !== false && portHolder.data('enable-pagination') === 'no') {
				    pagination = false;
			    }
			
			    var responsiveNumberOfItems1 = 1,
				    responsiveNumberOfItems2 = 2,
				    responsiveNumberOfItems3 = 3;
			
			    if (numberOfItems < 3) {
				    responsiveNumberOfItems1 = numberOfItems;
				    responsiveNumberOfItems2 = numberOfItems;
				    responsiveNumberOfItems3 = numberOfItems;
			    }
			
			    portSlider.owlCarousel({
				    items: numberOfItems,
				    margin: margin,
				    loop: loop,
				    autoplay: true,
				    autoplayTimeout: sliderSpeed,
				    autoplayHoverPause: true,
				    smartSpeed: 800,
				    nav: navigation,
				    navText: [
					    '<span class="eltdf-prev-icon"><span class="eltdf-icon-arrow icon-arrows-left"></span></span>',
					    '<span class="eltdf-next-icon"><span class="eltdf-icon-arrow icon-arrows-right"></span></span>'
				    ],
				    dots: pagination,
				    responsive: {
					    0: {
						    items: responsiveNumberOfItems1,
						    stagePadding: 0
					    },
					    600: {
						    items: responsiveNumberOfItems2
					    },
					    768: {
						    items: responsiveNumberOfItems3
					    },
					    1024: {
						    items: numberOfItems
					    }
				    }
			    });
			
			    thisPortSlider.css('opacity', '1');
		    });
	    }
    }

    var eltdfPortfolioSingleFollow = function() {

        var info = $('.eltdf-follow-portfolio-info .eltdf-portfolio-single-holder .eltdf-ps-info-sticky-holder');

        if (info.length) {
            var infoHolderOffset = info.offset().top,
                infoHolderHeight = info.height(),
                mediaHolder = $('.eltdf-ps-image-holder'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .eltdf-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function() {

            if(info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if(eltdf.scroll > infoHolderOffset) {
                        var marginTop = eltdf.scroll + headerHeight + eltdfGlobalVars.vars.eltdfAddForAdminBar - infoHolderOffset;
                        // if scroll is initially positioned below mediaHolderHeight
                        if(marginTop + infoHolderHeight > mediaHolderHeight){
                            marginTop = mediaHolderHeight - infoHolderHeight;
                        }
                        info.animate({
                            marginTop: marginTop
                        });
                    }
                }
            }
        };

        var recalculateInfoHolderPosition = function() {

            if (info.length) {
                if(mediaHolderHeight > infoHolderHeight) {
                    if(eltdf.scroll > infoHolderOffset) {
                    	
                        if(eltdf.scroll + headerHeight + infoHolderHeight <  mediaHolderHeight) {
                            //Calculate header height if header appears
                            if ($('.header-appear, .eltdf-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .eltdf-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (eltdf.scroll + headerHeight + eltdfGlobalVars.vars.eltdfAddForAdminBar - infoHolderOffset)
                            });
                            //Reset header height
                            headerHeight = 0;
                        } else{
                            info.stop().animate({
                            	marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {
            init : function() {
                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });
            }
        };
    };
	
	function initPortfolioSingleMasonry(){
		var masonryHolder = $('.eltdf-portfolio-single-holder .eltdf-ps-masonry-images'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.eltdf-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.eltdf-ps-grid-gutter',
                    columnWidth: '.eltdf-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
		}
	}

})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
	    // eltdfInitTeamSlider();
    });
	
	/**
	 * Init team slider shortcode
	 */
	function eltdfInitTeamSlider() {
		var teamSliders = $('.eltdf-team-slider-holder');
		
		if (teamSliders.length) {
			teamSliders.each(function () {
				
				var thisTeamSlider = $(this),
					teamHolder = thisTeamSlider.children('.eltdf-team-list-holder'),
					teamSlider = teamHolder.children('.eltdf-tl-inner');
				
				var dots = (teamHolder.data('dots') == 'yes');
				
				var numberOfItems = teamHolder.data('number_of_items');
				
				var responsiveItems1 = numberOfItems;
				var responsiveItems2 = 3;
				var responsiveItems3 = 2;
				var responsiveItems4 = 1;
				
				if (numberOfItems > 4) {
					responsiveItems1 = 4;
				}
				
				if(numberOfItems < 3) {
					responsiveItems2 = numberOfItems;
				}
				
				if (numberOfItems < 2) {
					responsiveItems3 = numberOfItems;
				}
				
				if (numberOfItems === 1) {
					responsiveItems4 = numberOfItems;
				}
				
				teamSlider.owlCarousel({
					dots: dots,
					nav: false,
					items: numberOfItems,
					responsive:{
						1200:{
							items: numberOfItems
						},
						1024:{
							items: responsiveItems1
						},
						769:{
							items: responsiveItems2
						},
						601:{
							items: responsiveItems3
						},
						0:{
							items: responsiveItems4
						}
					},
					onInitialized: function() {
						teamSlider.css({'opacity': 1});
					}
				});
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
	    eltdfInitTestimonials();
    });

	/**
	 * Init testimonials shortcode
	 */
	function eltdfInitTestimonials(){
		var testimonialsHolder = $('.eltdf-testimonials-holder');

		if(testimonialsHolder.length){
			testimonialsHolder.each(function(){
				var thisTestimonials = $(this),
					testimonials = thisTestimonials.children('.eltdf-testimonials'),
					numberOfItems = 3,
					loop = true,
					autoplay = true,
					number = 0,
					speed = 5000,
					animationSpeed = 600,
					navArrows = true,
					navDots = true,
					margin = 26;

				if (typeof testimonials.data('number') !== 'undefined' && testimonials.data('number') !== false) {
					number = parseInt(testimonials.data('number'));
				}

				if (typeof testimonials.data('number-visible') !== 'undefined' && testimonials.data('number-visible') !== false) {
					numberOfItems = parseInt(testimonials.data('number-visible'));
				}

				if (typeof testimonials.data('speed') !== 'undefined' && testimonials.data('speed') !== false) {
					speed = testimonials.data('speed');
				}

				if (typeof testimonials.data('animation-speed') !== 'undefined' && testimonials.data('animation-speed') !== false) {
					animationSpeed = testimonials.data('animation-speed');
				}

				if (typeof testimonials.data('nav-arrows') !== 'undefined' && testimonials.data('nav-arrows') !== false && testimonials.data('nav-arrows') === 'no') {
					navArrows = false;
				}

				if (typeof testimonials.data('nav-dots') !== 'undefined' && testimonials.data('nav-dots') !== false && testimonials.data('nav-dots') === 'no') {
					navDots = false;
				}

				if(number === 1) {
					loop = false;
					autoplay = false;
					navArrows = false;
					navDots = false;
				}

                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2;

                if (numberOfItems < 3) {
                    responsiveNumberOfItems1 = numberOfItems;
                    responsiveNumberOfItems2 = numberOfItems;
                }

				testimonials.owlCarousel({
					items: numberOfItems,
					loop: loop,
					autoplay: autoplay,
					autoplayTimeout: speed,
					smartSpeed: animationSpeed,
					margin: margin,
					nav: navArrows,
					dots: navDots,
                    responsive: {
						0: {
                            items: responsiveNumberOfItems1,
                            margin: 0,
                            center: false,
                            autoWidth: false
                        },
                        769: {
                            items: responsiveNumberOfItems2
                        },
                        1025: {
                            items: numberOfItems
                        }
                    },
					navText: [
						'<span class="eltdf-prev-icon"><span class="eltdf-icon-linear-icon lnr lnr-arrow-left"></span></span>',
						'<span class="eltdf-next-icon"><span class="eltdf-icon-linear-icon lnr lnr-arrow-right"></span></span>'
					]
				});
				thisTestimonials.css({'visibility': 'visible'});
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    var woocommerce = {};
    eltdf.modules.woocommerce = woocommerce;

    woocommerce.eltdfOnDocumentReady = eltdfOnDocumentReady;
    woocommerce.eltdfOnWindowLoad = eltdfOnWindowLoad;
    woocommerce.eltdfOnWindowResize = eltdfOnWindowResize;
    woocommerce.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfInitQuantityButtons();
        eltdfInitSelect2();
        eltdfInitSingleProductLightbox();
	    eltdfInitSingleProductImageSwitchLogic();
        eltdfInitSingleProductZoomImage();
        eltdfInitProductListFilter().init();
        eltdfWishlistRefresh().init();
        eltdfQuickViewGallery().init();
        eltdfQuickViewSelect2();
        eltdfAddingToCart();
        eltdfAddingToWishlist();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdfOnWindowLoad() {
        eltdfInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
        eltdfInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdfOnWindowScroll() {
        eltdfInitSingleProductZoomImageLogic();
    }
    
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
    function eltdfInitQuantityButtons() {
    
        $(document).on( 'click', '.eltdf-quantity-minus, .eltdf-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.eltdf-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('eltdf-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

            inputField.trigger( 'change' );
        });
    }

    /*
    ** Init select2 script for select html dropdowns
    */
    function eltdfInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length) {
            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });
        }

        if($('#calc_shipping_country').length) {
            $('#calc_shipping_country').select2();
        }

        $(eltdf.body).on('updated_shipping_method',function(){
            $('#calc_shipping_country').select2();
        });

        if($('.cart-collaterals .shipping select#calc_shipping_state').length) {
            $('.cart-collaterals .shipping select#calc_shipping_state').select2();
        }

        if($('.eltdf-woo-single-page .variations select').length) {
            $('.eltdf-woo-single-page .variations select').select2();
        }
    }

    /*
     ** Init Product Single Pretty Photo attributes
     */
    function eltdfInitSingleProductLightbox() {
        var item = $('.eltdf-woo-single-page .eltdf-single-product-content .images .woocommerce-product-gallery__image');

        if(item.length) {
            item.each(function() {
                var thisItem = $(this).children('a');

                thisItem.attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');

                if (typeof eltdf.modules.common.eltdfPrettyPhoto === "function") {
                    eltdf.modules.common.eltdfPrettyPhoto();
                }
            });
        }
    }

	 /*
    ** Init switch image logic for thumbnail and featured images on product single page
    */
    function eltdfInitSingleProductImageSwitchLogic() {

        if(eltdf.body.hasClass('eltdf-woo-single-switch-image')){
    
            var thumbnailImage = $('.eltdf-woo-single-page .eltdf-single-product-content .images.woocommerce-product-gallery--with-images .woocommerce-product-gallery__image:not(:first-child) > a'),
                featuredImage = $('.eltdf-woo-single-page .eltdf-single-product-content .images .woocommerce-product-gallery__image:first-child > a');
            
            if(featuredImage.length) {
                featuredImage.on('click', function() {
                    if($('div.pp_overlay').length) {
                        $.prettyPhoto.close();
                    }
                    if(eltdf.body.hasClass('eltdf-disable-thumbnail-prettyphoto')){
                        eltdf.body.removeClass('eltdf-disable-thumbnail-prettyphoto');
                    }
                    if(featuredImage.children('.eltdf-fake-featured-image').length){
                        $('.eltdf-fake-featured-image').stop().animate({'opacity': '0'}, 300, function() {
                            $(this).remove();
                        });
                    }
                    
                    setTimeout(function() {
                        eltdfInitSingleProductZoomImage();
                    }, 1000);
                });
            }

            if(thumbnailImage.length) {
                thumbnailImage.each(function(){
                    var thisThumbnailImage = $(this),
                        thisThumbnailImageSrc = thisThumbnailImage.attr('href');

                    thisThumbnailImage.on('click', function() {
                        if(!eltdf.body.hasClass('eltdf-disable-thumbnail-prettyphoto')){
                            eltdf.body.addClass('eltdf-disable-thumbnail-prettyphoto');
                        }

                        if($('div.pp_overlay').length) {
                            $.prettyPhoto.close();
                        }
                        if(thisThumbnailImageSrc !== '' && featuredImage !== '') {
                            if(featuredImage.children('.eltdf-fake-featured-image').length){
                                $('.eltdf-fake-featured-image').remove();
                            }
                            featuredImage.append('<img itemprop="image" class="eltdf-fake-featured-image" src="'+thisThumbnailImageSrc+'" />');
                        }

                        eltdfInitSingleProductZoomImage();
                    });
                });
            }            
        }
    }

    /*
    ** Set data attribute for single product buttons for hover animation
    */
    function eltdfInitSingleProductZoomImage() {

        var item = $('.no-touch .eltdf-woo-single-page-standard.eltdf-zoom-image-enabled .images.woocommerce-product-gallery--with-images .woocommerce-product-gallery__image:first-child > a');

        if(item.length) {

            if(item.children('.eltdf-woocommerce-main-image-zoom').length) {
                item.children('.eltdf-woocommerce-main-image-zoom').remove();
            }

            item.each(function() {
                var thisItem = $(this),
                    thisItemImage = thisItem.attr('href');

                thisItem.attr('id', 'eltdf-woo-zoom-cursor');

                if(thisItem.children('.eltdf-fake-featured-image').length) {
                    thisItemImage = thisItem.children('.eltdf-fake-featured-image').attr('src');
                }

                if(thisItemImage.length) {

                    if(thisItem.children('.eltdf-woocommerce-zoom-cursor').length) {
                        thisItem.children('.eltdf-woocommerce-zoom-cursor').remove();
                    }

                    thisItem.append('<div class="eltdf-woocommerce-zoom-cursor"></div>');
                    thisItem.append('<div class="eltdf-woocommerce-main-image-zoom" data-src="'+thisItemImage+'" style="background-image: url('+thisItemImage+');"></div>');
                    
                    eltdfInitSingleProductZoomImageLogic();
                }
            });
        }
    }

    /*
    ** Set data attribute for single product buttons for hover animation
    */
    function eltdfInitSingleProductZoomImageLogic() {

        var item = $('#eltdf-woo-zoom-cursor');

        if(item.length) {
      
            var tmpImg = new Image(),
                zoomImageSrc = item.children('.eltdf-woocommerce-main-image-zoom').data('src'),
                itemWidth = item.outerWidth(),
                itemHeight = item.outerHeight(),
                itemOffsetTop = item.offset().top - eltdf.scroll,
                itemOffsetLeft = item.offset().left,
                cursor = $('.eltdf-woocommerce-zoom-cursor'),
                cursorWidth = cursor.outerWidth(),
                cursorHeight = cursor.outerHeight(),
                x = 0,
                y = 0,
                currentXCPosition = 0,
                currentYCPosition = 0,
                imagePosition = 0,
                imagecurrXPosition = 0,
                imagecurrYPosition = 0,
                imageXPosition = 0,
                imageYPosition = 0,
                zoomImage = item.children('.eltdf-woocommerce-main-image-zoom');
            
            tmpImg.src = zoomImageSrc;
            
            document.getElementById('eltdf-woo-zoom-cursor').addEventListener("mousemove", function(event) {
                var orginalImageWidth = tmpImg.width,
                    orginalImageHeight = tmpImg.height;
                
                x = (event.clientX - itemOffsetLeft - cursorWidth / 2) >> 0;
                y = (event.clientY - itemOffsetTop - cursorWidth / 2) >> 0;

                if(x > itemWidth - cursorWidth) {
                    currentXCPosition = itemWidth - cursorWidth;
                } else if (x < 0) {
                    currentXCPosition = 0;
                } else {
                    currentXCPosition = x;
                }
    
                if(y > itemHeight - cursorHeight) {
                    currentYCPosition = itemHeight - cursorHeight;
                } else if (y < 0) {
                    currentYCPosition = 0;
                } else {
                    currentYCPosition = y;
                }
                
                imageXPosition = (currentXCPosition / itemWidth * orginalImageWidth) >> 0;
                imageYPosition = (currentYCPosition / itemHeight * orginalImageHeight) >> 0;
                
                imagecurrXPosition += (imageXPosition - imagecurrXPosition) / 3;
                imagecurrYPosition += (imageYPosition - imagecurrYPosition) / 3;

                imagePosition = -imagecurrXPosition + 'px' + ' ' + -imagecurrYPosition + 'px';

                item.css({'overflow': 'inherit'});
                cursor.css({'opacity': '1', 'top': currentYCPosition, 'left': currentXCPosition});
                zoomImage.css({'opacity': '1', 'background-position': imagePosition});
            });

            document.getElementById('eltdf-woo-zoom-cursor').addEventListener("mouseleave", function() {
                item.css({'overflow': 'hidden'});
                cursor.css({'opacity': '0'});
                zoomImage.css({'opacity': '0'});
            });
        }
    }



    /*
     ** Init Product List Masonry Image Sizes
     */
    function eltdfProductImageSizes(thisContainer) {

        var size = thisContainer.find('.eltdf-pl-sizer').width();

        var defaultMasonryItem = thisContainer.find('.eltdf-woo-image-normal-width');
        var largeWidthMasonryItem = thisContainer.find('.eltdf-woo-image-large-width');
        var largeHeightMasonryItem = thisContainer.find('.eltdf-woo-image-large-height');
        var largeWidthHeightMasonryItem = thisContainer.find('.eltdf-woo-image-large-width-height');

        if(thisContainer.find('.eltdf-landscape-size').length){
            size = size * 0.8;
        }
        defaultMasonryItem.css('height', size);

        if (eltdf.windowWidth > 600) {
            largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
            largeHeightMasonryItem.css('height', Math.round(2 * size));
            largeWidthMasonryItem.css('height', size);
        } else {
            largeWidthHeightMasonryItem.css('height', size);
            largeHeightMasonryItem.css('height', size);
        }
    }

	/*
	 ** Init Product List Masonry Shortcode Layout
	 */
	function eltdfInitProductListMasonryShortcode() {
		var container = $('.eltdf-pl-holder.eltdf-masonry-layout .eltdf-pl-outer');

		if(container.length) {
			container.each(function(){
				var thisContainer = $(this);

                eltdfProductImageSizes(thisContainer);
				thisContainer.waitForImages(function() {
					thisContainer.isotope({
						itemSelector: '.eltdf-pli',
						resizable: false,
                        layoutMode: 'packery',
						masonry: {
							columnWidth: '.eltdf-pl-sizer',
							gutter: '.eltdf-pl-gutter'
						}
					});
					
					thisContainer.isotope('layout');
					
					thisContainer.css('opacity', 1);
				});
			});
		}
	}

	function eltdfInitProductListFilter(){
		var productList = $('.eltdf-pl-holder');
		var queryParams = {};

        var initFilterClick = function(thisProductList){
            var links = thisProductList.find('.eltdf-pl-categories a, .eltdf-pl-ordering a');

            links.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var clickedLink = $(this);
                if(!clickedLink.hasClass('active')) {
                    initMainPagFunctionality(thisProductList, clickedLink);
                }
            });
		}

		//used for replacing content after ajax call
        var eltdfReplaceStandardContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.html(responseHtml);
            loader.fadeOut();
        };

        //used for replacing content after ajax call
        var eltdfReplaceMasonryContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.find('.eltdf-pli').remove();

            thisProductListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            eltdfProductImageSizes(thisProductListInner);
            setTimeout(function() {
                thisProductListInner.isotope('layout');
                loader.fadeOut();
            }, 400);
        };

        //used for storing parameters in global object
        var eltdfReturnOrderingParemeters = function(queryParams, data){

            for (var key in data) {
                queryParams[key] = data[key];
            }

            //store ordering parameters
            switch(queryParams.ordering) {
                case 'menu_order':
                    queryParams.metaKey = '';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'menu_order title';
                    break;
                case 'popularity':
                    queryParams.metaKey = 'total_sales';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'rating':
                    queryParams.metaKey = '_wc_average_rating';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'newness':
                    queryParams.metaKey = '';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'date';
                    break;
                case 'price':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'price-desc':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
            }

            return queryParams;
        }

		var initMainPagFunctionality = function(thisProductList, clickedLink){
            var thisProductListInner = thisProductList.find('.eltdf-pl-outer');

            var loadData = eltdf.modules.common.getLoadMoreData(thisProductList),
				loader = thisProductList.find('.eltdf-prl-loading');

            //store parameters in global object
            eltdfReturnOrderingParemeters(queryParams, clickedLink.data());

            //set paremeters for new query passed through ajax
            loadData.category = queryParams.category !== undefined ? queryParams.category : '';
            loadData.metaKey = queryParams.metaKey !== undefined ? queryParams.metaKey : '';
            loadData.order = queryParams.order !== undefined ? queryParams.order : '';
            loadData.orderby = queryParams.orderby !== undefined ? queryParams.orderby : '';
            loadData.minPrice = queryParams.minprice !== undefined ? queryParams.minprice : '';
            loadData.maxPrice = queryParams.maxprice !== undefined ? queryParams.maxprice : '';

            loader.fadeIn();

            var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadData, 'eltdf_product_ajax_load_category');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedAjaxUrl,
                success: function (data) {
                    var response = $.parseJSON(data),
                        responseHtml =  response.html;

					thisProductList.waitForImages(function(){
                        clickedLink.parent().siblings().find('a').removeClass('active');
                        clickedLink.addClass('active');
                        if(thisProductList.hasClass('eltdf-masonry-layout')) {
                            eltdfReplaceMasonryContent(thisProductListInner, loader, responseHtml);
                        }else{
                            eltdfReplaceStandardContent(thisProductListInner, loader, responseHtml);
                        }
                        eltdfAddingToCart();
                        eltdfAddingToWishlist();
					});

                }
            });
        }

        var initMobileFilterClick = function(cliked, holder){
            cliked.on('click',function(){
                if(eltdf.windowWidth <= 768) {
                    if(!cliked.hasClass('opened')){
                        cliked.addClass('opened');
                        holder.slideDown();
                    }else{
                        cliked.removeClass('opened');
                        holder.slideUp();
                    }
                }
            });
        }
		
        return {
            init: function () {
                if (productList.length) {
                    productList.each(function () {
                        var thisProductList = $(this);
                        initFilterClick(thisProductList);

                        initMobileFilterClick(thisProductList.find('.eltdf-pl-ordering-outer h6'), thisProductList.find('.eltdf-pl-ordering'));
                        initMobileFilterClick(thisProductList.find('.eltdf-pl-categories-label'),thisProductList.find('.eltdf-pl-categories-label').next('ul'));
                    });
                }
            },

        }
	}

    function eltdfWishlistRefresh() {

        var initRefreshWishlist = function(){
            $.ajax({
                url: ElatedAjaxUrl,
                type: "POST",
                data: {
                    'action' : 'eltdf_product_ajax_wishlist'
                },
                success:function(data) {


                    $('.eltdf-wishlist-widget-holder .eltdf-wishlist-items-number span').html(data['wishlist_count_products']);
                }
            });
        }

        return {
            init: function () {
                //trigger defined in jquery.yith-wcwl.js, after product is added to wishlist
                $('body').on('added_to_wishlist',function(){
                    initRefreshWishlist();
                });

                //after product is removed from wishlist list
                $('#yith-wcwl-form').on('click', '.product-remove a, .product-add-to-cart a', function() {
                    setTimeout(function() {
                        initRefreshWishlist();
                    }, 2000);
                });
            }

        }

    }

    function eltdfQuickViewGallery() {

        var initGallery = function(){
            var sliders = $('.eltdf-quick-view-gallery.eltdf-owl-slider');

            if (sliders.length) {
                sliders.each(function(){
                    var slider = $(this);
                    slider.owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: false,
                        smartSpeed: 600,
                        margin: 0,
                        center: false,
                        autoWidth: false,
                        animateIn : false,
                        animateOut : false,
                        dots: false,
                        nav: true,
                        navText: [
                            '<span class="eltdf-prev-icon"><span class="eltdf-icon-linear-icon lnr lnr-chevron-left"></span></span>',
                            '<span class="eltdf-next-icon"><span class="eltdf-icon-linear-icon lnr lnr-chevron-right"></span></span>'
                        ],
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        }
                    });
                });
            }
        }

        return {
            init: function () {
                //trigger defined in yith-woocommerce-quick-view\assets\js\frontend.js, after quick view is returned
                $(document).on('qv_loader_stop',function(){
                    initGallery();

                    $('.yith-wcqv-wrapper').css('top', eltdf.scroll+20); //positioning popup on screens smaller than ipad portrait
                });
            }
        }
    }

    function eltdfQuickViewSelect2() {
        $(document).on('qv_loader_stop',function(){
            $('#yith-quick-view-modal select').select2();
        });
    }

    function eltdfAddingToCart() {
        var addToCartButtons = $('.add_to_cart_button, .single_add_to_cart_button');

        if (addToCartButtons.length) {
            addToCartButtons.click(function(){
                $(this).text(eltdfGlobalVars.vars.eltdfAddingToCartLabel);
            });
        }
    }

    function eltdfAddingToWishlist() {
        var wishlistButtons = $('.add_to_wishlist');

        if (wishlistButtons.length) {
            wishlistButtons.click(function(){
                var wishlistButton = $(this),
                    wishlistItem,
                    wishlistItemOffset,
                    heightAdj,
                    widthAdj;

                //absolute centering over added item
                if (wishlistButton.closest('.eltdf-pli').length) {
                    wishlistItem = wishlistButton.closest('.eltdf-pli');            // product list shortcode
                } else if (wishlistButton.closest('.eltdf-plc-item').length) {
                    wishlistItem = wishlistButton.closest('.eltdf-plc-item');       // product carousel shortcode
                } else if (wishlistButton.closest('.product').length) {
                    wishlistItem = wishlistButton.closest('.product');              // WooCommerce template
                }

                wishlistItemOffset = wishlistItem.find('img').offset();
                heightAdj = wishlistItem.find('img').height()/2;
                widthAdj = wishlistItem.find('img').width()/2;

                $('#yith-wcwl-popup-message').css({
                    'top': wishlistItemOffset.top + heightAdj,
                    'left': wishlistItemOffset.left + widthAdj,
                });

                wishlistButton.addClass('eltdf-adding-to-wishlist');

                $(document).on('added_to_wishlist', function(){
                    wishlistButton.removeClass('eltdf-adding-to-wishlist');

                    setTimeout(function(){
                        var wishlistMsg = $('#yith-wcwl-popup-message');

                        wishlistMsg.stop().addClass('eltdf-wishlist-vanish-out');
                        wishlistMsg.one('webkitAnimationEnd oanimationend msAnimationEnd animationend' ,function(){
                            wishlistMsg.removeClass('eltdf-wishlist-vanish-out');
                        });
                    }, 1000);
                });
            });
        }
    }

})(jQuery);