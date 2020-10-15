<?php

if(!function_exists('satine_elated_register_full_screen_menu_nav')) {
    function satine_elated_register_full_screen_menu_nav() {
	    register_nav_menus(
		    array(
			    'popup-navigation' => esc_html__('Fullscreen Navigation', 'satine')
		    )
	    );
    }

	add_action('after_setup_theme', 'satine_elated_register_full_screen_menu_nav');
}

if ( !function_exists('satine_elated_register_full_screen_menu_sidebars') ) {

	function satine_elated_register_full_screen_menu_sidebars() {

		register_sidebar(array(
			'name' => esc_html__('Fullscreen Menu Top', 'satine'),
			'id' => 'fullscreen_menu_above',
			'description' => esc_html__('This widget area is rendered above fullscreen menu', 'satine'),
			'before_widget' => '<div class="%2$s eltdf-fullscreen-menu-above-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="eltdf-fullscreen-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => esc_html__('Fullscreen Menu Bottom', 'satine'),
			'id' => 'fullscreen_menu_below',
			'description' => esc_html__('This widget area is rendered below fullscreen menu', 'satine'),
			'before_widget' => '<div class="%2$s eltdf-fullscreen-menu-below-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="eltdf-fullscreen-widget-title">',
			'after_title' => '</h4>'
		));
	}

	add_action('widgets_init', 'satine_elated_register_full_screen_menu_sidebars');
}

if(!function_exists('satine_elated_fullscreen_menu_body_class')) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function satine_elated_fullscreen_menu_body_class($classes) {

		if ( satine_elated_get_meta_field_intersect('header_type') == 'header-minimal') {

			$classes[] = 'eltdf-' . satine_elated_options()->getOptionValue('fullscreen_menu_animation_style');
		}

		return $classes;
	}

	add_filter('body_class', 'satine_elated_fullscreen_menu_body_class');
}

if ( !function_exists('satine_elated_get_full_screen_menu') ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function satine_elated_get_full_screen_menu() {

		if ( satine_elated_get_meta_field_intersect('header_type') == 'header-minimal') {

			$parameters = array(
				'fullscreen_menu_in_grid' => satine_elated_options()->getOptionValue('fullscreen_in_grid') === 'yes' ? true : false
			);

			satine_elated_get_module_template_part('templates/fullscreen-menu', 'fullscreenmenu', '', $parameters);
		}
	}
	
	add_action('satine_elated_after_header_area', 'satine_elated_get_full_screen_menu', 10);
}