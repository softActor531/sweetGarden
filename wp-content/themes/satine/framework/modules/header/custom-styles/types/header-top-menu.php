<?php

if(!function_exists('satine_elated_header_top_menu_logo_area_styles')) {
	/**
	 * Generates styles for menu area
	 */
	function satine_elated_header_top_menu_logo_area_styles() {


		$menu_area_height = satine_elated_options()->getOptionValue('menu_area_height');

		if($menu_area_height !== '') {
			echo satine_elated_dynamic_css('.eltdf-header-top-menu .eltdf-page-header .eltdf-logo-area', array('margin-top' => $menu_area_height.'px'));
		}
	}

	add_action('satine_elated_style_dynamic', 'satine_elated_header_top_menu_logo_area_styles');
}