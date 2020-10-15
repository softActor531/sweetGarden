<?php

if(!function_exists('satine_elated_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function satine_elated_header_class($classes) {
		$id = satine_elated_get_page_id();

		$header_type = satine_elated_get_meta_field_intersect('header_type', $id);

        $classes[] = 'eltdf-'.$header_type;

        if($header_type == 'header-standard' && satine_elated_get_meta_field_intersect('menu_area_position_header_standard', $id) == 'right'){
			$classes[] = 'eltdf-'.$header_type.'-right-position';
		}

		$disable_menu_area_shadow = satine_elated_get_meta_field_intersect('menu_area_shadow',$id) == 'no';
		if($disable_menu_area_shadow) {
			$classes[] = 'eltdf-menu-area-shadow-disable';
		}

		$disable_menu_area_grid_shadow = satine_elated_get_meta_field_intersect('menu_area_in_grid_shadow',$id) == 'no';
		if($disable_menu_area_grid_shadow) {
			$classes[] = 'eltdf-menu-area-in-grid-shadow-disable';
		}

		$disable_menu_area_border = satine_elated_get_meta_field_intersect('menu_area_border',$id) == 'no';
		if($disable_menu_area_border) {
			$classes[] = 'eltdf-menu-area-border-disable';
		}

		$disable_menu_area_grid_border = satine_elated_get_meta_field_intersect('menu_area_in_grid_border',$id) == 'no';
		if($disable_menu_area_grid_border) {
			$classes[] = 'eltdf-menu-area-in-grid-border-disable';
		}

		if(satine_elated_get_meta_field_intersect('menu_area_in_grid',$id) == 'yes' &&
			satine_elated_get_meta_field_intersect('menu_area_grid_background_color',$id) !== '' &&
			satine_elated_get_meta_field_intersect('menu_area_grid_background_transparency',$id) !== '0'){
			$classes[] = 'eltdf-header-menu-area-in-grid-padding';
		}

		$disable_logo_area_border = satine_elated_get_meta_field_intersect('logo_area_border',$id) == 'no';
		if($disable_logo_area_border) {
			$classes[] = 'eltdf-logo-area-border-disable';
		}

		$disable_logo_area_grid_border = satine_elated_get_meta_field_intersect('logo_area_in_grid_border',$id) == 'no';
		if($disable_logo_area_grid_border) {
			$classes[] = 'eltdf-logo-area-in-grid-border-disable';
		}

		if(satine_elated_get_meta_field_intersect('logo_area_in_grid',$id) == 'yes' &&
			satine_elated_get_meta_field_intersect('logo_area_grid_background_color',$id) !== '' &&
			satine_elated_get_meta_field_intersect('logo_area_grid_background_transparency',$id) !== '0'){
			$classes[] = 'eltdf-header-logo-area-in-grid-padding';
		}

		$disable_shadow_vertical = satine_elated_get_meta_field_intersect('vertical_header_shadow',$id) == 'no';
		if($disable_shadow_vertical) {
			$classes[] = 'eltdf-header-vertical-shadow-disable';
		}

		$disable_border_vertical = satine_elated_get_meta_field_intersect('vertical_header_border',$id) == 'no';
		if($disable_border_vertical) {
			$classes[] = 'eltdf-header-vertical-border-disable';
		}

        return $classes;
    }

    add_filter('body_class', 'satine_elated_header_class');
}

if(!function_exists('satine_elated_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function satine_elated_header_behaviour_class($classes) {

        $classes[] = 'eltdf-'.satine_elated_get_meta_field_intersect('header_behaviour', satine_elated_get_page_id());

        return $classes;
    }

    add_filter('body_class', 'satine_elated_header_behaviour_class');
}

if(!function_exists('satine_elated_mobile_header_class')) {
    function satine_elated_mobile_header_class($classes) {
        $classes[] = 'eltdf-default-mobile-header';

        $classes[] = 'eltdf-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'satine_elated_mobile_header_class');
}

if(!function_exists('satine_elated_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     * @param array array of classes from main filter
     * @return array array of classes with added menu dropdown appearance class
     */
    function satine_elated_menu_dropdown_appearance($classes) {
		$dropdown_menu_appearance = satine_elated_options()->getOptionValue('menu_dropdown_appearance');
		
        if($dropdown_menu_appearance !== 'default'){
            $classes[] = 'eltdf-'.$dropdown_menu_appearance;
        }

        return $classes;
    }

    add_filter('body_class', 'satine_elated_menu_dropdown_appearance');
}

if (!function_exists('satine_elated_full_width_wide_menu_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function satine_elated_full_width_wide_menu_class($classes) {
		if (satine_elated_get_meta_field_intersect('enable_wide_menu_background',satine_elated_get_page_id()) === 'yes') {
			$classes[] = 'eltdf-full-width-wide-menu';
		}

		return $classes;
	}

	add_filter('body_class', 'satine_elated_full_width_wide_menu_class');
}

if (!function_exists('satine_elated_header_skin_class')) {

    function satine_elated_header_skin_class( $classes ) {
        $header_style     = satine_elated_get_meta_field_intersect('header_style');
	    $header_style_404 = satine_elated_options()->getOptionValue('404_header_style');
	    
        if(is_404() && !empty($header_style_404)) {
	        $classes[] = 'eltdf-' . $header_style_404;
        } else if (!empty($header_style)) {
	        $classes[] = 'eltdf-' . $header_style;
        }

        return $classes;
    }

    add_filter('body_class', 'satine_elated_header_skin_class');
}

if(!function_exists('satine_elated_header_global_js_var')) {
    function satine_elated_header_global_js_var($global_variables) {

        $global_variables['eltdfTopBarHeight'] = satine_elated_get_top_bar_height();
        $global_variables['eltdfStickyHeaderHeight'] = satine_elated_get_sticky_header_height();
        $global_variables['eltdfStickyHeaderTransparencyHeight'] = satine_elated_get_sticky_header_height_of_complete_transparency();


        return $global_variables;
    }

    add_filter('satine_elated_js_global_variables', 'satine_elated_header_global_js_var');
}

if(!function_exists('satine_elated_header_per_page_js_var')) {
    function satine_elated_header_per_page_js_var($perPageVars) {

        $perPageVars['eltdfStickyScrollAmount'] = satine_elated_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('satine_elated_per_page_js_vars', 'satine_elated_header_per_page_js_var');
}

if(!function_exists('satine_elated_get_top_bar_styles')) {
	/**
	 * Sets per page styles for header top bar
	 *
	 * @param $styles
	 *
	 * @return array
	 */
	function satine_elated_get_top_bar_styles($styles) {
		$id            = satine_elated_get_page_id();

		$class_id = satine_elated_get_page_id();
		if(satine_elated_is_woocommerce_installed() && is_product()) {
			$class_id = get_the_ID();
		}
		$class_prefix  = satine_elated_get_unique_page_class($class_id);

		$top_bar_style = array();

		$top_bar_bg_color = get_post_meta($id, 'eltdf_top_bar_background_color_meta', true);
		$top_bar_border = get_post_meta($id, 'eltdf_top_bar_border_meta', true);
		$top_bar_border_color = get_post_meta($id, 'eltdf_top_bar_border_color_meta', true);

		$current_style = '';

		$top_bar_selector = array(
			$class_prefix.' .eltdf-top-bar'
		);

		if($top_bar_bg_color !== '') {
			$top_bar_transparency = get_post_meta($id, 'eltdf_top_bar_background_transparency_meta', true);
			if($top_bar_transparency === '') {
				$top_bar_transparency = 1;
			}
			$top_bar_style['background-color'] = satine_elated_rgba_color($top_bar_bg_color, $top_bar_transparency);
		}

		if($top_bar_border == 'yes') {
			$top_bar_style['border-bottom'] = '1px solid '.$top_bar_border_color;
		}elseif($top_bar_border == 'no'){
			$top_bar_style['border-bottom'] = '0';
		}

		$current_style  .= satine_elated_dynamic_css($top_bar_selector, $top_bar_style);

		$current_style = $current_style . $styles;

		return $current_style;
	}

	add_filter('satine_elated_add_page_custom_style', 'satine_elated_get_top_bar_styles');
}

if(!function_exists('satine_elated_top_bar_skin_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function satine_elated_top_bar_skin_class($classes) {
		$id           = satine_elated_get_page_id();
		$top_bar_skin = get_post_meta($id, 'eltdf_top_bar_skin_meta', true);

		if(!empty($top_bar_skin)) {
			$classes[] = 'eltdf-top-bar-'.$top_bar_skin;
		}

		return $classes;
	}

	add_filter('body_class', 'satine_elated_top_bar_skin_class');
}

if(!function_exists('satine_elated_top_bar_grid_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function satine_elated_top_bar_grid_class($classes) {
		$id = satine_elated_get_page_id();

		if(satine_elated_get_meta_field_intersect('top_bar_in_grid', $id) == 'yes' &&
			satine_elated_options()->getOptionValue('top_bar_grid_background_color') !== '' &&
			satine_elated_options()->getOptionValue('top_bar_grid_background_transparency') !== '0') {
			$classes[] = 'eltdf-top-bar-in-grid-padding';
		}
		
		return $classes;
	}

	add_filter('body_class', 'satine_elated_top_bar_grid_class');
}