<?php

if(!function_exists('satine_elated_map_woocommerce_meta')) {
    function satine_elated_map_woocommerce_meta() {
        $woocommerce_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('product'),
                'title' => esc_html__('Product Meta', 'satine'),
                'name' => 'woo_product_meta'
            )
        );

        satine_elated_add_meta_box_field(array(
            'name'        => 'eltdf_product_featured_image_size',
            'type'        => 'select',
            'label'       => esc_html__('Dimensions for Product List Shortcode', 'satine'),
            'description' => esc_html__('Choose image layout when it appears in Elated Product List - Masonry layout shortcode', 'satine'),
            'parent'      => $woocommerce_meta_box,
            'options'     => array(
                'eltdf-woo-image-normal-width'		 => esc_html__('Default', 'satine'),
				'eltdf-woo-image-large-width'        => esc_html__('Large width', 'satine'),
				'eltdf-woo-image-large-height'       => esc_html__('Large height', 'satine'),
				'eltdf-woo-image-large-width-height' => esc_html__('Large width/height', 'satine'),
            )
        ));

        satine_elated_add_meta_box_field(
            array(
                'name'          => 'eltdf_show_title_area_woo_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Title Area', 'satine'),
                'description'   => esc_html__('Disabling this option will turn off page title area', 'satine'),
                'parent'        => $woocommerce_meta_box,
                'options'       => satine_elated_get_yes_no_select_array()
            )
        );

		satine_elated_add_meta_box_field(array(
			'name'        => 'eltdf_single_product_new_meta',
			'type'        => 'select',
			'label'       => esc_html__('Enable New Product Mark', 'satine'),
			'description' => esc_html__('Enabling this option will show new product mark on your product lists and product single', 'satine'),
			'parent'      => $woocommerce_meta_box,
			'options'     => array(
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			)
		));
    }
	
    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_woocommerce_meta', 99);
}