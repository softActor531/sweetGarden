<?php

if(!function_exists('satine_elated_map_post_gallery_meta')) {

    function satine_elated_map_post_gallery_meta() {
        $gallery_post_format_meta_box = satine_elated_add_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Gallery Post Format', 'satine'),
                'name' 	=> 'post_format_gallery_meta'
            )
        );

        satine_elated_add_multiple_images_field(
            array(
                'name'        => 'eltdf_post_gallery_images_meta',
                'label'       => esc_html__('Gallery Images', 'satine'),
                'description' => esc_html__('Choose your gallery images', 'satine'),
                'parent'      => $gallery_post_format_meta_box,
            )
        );
    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_post_gallery_meta', 21);
}
