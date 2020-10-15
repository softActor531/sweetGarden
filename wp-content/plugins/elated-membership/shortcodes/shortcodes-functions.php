<?php

if(!function_exists('eltdf_membership_include_shortcodes_file')) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function eltdf_membership_include_shortcodes_file() {
		foreach(glob(ELATED_MEMBERSHIP_SHORTCODES_PATH.'/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}
		
		do_action('eltdf_membership_action_include_shortcodes_file');
	}
	
	add_action('init', 'eltdf_membership_include_shortcodes_file', 6); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if(!function_exists('eltdf_membership_load_shortcodes')) {
	function eltdf_membership_load_shortcodes() {
		include_once ELATED_MEMBERSHIP_ABS_PATH.'/lib/shortcode-loader.php';

		ElatedMembership\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action('init', 'eltdf_membership_load_shortcodes', 7); // permission 7 is set to be before vc_before_init hook that has permission 9 and after eltdf_core_include_shortcodes_file hook
}