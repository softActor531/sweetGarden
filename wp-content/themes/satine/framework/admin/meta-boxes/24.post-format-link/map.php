<?php

if(!function_exists('satine_elated_map_post_link_meta')) {
    function satine_elated_map_post_link_meta() {
        $link_post_format_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('post'),
                'title' => esc_html__('Link Post Format', 'satine'),
                'name' => 'post_format_link_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_post_link_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Link', 'satine'),
                'description' => esc_html__('Enter link', 'satine'),
                'parent'      => $link_post_format_meta_box,

            )
        );


    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_post_link_meta', 24);
}