<?php

if(!function_exists('eltdf_core_include_team_shortcodes')) {
	function eltdf_core_include_team_shortcodes() {
		include_once ELATED_CORE_CPT_PATH.'/team/shortcodes/team-list.php';
		include_once ELATED_CORE_CPT_PATH.'/team/shortcodes/team-member.php';
		include_once ELATED_CORE_CPT_PATH.'/team/shortcodes/team-slider.php';
	}
	
	add_action('eltdf_core_action_include_shortcodes_file', 'eltdf_core_include_team_shortcodes');
}

if(!function_exists('eltdf_core_add_team_shortcodes')) {
	function eltdf_core_add_team_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\Team\TeamList',
			'ElatedCore\CPT\Shortcodes\Team\TeamMember',
			'ElatedCore\CPT\Shortcodes\Team\TeamSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltdf_core_filter_add_vc_shortcode', 'eltdf_core_add_team_shortcodes');
}