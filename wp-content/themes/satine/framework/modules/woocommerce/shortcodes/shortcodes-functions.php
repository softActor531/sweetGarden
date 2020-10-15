<?php

if(!function_exists('satine_elated_include_woocommerce_shortcodes')) {
	function satine_elated_include_woocommerce_shortcodes() {
		foreach(glob(ELATED_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/shortcodes/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}

	}
	
	if(satine_elated_core_plugin_installed()) {
		add_action('eltdf_core_action_include_shortcodes_file', 'satine_elated_include_woocommerce_shortcodes');
	}
}