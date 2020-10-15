<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Eltdf_Accordion extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Eltdf_Accordion_Tab extends WPBakeryShortCodesContainer {}
}

if(!function_exists('eltdf_core_add_accordion_shortcodes')) {
	function eltdf_core_add_accordion_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\Accordion\Accordion',
			'ElatedCore\CPT\Shortcodes\AccordionTab\AccordionTab'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltdf_core_filter_add_vc_shortcode', 'eltdf_core_add_accordion_shortcodes');
}