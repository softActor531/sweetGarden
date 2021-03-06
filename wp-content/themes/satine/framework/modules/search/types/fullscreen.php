<?php

if( !function_exists('satine_elated_search_body_class') ) {
    /**
     * Function that adds body classes for different search types
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function satine_elated_search_body_class($classes) {

        $classes[] = 'eltdf-fullscreen-search';
        $classes[] = 'eltdf-search-fade';

        return $classes;

    }

    add_filter('body_class', 'satine_elated_search_body_class');
}

if ( ! function_exists('satine_elated_get_search') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function satine_elated_get_search() {
        satine_elated_load_search_template();
    }

    add_action('satine_elated_before_page_header', 'satine_elated_get_search', 9);
}

if ( ! function_exists('satine_elated_load_search_template') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function satine_elated_load_search_template() {
        satine_elated_get_module_template_part('templates/types/fullscreen', 'search');
    }
}