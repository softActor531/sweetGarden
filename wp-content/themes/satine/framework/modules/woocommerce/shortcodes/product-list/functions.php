<?php
if(!function_exists('satine_elated_add_product_list_shortcode')) {
	function satine_elated_add_product_list_shortcode($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\ProductList\ProductList',
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	if(satine_elated_core_plugin_installed()) {
		add_filter('eltdf_core_filter_add_vc_shortcode', 'satine_elated_add_product_list_shortcode');
	}
}