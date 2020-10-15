<?php

if(!function_exists('satine_elated_map_content_bottom_meta')) {
    function satine_elated_map_content_bottom_meta() {
        $content_bottom_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Content Bottom', 'satine'),
                'name' => 'content_bottom_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_enable_content_bottom_area_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Content Bottom Area', 'satine'),
                'description' => esc_html__('This option will enable Content Bottom area on pages', 'satine'),
                'parent' => $content_bottom_meta_box,
                'options' => satine_elated_get_yes_no_select_array(),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        '' => '#eltdf_eltdf_show_content_bottom_meta_container',
                        'no' => '#eltdf_eltdf_show_content_bottom_meta_container'
                    ),
                    'show' => array(
                        'yes' => '#eltdf_eltdf_show_content_bottom_meta_container'
                    )
                )
            )
        );

        $show_content_bottom_meta_container = satine_elated_add_admin_container(
            array(
                'parent' => $content_bottom_meta_box,
                'name' => 'eltdf_show_content_bottom_meta_container',
                'hidden_property' => 'eltdf_enable_content_bottom_area_meta',
                'hidden_values' => array('','no')
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_content_bottom_sidebar_custom_display_meta',
                'type' => 'selectblank',
                'default_value' => '',
                'label' => esc_html__('Sidebar to Display', 'satine'),
                'description' => esc_html__('Choose a content bottom sidebar to display', 'satine'),
                'options' => satine_elated_get_custom_sidebars(),
                'parent' => $show_content_bottom_meta_container
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'type' => 'select',
                'name' => 'eltdf_content_bottom_in_grid_meta',
                'default_value' => '',
                'label' => esc_html__('Display in Grid', 'satine'),
                'description' => esc_html__('Enabling this option will place content bottom in grid', 'satine'),
                'options' => satine_elated_get_yes_no_select_array(),
                'parent' => $show_content_bottom_meta_container
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'type' => 'color',
                'name' => 'eltdf_content_bottom_background_color_meta',
                'label' => esc_html__('Background Color', 'satine'),
                'description' => esc_html__('Choose a background color for content bottom area', 'satine'),
                'parent' => $show_content_bottom_meta_container
            )
        );
    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_content_bottom_meta', 71);
}