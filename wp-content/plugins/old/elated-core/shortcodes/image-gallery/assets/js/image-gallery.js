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