<?php

if (!function_exists('satine_elated_logo_meta_box_map')) {
    function satine_elated_logo_meta_box_map() {

        $logo_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'eltdf-team-member'),
                'title' => esc_html__('Logo', 'satine'),
                'name'  => 'logo_meta'
            )
        );


        satine_elated_add_meta_box_field(
            array(
                'name'          => 'eltdf_logo_image_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Default', 'satine'),
                'description'   => esc_html__('Choose a default logo image to display ', 'satine'),
                'parent'        => $logo_meta_box
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'          => 'eltdf_logo_image_dark_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Dark', 'satine'),
                'description'   => esc_html__('Choose a default logo image to display ', 'satine'),
                'parent'        => $logo_meta_box
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'          => 'eltdf_logo_image_light_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Light', 'satine'),
                'description'   => esc_html__('Choose a default logo image to display ', 'satine'),
                'parent'        => $logo_meta_box
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'          => 'eltdf_logo_image_sticky_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Sticky', 'satine'),
                'description'   => esc_html__('Choose a default logo image to display ', 'satine'),
                'parent'        => $logo_meta_box
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'          => 'eltdf_logo_image_mobile_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Mobile', 'satine'),
                'description'   => esc_html__('Choose a default logo image to display ', 'satine'),
                'parent'        => $logo_meta_box
            )
        );
    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_logo_meta_box_map');
}