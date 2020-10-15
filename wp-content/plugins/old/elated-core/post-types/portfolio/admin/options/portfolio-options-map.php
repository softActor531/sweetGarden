<?php

if ( ! function_exists('satine_elated_portfolio_options_map') ) {
	function satine_elated_portfolio_options_map() {

		satine_elated_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__('Portfolio', 'eltdf-core'),
			'icon'  => 'fa fa-camera-retro'
		));

		$panel_archive = satine_elated_add_admin_panel(array(
			'title' => esc_html__('Portfolio Archive', 'eltdf-core'),
			'name'  => 'panel_portfolio_archive',
			'page'  => '_portfolio'
		));

		satine_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_items',
			'type'        => 'text',
			'label'       => esc_html__('Number of Items', 'eltdf-core'),
			'description' => esc_html__('Set number of items for your portfolio list on archive pages. Default value is 12', 'eltdf-core'),
			'parent'      => $panel_archive,
			'args'        => array(
				'col_width' => 3
			)
		));

		satine_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Number of Columns', 'eltdf-core'),
			'default_value' => '4',
			'description' => esc_html__('Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'eltdf-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'2' => esc_html__('2 Columns', 'eltdf-core'),
				'3' => esc_html__('3 Columns', 'eltdf-core'),
				'4' => esc_html__('4 Columns', 'eltdf-core'),
				'5' => esc_html__('5 Columns', 'eltdf-core')
			)
		));

		satine_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Space Between Items', 'eltdf-core'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'eltdf-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'normal'    => esc_html__('Normal', 'eltdf-core'),
				'small'     => esc_html__('Small', 'eltdf-core'),
				'tiny'      => esc_html__('Tiny', 'eltdf-core'),
				'no'        => esc_html__('No Space', 'eltdf-core')
			)
		));

		satine_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_image_size',
			'type'        => 'select',
			'label'       => esc_html__('Image Proportions', 'eltdf-core'),
			'default_value' => 'landscape',
			'description' => esc_html__('Set image proportions for your portfolio list on archive pages. Default value is landscape', 'eltdf-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'full'      => esc_html__('Original', 'eltdf-core'),
				'landscape' => esc_html__('Landscape', 'eltdf-core'),
				'portrait'  => esc_html__('Portrait', 'eltdf-core'),
				'square'    => esc_html__('Square', 'eltdf-core')
			)
		));
		
		satine_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_item_layout',
			'type'        => 'select',
			'label'       => esc_html__('Item Style', 'eltdf-core'),
			'default_value' => 'standard-shader',
			'description' => esc_html__('Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'eltdf-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'standard-shader' => esc_html__('Standard - Shader', 'eltdf-core'),
				'gallery-overlay' => esc_html__('Gallery - Overlay', 'eltdf-core')
			)
		));

		$panel = satine_elated_add_admin_panel(array(
			'title' => esc_html__('Portfolio Single', 'eltdf-core'),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		satine_elated_add_admin_field(array(
			'name'          => 'portfolio_single_template',
			'type'          => 'select',
			'label'         => esc_html__('Portfolio Type', 'eltdf-core'),
			'default_value'	=> 'small-images',
			'description'   => esc_html__('Choose a default type for Single Project pages', 'eltdf-core'),
			'parent'        => $panel,
			'options'       => array(
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
					'huge-images'       => '',
					'images'            => '',
					'small-images'      => '',
					'slider'            => '',
					'small-slider'      => '',
					'gallery'           => '#eltdf_portfolio_gallery_container',
					'small-gallery'     => '#eltdf_portfolio_gallery_container',
					'masonry'           => '#eltdf_portfolio_masonry_container',
					'small-masonry'     => '#eltdf_portfolio_masonry_container',
					'custom'            => '',
					'full-width-custom' => ''
				),
				'hide' => array(
					'huge-images'       => '#eltdf_portfolio_gallery_container, #eltdf_portfolio_masonry_container',
					'images'            => '#eltdf_portfolio_gallery_container, #eltdf_portfolio_masonry_container',
					'small-images'      => '#eltdf_portfolio_gallery_container, #eltdf_portfolio_masonry_container',
					'slider'            => '#eltdf_portfolio_gallery_container, #eltdf_portfolio_masonry_container',
					'small-slider'      => '#eltdf_portfolio_gallery_container, #eltdf_portfolio_masonry_container',
					'gallery'           => '#eltdf_portfolio_masonry_container',
					'small-gallery'     => '#eltdf_portfolio_masonry_container',
					'masonry'           => '#eltdf_portfolio_gallery_container',
					'small-masonry'     => '#eltdf_portfolio_gallery_container',
					'custom'            => '#eltdf_portfolio_gallery_container, #eltdf_portfolio_masonry_container',
					'full-width-custom' => '#eltdf_portfolio_gallery_container, #eltdf_portfolio_masonry_container'
				)
			)
		));
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = satine_elated_add_admin_container(array(
			'parent'          => $panel,
			'name'            => 'portfolio_gallery_container',
			'hidden_property' => 'portfolio_single_template',
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
		));
		
			satine_elated_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_columns_number',
				'type'        => 'select',
				'label'       => esc_html__('Number of Columns', 'eltdf-core'),
				'default_value' => 'three',
				'description' => esc_html__('Set number of columns for portfolio gallery type', 'eltdf-core'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'two'   => esc_html__('2 Columns', 'eltdf-core'),
					'three' => esc_html__('3 Columns', 'eltdf-core'),
					'four'  => esc_html__('4 Columns', 'eltdf-core')
				)
			));
		
			satine_elated_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_space_between_items',
				'type'        => 'select',
				'label'       => esc_html__('Space Between Items', 'eltdf-core'),
				'default_value' => 'normal',
				'description' => esc_html__('Set space size between columns for portfolio gallery type', 'eltdf-core'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'normal'    => esc_html__('Normal', 'eltdf-core'),
					'small'     => esc_html__('Small', 'eltdf-core'),
					'tiny'      => esc_html__('Tiny', 'eltdf-core'),
					'no'        => esc_html__('No Space', 'eltdf-core')
				)
			));
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = satine_elated_add_admin_container(array(
			'parent'          => $panel,
			'name'            => 'portfolio_masonry_container',
			'hidden_property' => 'portfolio_single_template',
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
		));
		
			satine_elated_add_admin_field(array(
				'name'        => 'portfolio_single_masonry_columns_number',
				'type'        => 'select',
				'label'       => esc_html__('Number of Columns', 'eltdf-core'),
				'default_value' => 'three',
				'description' => esc_html__('Set number of columns for portfolio masonry type', 'eltdf-core'),
				'parent'      => $portfolio_masonry_container,
				'options'     => array(
					'two'   => esc_html__('2 Columns', 'eltdf-core'),
					'three' => esc_html__('3 Columns', 'eltdf-core'),
					'four'  => esc_html__('4 Columns', 'eltdf-core')
				)
			));
			
			satine_elated_add_admin_field(array(
				'name'        => 'portfolio_single_masonry_space_between_items',
				'type'        => 'select',
				'label'       => esc_html__('Space Between Items', 'eltdf-core'),
				'default_value' => 'normal',
				'description' => esc_html__('Set space size between columns for portfolio masonry type', 'eltdf-core'),
				'parent'      => $portfolio_masonry_container,
				'options'     => array(
					'normal'    => esc_html__('Normal', 'eltdf-core'),
					'small'     => esc_html__('Small', 'eltdf-core'),
					'tiny'      => esc_html__('Tiny', 'eltdf-core'),
					'no'        => esc_html__('No Space', 'eltdf-core')
				)
			));
		
		/***************** Masonry Layout *****************/
		
		satine_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'eltdf-core'),
				'description' => esc_html__('Enabling this option will show title area on single projects', 'eltdf-core'),
				'parent'      => $panel,
                'options' => array(
                    '' => esc_html__('Default', 'eltdf-core'),
                    'yes' => esc_html__('Yes', 'eltdf-core'),
                    'no' => esc_html__('No', 'eltdf-core')
                ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		satine_elated_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Images', 'eltdf-core'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for projects with images', 'eltdf-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		satine_elated_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Videos', 'eltdf-core'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'eltdf-core'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		satine_elated_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Date', 'eltdf-core'),
			'description'   => esc_html__('Enabling this option will enable date meta on single projects', 'eltdf-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));
		
		satine_elated_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Sticky Side Text', 'eltdf-core'),
			'description'   => esc_html__('Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'eltdf-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		satine_elated_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'eltdf-core'),
			'description'   => esc_html__('Enabling this option will show comments on your page', 'eltdf-core'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		satine_elated_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Pagination', 'eltdf-core'),
			'description'   => esc_html__('Enabling this option will turn off portfolio pagination functionality', 'eltdf-core'),
			'parent'        => $panel,
			'default_value' => 'no',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '#eltdf_navigate_same_category_container'
			)
		));

			$container_navigate_category = satine_elated_add_admin_container(array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'hidden_property' => 'portfolio_single_hide_pagination',
				'hidden_value'    => 'yes'
			));
	
				satine_elated_add_admin_field(array(
					'name'            => 'portfolio_single_nav_same_category',
					'type'            => 'yesno',
					'label'           => esc_html__('Enable Pagination Through Same Category', 'eltdf-core'),
					'description'     => esc_html__('Enabling this option will make portfolio pagination sort through current category', 'eltdf-core'),
					'parent'          => $container_navigate_category,
					'default_value'   => 'no'
				));

		satine_elated_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label'       => esc_html__('Portfolio Single Slug', 'eltdf-core'),
			'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'eltdf-core'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));
	}

	add_action( 'satine_elated_options_map', 'satine_elated_portfolio_options_map', 13);
}