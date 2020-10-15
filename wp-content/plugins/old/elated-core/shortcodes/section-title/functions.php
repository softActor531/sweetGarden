<?php

if(!function_exists('eltdf_core_add_section_title_shortcodes')) {
	function eltdf_core_add_section_title_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\SectionTitle\SectionTitle'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltdf_core_filter_add_vc_shortcode', 'eltdf_core_add_section_title_shortcodes');
}