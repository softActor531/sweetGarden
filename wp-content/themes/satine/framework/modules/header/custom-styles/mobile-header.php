<?php

if(!function_exists('satine_elated_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function satine_elated_mobile_header_general_styles() {
        $item_styles      = array();
        $height           = satine_elated_options()->getOptionValue('mobile_header_height');
	    $background_color = satine_elated_options()->getOptionValue('mobile_header_background_color');
	    $border_color     = satine_elated_options()->getOptionValue('mobile_header_border_bottom_color');
	    
        if(!empty($height)) {
            $item_styles['height'] = satine_elated_filter_px($height).'px';
        }

        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        if(!empty($border_color)) {
            $item_styles['border-color'] = $border_color;
        }

        echo satine_elated_dynamic_css('.eltdf-mobile-header .eltdf-mobile-header-inner', $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_mobile_header_general_styles');
}

if(!function_exists('satine_elated_mobile_navigation_styles')) {
    /**
     * Generates styles for mobile navigation
     */
    function satine_elated_mobile_navigation_styles() {
        $mobile_nav_styles = array();
	    $background_color  = satine_elated_options()->getOptionValue('mobile_menu_background_color');
	    $border_color      = satine_elated_options()->getOptionValue('mobile_menu_border_bottom_color');
	    
        if(!empty($background_color)) {
            $mobile_nav_styles['background-color'] = $background_color;
        }

        if(!empty($border_color)) {
            $mobile_nav_styles['border-color'] = $border_color;
        }

        echo satine_elated_dynamic_css('.eltdf-mobile-header .eltdf-mobile-nav', $mobile_nav_styles);

        $nav_item_styles   = array();
	    $nav_border_color  = satine_elated_options()->getOptionValue('mobile_menu_separator_color');
	    $mobile_nav_item_selector = array(
	        '.eltdf-mobile-header .eltdf-mobile-nav ul li a',
		    '.eltdf-mobile-header .eltdf-mobile-nav ul li h5'
	    );
	    
        if(!empty($nav_border_color)) {
	        $nav_item_styles['border-bottom-color'] = $nav_border_color;
        }
	
	    echo satine_elated_dynamic_css($mobile_nav_item_selector, $nav_item_styles);
	    
	
	    // mobile dropdown 1st level menu style
    
        $mobile_menu_style = satine_elated_get_typography_styles('mobile_text');
	
	    $mobile_menu_selector = array(
		    '.eltdf-mobile-header .eltdf-mobile-nav .eltdf-grid > ul > li > a',
		    '.eltdf-mobile-header .eltdf-mobile-nav .eltdf-grid > ul > li > h5'
        );
    
        echo satine_elated_dynamic_css($mobile_menu_selector, $mobile_menu_style);
	    

        $mobile_nav_item_hover_styles = array();
        $mobile_text_hover_color      = satine_elated_options()->getOptionValue('mobile_text_hover_color');
        
        if(!empty($mobile_text_hover_color)) {
            $mobile_nav_item_hover_styles['color'] = $mobile_text_hover_color;
        }

        $mobile_nav_item_selector_hover = array(
            '.eltdf-mobile-header .eltdf-mobile-nav .eltdf-grid > ul > li.eltdf-active-item > a',
            '.eltdf-mobile-header .eltdf-mobile-nav .eltdf-grid > ul > li > a:hover',
            '.eltdf-mobile-header .eltdf-mobile-nav .eltdf-grid > ul > li > h5:hover'
        );

        echo satine_elated_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
	
	    // mobile dropdown deeper levels menu style
	    
	    $mobile_dropdown_style = satine_elated_get_typography_styles('mobile_dropdown_text');
	
	    $mobile_dropdown_selector = array(
		    '.eltdf-mobile-header .eltdf-mobile-nav ul ul li a',
		    '.eltdf-mobile-header .eltdf-mobile-nav ul ul li h5'
	    );
	
	    echo satine_elated_dynamic_css($mobile_dropdown_selector, $mobile_dropdown_style);
	    

        $mobile_nav_dropdown_item_hover_styles = array();
	    $mobile_nav_dropdown_hover_color       = satine_elated_options()->getOptionValue('mobile_dropdown_text_hover_color');
	
	    if(!empty($mobile_nav_dropdown_hover_color)) {
		    $mobile_nav_dropdown_item_hover_styles['color'] = $mobile_nav_dropdown_hover_color;
	    }

        $mobile_nav_dropdown_item_selector_hover = array(
            '.eltdf-mobile-header .eltdf-mobile-nav ul ul li.current-menu-ancestor > a',
            '.eltdf-mobile-header .eltdf-mobile-nav ul ul li.current-menu-item > a',
            '.eltdf-mobile-header .eltdf-mobile-nav ul ul li a:hover',
            '.eltdf-mobile-header .eltdf-mobile-nav ul ul li h5:hover'
        );

        echo satine_elated_dynamic_css($mobile_nav_dropdown_item_selector_hover, $mobile_nav_dropdown_item_hover_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_mobile_navigation_styles');
}

if(!function_exists('satine_elated_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function satine_elated_mobile_logo_styles() {
    	$logo_height          = satine_elated_options()->getOptionValue('mobile_logo_height');
	    $mobile_logo_height   = satine_elated_options()->getOptionValue('mobile_logo_height_phones');
	    $mobile_header_height = satine_elated_options()->getOptionValue('mobile_header_height');
	    
        if(!empty($logo_height)) { ?>
            @media only screen and (max-width: 1024px) {
	            <?php echo satine_elated_dynamic_css(
	                '.eltdf-mobile-header .eltdf-mobile-logo-wrapper a',
	                array('height' => satine_elated_filter_px($logo_height).'px !important')
	            ); ?>
            }
        <?php }

        if(!empty($mobile_logo_height)) { ?>
            @media only screen and (max-width: 480px) {
	            <?php echo satine_elated_dynamic_css(
	                '.eltdf-mobile-header .eltdf-mobile-logo-wrapper a',
	                array('height' => satine_elated_filter_px($mobile_logo_height).'px !important')
	            ); ?>
            }
        <?php }

        if(!empty($mobile_header_height)) {
            echo satine_elated_dynamic_css('.eltdf-mobile-header .eltdf-mobile-logo-wrapper a', array('max-height' => satine_elated_filter_px($mobile_header_height).'px'));
        }
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_mobile_logo_styles');
}

if(!function_exists('satine_elated_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function satine_elated_mobile_icon_styles() {
        $mobile_icon_styles = array();
	    $mobile_text_styles = array();
	    
	    $icon_color       = satine_elated_options()->getOptionValue('mobile_icon_color');
	    $icon_hover_color = satine_elated_options()->getOptionValue('mobile_icon_hover_color');
	    
        if(!empty($icon_color)) {
            $mobile_icon_styles['background-color'] = $icon_color;
	        $mobile_text_styles['color']            = $icon_color;
        }

        echo satine_elated_dynamic_css('.eltdf-mobile-header .eltdf-mobile-menu-opener a .eltdf-mo-lines .eltdf-mo-line', $mobile_icon_styles);
	    echo satine_elated_dynamic_css('.eltdf-mobile-header .eltdf-mobile-menu-opener a .eltdf-mobile-menu-text', $mobile_text_styles);

        if(!empty($icon_hover_color)) {
            echo satine_elated_dynamic_css('.eltdf-mobile-header .eltdf-mobile-menu-opener a:hover .eltdf-mo-lines .eltdf-mo-line', array('background-color' => $icon_hover_color));

	        echo satine_elated_dynamic_css('.eltdf-mobile-header .eltdf-mobile-menu-opener a:hover .eltdf-mobile-menu-text', array('color' => $icon_hover_color));
        }
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_mobile_icon_styles');
}