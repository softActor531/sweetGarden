<?php

if ( ! function_exists('satine_elated_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function satine_elated_woocommerce_options_map() {

		satine_elated_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => esc_html__('Woocommerce', 'satine'),
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = satine_elated_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => esc_html__('Product List', 'satine')
			)
		);

		satine_elated_add_admin_field(array(
			'name'        	=> 'eltdf_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product List Columns', 'satine'),
			'default_value'	=> 'eltdf-woocommerce-columns-4',
			'description' 	=> esc_html__('Choose number of columns for product listing and related products on single product', 'satine'),
			'options'		=> array(
				'eltdf-woocommerce-columns-3' => esc_html__('3 Columns', 'satine'),
				'eltdf-woocommerce-columns-4' => esc_html__('4 Columns', 'satine')
			),
			'parent'      	=> $panel_product_list,
		));
		
		satine_elated_add_admin_field(array(
			'name'        	=> 'eltdf_woo_product_list_columns_space',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Space Between Products', 'satine'),
			'default_value'	=> 'eltdf-woo-normal-space',
			'description' 	=> esc_html__('Select space between products for product listing and related products on single product', 'satine'),
			'options'		=> array(
				'eltdf-woo-normal-space' => esc_html__('Normal', 'satine'),
				'eltdf-woo-small-space'  => esc_html__('Small', 'satine'),
				'eltdf-woo-no-space'     => esc_html__('No Space', 'satine')
			),
			'parent'      	=> $panel_product_list,
		));
		
		satine_elated_add_admin_field(array(
			'name'        	=> 'eltdf_woo_product_list_info_position',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product Info Position', 'satine'),
			'default_value'	=> 'info_below_image',
			'description' 	=> esc_html__('Select product info position for product listing and related products on single product', 'satine'),
			'options'		=> array(
				'info_below_image'    => esc_html__('Info Below Image', 'satine'),
				'info_on_image_hover' => esc_html__('Info On Image Hover', 'satine')
			),
			'parent'      	=> $panel_product_list,
		));

		satine_elated_add_admin_field(array(
			'name'        	=> 'eltdf_woo_product_list_show_ratings',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Show Ratings', 'satine'),
			'default_value'	=> 'no',
			'options' => array(
                '' 		=> esc_html__('Default', 'satine'),
                'yes' 	=> esc_html__('Yes', 'satine'),
                'no' 	=> esc_html__('No', 'satine')
            ),
			'parent'      	=> $panel_product_list,
		));

		satine_elated_add_admin_field(array(
			'name'        	=> 'eltdf_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> esc_html__('Number of products per page', 'satine'),
			'default_value'	=> '',
			'description' 	=> esc_html__('Set number of products on shop page', 'satine'),
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		satine_elated_add_admin_field(array(
			'name'        	=> 'eltdf_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Products Title Tag', 'satine'),
			'default_value'	=> 'h5',
			'description' 	=> '',
			'options'       => satine_elated_get_title_tag(),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = satine_elated_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => esc_html__('Single Product', 'satine')
			)
		);
		
			satine_elated_add_admin_field(array(
				'name'          => 'woo_enable_single_thumb_featured_switch',
				'type'          => 'yesno',
				'label'         => esc_html__('Switch Featured Image on Thumbnail Click', 'satine'),
				'description'   => esc_html__('Enabling this option will switch featured image with thumbnail image on thumbnail click', 'satine'),
				'default_value' => 'yes',
				'parent'        => $panel_single_product
			));
			
			satine_elated_add_admin_field(array(
				'name'          => 'woo_set_thumb_images_position',
				'type'          => 'select',
				'label'         => esc_html__('Set Thumbnail Images Position', 'satine'),
				'default_value' => 'on-left-side',
				'options'		=> array(
					'below-image'  => esc_html__('Below Featured Image', 'satine'),
					'on-left-side' => esc_html__('On The Left Side Of Featured Image', 'satine')
				),
				'parent'        => $panel_single_product
			));

			satine_elated_add_admin_field(array(
				'name'        	=> 'eltdf_single_product_title_tag',
				'type'        	=> 'select',
				'label'       	=> esc_html__('Single Product Title Tag', 'satine'),
				'default_value'	=> 'h2',
				'description' 	=> '',
				'options'       => satine_elated_get_title_tag(),
				'parent'      	=> $panel_single_product,
			));

            satine_elated_add_admin_field(
                array(
                    'type' => 'select',
                    'name' => 'show_title_area_woo',
                    'default_value' => '',
                    'label'       => esc_html__('Show Title Area', 'satine'),
                    'description' => esc_html__('Enabling this option will show title area on single post pages', 'satine'),
                    'parent'      => $panel_single_product,
                    'options' => array(
                        '' => esc_html__('Default', 'satine'),
                        'yes' => esc_html__('Yes', 'satine'),
                        'no' => esc_html__('No', 'satine')
                    ),
                    'args' => array(
                        'col_width' => 3
                    )
                )
            );

		/**
		 * DropDown Cart Widget Settings
		 */
		$panel_dropdown_cart = satine_elated_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_dropdown_cart',
				'title' => esc_html__('Dropdown Cart Widget', 'satine')
			)
		);

			satine_elated_add_admin_field(array(
				'name'        	=> 'eltdf_woo_dropdown_cart_description',
				'type'        	=> 'text',
				'label'       	=> esc_html__('Cart Description', 'satine'),
				'default_value'	=> '',
				'description' 	=> esc_html__('Enter dropdown cart description', 'satine'),
				'parent'      	=> $panel_dropdown_cart
			));
	}

	add_action( 'satine_elated_options_map', 'satine_elated_woocommerce_options_map', 17);
}