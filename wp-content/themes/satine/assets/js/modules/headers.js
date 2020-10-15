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