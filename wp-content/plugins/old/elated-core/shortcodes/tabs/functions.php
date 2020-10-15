<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Eltdf_Tabs extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Eltdf_Tab extends WPBakeryShortCodesContainer {}
}

if(!function_exists('eltdf_core_add_tabs_shortcodes')) {
	function eltdf_core_add_tabs_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\Tabs\Tabs',
			'ElatedCore\CPT\Shortcodes\Tab\Tab'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltdf_core_filter_add_vc_shortcode', 'eltdf_core_add_tabs_shortcodes');
}