<?php

if(!function_exists('satine_elated_admin_map_init')) {
	function satine_elated_admin_map_init() {
		do_action('satine_elated_before_options_map');
		
		require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/fonts/map.php';
		require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/general/map.php';
		require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/page/map.php';
		require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/social/map.php';
		require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/reset/map.php';
		
		do_action('satine_elated_options_map');
		
		do_action('satine_elated_after_options_map');
	}
	
	add_action('after_setup_theme', 'satine_elated_admin_map_init', 0);
}