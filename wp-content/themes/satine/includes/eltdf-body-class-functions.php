<?php

if(!function_exists('satine_elated_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function satine_elated_theme_version_class($classes) {
        $current_theme = wp_get_theme();

        //is child theme activated?
        if($current_theme->parent()) {
            //add child theme version
            $classes[] = strtolower($current_theme->get('Name')).'-child-ver-'.$current_theme->get('Version');

            //get parent theme
            $current_theme = $current_theme->parent();
        }

        if($current_theme->exists() && $current_theme->get('Version') != '') {
            $classes[] = strtolower($current_theme->get('Name')).'-ver-'.$current_theme->get('Version');
        }

        return $classes;
    }

    add_filter('body_class', 'satine_elated_theme_version_class');
}

if(!function_exists('satine_elated_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function satine_elated_boxed_class($classes) {

        //is boxed layout turned on?
        if(satine_elated_get_meta_field_intersect('boxed') == 'yes' && satine_elated_get_meta_field_intersect('header_type') !== 'header-vertical') {
            $classes[] = 'eltdf-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'satine_elated_boxed_class');
}

if(!function_exists('satine_elated_paspartu_class')) {
    /**
     * Function that adds classes on body for paspartu layout
     */
    function satine_elated_paspartu_class($classes) {

        //is paspartu layout turned on?
        if(satine_elated_get_meta_field_intersect('paspartu') === 'yes') {
            $classes[] = 'eltdf-paspartu-enabled';

            if(satine_elated_get_meta_field_intersect('disable_top_paspartu') === 'yes') {
                $classes[] = 'eltdf-top-paspartu-disabled';
            }
        }

        return $classes;
    }

    add_filter('body_class', 'satine_elated_paspartu_class');
}

if(!function_exists('satine_elated_smooth_page_transitions_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function satine_elated_smooth_page_transitions_class($classes) {

		$id = satine_elated_get_page_id();

		if(satine_elated_get_meta_field_intersect('smooth_page_transitions',$id) == 'yes') {
			$classes[] = 'eltdf-smooth-page-transitions';

			if(satine_elated_get_meta_field_intersect('page_transition_preloader',$id) == 'yes') {
				$classes[] = 'eltdf-smooth-page-transitions-preloader';
			}

			if(satine_elated_get_meta_field_intersect('page_transition_fadeout',$id) == 'yes') {
				$classes[] = 'eltdf-smooth-page-transitions-fadeout';
			}

		}
        return $classes;
    }

    add_filter('body_class', 'satine_elated_smooth_page_transitions_class');
}

if(!function_exists('satine_elated_content_initial_width_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function satine_elated_content_initial_width_body_class($classes) {

        if(satine_elated_options()->getOptionValue('initial_content_width')) {
            $classes[] = satine_elated_options()->getOptionValue('initial_content_width');
        }

        return $classes;
    }

    add_filter('body_class', 'satine_elated_content_initial_width_body_class');
}

if(!function_exists('satine_elated_top_bar_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function satine_elated_top_bar_body_class($classes) {

        $id = satine_elated_get_page_id();

        if(satine_elated_get_meta_field_intersect('top_bar',$id) == 'yes') {
            $classes[] = 'eltdf-top-bar-enabled';
        }

        return $classes;
    }

    add_filter('body_class', 'satine_elated_top_bar_body_class');
}