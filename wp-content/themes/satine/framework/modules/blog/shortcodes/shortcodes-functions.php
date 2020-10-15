<?php

if(!function_exists('satine_elated_include_blog_shortcodes')) {
	function satine_elated_include_blog_shortcodes() {

		include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-list/blog-list.php';
		include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-slider/blog-slider.php';
	}
	
	if(satine_elated_core_plugin_installed()) {
		add_action('eltdf_core_action_include_shortcodes_file', 'satine_elated_include_blog_shortcodes');
	}
}

if(!function_exists('satine_elated_add_blog_shortcodes')) {
	function satine_elated_add_blog_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\BlogList\BlogList',
			'ElatedCore\CPT\Shortcodes\BlogSlider\BlogSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	if(satine_elated_core_plugin_installed()) {
		add_filter('eltdf_core_filter_add_vc_shortcode', 'satine_elated_add_blog_shortcodes');
	}
}