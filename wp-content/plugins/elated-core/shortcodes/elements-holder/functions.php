<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Eltdf_Elements_Holder extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Eltdf_Elements_Holder_Item extends WPBakeryShortCodesContainer {}
}

if(!function_exists('eltdf_core_add_elements_holder_shortcodes')) {
	function eltdf_core_add_elements_holder_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\ElementsHolder\ElementsHolder',
			'ElatedCore\CPT\Shortcodes\ElementsHolderItem\ElementsHolderItem'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltdf_core_filter_add_vc_shortcode', 'eltdf_core_add_elements_holder_shortcodes');
}