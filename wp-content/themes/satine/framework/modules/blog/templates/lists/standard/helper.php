<?php

if( !function_exists('satine_elated_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function satine_elated_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'eltdf-container';
        $params_list['inner'] = 'eltdf-container-inner clearfix';

        return $params_list;
    }

    add_filter( 'satine_elated_blog_holder_params', 'satine_elated_get_blog_holder_params' );
}

if( !function_exists('satine_elated_get_blog_holder_classes') ) {
	/**
	 * Function that generates blog holder classes for blog page
	 */
	function satine_elated_get_blog_holder_classes($classes) {
		$sidebar_classes   = array();
		$sidebar_classes[] = 'eltdf-grid-large-gutter';
		
		return implode(' ', $sidebar_classes);
	}
	
	add_filter( 'satine_elated_blog_holder_classes', 'satine_elated_get_blog_holder_classes' );
}

if( !function_exists('satine_elated_blog_part_params') ) {
    function satine_elated_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h2';
        $part_params['link_tag'] = 'h5';
        $part_params['quote_tag'] = 'h5';

        return array_merge($params, $part_params);
    }

    add_filter( 'satine_elated_blog_part_params', 'satine_elated_blog_part_params' );
}