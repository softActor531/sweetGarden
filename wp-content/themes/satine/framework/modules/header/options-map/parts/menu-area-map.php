<?php
if(!function_exists('satine_elated_header_menu_area_options_map')) {

	function satine_elated_header_menu_area_options_map($panel_header){

		$menu_area_container = satine_elated_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'menu_area_container',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-vertical','header-vertical-compact','header-vertical-closed')
			)
		);

		satine_elated_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_style',
				'title' => esc_html__('Menu Area Style', 'satine')
			)
		);

        $menu_area_position_header_standard_container = satine_elated_add_admin_container(
            array(
                'parent' => $menu_area_container,
                'name' => 'menu_area_position_header_standard_container',
                'hidden_property' => 'header_type',
                'hidden_values' => array('header-minimal','header-divided','header-centered')
            )
        );

            satine_elated_add_admin_field(
                array(
                    'parent'		=> $menu_area_position_header_standard_container,
                    'type'			=> 'select',
                    'name'			=> 'menu_area_position_header_standard',
                    'default_value'	=> 'center',
                    'options' => array(
                        'center'	=> esc_html__('Center', 'satine'),
                        'right'		=> esc_html__('Right', 'satine'),
                    ),
                    'label'			=> esc_html__('Menu Area Position', 'satine'),
                    'description'	=> esc_html__('Set posistion of menu area for Standard Header Type', 'satine'),
                )
            );

		satine_elated_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid',
				'default_value' => 'no',
				'label' => esc_html__('Menu Area In Grid', 'satine'),
				'description' => esc_html__('Set menu area content to be in grid', 'satine'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltdf_menu_area_in_grid_container'
				)
			)
		);

		$menu_area_in_grid_container = satine_elated_add_admin_container(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_in_grid_container',
				'hidden_property' => 'menu_area_in_grid',
				'hidden_value' => 'no'
			)
		);

			satine_elated_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'color',
					'name' => 'menu_area_grid_background_color',
					'default_value' => '',
					'label' => esc_html__('Grid Background Color', 'satine'),
					'description' => esc_html__('Set grid background color for menu area', 'satine'),
				)
			);

			satine_elated_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'text',
					'name' => 'menu_area_grid_background_transparency',
					'default_value' => '',
					'label' => esc_html__('Grid Background Transparency', 'satine'),
					'description' => esc_html__('Set grid background transparency for menu area', 'satine'),
					'args' => array(
						'col_width' => 3
					)
				)
			);

			satine_elated_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'yesno',
					'name' => 'menu_area_in_grid_shadow',
					'default_value' => 'no',
					'label' => esc_html__('Grid Area Shadow', 'satine'),
					'description' => esc_html__('Set shadow on grid area', 'satine')
				)
			);

			satine_elated_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'yesno',
					'name' => 'menu_area_in_grid_border',
					'default_value' => 'no',
					'label' => esc_html__('Grid Area Border', 'satine'),
					'description' => esc_html__('Set border on grid area', 'satine'),
					'args' => array(
						'dependence' => true,
						'dependence_hide_on_yes' => '',
						'dependence_show_on_yes' => '#eltdf_menu_area_in_grid_border_container'
					)
				)
			);

			$menu_area_in_grid_border_container = satine_elated_add_admin_container(
				array(
					'parent' => $menu_area_in_grid_container,
					'name' => 'menu_area_in_grid_border_container',
					'hidden_property' => 'menu_area_in_grid_border',
					'hidden_value' => 'no'
				)
			);

				satine_elated_add_admin_field(
					array(
						'parent' => $menu_area_in_grid_border_container,
						'type' => 'color',
						'name' => 'menu_area_in_grid_border_color',
						'default_value' => '',
						'label' => esc_html__('Border Color', 'satine'),
						'description' => esc_html__('Set border color for menu area', 'satine'),
					)
				);

		satine_elated_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'color',
				'name' => 'menu_area_background_color',
				'default_value' => '',
				'label' => esc_html__('Background color', 'satine'),
				'description' => esc_html__('Set background color for menu area', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'text',
				'name' => 'menu_area_background_transparency',
				'default_value' => '',
				'label' => esc_html__('Background transparency', 'satine'),
				'description' => esc_html__('Set background transparency for menu area', 'satine'),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'yesno',
				'name' => 'menu_area_shadow',
				'default_value' => 'no',
				'label' => esc_html__('Menu Area Area Shadow', 'satine'),
				'description' => esc_html__('Set shadow on menu area', 'satine'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'yesno',
				'name' => 'menu_area_border',
				'default_value' => 'no',
				'label' => esc_html__('Menu Area Border', 'satine'),
				'description' => esc_html__('Set border on menu area', 'satine'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltdf_menu_area_border_container'
				)
			)
		);

		$menu_area_border_container = satine_elated_add_admin_container(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_border_container',
				'hidden_property' => 'menu_area_border',
				'hidden_value' => 'no'
			)
		);

			satine_elated_add_admin_field(
				array(
					'parent' => $menu_area_border_container,
					'type' => 'color',
					'name' => 'menu_area_border_color',
					'default_value' => '',
					'label' => esc_html__('Border Color', 'satine'),
					'description' => esc_html__('Set border color for menu area', 'satine'),
				)
			);

		satine_elated_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'text',
				'name' => 'menu_area_height',
				'default_value' => '',
				'label' => esc_html__('Height', 'satine'),
				'description' => esc_html__('Enter header height', 'satine'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		do_action('satine_elated_header_menu_area_additional_options', $panel_header);
	}

	add_action('satine_elated_header_menu_area_options_map', 'satine_elated_header_menu_area_options_map', 10, 1);
}