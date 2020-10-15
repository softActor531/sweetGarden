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