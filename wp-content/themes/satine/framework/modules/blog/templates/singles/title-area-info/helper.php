<?php

if( !function_exists('satine_elated_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function satine_elated_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'eltdf-container';
        $params_list['inner'] = 'eltdf-container-inner clearfix';

        $params_list['module_title'] = true;
        $params_list['module_title_layout'] = 'title-area-info';

        return $params_list;
    }

    add_filter( 'satine_elated_blog_holder_params', 'satine_elated_get_blog_holder_params' );
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

if( !function_exists('satine_elated_get_blog_single_title_height') ) {
    /**
     * Function that sets default title height for specific type of header
     *
     * @see satine_elated_get_title_area_height_default_value() in title-functions.php
     *
     * @param int $height standard height value
     *
     * @return integer value of title height
     */
    function satine_elated_get_blog_single_title_height($height) {
        if($height == satine_elated_get_title_area_height_default_value()) {
            return 350;
        }

        return $height;
    }

    add_filter( 'satine_elated_title_area_height', 'satine_elated_get_blog_single_title_height' );
}

if(!function_exists('satine_elated_blog_single_layout_title_class')) {
    /**
     * Function that adds class on title holder if full height title option is enabled for single post page
     * First filter is for applying class
     * Second filter is for overriding title values
     *
     * @see satine_elated_title_classes() in filter-functions.php
     *
     * @param $classes array of classes
     *
     * @return array changed array of classes
     *
     */
    function satine_elated_blog_single_layout_title_class($classes) {

        $classes[] = 'eltdf-blog-single-title-area-info';

        return $classes;
    }

    add_filter('satine_elated_title_classes', 'satine_elated_blog_single_layout_title_class');
}

if(!function_exists('satine_elated_blog_single_layout_title_load')) {
    /**
     * Function that calls function for overriding title values
     *
     * @see satine_elated_blog_single_title_module() in filter-functions.php
     *
     *
     */
    function satine_elated_blog_single_layout_title_load() {

        add_filter('satine_elated_title_area_height_params', 'satine_elated_blog_single_title_module');
		add_filter('satine_elated_title_image_exists', 'satine_elated_post_has_thumbnail');
    }

    add_action('satine_elated_blog_single_loaded', 'satine_elated_blog_single_layout_title_load');
}