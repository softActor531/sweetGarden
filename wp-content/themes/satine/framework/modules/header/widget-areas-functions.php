<?php

if(!function_exists('satine_elated_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function satine_elated_register_top_header_areas() {

        register_sidebar(array(
            'name'          => esc_html__('Top Bar Left Column', 'satine'),
            'id'            => 'eltdf-top-bar-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-top-bar-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the left side in top bar header', 'satine')
        ));

        register_sidebar(array(
            'name'          => esc_html__('Top Bar Middle Column', 'satine'),
            'id'            => 'eltdf-top-bar-center',
            'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-top-bar-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the middle side in top bar header', 'satine')
        ));

        register_sidebar(array(
            'name'          => esc_html__('Top Bar Right Column', 'satine'),
            'id'            => 'eltdf-top-bar-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-top-bar-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right side in top bar header', 'satine')
        ));
    }

    add_action('widgets_init', 'satine_elated_register_top_header_areas');
}

if(!function_exists('satine_elated_header_widget_areas')) {
    /**
     * Registers widget areas for header types
     */
    function satine_elated_header_standard_widget_areas() {
		register_sidebar(array(
			'name'          => esc_html__('Header Widget Logo Area', 'satine'),
			'id'            => 'eltdf-header-widget-logo-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-header-widget-logo-area">',
			'after_widget'  => '</div>',
			'description'   => esc_html__('Widgets added here will appear in the logo area', 'satine')
		));

		register_sidebar(array(
            'name'          => esc_html__('Header Widget Menu Area Right', 'satine'),
            'id'            => 'eltdf-header-widget-menu-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-header-widget-menu-area">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear in the menu area', 'satine')
        ));
        register_sidebar(array(
            'name'          => esc_html__('Header Widget Menu Area Left', 'satine'),
            'id'            => 'eltdf-header-widget-menu-area-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-header-widget-menu-area">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the left side in the menu area of Centered Header', 'satine')
        ));
    }

    add_action('widgets_init', 'satine_elated_header_standard_widget_areas');
}

if(!function_exists('satine_elated_header_vertical_widget_top_areas')) {
    /**
     * Registers widget areas for vertical header
     */
    function satine_elated_header_vertical_widget_top_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Vertical Area Top', 'satine'),
            'id'            => 'eltdf-vertical-area-top',
            'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-vertical-area-widget-top">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear bellow menu items', 'satine')
        ));
    }

    add_action('widgets_init', 'satine_elated_header_vertical_widget_top_areas');
}

if(!function_exists('satine_elated_header_vertical_widget_areas')) {
	/**
	 * Registers widget areas for vertical header
	 */
	function satine_elated_header_vertical_widget_areas() {
		register_sidebar(array(
			'name'          => esc_html__('Vertical Area', 'satine'),
			'id'            => 'eltdf-vertical-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-vertical-area-widget">',
			'after_widget'  => '</div>',
			'description'   => esc_html__('Widgets added here will appear on the bottom of vertical menu', 'satine')
		));
	}

	add_action('widgets_init', 'satine_elated_header_vertical_widget_areas');
}

if(!function_exists('satine_elated_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function satine_elated_register_mobile_header_areas() {
        if(satine_elated_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Mobile Header Widget Area', 'satine'),
                'id'            => 'eltdf-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-right-from-mobile-logo">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo on mobile header', 'satine')
            ));
        }
    }

    add_action('widgets_init', 'satine_elated_register_mobile_header_areas');
}

if(!function_exists('satine_elated_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function satine_elated_register_sticky_header_areas() {
		$id = satine_elated_get_page_id();

        if(in_array(satine_elated_get_meta_field_intersect('header_behaviour',$id), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name'          => esc_html__('Sticky Header Widget Area', 'satine'),
                'id'            => 'eltdf-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-sticky-right">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the sticky menu', 'satine')
            ));
        }
    }

    add_action('widgets_init', 'satine_elated_register_sticky_header_areas');
}