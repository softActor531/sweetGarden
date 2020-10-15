<?php

if(!function_exists('eltdf_core_include_portfolio_shortcodes')) {
	function eltdf_core_include_portfolio_shortcodes() {
		include_once ELATED_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-list.php';
		include_once ELATED_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-slider.php';
	}
	
	add_action('eltdf_core_action_include_shortcodes_file', 'eltdf_core_include_portfolio_shortcodes');
}

if(!function_exists('eltdf_core_add_portfolio_shortcodes')) {
	function eltdf_core_add_portfolio_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\Portfolio\PortfolioList',
			'ElatedCore\CPT\Shortcodes\Portfolio\PortfolioSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltdf_core_filter_add_vc_shortcode', 'eltdf_core_add_portfolio_shortcodes');
}