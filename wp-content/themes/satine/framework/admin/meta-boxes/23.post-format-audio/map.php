<?php

if(!function_exists('satine_elated_map_post_audio_meta')) {
    function satine_elated_map_post_audio_meta() {
        $audio_post_format_meta_box = satine_elated_add_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Audio Post Format', 'satine'),
                'name' 	=> 'post_format_audio_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_audio_type_meta',
                'type'        => 'select',
                'label'       => esc_html__('Audio Type', 'satine'),
                'description' => esc_html__('Choose audio type', 'satine'),
                'parent'      => $audio_post_format_meta_box,
                'default_value' => 'social_networks',
                'options'     => array(
                    'social_networks' => esc_html__('Audio Service', 'satine'),
                    'self' => esc_html__('Self Hosted', 'satine')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'social_networks' => '#eltdf_eltdf_audio_self_hosted_container',
                        'self' => '#eltdf_eltdf_audio_embedded_container'
                    ),
                    'show' => array(
                        'social_networks' => '#eltdf_eltdf_audio_embedded_container',
                        'self' => '#eltdf_eltdf_audio_self_hosted_container')
                )
            )
        );

        $eltdf_audio_embedded_container = satine_elated_add_admin_container(
            array(
                'parent' => $audio_post_format_meta_box,
                'name' => 'eltdf_audio_embedded_container',
                'hidden_property' => 'eltdf_audio_type_meta',
                'hidden_value' => 'self'
            )
        );

        $eltdf_audio_self_hosted_container = satine_elated_add_admin_container(
            array(
                'parent' => $audio_post_format_meta_box,
                'name' => 'eltdf_audio_self_hosted_container',
                'hidden_property' => 'eltdf_audio_type_meta',
                'hidden_value' => 'social_networks'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_post_audio_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Audio URL', 'satine'),
                'description' => esc_html__('Enter audio URL', 'satine'),
                'parent'      => $eltdf_audio_embedded_container,
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_post_audio_custom_meta',
                'type'        => 'text',
                'label'       => esc_html__('Audio Link', 'satine'),
                'description' => esc_html__('Enter audio link', 'satine'),
                'parent'      => $eltdf_audio_self_hosted_container,
            )
        );
    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_post_audio_meta', 23);
}