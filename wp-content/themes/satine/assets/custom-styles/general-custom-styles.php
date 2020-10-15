<?php
if(!function_exists('satine_elated_design_styles')) {
    /**
     * Generates general custom styles
     */
    function satine_elated_design_styles() {
	    $font_family = satine_elated_options()->getOptionValue('google_fonts');
	    if (!empty($font_family) && satine_elated_is_font_option_valid($font_family)){
		    echo satine_elated_dynamic_css('body', array('font-family' => satine_elated_get_font_option_val($font_family)));
		}

		$first_main_color = satine_elated_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(
				'a',
				'a:hover',
				'h1',
				'h1 a:hover',
				'h2',
				'h2 a:hover',
				'h3',
				'h3 a:hover',
				'h4 a:hover',
				'h5',
				'h5 a:hover',
				'h6 a:hover',
				'mark',
				'p a',
				'p a:hover',
				'.eltdf-comment-holder .eltdf-comment-text .comment-edit-link',
				'.eltdf-comment-holder .eltdf-comment-text .comment-reply-link',
				'.eltdf-comment-holder .eltdf-comment-text .replay',
				'.eltdf-comment-holder .eltdf-comment-text .comment-edit-link:hover',
				'.eltdf-comment-holder .eltdf-comment-text .comment-reply-link:hover',
				'.eltdf-comment-holder .eltdf-comment-text .replay:hover',
				'.eltdf-comment-holder .eltdf-comment-text .comment-reply-link:after',
				'.eltdf-comment-holder .eltdf-comment-text #cancel-comment-reply-link',
				'.eltdf-comment-holder .eltdf-comment-text #cancel-comment-reply-link:hover',
				'#respond input[type=text]',
				'#respond textarea',
				'.post-password-form input[type=password]',
				'#respond input[type=text]:focus',
				'#respond textarea:focus',
				'.post-password-form input[type=password]:focus',
				'.wpcf7-form-control.wpcf7-date:focus',
				'.wpcf7-form-control.wpcf7-number:focus',
				'.wpcf7-form-control.wpcf7-quiz:focus',
				'.wpcf7-form-control.wpcf7-select:focus',
				'.wpcf7-form-control.wpcf7-text:focus',
				'.wpcf7-form-control.wpcf7-textarea:focus',
				'.eltdf-owl-slider .owl-nav .eltdf-next-icon',
				'.eltdf-owl-slider .owl-nav .eltdf-prev-icon',
				'.eltdf-404-page .eltdf-page-not-found .eltdf-icon-shortcode',
				'#eltdf-back-to-top>span',
				'.eltdf-main-menu>ul>li>a',
				'.eltdf-drop-down .second .inner ul li a:hover',
				'.eltdf-drop-down .second .inner ul li.current-menu-ancestor>a',
				'.eltdf-drop-down .second .inner ul li.current-menu-item>a',
				'.eltdf-vertical-menu .second .inner ul li a:hover',
				'.eltdf-vertical-menu .second .inner ul li.current-menu-ancestor>a',
				'.eltdf-vertical-menu .second .inner ul li.current-menu-item>a',
				'.eltdf-drop-down .wide .second .inner>ul>li>a',
				'.eltdf-drop-down .wide .second .inner>ul>li.current-menu-ancestor>a',
				'.eltdf-drop-down .wide .second .inner>ul>li.current-menu-item>a',
				'.eltdf-top-bar',
				'.eltdf-header-vertical-closed .eltdf-vertical-menu ul li a',
				'.eltdf-header-vertical-closed .eltdf-vertical-menu ul li a .eltdf-menu-featured-icon',
				'.eltdf-header-vertical-compact .eltdf-vertical-menu .eltdf-menu-featured-icon',
				'.eltdf-header-vertical .eltdf-vertical-menu ul li a',
				'.eltdf-header-vertical .eltdf-vertical-menu ul li a .eltdf-menu-featured-icon',
				'.eltdf-mobile-header .eltdf-mobile-menu-opener.eltdf-mobile-menu-opened a',
				'.eltdf-mobile-header .eltdf-mobile-nav ul ul li.current-menu-ancestor>a',
				'.eltdf-mobile-header .eltdf-mobile-nav ul ul li.current-menu-item>a',
				'.eltdf-mobile-header .eltdf-mobile-nav .eltdf-grid>ul>li>a',
				'.eltdf-mobile-header .eltdf-mobile-nav .eltdf-grid>ul>li>h5',
				'.eltdf-page-footer .eltdf-dark .widget',
				'.eltdf-page-footer .eltdf-dark .widget ul li a',
				'.eltdf-page-footer .eltdf-dark .widget.widget_nav_menu ul li a',
				'.eltdf-page-footer .eltdf-dark .widget div.eltdf-widget-title-holder .eltdf-widget-title',
				'.eltdf-page-footer .eltdf-footer-bottom-holder .eltdf-footer-bottom-inner .eltdf-dark .widget',
				'.eltdf-page-footer .eltdf-footer-bottom-holder .eltdf-footer-bottom-inner .eltdf-dark .widget.widget_nav_menu ul li a',
				'.eltdf-page-footer .widget div.eltdf-widget-title-holder .eltdf-widget-title',
				'.eltdf-title .eltdf-title-holder .eltdf-breadcrumbs a:hover',
				'.eltdf-side-menu .widget_nav_menu ul li a',
				'.eltdf-side-menu a.eltdf-close-side-menu',
				'nav.eltdf-fullscreen-menu ul li a:hover',
				'nav.eltdf-fullscreen-menu>ul>li>a',
				'.eltdf-fullscreen-below-menu-widget-holder .textwidget',
				'.eltdf-search-opener',
				'.eltdf-search-page-holder .eltdf-search-page-form .eltdf-form-holder .eltdf-search-submit:hover',
				'.eltdf-search-page-holder article.sticky .eltdf-post-title-area h3 a',
				'.eltdf-search-cover',
				'.eltdf-search-cover .eltdf-search-close a:hover',
				'.eltdf-fullscreen-search-holder .eltdf-search-submit:hover',
				'.eltdf-fullscreen-search-opened::-webkit-input-placeholder',
				'.eltdf-fullscreen-search-opened:-moz-placeholder',
				'.eltdf-fullscreen-search-opened::-moz-placeholder',
				'.eltdf-fullscreen-search-opened:-ms-input-placeholder',
				'.eltdf-blog-holder article.sticky .eltdf-post-title a',
				'.eltdf-blog-holder.eltdf-blog-masonry article .eltdf-post-read-more-button a i',
				'.eltdf-blog-holder.eltdf-blog-masonry article .eltdf-post-info-bottom .eltdf-post-info-author a:hover',
				'.eltdf-blog-holder.eltdf-blog-masonry article .eltdf-post-info-bottom .eltdf-blog-like:hover i:first-child',
				'.eltdf-blog-holder.eltdf-blog-masonry article .eltdf-post-info-bottom .eltdf-blog-like:hover span:first-child',
				'.eltdf-blog-holder.eltdf-blog-masonry article .eltdf-post-info-bottom .eltdf-post-info-comments-holder:hover span:first-child',
				'.eltdf-blog-holder.eltdf-blog-masonry article.format-quote .eltdf-post-mark .eltdf-quote-mark',
				'.eltdf-blog-holder.eltdf-blog-narrow article .eltdf-post-info.eltdf-section-bottom .eltdf-post-info-author a:hover',
				'.eltdf-blog-holder.eltdf-blog-narrow article .eltdf-post-info.eltdf-section-bottom .eltdf-blog-like:hover i:first-child',
				'.eltdf-blog-holder.eltdf-blog-narrow article .eltdf-post-info.eltdf-section-bottom .eltdf-blog-like:hover span:first-child',
				'.eltdf-blog-holder.eltdf-blog-narrow article .eltdf-post-info.eltdf-section-bottom .eltdf-post-info-comments-holder:hover span:first-child',
				'.eltdf-blog-holder.eltdf-blog-standard-date-on-side article .eltdf-post-date-inner .eltdf-post-date-day',
				'.eltdf-blog-holder.eltdf-blog-standard-date-on-side article .eltdf-post-date-inner .eltdf-post-date-month',
				'.eltdf-blog-holder.eltdf-blog-standard-date-on-side article .eltdf-post-title a:hover',
				'.eltdf-blog-holder.eltdf-blog-standard-date-on-side article .eltdf-post-info>div a:hover',
				'.eltdf-blog-holder.eltdf-blog-standard-date-on-side article.format-quote .eltdf-quote-author',
				'.eltdf-blog-holder.eltdf-blog-standard article .eltdf-post-info-bottom .eltdf-post-info-comments-holder a',
				'.eltdf-blog-holder.eltdf-blog-standard article .eltdf-post-info-bottom .eltdf-post-info-category a',
				'.eltdf-blog-holder.eltdf-blog-standard article.format-quote .eltdf-post-mark .eltdf-quote-mark',
				'.eltdf-blog-holder.eltdf-blog-standard article.format-quote .eltdf-quote-author',
				'.eltdf-author-description .eltdf-author-description-text-holder .eltdf-author-name a',
				'.eltdf-author-description .eltdf-author-description-text-holder .eltdf-author-name a:hover',
				'.eltdf-author-description .eltdf-author-description-text-holder .eltdf-author-social-icons a',
				'.eltdf-blog-pagination ul li a',
				'.eltdf-blog-pagination ul li.eltdf-pag-first a',
				'.eltdf-blog-pagination ul li.eltdf-pag-last a',
				'.eltdf-blog-pagination ul li.eltdf-pag-next a',
				'.eltdf-blog-pagination ul li.eltdf-pag-prev a',
				'.eltdf-bl-standard-pagination ul li.eltdf-bl-pag-active a',
				'.eltdf-blog-pag-loading',
				'.eltdf-blog-single-navigation .eltdf-blog-single-next:hover',
				'.eltdf-blog-single-navigation .eltdf-blog-single-prev:hover',
				'.eltdf-blog-list-holder.eltdf-bl-boxed .eltdf-bli-info .eltdf-post-info-comments-holder a',
				'.eltdf-blog-list-holder.eltdf-bl-boxed .eltdf-bli-info .eltdf-post-info-category a',
				'.eltdf-blog-list-holder.eltdf-bl-masonry .eltdf-bli-excerpt .eltdf-post-read-more-button a i',
				'.eltdf-blog-list-holder.eltdf-bl-masonry .eltdf-bli-info .eltdf-post-info-comments-holder a',
				'.eltdf-blog-list-holder.eltdf-bl-masonry .eltdf-bli-info .eltdf-post-info-category a',
				'.eltdf-blog-list-holder.eltdf-bl-simple .eltdf-post-info-comments-holder a',
				'.eltdf-blog-list-holder.eltdf-bl-simple .eltdf-post-info-category a',
				'.eltdf-blog-list-holder.eltdf-bl-standard .eltdf-bli-excerpt .eltdf-post-read-more-button a i',
				'.eltdf-blog-list-holder.eltdf-bl-standard .eltdf-bli-info .eltdf-post-info-comments-holder a',
				'.eltdf-blog-list-holder.eltdf-bl-standard .eltdf-bli-info .eltdf-post-info-category a',
				'.eltdf-blog-slider-holder .owl-nav .owl-next:hover .eltdf-next-icon',
				'.eltdf-blog-slider-holder .owl-nav .owl-next:hover .eltdf-prev-icon',
				'.eltdf-blog-slider-holder .owl-nav .owl-prev:hover .eltdf-next-icon',
				'.eltdf-blog-slider-holder .owl-nav .owl-prev:hover .eltdf-prev-icon',
				'.eltdf-blog-slider-holder .owl-nav .eltdf-next-icon',
				'.eltdf-blog-slider-holder .owl-nav .eltdf-prev-icon',
				'.eltdf-blog-holder.eltdf-blog-single.eltdf-blog-single-standard article .eltdf-post-info-top .eltdf-post-info-author .eltdf-post-info-author-link',
				'.eltdf-blog-holder.eltdf-blog-single.eltdf-blog-single-standard article .eltdf-post-info-top .eltdf-post-info-comments-holder a',
				'.eltdf-blog-holder.eltdf-blog-single.eltdf-blog-single-standard article .eltdf-post-info-top .eltdf-post-info-category a',
				'.eltdf-blog-holder.eltdf-blog-single.eltdf-blog-single-standard article .eltdf-post-info-top>div a:hover',
				'.eltdf-blog-holder.eltdf-blog-single.eltdf-blog-single-standard article .eltdf-post-info-bottom .eltdf-post-info-bottom-left>div a:hover',
				'.eltdf-blog-holder.eltdf-blog-single.eltdf-blog-single-standard article.format-quote .eltdf-post-mark .eltdf-quote-mark',
				'.eltdf-blog-holder.eltdf-blog-single.eltdf-blog-single-standard article.format-quote .eltdf-quote-author',
				'.eltdf-blog-holder.eltdf-blog-single.eltdf-blog-single-standard article.format-gallery .owl-nav .eltdf-next-icon',
				'.eltdf-blog-holder.eltdf-blog-single.eltdf-blog-single-standard article.format-gallery .owl-nav .eltdf-prev-icon',
				'.eltdf-blog-single-title-area-empty article.format-link .eltdf-post-mark .eltdf-link-mark',
				'.eltdf-blog-single-title-area-empty article.format-quote .eltdf-post-mark .eltdf-quote-mark',
				'.eltdf-blog-single-title-area-empty article.format-quote .eltdf-quote-author',
				'.eltdf-blog-single-title-area-info article.format-link .eltdf-post-mark .eltdf-link-mark',
				'.eltdf-blog-single-title-area-info article.format-quote .eltdf-post-mark .eltdf-quote-mark',
				'.eltdf-blog-single-title-area-info article.format-quote .eltdf-quote-author',
				'footer .widget ul li a:hover',
				'footer .widget.widget_nav_menu ul li a',
				'footer .widget #wp-calendar tfoot a:hover',
				'footer .widget.widget_search .input-holder button:hover',
				'.eltdf-side-menu .widget .eltdf-widget-title-holder .eltdf-widget-title',
				'footer .widget.widget_tag_cloud a:hover',
				'.eltdf-side-menu .widget ul li a:hover',
				'.eltdf-side-menu .widget.widget_nav_menu ul li a',
				'.eltdf-side-menu .widget #wp-calendar tfoot a:hover',
				'.eltdf-side-menu .widget.widget_search .input-holder button:hover',
				'.eltdf-side-menu .widget.widget_tag_cloud a:hover',
				'aside.eltdf-sidebar div.widget div.eltdf-widget-title-holder .eltdf-widget-title',
				'.wpb_widgetised_column .widget ul li a',
				'aside.eltdf-sidebar .widget ul li a',
				'.wpb_widgetised_column .widget.widget_nav_menu ul li a',
				'aside.eltdf-sidebar .widget.widget_nav_menu ul li a',
				'.wpb_widgetised_column .widget #wp-calendar tfoot a',
				'aside.eltdf-sidebar .widget #wp-calendar tfoot a',
				'.widget ul li a',
				'.widget.widget_nav_menu ul li a',
				'.widget #wp-calendar tfoot a',
				'.widget.widget_eltdf_twitter_widget .eltdf-twitter-widget.eltdf-twitter-standard li .eltdf-tweet-text a',
				'.widget.widget_eltdf_twitter_widget .eltdf-twitter-widget.eltdf-twitter-standard li .eltdf-tweet-text a:hover',
				'.widget.widget_eltdf_twitter_widget .eltdf-twitter-widget.eltdf-twitter-standard li .eltdf-tweet-text span',
				'.widget.widget_eltdf_twitter_widget .eltdf-twitter-widget.eltdf-twitter-slider li .eltdf-twitter-icon i',
				'.widget.widget_eltdf_twitter_widget .eltdf-twitter-widget.eltdf-twitter-slider li .eltdf-tweet-text a',
				'.widget.widget_eltdf_twitter_widget .eltdf-twitter-widget.eltdf-twitter-slider li .eltdf-tweet-text a:hover',
				'.widget.widget_eltdf_twitter_widget .eltdf-twitter-widget.eltdf-twitter-slider li .eltdf-tweet-text span',
				'body .pp_pic_holder #pp_full_res .pp_inline',
				'body .pp_pic_holder a.pp_arrow_next:hover',
				'body .pp_pic_holder a.pp_arrow_previous:hover',
				'body .pp_pic_holder a.pp_next:hover',
				'body .pp_pic_holder a.pp_previous:hover',
				'body .pp_pic_holder a.pp_close:hover',
				'.eltdf-main-menu .menu-item-language .submenu-languages a:hover',
				'.eltdf-accordion-holder span.eltdf-title-holder',
				'.eltdf-accordion-holder.eltdf-ac-boxed.eltdf-white-skin .eltdf-title-holder.ui-state-active',
				'.eltdf-accordion-holder.eltdf-ac-boxed.eltdf-white-skin .eltdf-title-holder.ui-state-default.ui-state-hover',
				'blockquote .eltdf-icon-quotations-holder',
				'blockquote .eltdf-blockquote-author',
				'.eltdf-btn.eltdf-btn-simple',
				'.eltdf-btn.eltdf-btn-outline',
				'.eltdf-countdown .countdown-row .countdown-section .countdown-amount',
				'.eltdf-countdown .countdown-row .countdown-section .countdown-period',
				'.eltdf-countdown.eltdf-dark-skin .countdown-row .countdown-section .countdown-amount',
				'.eltdf-countdown.eltdf-dark-skin .countdown-row .countdown-section .countdown-period',
				'.eltdf-icon-list-holder .eltdf-il-icon-holder>*',
				'.eltdf-icon-shortcode.eltdf-circle .eltdf-icon-element',
				'.eltdf-icon-shortcode.eltdf-dropcaps.eltdf-circle .eltdf-icon-element',
				'.eltdf-icon-shortcode.eltdf-square .eltdf-icon-element',
				'.eltdf-icon-shortcode .eltdf-icon-element',
				'.eltdf-image-gallery .owl-nav .owl-next:hover .eltdf-next-icon',
				'.eltdf-image-gallery .owl-nav .owl-next:hover .eltdf-prev-icon',
				'.eltdf-image-gallery .owl-nav .owl-prev:hover .eltdf-next-icon',
				'.eltdf-image-gallery .owl-nav .owl-prev:hover .eltdf-prev-icon',
				'.eltdf-image-gallery .owl-nav .eltdf-next-icon',
				'.eltdf-image-gallery .owl-nav .eltdf-prev-icon',
				'.eltdf-message .eltdf-message-inner a.eltdf-close',
				'.eltdf-pie-chart-holder .eltdf-pc-percentage .eltdf-pc-percent',
				'.eltdf-price-item .eltdf-pi-inner .eltdf-pi-prices .eltdf-pi-price',
				'.eltdf-price-item .eltdf-pi-inner .eltdf-pi-prices .eltdf-pi-currency',
				'.eltdf-price-item .eltdf-pi-inner ul li:before',
				'.eltdf-price-table .eltdf-pt-inner ul li.eltdf-pt-title-holder .eltdf-pt-title',
				'.eltdf-price-table .eltdf-pt-inner ul li.eltdf-pt-prices .eltdf-pt-value',
				'.eltdf-price-table .eltdf-pt-inner ul li.eltdf-pt-prices .eltdf-pt-price',
				'.eltdf-price-table .eltdf-pt-inner ul li.eltdf-pt-prices .eltdf-pt-mark',
				'.eltdf-progress-bar.eltdf-progress-bar-dark .eltdf-pb-title-holder .eltdf-pb-title',
				'.eltdf-progress-bar.eltdf-progress-bar-dark .eltdf-pb-percent',
				'.eltdf-social-share-holder.eltdf-list li a',
				'.eltdf-social-share-holder.eltdf-dropdown .eltdf-social-share-dropdown-opener .social_share',
				'.eltdf-social-share-holder.eltdf-dropdown .eltdf-social-share-dropdown-opener:hover',
				'.eltdf-tabs.eltdf-tabs-standard .eltdf-tabs-nav li a',
				'.eltdf-tabs.eltdf-tabs-boxed .eltdf-tabs-nav li a',
				'.eltdf-tabs.eltdf-tabs-simple .eltdf-tabs-nav li.ui-state-active a',
				'.eltdf-tabs.eltdf-tabs-simple .eltdf-tabs-nav li.ui-state-hover a',
				'#multiscroll-nav ul li a.active:before',
				'#multiscroll-nav ul li a:hover:before',
				'.eltdf-tabs.eltdf-tabs-vertical .eltdf-tabs-nav li.ui-state-active a',
				'.eltdf-tabs.eltdf-tabs-vertical .eltdf-tabs-nav li.ui-state-hover a',
				'.eltdf-video-button-holder .eltdf-video-button-play',
				'.eltdf-pl-filter-holder ul li span',
				'.eltdf-pl-standard-pagination ul li a',
				'.eltdf-pl-standard-pagination ul li.eltdf-pl-pag-next a',
				'.eltdf-pl-standard-pagination ul li.eltdf-pl-pag-prev a',
				'.eltdf-pl-loading',
				'.eltdf-portfolio-slider-holder .owl-nav .owl-next:hover .eltdf-next-icon',
				'.eltdf-portfolio-slider-holder .owl-nav .owl-next:hover .eltdf-prev-icon',
				'.eltdf-portfolio-slider-holder .owl-nav .owl-prev:hover .eltdf-next-icon',
				'.eltdf-portfolio-slider-holder .owl-nav .owl-prev:hover .eltdf-prev-icon',
				'.eltdf-portfolio-slider-holder .owl-nav .eltdf-next-icon',
				'.eltdf-portfolio-slider-holder .owl-nav .eltdf-prev-icon',
				'.eltdf-portfolio-list-holder.eltdf-pl-gallery-overlay article .eltdf-pli-text .eltdf-pli-category-holder a:hover',
				'.eltdf-portfolio-single-holder .eltdf-ps-info-holder .eltdf-ps-info-item .eltdf-ps-info-title',
				'.eltdf-portfolio-single-holder.eltdf-ps-gallery-layout .eltdf-ps-social-info-holder .eltdf-portfolio-single-likes a span',
				'.eltdf-portfolio-single-holder.eltdf-ps-huge-images-layout .eltdf-portfolio-single-likes a span',
				'.eltdf-portfolio-single-holder.eltdf-ps-images-layout .eltdf-ps-social-info-holder .eltdf-portfolio-single-likes a span',
				'.eltdf-portfolio-single-holder.eltdf-ps-masonry-layout .eltdf-ps-social-info-holder .eltdf-portfolio-single-likes a span',
				'.eltdf-portfolio-single-holder.eltdf-ps-slider-layout .eltdf-ps-social-info-holder .eltdf-portfolio-single-likes a span',
				'.eltdf-portfolio-single-holder.eltdf-ps-slider-layout .owl-nav .eltdf-next-icon .eltdf-icon-linear-icon',
				'.eltdf-portfolio-single-holder.eltdf-ps-slider-layout .owl-nav .eltdf-prev-icon .eltdf-icon-linear-icon',
				'.eltdf-portfolio-single-holder.eltdf-ps-small-gallery-layout .eltdf-portfolio-single-likes a span',
				'.eltdf-portfolio-single-holder.eltdf-ps-small-images-layout .eltdf-portfolio-single-likes a span',
				'.eltdf-portfolio-single-holder.eltdf-ps-small-masonry-layout .eltdf-portfolio-single-likes a span',
				'.eltdf-portfolio-single-holder.eltdf-ps-small-slider-layout .eltdf-portfolio-single-likes a span',
				'.eltdf-portfolio-single-holder.eltdf-ps-small-slider-layout .owl-nav .eltdf-next-icon .eltdf-icon-linear-icon',
				'.eltdf-portfolio-single-holder.eltdf-ps-small-slider-layout .owl-nav .eltdf-prev-icon .eltdf-icon-linear-icon',
				'.eltdf-ps-navigation .eltdf-ps-next .eltdf-single-nav-title-holder .eltdf-single-nav-title',
				'.eltdf-ps-navigation .eltdf-ps-prev .eltdf-single-nav-title-holder .eltdf-single-nav-title',
				'.eltdf-ps-navigation .eltdf-ps-next a .eltdf-ps-nav-mark',
				'.eltdf-ps-navigation .eltdf-ps-prev a .eltdf-ps-nav-mark',
				'.eltdf-team .eltdf-icon-shortcode',
				'.eltdf-team .eltdf-icon-shortcode a',
				'.eltdf-team .eltdf-icon-shortcode i',
				'.eltdf-team .eltdf-icon-shortcode span',
				'.eltdf-testimonials-holder .owl-nav .owl-next:hover .eltdf-next-icon',
				'.eltdf-testimonials-holder .owl-nav .owl-next:hover .eltdf-prev-icon',
				'.eltdf-testimonials-holder .owl-nav .owl-prev:hover .eltdf-next-icon',
				'.eltdf-testimonials-holder .owl-nav .owl-prev:hover .eltdf-prev-icon',
				'.eltdf-testimonials-holder .owl-nav .eltdf-next-icon',
				'.eltdf-testimonials-holder .owl-nav .eltdf-prev-icon',
				'.eltdf-testimonials-holder.eltdf-testimonials-standard .eltdf-testimonial-quote span',
				'.eltdf-woocommerce-page.woocommerce-cart .woocommerce>form table.cart tr.cart_item td.product-remove a:hover',
				'.eltdf-woocommerce-page.woocommerce-cart .woocommerce>form table.cart td.actions button[type=submit]',
				'.eltdf-woocommerce-page.woocommerce-cart .woocommerce>form table.cart td.actions input[type=submit]',
				'.eltdf-woocommerce-page.woocommerce-cart .cart-collaterals table th',
				'.eltdf-woocommerce-page.woocommerce-cart .cart-collaterals tr.order-total td',
				'.eltdf-woocommerce-page .cart-empty',
				'.eltdf-woocommerce-page.woocommerce-order-received .woocommerce ul.order_details li strong',
				'.eltdf-woocommerce-page .woocommerce-error>a:hover',
				'.eltdf-woocommerce-page .woocommerce-info>a:hover',
				'.eltdf-woocommerce-page .woocommerce-message>a:hover',
				'.eltdf-woocommerce-page .woocommerce-info .showcoupon:hover',
				'.woocommerce-pagination .page-numbers li a',
				'.woocommerce-pagination .page-numbers li span',
				'.eltdf-woo-view-all-pagination a',
				'.eltdf-woo-view-all-pagination a:before',
				'.eltdf-woo-view-all-pagination a:hover',
				'.woocommerce-page .eltdf-content .eltdf-quantity-buttons .eltdf-quantity-minus',
				'.woocommerce-page .eltdf-content .eltdf-quantity-buttons .eltdf-quantity-plus',
				'div.woocommerce .eltdf-quantity-buttons .eltdf-quantity-minus',
				'div.woocommerce .eltdf-quantity-buttons .eltdf-quantity-plus',
				'.woocommerce-page .eltdf-content label',
				'div.woocommerce label',
				'.select2-container .select2-choice:hover',
				'.select2-container .select2-choice:hover .select2-arrow',
				'.select2-drop .select2-results .select2-highlighted',
				'.select2-results .select2-highlighted ul',
				'.select2-container--default.select2-container--open .select2-selection--single',
				'.select2-container--default .select2-selection--single:hover',
				'.select2-container--default .select2-selection--single:hover .select2-selection__arrow',
				'.select2-container--default .select2-results__option[aria-disabled=true]',
				'.select2-container--default .select2-results__option[aria-selected=true]',
				'.select2-container--default .select2-results__option--highlighted[aria-selected]',
				'.woocommerce .star-rating',
				'.eltdf-woocommerce-page .eltdf-content .variations .reset_variations',
				'.eltdf-woocommerce-page .eltdf-content table.group_table a:hover',
				'.eltdf-woocommerce-page.woocommerce-account .eltdf-woocommerce-account-navigation .woocommerce-MyAccount-navigation ul li.is-active a',
				'.eltdf-woocommerce-page.woocommerce-account .eltdf-woocommerce-account-navigation .woocommerce-MyAccount-navigation ul li:hover a',
				'.eltdf-woocommerce-page.woocommerce-account .woocommerce form.edit-account fieldset>legend',
				'.eltdf-woocommerce-page.woocommerce-account .woocommerce table.shop_table th',
				'.eltdf-woocommerce-page.woocommerce-account .vc_row .woocommerce form.login p label:not(.inline)',
				'ul.products>.product .eltdf-pl-add-to-cart a',
				'.eltdf-content .woocommerce.add_to_cart_inline del',
				'.eltdf-content .woocommerce.add_to_cart_inline ins',
				'div.woocommerce>.single-product .woocommerce-tabs #reviews .comment-respond .comment-reply-title',
				'.eltdf-woo-single-page .eltdf-single-product-summary .price',
				'.eltdf-woo-single-page .eltdf-single-product-summary .eltdf-single-product-share-wish .eltdf-woo-social-share-holder>span',
				'.eltdf-woo-single-page .eltdf-single-product-summary .product_meta>span',
				'.eltdf-woo-single-page .eltdf-single-product-summary .product_meta>span a:hover',
				'.eltdf-woo-single-page .eltdf-single-product-summary p.stock.in-stock',
				'.eltdf-woo-single-page .eltdf-single-product-summary p.stock.out-of-stock',
				'.eltdf-woo-single-page .woocommerce-tabs ul.tabs>li>a',
				'.eltdf-woo-single-page .woocommerce-tabs #reviews .comment-respond .comment-reply-title',
				'.eltdf-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a:before',
				'.eltdf-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a.active:after',
				'.eltdf-shopping-cart-holder .eltdf-header-cart .eltdf-cart-icon',
				'.eltdf-shopping-cart-holder .eltdf-header-cart .eltdf-cart-count',
				'.eltdf-shopping-cart-holder .eltdf-header-cart:hover',
				'.eltdf-shopping-cart-dropdown .eltdf-item-info-holder .eltdf-product-title',
				'.eltdf-shopping-cart-dropdown .eltdf-item-info-holder .remove',
				'.eltdf-shopping-cart-dropdown .eltdf-cart-bottom .eltdf-subtotal-holder>*',
				'.eltdf-shopping-cart-dropdown .eltdf-cart-bottom .eltdf-subtotal-holder .eltdf-total',
				'.eltdf-shopping-cart-dropdown .eltdf-cart-bottom .eltdf-cart-description .eltdf-cart-description-inner span',
				'.widget.woocommerce.widget_layered_nav ul li.chosen a',
				'.widget.woocommerce.widget_price_filter .price_slider_wrapper .price_slider_amount button',
				'.widget.woocommerce.widget_products ul li .amount',
				'.widget.woocommerce.widget_recently_viewed_products ul li .amount',
				'.widget.woocommerce.widget_top_rated_products ul li .amount',
				'.widget.woocommerce.widget_product_search .woocommerce-product-search button:hover',
				'.eltdf-product-info-minimal .eltdf-pi-price span',
				'.eltdf-product-info .eltdf-pi-add-to-cart .eltdf-btn.eltdf-btn-solid.eltdf-white-skin',
				'.eltdf-product-info .eltdf-pi-add-to-cart .eltdf-btn.eltdf-btn-solid.eltdf-dark-skin:hover',
				'.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-excerpt',
				'.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-add-to-cart a',
				'.eltdf-pl-holder .eltdf-prl-loading .eltdf-prl-loading-msg',
				'.eltdf-pl-holder .eltdf-pl-ordering-outer .eltdf-pl-ordering div h5',
				'.eltdf-pl-holder .eltdf-pl-ordering-outer .eltdf-pl-ordering div ul li a.active',
				'.eltdf-pl-holder .eltdf-pl-ordering-outer .eltdf-pl-ordering div ul li a:hover',
				'.eltdf-pl-holder .eltdf-pli .eltdf-pli-excerpt',
				'.eltdf-pl-holder .eltdf-pli .eltdf-pli-rating',
				'.eltdf-pl-holder .eltdf-pli .eltdf-pli-add-to-cart a',
				'.eltdf-pl-holder.eltdf-product-info-dark .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-category',
				'.eltdf-pl-holder.eltdf-product-info-dark .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-excerpt',
				'.eltdf-pl-holder.eltdf-product-info-dark .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-price',
				'.eltdf-pl-holder.eltdf-product-info-dark .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-rating',
				'.eltdf-pl-holder.eltdf-product-info-dark .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-title',
				'#yith-quick-view-modal #yith-quick-view-content .summary .variations .reset_variations',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .variations .reset_variations',
				'#yith-quick-view-modal #yith-quick-view-content .summary table.group_table a:hover',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary table.group_table a:hover',
				'#yith-quick-view-modal #yith-quick-view-content .summary .price',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .price',
				'#yith-quick-view-modal #yith-quick-view-content .summary .eltdf-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
				'#yith-quick-view-modal #yith-quick-view-content .summary .eltdf-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .eltdf-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .eltdf-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
				'#yith-quick-view-modal #yith-quick-view-content .summary .eltdf-single-product-share-wish .eltdf-woo-social-share-holder>span',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .eltdf-single-product-share-wish .eltdf-woo-social-share-holder>span',
				'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
				'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
				'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
				'#yith-quick-view-modal #yith-quick-view-content .summary p.stock.in-stock',
				'#yith-quick-view-modal #yith-quick-view-content .summary p.stock.out-of-stock',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary p.stock.in-stock',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary p.stock.out-of-stock',
				'#yith-quick-view-modal #yith-quick-view-content .product_meta>span',
				'.yith-quick-view.yith-modal #yith-quick-view-content .product_meta>span',
				'#yith-quick-view-modal #yith-quick-view-content .product_meta>span a:hover',
				'.yith-quick-view.yith-modal #yith-quick-view-content .product_meta>span a:hover',
				'#yith-quick-view-modal #yith-quick-view-close',
				'.yith-quick-view.yith-modal #yith-quick-view-close',
				'.woocommerce-wishlist .woocommerce-error>a:hover',
				'.woocommerce-wishlist .woocommerce-info>a:hover',
				'.woocommerce-wishlist .woocommerce-message>a:hover',
				'.woocommerce-wishlist table.wishlist_table tbody tr td.product-remove a:hover',
				'.woocommerce-wishlist table.wishlist_table tbody tr td.product-add-to-cart a',
				'.eltdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
				'.eltdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
				'.eltdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
				'.eltdf-wishlist-widget-holder a',
            );

	        $color_important_selector = array(
	        );

            $background_color_selector = array(
				'.eltdf-st-loader .pulse',
				'.eltdf-st-loader .double_pulse .double-bounce1',
				'.eltdf-st-loader .double_pulse .double-bounce2',
				'.eltdf-st-loader .cube',
				'.eltdf-st-loader .rotating_cubes .cube1',
				'.eltdf-st-loader .rotating_cubes .cube2',
				'.eltdf-st-loader .stripes>div',
				'.eltdf-st-loader .wave>div',
				'.eltdf-st-loader .two_rotating_circles .dot1',
				'.eltdf-st-loader .two_rotating_circles .dot2',
				'.eltdf-st-loader .five_rotating_circles .container1>div',
				'.eltdf-st-loader .five_rotating_circles .container2>div',
				'.eltdf-st-loader .five_rotating_circles .container3>div',
				'.eltdf-st-loader .atom .ball-1:before',
				'.eltdf-st-loader .atom .ball-2:before',
				'.eltdf-st-loader .atom .ball-3:before',
				'.eltdf-st-loader .atom .ball-4:before',
				'.eltdf-st-loader .clock .ball:before',
				'.eltdf-st-loader .mitosis .ball',
				'.eltdf-st-loader .lines .line1',
				'.eltdf-st-loader .lines .line2',
				'.eltdf-st-loader .lines .line3',
				'.eltdf-st-loader .lines .line4',
				'.eltdf-st-loader .fussion .ball',
				'.eltdf-st-loader .fussion .ball-1',
				'.eltdf-st-loader .fussion .ball-2',
				'.eltdf-st-loader .fussion .ball-3',
				'.eltdf-st-loader .fussion .ball-4',
				'.eltdf-st-loader .wave_circles .ball',
				'.eltdf-st-loader .pulse_circles .ball',
				'#submit_comment',
				'.post-password-form input[type=submit]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.eltdf-owl-slider .owl-dots .owl-dot.active span',
				'.eltdf-owl-slider .owl-dots .owl-dot:hover span',
				'.eltdf-header-vertical-closed .eltdf-vertical-menu-area .eltdf-vertical-area-opener .eltdf-vertical-area-opener-line',
				'.eltdf-header-vertical-closed .eltdf-vertical-menu-area .eltdf-vertical-area-opener .eltdf-vertical-area-opener-line:before',
				'.eltdf-header-vertical-closed .eltdf-vertical-menu-area .eltdf-vertical-area-opener .eltdf-vertical-area-opener-line:after',
				'.eltdf-header-vertical-compact .eltdf-vertical-menu>ul>li:hover',
				'.eltdf-fullscreen-menu-opener .eltdf-fm-lines .eltdf-fm-line',
				'.eltdf-blog-holder article.format-audio .eltdf-blog-audio-holder .mejs-container',
				'.eltdf-blog-holder article.format-audio .eltdf-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
				'.eltdf-blog-holder article.format-audio .eltdf-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
				'.eltdf-blog-pagination ul li a.eltdf-pag-active:after',
				'.eltdf-blog-pag-loading>div',
				'.eltdf-bl-loading>div',
				'.eltdf-blog-slider-holder .owl-dots .owl-dot.active span',
				'.eltdf-blog-slider-holder .owl-dots .owl-dot:hover span',
				'.widget.eltdf-image-slider-widget .owl-dots .owl-dot.active span',
				'body .pp_overlay',
				'.eltdf-page-footer .widget_icl_lang_sel_widget #lang_sel ul ul',
				'.eltdf-page-footer .widget_icl_lang_sel_widget #lang_sel_click ul ul',
				'.eltdf-top-bar .widget_icl_lang_sel_widget #lang_sel ul ul',
				'.eltdf-top-bar .widget_icl_lang_sel_widget #lang_sel_click ul ul',
				'.eltdf-accordion-holder.eltdf-ac-boxed .eltdf-title-holder.ui-state-active',
				'.eltdf-accordion-holder.eltdf-ac-boxed .eltdf-title-holder.ui-state-hover',
				'.eltdf-btn.eltdf-btn-solid',
				'.eltdf-btn.eltdf-btn-with-arrow',
				'.eltdf-dropcaps.eltdf-circle',
				'.eltdf-dropcaps.eltdf-square',
				'.eltdf-image-gallery .owl-dots .owl-dot.active span',
				'.eltdf-image-gallery .owl-dots .owl-dot:hover span',
				'.eltdf-message',
				'.eltdf-progress-bar.eltdf-progress-bar-dark .eltdf-pb-content-holder .eltdf-pb-content',
				'.eltdf-progress-bar.eltdf-progress-bar-default .eltdf-pb-content-holder .eltdf-pb-content',
				'.eltdf-quote-section-holder .eltdf-quote-section-line',
				'.eltdf-tabs.eltdf-tabs-standard .eltdf-tabs-nav li.ui-state-active a',
				'.eltdf-tabs.eltdf-tabs-standard .eltdf-tabs-nav li.ui-state-hover a',
				'.eltdf-tabs.eltdf-tabs-boxed .eltdf-tabs-nav li.ui-state-active a',
				'.eltdf-tabs.eltdf-tabs-boxed .eltdf-tabs-nav li.ui-state-hover a',
				'#multiscroll-nav ul li a.active',
				'#multiscroll-nav ul li a:hover',
				'.eltdf-video-button-holder .eltdf-video-button-play .eltdf-video-button-play-inner',
				'.eltdf-video-button-holder .eltdf-video-button-play-image .eltdf-video-button-play-inner',
				'.eltdf-pl-standard-pagination ul li.eltdf-pl-pag-active a:after',
				'.eltdf-pl-loading>div',
				'.eltdf-portfolio-slider-holder .owl-dots .owl-dot.active span',
				'.eltdf-portfolio-slider-holder .owl-dots .owl-dot:hover span',
				'.eltdf-team-slider-holder .eltdf-tl-inner .owl-dots .owl-dot:not(.active) span',
				'.eltdf-team-slider-holder .eltdf-tl-inner .owl-dots .owl-dot.active span',
				'.eltdf-team-slider-holder .eltdf-tl-inner .owl-dots .owl-dot:hover span',
				'.eltdf-testimonials-holder .owl-dots .owl-dot:not(.active) span',
				'.eltdf-testimonials-holder .owl-dots .owl-dot.active span',
				'.eltdf-testimonials-holder .owl-dots .owl-dot:hover span',
				'.eltdf-woocommerce-page.woocommerce-cart .cart-collaterals .woocommerce-shipping-calculator button',
				'.woocommerce-page .eltdf-content a.added_to_cart .wc-forward:not(.added_to_cart):not(.checkout-button)',
				'.woocommerce-page .eltdf-content a.button',
				'.woocommerce-page .eltdf-content button[type=submit]',
				'.woocommerce-page .eltdf-content input[type=submit]',
				'div.woocommerce a.added_to_cart .wc-forward:not(.added_to_cart):not(.checkout-button)',
				'div.woocommerce a.button',
				'div.woocommerce button[type=submit]',
				'div.woocommerce input[type=submit]',
				'.woocommerce .eltdf-new-product',
				'.woocommerce .eltdf-onsale',
				'.woocommerce .eltdf-out-of-stock',
				'.woocommerce-pagination .page-numbers li a.current:after',
				'.woocommerce-pagination .page-numbers li span.current:after',
				'.select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice',
				'div.woocommerce>.single-product .woocommerce-tabs ul.tabs>li.active a',
				'div.woocommerce>.single-product .woocommerce-tabs ul.tabs>li.active a:after',
				'.eltdf-shopping-cart-dropdown .eltdf-cart-bottom .eltdf-view-cart',
				'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content',
				'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle',
				'.eltdf-product-info .eltdf-pi-add-to-cart .eltdf-btn.eltdf-btn-solid.eltdf-dark-skin',
				'.eltdf-product-info .eltdf-pi-add-to-cart .eltdf-btn.eltdf-btn-solid.eltdf-white-skin:hover',
				'.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-image-outer .eltdf-plc-image .eltdf-plc-new-product',
				'.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-image-outer .eltdf-plc-image .eltdf-plc-onsale',
				'.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-image-outer .eltdf-plc-image .eltdf-plc-out-of-stock',
				'.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-image .eltdf-pli-new-product',
				'.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-image .eltdf-pli-onsale',
				'.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-image .eltdf-pli-out-of-stock',
				'.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-yith-wcqv-holder',
				'.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-text-inner .eltdf-yith-wcqv-holder',
				'ul.products>.product .eltdf-pl-inner .eltdf-pl-text-inner .eltdf-yith-wcqv-holder',
				'.yith-wcwl-add-to-wishlist'
            );

            $border_color_selector = array(
				'.eltdf-st-loader .pulse_circles .ball',
				'.eltdf-owl-slider .owl-dots .owl-dot.active span',
				'.eltdf-owl-slider .owl-dots .owl-dot:hover span',
				'.eltdf-search-page-holder .eltdf-search-page-form .eltdf-form-holder .eltdf-search-field:focus',
				'.eltdf-blog-slider-holder .owl-dots .owl-dot.active span',
				'.eltdf-blog-slider-holder .owl-dots .owl-dot:hover span',
				'.eltdf-accordion-holder.eltdf-ac-boxed .eltdf-title-holder.ui-state-active',
				'.eltdf-image-gallery .owl-dots .owl-dot.active span',
				'.eltdf-image-gallery .owl-dots .owl-dot:hover span',
				'.eltdf-message',
				'.eltdf-tabs.eltdf-tabs-standard .eltdf-tabs-nav li.ui-state-active a',
				'.eltdf-tabs.eltdf-tabs-standard .eltdf-tabs-nav li.ui-state-hover a',
				'#multiscroll-nav ul li a',
				'.eltdf-portfolio-slider-holder .owl-dots .owl-dot.active span',
				'.eltdf-portfolio-slider-holder .owl-dots .owl-dot:hover span',
				'.eltdf-team-slider-holder .eltdf-tl-inner .owl-dots .owl-dot.active span',
				'.eltdf-team-slider-holder .eltdf-tl-inner .owl-dots .owl-dot:hover span',
				'.eltdf-testimonials-holder .owl-dots .owl-dot.active span',
				'.eltdf-testimonials-holder .owl-dots .owl-dot:hover span',
				'.select2-container--default .select2-search--dropdown .select2-search__field:focus',
				'.eltdf-product-info .eltdf-pi-add-to-cart .eltdf-btn.eltdf-btn-solid.eltdf-dark-skin',
				'.eltdf-product-info .eltdf-pi-add-to-cart .eltdf-btn.eltdf-btn-solid.eltdf-white-skin:hover',
				'.eltdf-blog-holder article.format-audio .eltdf-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-float .mejs-time-float-corner'
            );

            echo satine_elated_dynamic_css($color_selector, array('color' => $first_main_color));
	        echo satine_elated_dynamic_css($color_important_selector, array('color' => $first_main_color.'!important'));
	        echo satine_elated_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
	        echo satine_elated_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
        }

        $page_background_color = satine_elated_options()->getOptionValue('page_background_color');
		if (!empty($page_background_color)) {
			$background_color_selector = array(
				'.eltdf-wrapper-inner',
				'.eltdf-content'
			);
			echo satine_elated_dynamic_css($background_color_selector, array('background-color' => $page_background_color));
		}

		$selection_color = satine_elated_options()->getOptionValue('selection_color');
		if (!empty($selection_color)) {
			echo satine_elated_dynamic_css('::selection', array('background' => $selection_color));
			echo satine_elated_dynamic_css('::-moz-selection', array('background' => $selection_color));
		}

		$boxed_background_style = array();
	    $boxed_page_background_color = satine_elated_options()->getOptionValue('page_background_color_in_box');
		if (!empty($boxed_page_background_color)) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
	
	    $boxed_page_background_image = satine_elated_options()->getOptionValue('boxed_background_image');
		if (!empty($boxed_page_background_image)) {
			$boxed_background_style['background-image'] = 'url('.esc_url($boxed_page_background_image).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}
	
	    $boxed_page_background_pattern_image = satine_elated_options()->getOptionValue('boxed_pattern_background_image');
		if (!empty($boxed_page_background_pattern_image)) {
			$boxed_background_style['background-image'] = 'url('.esc_url($boxed_page_background_pattern_image).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}
	
	    $boxed_page_background_attachment = satine_elated_options()->getOptionValue('boxed_background_image_attachment');
		if (!empty($boxed_page_background_attachment)) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}

		echo satine_elated_dynamic_css('.eltdf-boxed .eltdf-wrapper', $boxed_background_style);

        $paspartu_style = array();
	    $paspartu_color = satine_elated_options()->getOptionValue('paspartu_color');
        if (!empty($paspartu_color)) {
            $paspartu_style['background-color'] = $paspartu_color;
        }
	
	    $paspartu_width = satine_elated_options()->getOptionValue('paspartu_width');
        if ($paspartu_width !== '') {
            $paspartu_style['padding'] = $paspartu_width.'%';
        }

        echo satine_elated_dynamic_css('.eltdf-paspartu-enabled .eltdf-wrapper', $paspartu_style);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_design_styles');
}

if(!function_exists('satine_elated_content_styles')) {
    /**
     * Generates content custom styles
     */
    function satine_elated_content_styles() {
        $content_style = array();
	    
	    $padding_top = satine_elated_options()->getOptionValue('content_top_padding');
	    if ($padding_top !== '') {
            $content_style['padding-top'] = satine_elated_filter_px($padding_top).'px';
        }

        $content_selector = array(
            '.eltdf-content .eltdf-content-inner > .eltdf-full-width > .eltdf-full-width-inner',
        );

        echo satine_elated_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
	    
	    $padding_top_in_grid = satine_elated_options()->getOptionValue('content_top_padding_in_grid');
	    if ($padding_top_in_grid !== '') {
            $content_style_in_grid['padding-top'] = satine_elated_filter_px($padding_top_in_grid).'px';
        }

        $content_selector_in_grid = array(
            '.eltdf-content .eltdf-content-inner > .eltdf-container > .eltdf-container-inner',
        );

        echo satine_elated_dynamic_css($content_selector_in_grid, $content_style_in_grid);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_content_styles');
}

if (!function_exists('satine_elated_h1_styles')) {

    function satine_elated_h1_styles() {
	    $margin_top = satine_elated_options()->getOptionValue('h1_margin_top');
	    $margin_bottom = satine_elated_options()->getOptionValue('h1_margin_bottom');
	    
	    $item_styles = satine_elated_get_typography_styles('h1');
	    
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = satine_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = satine_elated_filter_px($margin_bottom).'px';
	    }
	    
	    $item_selector = array(
		    'h1'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_h1_styles');
}

if (!function_exists('satine_elated_h2_styles')) {

    function satine_elated_h2_styles() {
	    $margin_top = satine_elated_options()->getOptionValue('h2_margin_top');
	    $margin_bottom = satine_elated_options()->getOptionValue('h2_margin_bottom');
	
	    $item_styles = satine_elated_get_typography_styles('h2');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = satine_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = satine_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h2'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_h2_styles');
}

if (!function_exists('satine_elated_h3_styles')) {

    function satine_elated_h3_styles() {
	    $margin_top = satine_elated_options()->getOptionValue('h3_margin_top');
	    $margin_bottom = satine_elated_options()->getOptionValue('h3_margin_bottom');
	
	    $item_styles = satine_elated_get_typography_styles('h3');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = satine_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = satine_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h3'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_h3_styles');
}

if (!function_exists('satine_elated_h4_styles')) {

    function satine_elated_h4_styles() {
	    $margin_top = satine_elated_options()->getOptionValue('h4_margin_top');
	    $margin_bottom = satine_elated_options()->getOptionValue('h4_margin_bottom');
	
	    $item_styles = satine_elated_get_typography_styles('h4');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = satine_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = satine_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h4'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_h4_styles');
}

if (!function_exists('satine_elated_h5_styles')) {

    function satine_elated_h5_styles() {
	    $margin_top = satine_elated_options()->getOptionValue('h5_margin_top');
	    $margin_bottom = satine_elated_options()->getOptionValue('h5_margin_bottom');
	
	    $item_styles = satine_elated_get_typography_styles('h5');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = satine_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = satine_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h5'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_h5_styles');
}

if (!function_exists('satine_elated_h6_styles')) {

    function satine_elated_h6_styles() {
	    $margin_top = satine_elated_options()->getOptionValue('h6_margin_top');
	    $margin_bottom = satine_elated_options()->getOptionValue('h6_margin_bottom');
	
	    $item_styles = satine_elated_get_typography_styles('h6');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = satine_elated_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = satine_elated_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h6'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_h6_styles');
}

if (!function_exists('satine_elated_text_styles')) {

    function satine_elated_text_styles() {
	    $item_styles = satine_elated_get_typography_styles('text');
	
	    $item_selector = array(
		    'p'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_text_styles');
}

if (!function_exists('satine_elated_link_styles')) {

    function satine_elated_link_styles() {
        $link_styles = array();

        if(satine_elated_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = satine_elated_options()->getOptionValue('link_color');
        }
        if(satine_elated_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = satine_elated_options()->getOptionValue('link_fontstyle');
        }
        if(satine_elated_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = satine_elated_options()->getOptionValue('link_fontweight');
        }
        if(satine_elated_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = satine_elated_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo satine_elated_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_link_styles');
}

if (!function_exists('satine_elated_link_hover_styles')) {

    function satine_elated_link_hover_styles() {
        $link_hover_styles = array();

        if(satine_elated_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = satine_elated_options()->getOptionValue('link_hovercolor');
        }
        if(satine_elated_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = satine_elated_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo satine_elated_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(satine_elated_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = satine_elated_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo satine_elated_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_link_hover_styles');
}

if (!function_exists('satine_elated_smooth_page_transition_styles')) {

	function satine_elated_smooth_page_transition_styles($style) {
		$id = satine_elated_get_page_id();
		$loader_style = array();
		$current_style = '';

		if(satine_elated_get_meta_field_intersect('smooth_pt_bgnd_color',$id) !== '') {
			$loader_style['background-color'] = satine_elated_get_meta_field_intersect('smooth_pt_bgnd_color',$id);
		}

		$loader_selector = array('.eltdf-smooth-transition-loader');

		if (!empty($loader_style)) {
			$current_style .= satine_elated_dynamic_css($loader_selector, $loader_style);
		}

		$spinner_style = array();

		if(satine_elated_get_meta_field_intersect('smooth_pt_spinner_color',$id) !== '') {
			$spinner_style['background-color'] = satine_elated_get_meta_field_intersect('smooth_pt_spinner_color',$id);
		}

		$spinner_selectors = array(
			'.eltdf-st-loader .eltdf-rotate-circles > div',
			'.eltdf-st-loader .pulse',
			'.eltdf-st-loader .double_pulse .double-bounce1',
			'.eltdf-st-loader .double_pulse .double-bounce2',
			'.eltdf-st-loader .cube',
			'.eltdf-st-loader .rotating_cubes .cube1',
			'.eltdf-st-loader .rotating_cubes .cube2',
			'.eltdf-st-loader .stripes > div',
			'.eltdf-st-loader .wave > div',
			'.eltdf-st-loader .two_rotating_circles .dot1',
			'.eltdf-st-loader .two_rotating_circles .dot2',
			'.eltdf-st-loader .five_rotating_circles .container1 > div',
			'.eltdf-st-loader .five_rotating_circles .container2 > div',
			'.eltdf-st-loader .five_rotating_circles .container3 > div',
			'.eltdf-st-loader .atom .ball-1:before',
			'.eltdf-st-loader .atom .ball-2:before',
			'.eltdf-st-loader .atom .ball-3:before',
			'.eltdf-st-loader .atom .ball-4:before',
			'.eltdf-st-loader .clock .ball:before',
			'.eltdf-st-loader .mitosis .ball',
			'.eltdf-st-loader .lines .line1',
			'.eltdf-st-loader .lines .line2',
			'.eltdf-st-loader .lines .line3',
			'.eltdf-st-loader .lines .line4',
			'.eltdf-st-loader .fussion .ball',
			'.eltdf-st-loader .fussion .ball-1',
			'.eltdf-st-loader .fussion .ball-2',
			'.eltdf-st-loader .fussion .ball-3',
			'.eltdf-st-loader .fussion .ball-4',
			'.eltdf-st-loader .wave_circles .ball',
			'.eltdf-st-loader .pulse_circles .ball'
		);

		if (!empty($spinner_style)) {
			$current_style .= satine_elated_dynamic_css($spinner_selectors, $spinner_style);
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter('satine_elated_add_page_custom_style', 'satine_elated_smooth_page_transition_styles');
}