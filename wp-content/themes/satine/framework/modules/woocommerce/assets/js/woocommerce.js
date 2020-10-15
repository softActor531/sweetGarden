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