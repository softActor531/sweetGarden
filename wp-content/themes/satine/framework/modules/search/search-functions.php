<?php

if( !function_exists('satine_elated_load_search') ) {
    function satine_elated_load_search() {

        $search_type = 'fullscreen';
        $search_type = satine_elated_options()->getOptionValue('search_type');

        if ( satine_elated_active_widget( false, false, 'eltdf_search_opener' ) ) {
            include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '.php';
        }
    }

    add_action('init', 'satine_elated_load_search');
}