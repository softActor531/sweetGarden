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

        $classes[] = 'eltdf-search-slides-from-window-top';

        return $classes;

    }

    add_filter('body_class', 'satine_elated_search_body_class');
}

if ( ! function_exists('satine_elated_get_search') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function satine_elated_get_search() {

        add_action( 'satine_elated_after_header_menu_area_html_open', 'satine_elated_load_search_template');
        if ( satine_elated_is_responsive_on() ) {
            add_action( 'satine_elated_after_mobile_header_html_open', 'satine_elated_load_search_template');
        }
    }

    add_action('satine_elated_before_page_header', 'satine_elated_get_search', 9);
}

if ( ! function_exists('satine_elated_load_search_template') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function satine_elated_load_search_template() {

        $search_in_grid = satine_elated_options()->getOptionValue('search_in_grid') == 'yes' ? true : false;
        $search_icon = '';
        $search_icon_close = '';
        if ( satine_elated_options()->getOptionValue('search_icon_pack') !== '' ) {
            $search_icon = satine_elated_icon_collections()->getSearchIcon( satine_elated_options()->getOptionValue('search_icon_pack'), true );
            $search_icon_close = satine_elated_icon_collections()->getSearchClose( satine_elated_options()->getOptionValue('search_icon_pack'), true );
        }

        $parameters = array(
            'search_in_grid'		=> $search_in_grid,
            'search_icon'			=> $search_icon,
            'search_icon_close'		=> $search_icon_close
        );

        satine_elated_get_module_template_part('templates/types/slide-from-window-top', 'search', '', $parameters);

    }
}