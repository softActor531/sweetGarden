<?php

if (!function_exists('satine_elated_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function satine_elated_register_sidebars() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'satine'),
            'id' => 'sidebar',
            'description' => esc_html__('Default Sidebar', 'satine'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="eltdf-widget-title-holder"><h5 class="eltdf-widget-title">',
            'after_title' => '</h5></div>'
        ));
    }

    add_action('widgets_init', 'satine_elated_register_sidebars', 1);
}

if (!function_exists('satine_elated_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates SatineElatedSidebar object
     */
    function satine_elated_add_support_custom_sidebar() {
        add_theme_support('SatineElatedSidebar');
        if (get_theme_support('SatineElatedSidebar')) new SatineElatedSidebar();
    }

    add_action('after_setup_theme', 'satine_elated_add_support_custom_sidebar');
}