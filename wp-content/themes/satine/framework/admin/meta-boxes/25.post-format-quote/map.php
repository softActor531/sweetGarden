<?php

if(!function_exists('satine_elated_map_post_quote_meta')) {
    function satine_elated_map_post_quote_meta() {
        $quote_post_format_meta_box = satine_elated_add_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Quote Post Format', 'satine'),
                'name' 	=> 'post_format_quote_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_post_quote_text_meta',
                'type'        => 'text',
                'label'       => esc_html__('Quote Text', 'satine'),
                'description' => esc_html__('Enter Quote text', 'satine'),
                'parent'      => $quote_post_format_meta_box,

            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_post_quote_author_meta',
                'type'        => 'text',
                'label'       => esc_html__('Quote Author', 'satine'),
                'description' => esc_html__('Enter Quote author', 'satine'),
                'parent'      => $quote_post_format_meta_box,
            )
        );
    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_post_quote_meta', 25);
}