<?php

if(!function_exists('eltdf_core_map_testimonials_meta')) {
    function eltdf_core_map_testimonials_meta() {
        $testimonial_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('testimonials'),
                'title' => esc_html__('Testimonial', 'eltdf-core'),
                'name' => 'testimonial_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        	=> 'eltdf_testimonial_title',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Title', 'eltdf-core'),
                'description' 	=> esc_html__('Enter testimonial title', 'eltdf-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        	=> 'eltdf_testimonial_text',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Text', 'eltdf-core'),
                'description' 	=> esc_html__('Enter testimonial text', 'eltdf-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        	=> 'eltdf_testimonial_author',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Author', 'eltdf-core'),
                'description' 	=> esc_html__('Enter author name', 'eltdf-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        	=> 'eltdf_testimonial_position',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Author Position', 'eltdf-core'),
                'description' 	=> esc_html__('Enter Author Position', 'eltdf-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );
    }

    add_action('satine_elated_meta_boxes_map', 'eltdf_core_map_testimonials_meta', 95);
}