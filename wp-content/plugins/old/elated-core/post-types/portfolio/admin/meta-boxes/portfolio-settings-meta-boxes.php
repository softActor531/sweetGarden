<?php

if(!function_exists('eltdf_core_map_portfolio_settings_meta')) {
    function eltdf_core_map_portfolio_settings_meta() {
        $meta_box = satine_elated_add_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__('Portfolio Settings', 'eltdf-core'),
            'name'  => 'portfolio_settings_meta_box'
        ));

        satine_elated_add_meta_box_field(array(
            'name'        => 'eltdf_portfolio_single_template_meta',
            'type'        => 'select',
            'label'       => esc_html__('Portfolio Type', 'eltdf-core'),
            'description' => esc_html__('Choose a default type for Single Project pages', 'eltdf-core'),
            'parent'      => $meta_box,
            'options'     => array(
                ''                  => esc_html__('Default', 'eltdf-core'),
                'huge-images'       => esc_html__('Portfolio Full Width Images', 'eltdf-core'),
                'images'            => esc_html__('Portfolio Images', 'eltdf-core'),
                'small-images'      => esc_html__('Portfolio Small Images', 'eltdf-core'),
                'slider'            => esc_html__('Portfolio Slider', 'eltdf-core'),
                'small-slider'      => esc_html__('Portfolio Small Slider', 'eltdf-core'),
                'gallery'           => esc_html__('Portfolio Gallery', 'eltdf-core'),
                'small-gallery'     => esc_html__('Portfolio Small Gallery', 'eltdf-core'),
                'masonry'           => esc_html__('Portfolio Masonry', 'eltdf-core'),
                'small-masonry'     => esc_html__('Portfolio Small Masonry', 'eltdf-core'),
                'custom'            => esc_html__('Portfolio Custom', 'eltdf-core'),
                'full-width-custom' => esc_html__('Portfolio Full Width Custom', 'eltdf-core')
            ),
            'args' => array(
	            'dependence' => true,
	            'show' => array(
		            ''                  => '',
	            	'huge-images'       => '',
		            'images'            => '',
		            'small-images'      => '',
		            'slider'            => '',
		            'small-slider'      => '',
		            'gallery'           => '#eltdf_eltdf_gallery_type_meta_container',
		            'small-gallery'     => '#eltdf_eltdf_gallery_type_meta_container',
		            'masonry'           => '#eltdf_eltdf_masonry_type_meta_container',
		            'small-masonry'     => '#eltdf_eltdf_masonry_type_meta_container',
		            'custom'            => '',
		            'full-width-custom' => ''
	            ),
	            'hide' => array(
		            ''                  => '#eltdf_eltdf_gallery_type_meta_container, #eltdf_eltdf_masonry_type_meta_container',
	            	'huge-images'       => '#eltdf_eltdf_gallery_type_meta_container, #eltdf_eltdf_masonry_type_meta_container',
		            'images'            => '#eltdf_eltdf_gallery_type_meta_container, #eltdf_eltdf_masonry_type_meta_container',
		            'small-images'      => '#eltdf_eltdf_gallery_type_meta_container, #eltdf_eltdf_masonry_type_meta_container',
		            'slider'            => '#eltdf_eltdf_gallery_type_meta_container, #eltdf_eltdf_masonry_type_meta_container',
		            'small-slider'      => '#eltdf_eltdf_gallery_type_meta_container, #eltdf_eltdf_masonry_type_meta_container',
		            'gallery'           => '#eltdf_eltdf_masonry_type_meta_container',
		            'small-gallery'     => '#eltdf_eltdf_masonry_type_meta_container',
		            'masonry'           => '#eltdf_eltdf_gallery_type_meta_container',
		            'small-masonry'     => '#eltdf_eltdf_gallery_type_meta_container',
		            'custom'            => '#eltdf_eltdf_gallery_type_meta_container, #eltdf_eltdf_masonry_type_meta_container',
		            'full-width-custom' => '#eltdf_eltdf_gallery_type_meta_container, #eltdf_eltdf_masonry_type_meta_container'
	            )
            )
        ));
	
	    /***************** Gallery Layout *****************/
	
	    $gallery_type_meta_container = satine_elated_add_admin_container(
		    array(
			    'parent' => $meta_box,
			    'name' => 'eltdf_gallery_type_meta_container',
			    'hidden_property' => 'eltdf_portfolio_single_template_meta',
			    'hidden_values' => array(
				    'huge-images',
				    'images',
				    'small-images',
				    'slider',
				    'small-slider',
				    'masonry',
				    'small-masonry',
				    'custom',
				    'full-width-custom'
			    )
		    )
	    );
	
	        satine_elated_add_meta_box_field(array(
			    'name'        => 'eltdf_portfolio_single_gallery_columns_number_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Number of Columns', 'eltdf-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set number of columns for portfolio gallery type', 'eltdf-core'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''      => esc_html__('Default', 'eltdf-core'),
				    'two'   => esc_html__('2 Columns', 'eltdf-core'),
				    'three' => esc_html__('3 Columns', 'eltdf-core'),
				    'four'  => esc_html__('4 Columns', 'eltdf-core')
			    )
		    ));
	
	        satine_elated_add_meta_box_field(array(
			    'name'        => 'eltdf_portfolio_single_gallery_space_between_items_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Space Between Items', 'eltdf-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set space size between columns for portfolio gallery type', 'eltdf-core'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''          => esc_html__('Default', 'eltdf-core'),
				    'normal'    => esc_html__('Normal', 'eltdf-core'),
				    'small'     => esc_html__('Small', 'eltdf-core'),
				    'tiny'      => esc_html__('Tiny', 'eltdf-core'),
				    'no'        => esc_html__('No Space', 'eltdf-core')
			    )
		    ));
	
	    /***************** Gallery Layout *****************/
	
	    /***************** Masonry Layout *****************/
	
	    $masonry_type_meta_container = satine_elated_add_admin_container(
		    array(
			    'parent' => $meta_box,
			    'name' => 'eltdf_masonry_type_meta_container',
			    'hidden_property' => 'eltdf_portfolio_single_template_meta',
			    'hidden_values' => array(
				    'huge-images',
				    'images',
				    'small-images',
				    'slider',
				    'small-slider',
				    'gallery',
				    'small-gallery',
				    'custom',
				    'full-width-custom'
			    )
		    )
	    );
	
		    satine_elated_add_meta_box_field(array(
			    'name'        => 'eltdf_portfolio_single_masonry_columns_number_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Number of Columns', 'eltdf-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set number of columns for portfolio masonry type', 'eltdf-core'),
			    'parent'      => $masonry_type_meta_container,
			    'options'     => array(
				    ''      => esc_html__('Default', 'eltdf-core'),
				    'two'   => esc_html__('2 Columns', 'eltdf-core'),
				    'three' => esc_html__('3 Columns', 'eltdf-core'),
				    'four'  => esc_html__('4 Columns', 'eltdf-core')
			    )
		    ));
		
		    satine_elated_add_meta_box_field(array(
			    'name'        => 'eltdf_portfolio_single_masonry_space_between_items_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Space Between Items', 'eltdf-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set space size between columns for portfolio masonry type', 'eltdf-core'),
			    'parent'      => $masonry_type_meta_container,
			    'options'     => array(
				    ''          => esc_html__('Default', 'eltdf-core'),
				    'normal'    => esc_html__('Normal', 'eltdf-core'),
				    'small'     => esc_html__('Small', 'eltdf-core'),
				    'tiny'      => esc_html__('Tiny', 'eltdf-core'),
				    'no'        => esc_html__('No Space', 'eltdf-core')
			    )
		    ));
	
	    /***************** Masonry Layout *****************/

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_show_title_area_portfolio_single_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'eltdf-core'),
                'description' => esc_html__('Enabling this option will show title area on your single portfolio page', 'eltdf-core'),
                'parent'      => $meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'eltdf-core'),
                    'yes' => esc_html__('Yes', 'eltdf-core'),
                    'no' => esc_html__('No', 'eltdf-core')
                )
            )
        );

	    satine_elated_add_meta_box_field(array(
		    'name'        => 'portfolio_info_top_padding',
		    'type'        => 'text',
		    'label'       => esc_html__('Portfolio Info Top Padding', 'eltdf-core'),
		    'description' => esc_html__('Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'eltdf-core'),
		    'parent'      => $meta_box,
		    'args'        => array(
			    'col_width' => 3,
			    'suffix' => 'px'
		    )
	    ));

        $all_pages = array();
        $pages     = get_pages();
        foreach($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        satine_elated_add_meta_box_field(array(
            'name'        => 'portfolio_single_back_to_link',
            'type'        => 'select',
            'label'       => esc_html__('"Back To" Link', 'eltdf-core'),
            'description' => esc_html__('Choose "Back To" page to link from portfolio Single Project page', 'eltdf-core'),
            'parent'      => $meta_box,
            'options'     => $all_pages
        ));

        satine_elated_add_meta_box_field(array(
            'name'        => 'portfolio_external_link',
            'type'        => 'text',
            'label'       => esc_html__('Portfolio External Link', 'eltdf-core'),
            'description' => esc_html__('Enter URL to link from Portfolio List page', 'eltdf-core'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));
	
	    satine_elated_add_meta_box_field(
		    array(
			    'name' => 'eltdf_portfolio_featured_image_meta',
			    'type' => 'image',
			    'label' => esc_html__('Featured Image', 'eltdf-core'),
			    'description' => esc_html__('Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'eltdf-core'),
			    'parent' => $meta_box
		    )
	    );
	
	    satine_elated_add_meta_box_field(array(
		    'name' => 'eltdf_portfolio_masonry_fixed_dimensions_meta',
		    'type' => 'select',
		    'label' => esc_html__('Dimensions for Masonry - Image Fixed Proportion', 'eltdf-core'),
		    'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'eltdf-core'),
		    'default_value' => 'default',
		    'parent' => $meta_box,
		    'options' => array(
			    'default' => esc_html__('Default', 'eltdf-core'),
			    'large-width' => esc_html__('Large Width', 'eltdf-core'),
			    'large-height' => esc_html__('Large Height', 'eltdf-core'),
			    'large-width-height' => esc_html__('Large Width/Height', 'eltdf-core')
		    )
	    ));
	
	    satine_elated_add_meta_box_field(array(
		    'name' => 'eltdf_portfolio_masonry_original_dimensions_meta',
		    'type' => 'select',
		    'label' => esc_html__('Dimensions for Masonry - Image Original Proportion', 'eltdf-core'),
		    'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'eltdf-core'),
		    'default_value' => 'default',
		    'parent' => $meta_box,
		    'options' => array(
			    'default' => esc_html__('Default', 'eltdf-core'),
			    'large-width' => esc_html__('Large Width', 'eltdf-core')
		    )
	    ));
    }

    add_action('satine_elated_meta_boxes_map', 'eltdf_core_map_portfolio_settings_meta', 41);
}