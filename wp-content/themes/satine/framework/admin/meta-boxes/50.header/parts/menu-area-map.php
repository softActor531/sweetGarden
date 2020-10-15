<?php
if(!function_exists('satine_elated_header_menu_area_meta_options_map')) {

	function satine_elated_header_menu_area_meta_options_map($header_meta_box){

		$menu_area_container = satine_elated_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'menu_area_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'eltdf_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-vertical','header-vertical-compact','header-vertical-closed')
			));

		satine_elated_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_style',
				'title' => esc_html__('Menu Area Style', 'satine')
			)
		);

		satine_elated_add_meta_box_field(
			array(
				'name' => 'eltdf_disable_header_widget_menu_area_meta',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__('Disable Header Menu Area Widget', 'satine'),
				'description' => esc_html__('Enabling this option will hide widget area from the menu area', 'satine'),
				'parent' => $menu_area_container
			)
		);

		$satine_custom_sidebars = satine_elated_get_custom_sidebars();
		if(count($satine_custom_sidebars) > 0) {
			satine_elated_add_meta_box_field(array(
				'name' => 'eltdf_custom_menu_area_sidebar_meta',
				'type' => 'selectblank',
				'label' => esc_html__('Choose Custom Widget Area in Menu area', 'satine'),
				'description' => esc_html__('Choose custom widget area to display in header menu area', 'satine'),
				'parent' => $menu_area_container,
				'options' => $satine_custom_sidebars
			));
		}

        $menu_area_position_header_centered_container = satine_elated_add_admin_container(
            array(
                'parent' => $menu_area_container,
                'name' => 'menu_area_position_header_centered_container',
                'hidden_property' => 'eltdf_header_type_meta',
                'hidden_values' => array('header-minimal','header-divided','header-standard','header-box','header-standard-extended','header-tabbed', 'header-top')
            )
        );

        $satine_custom_sidebars = satine_elated_get_custom_sidebars();
        if(count($satine_custom_sidebars) > 0) {
            satine_elated_add_meta_box_field(array(
                'parent' => $menu_area_position_header_centered_container,
                'name' => 'eltdf_custom_menu_area_left_sidebar_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Custom Widget Area Placed Left of the Centered Menu', 'satine'),
                'description' => esc_html__('Choose Custom Widget Area That is Placed Left of the Centered Menu', 'satine'),
                'options' => $satine_custom_sidebars
            ));
        }

        $menu_area_position_header_standard_container = satine_elated_add_admin_container(
            array(
                'parent' => $menu_area_container,
                'name' => 'menu_area_position_header_standard_container',
                'hidden_property' => 'eltdf_header_type_meta',
                'hidden_values' => array('header-minimal','header-divided','header-centered')
            )
        );

        satine_elated_add_meta_box_field(
                array(
                    'parent'		=> $menu_area_position_header_standard_container,
                    'type'			=> 'select',
                    'name'			=> 'eltdf_menu_area_position_header_standard_meta',
                    'default_value'	=> '',
                    'options' => array(
                        ''          => esc_html__('Default', 'satine'),
                        'center'	=> esc_html__('Center', 'satine'),
                        'right'		=> esc_html__('Right', 'satine'),
                    ),
                    'label'			=> esc_html__('Menu Area Position', 'satine'),
                    'description'	=> esc_html__('Set posistion of menu area for Standard Header Type', 'satine'),
                )
            );

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_menu_area_in_grid_meta',
			'type'          => 'select',
			'label'         => esc_html__('Menu Area In Grid', 'satine'),
			'description'   => esc_html__('Set menu area content to be in grid', 'satine'),
			'parent'        => $menu_area_container,
			'default_value' => '',
			'options'       => array(
				''    => esc_html__('Default', 'satine'),
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#eltdf_menu_area_in_grid_container',
					'no'  => '#eltdf_menu_area_in_grid_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#eltdf_menu_area_in_grid_container'
				)
			)
		));

		$menu_area_in_grid_container = satine_elated_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'menu_area_in_grid_container',
			'parent'          => $menu_area_container,
			'hidden_property' => 'eltdf_menu_area_in_grid_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));


		satine_elated_add_meta_box_field(
			array(
				'name'        => 'eltdf_menu_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__('Grid Background Color', 'satine'),
				'description' => esc_html__('Set grid background color for menu area', 'satine'),
				'parent'      => $menu_area_in_grid_container
			)
		);

		satine_elated_add_meta_box_field(
			array(
				'name'        => 'eltdf_menu_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__('Grid Background Transparency', 'satine'),
				'description' => esc_html__('Set grid background transparency for menu area (0 = fully transparent, 1 = opaque)', 'satine'),
				'parent'      => $menu_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_menu_area_in_grid_shadow_meta',
			'type'          => 'select',
			'label'         => esc_html__('Grid Area Shadow', 'satine'),
			'description'   => esc_html__('Set shadow on grid menu area', 'satine'),
			'parent'        => $menu_area_in_grid_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			)
		));

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_menu_area_in_grid_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Grid Area Border', 'satine'),
			'description'   => esc_html__('Set border on grid menu area', 'satine'),
			'parent'        => $menu_area_in_grid_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#eltdf_menu_area_in_grid_border_container',
					'no'  => '#eltdf_menu_area_in_grid_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#eltdf_menu_area_in_grid_border_container'
				)
			)
		));

		$menu_area_in_grid_border_container = satine_elated_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'menu_area_in_grid_border_container',
			'parent'          => $menu_area_in_grid_container,
			'hidden_property' => 'eltdf_menu_area_in_grid_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		satine_elated_add_meta_box_field(array(
			'name'        => 'eltdf_menu_area_in_grid_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'satine'),
			'description' => esc_html__('Set border color for grid area', 'satine'),
			'parent'      => $menu_area_in_grid_border_container
		));


		satine_elated_add_meta_box_field(
			array(
				'name'        => 'eltdf_menu_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__('Background Color', 'satine'),
				'description' => esc_html__('Choose a background color for menu area', 'satine'),
				'parent'      => $menu_area_container
			)
		);

		satine_elated_add_meta_box_field(
			array(
				'name'        => 'eltdf_menu_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__('Transparency', 'satine'),
				'description' => esc_html__('Choose a transparency for the menu area background color (0 = fully transparent, 1 = opaque)', 'satine'),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_menu_area_shadow_meta',
			'type'          => 'select',
			'label'         => esc_html__('Menu Area Shadow', 'satine'),
			'description'   => esc_html__('Set shadow on menu area', 'satine'),
			'parent'        => $menu_area_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			)
		));

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_menu_area_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Menu Area Border', 'satine'),
			'description'   => esc_html__('Set border on menu area', 'satine'),
			'parent'        => $menu_area_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#eltdf_menu_area_border_bottom_color_container',
					'no'  => '#eltdf_menu_area_border_bottom_color_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#eltdf_menu_area_border_bottom_color_container'
				)
			)
		));

		$menu_area_border_bottom_color_container = satine_elated_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'menu_area_border_bottom_color_container',
			'parent'          => $menu_area_container,
			'hidden_property' => 'eltdf_menu_area_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		satine_elated_add_meta_box_field(array(
			'name'        => 'eltdf_menu_area_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'satine'),
			'description' => esc_html__('Choose color of header bottom border', 'satine'),
			'parent'      => $menu_area_border_bottom_color_container
		));

		satine_elated_add_meta_box_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'text',
				'name' => 'eltdf_menu_area_height_meta',
				'default_value' => '',
				'label' => esc_html__('Height', 'satine'),
				'description' => esc_html__('Enter header height', 'satine'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		do_action('satine_elated_header_menu_area_additional_meta_options',$menu_area_container);
	}

	add_action('satine_elated_header_menu_area_meta_options_map', 'satine_elated_header_menu_area_meta_options_map', 10, 1);
}