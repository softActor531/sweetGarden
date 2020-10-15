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

        $classes[] = 'eltdf-search-covers-header';

        return $classes;

    }

    add_filter('body_class', 'satine_elated_search_body_class');
}

if ( ! function_exists('satine_elated_get_search') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function satine_elated_get_search() {

        $containing_sidebar = satine_elated_active_widget( false, false, 'eltdf_search_opener' );

        foreach ($containing_sidebar as $sidebar) {

            if ( strpos( $sidebar, 'top-bar' ) !== false ) {
                add_action( 'satine_elated_after_header_top_html_open', 'satine_elated_load_search_template');
            } else if ( strpos( $sidebar, 'main-menu' ) !== false ) {
                add_action( 'satine_elated_after_header_menu_area_html_open', 'satine_elated_load_search_template');
            } else if ( strpos( $sidebar, 'mobile-logo' ) !== false ) {
                add_action( 'satine_elated_after_mobile_header_html_open', 'satine_elated_load_search_template');
            } else if ( strpos( $sidebar, 'logo' ) !== false ) {
                add_action( 'satine_elated_after_header_logo_area_html_open', 'satine_elated_load_search_template');
            } else if ( strpos( $sidebar, 'sticky' ) !== false ) {
                add_action( 'satine_elated_after_sticky_menu_html_open', 'satine_elated_load_search_template');
            }
            else {
                add_action( 'satine_elated_after_header_menu_area_html_open', 'satine_elated_load_search_template');
            }

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

        satine_elated_get_module_template_part('templates/types/covers-header', 'search', '', $parameters);

    }
}