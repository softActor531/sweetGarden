<?php

foreach(glob(ELATED_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/50.header/*/*.php') as $meta_box_load) {
	include_once $meta_box_load;
}

if(!function_exists('satine_elated_map_header_meta')) {
    function satine_elated_map_header_meta() {
        $header_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Header', 'satine'),
                'name' => 'header_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_header_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Choose Header Type', 'satine'),
                'description' => esc_html__('Select header type layout', 'satine'),
                'parent' => $header_meta_box,
                'options' => array(
					''                         => esc_html__('', 'satine'),
					'header-standard'          => esc_html__('Standard Header', 'satine'),
					'header-minimal'           => esc_html__('Minimal Header', 'satine'),
					'header-divided'           => esc_html__('Divided Header', 'satine'),
					'header-centered'          => esc_html__('Centered Header', 'satine'),
					'header-vertical'          => esc_html__('Vertical Header', 'satine'),
                ),
				'args'          => array(
					"dependence" => true,
					'show' => array(
						'header-standard'          => '#eltdf_top_header_container,#eltdf_menu_area_container,#eltdf_menu_area_position_header_standard_container',
						'header-minimal'           => '#eltdf_top_header_container,#eltdf_menu_area_container',
						'header-divided'           => '#eltdf_top_header_container,#eltdf_menu_area_container',
						'header-centered'          => '#eltdf_top_header_container,#eltdf_logo_area_container, #eltdf_menu_area_container,#eltdf_eltdf_logo_wrapper_padding_header_centered_meta, #eltdf_menu_area_position_header_centered_container',
						'header-vertical'          => '#eltdf_header_vertical_area_meta_container',
					),
					'hide' => array(
						''						   => '#eltdf_logo_area_container, #eltdf_menu_area_container,#eltdf_header_vertical_area_meta_container, #eltdf_menu_area_position_header_centered_container',
						'header-standard'          => '#eltdf_logo_area_container,#eltdf_eltdf_logo_wrapper_padding_header_centered_meta,#eltdf_header_vertical_area_meta_container, #eltdf_menu_area_position_header_centered_container',
						'header-minimal'           => '#eltdf_logo_area_container,#eltdf_eltdf_logo_wrapper_padding_header_centered_meta,#eltdf_header_vertical_area_meta_container,#eltdf_menu_area_position_header_standard_container, #eltdf_menu_area_position_header_centered_container',
						'header-divided'           => '#eltdf_logo_area_container,#eltdf_eltdf_logo_wrapper_padding_header_centered_meta,#eltdf_header_vertical_area_meta_container,#eltdf_menu_area_position_header_standard_container, #eltdf_menu_area_position_header_centered_container',
						'header-centered'          => '#eltdf_header_vertical_area_meta_container,#eltdf_menu_area_position_header_standard_container',
						'header-vertical'          => '#eltdf_top_header_container,#eltdf_logo_area_container, #eltdf_menu_area_container,#eltdf_eltdf_logo_wrapper_padding_header_centered_meta',
					)
				)
            )
        );

		satine_elated_add_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'eltdf_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__('Choose Header behaviour', 'satine'),
				'description'     => esc_html__('Select the behaviour of header when you scroll down to page', 'satine'),
				'options'         => array(
					''                                => '',
					'no-behavior'                     => esc_html__('No Behavior', 'satine'),
					'sticky-header-on-scroll-up'      => esc_html__('Sticky on scrol up', 'satine'),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scrol up/down', 'satine'),
					'fixed-on-scroll'                 => esc_html__('Fixed on scroll', 'satine')
				),
				'hidden_property' => 'eltdf_header_type_meta',
				'hidden_value'    => '',
				'args'            => array(
					'dependence' => true,
					'show'       => array(
						''                                => '',
						'sticky-header-on-scroll-up'      => '',
						'sticky-header-on-scroll-down-up' => '#eltdf_eltdf_sticky_amount_container_meta_container',
						'no-behavior'                     => ''
					),
					'hide'       => array(
						''                                => '#eltdf_eltdf_sticky_amount_container_meta_container',
						'sticky-header-on-scroll-up'      => '#eltdf_eltdf_sticky_amount_container_meta_container',
						'sticky-header-on-scroll-down-up' => '',
						'no-behavior'                     => '#eltdf_eltdf_sticky_amount_container_meta_container'
					)
				)
			)
		);

		$sticky_amount_container = satine_elated_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'eltdf_sticky_amount_container_meta_container',
				'hidden_property' => 'eltdf_header_behaviour_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('', 'no-behavior', 'sticky-header-on-scroll-up, fixed-on-scroll'),
			)
		);

			satine_elated_add_meta_box_field(
				array(
					'name'            => 'eltdf_scroll_amount_for_sticky_meta',
					'type'            => 'text',
					'label'           => esc_html__('Scroll amount for sticky header appearance', 'satine'),
					'description'     => esc_html__('Define scroll amount for sticky header appearance', 'satine'),
					'parent'          => $sticky_amount_container,
					'args'            => array(
						'col_width' => 2,
						'suffix'    => 'px'
					)
				)
			);

		satine_elated_add_meta_box_field(
			array(
				'name' => 'eltdf_header_style_meta',
				'type' => 'select',
				'default_value' => '',
				'label' => esc_html__('Header Skin', 'satine'),
				'description' => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'satine'),
				'parent' => $header_meta_box,
				'options' => array(
					'' => esc_html__('Default', 'satine'),
					'light-header' => esc_html__('Light', 'satine'),
					'dark-header' => esc_html__('Dark', 'satine')
				)
			)
		);

        satine_elated_add_meta_box_field(
            array(
                'name'          => 'eltdf_sticky_header_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__('Sticky Header In Grid', 'satine'),
                'description'   => esc_html__('Set sticky header content to be in grid', 'satine'),
                'parent'        => $header_meta_box,
                'default_value' => '',
                'options'       => array(
                    ''    => esc_html__('Default', 'satine'),
                    'no'  => esc_html__('No', 'satine'),
                    'yes' => esc_html__('Yes', 'satine')
                ),
            )
        );

		satine_elated_add_meta_box_field(
			array(
				'name'          => 'eltdf_enable_wide_menu_background_meta',
				'type'          => 'select',
				'label'         => esc_html__('Enable Full Width Background for Wide Dropdown Type', 'satine'),
				'description'   => esc_html__('Enabling this option will show full width background for wide dropdown type', 'satine'),
				'parent'        => $header_meta_box,
				'default_value' => '',
				'options'       => array(
					''    => esc_html__('', 'satine'),
					'no'  => esc_html__('No', 'satine'),
					'yes' => esc_html__('Yes', 'satine')
				),
			)
		);

		//top area
		do_action('satine_elated_header_top_area_meta_options_map',$header_meta_box);

		//logo area
		do_action('satine_elated_header_logo_area_meta_options_map',$header_meta_box);

		//menu area
		do_action('satine_elated_header_menu_area_meta_options_map',$header_meta_box);

		//vertical area
		do_action('satine_elated_header_vertical_area_meta_options_map',$header_meta_box);
    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_header_meta', 50);
}