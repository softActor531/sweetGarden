<?php
if(!function_exists('satine_elated_header_logo_area_options_map')) {

	function satine_elated_header_logo_area_options_map($panel_header){

		$logo_area_container = satine_elated_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'logo_area_container',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-standard','header-box','header-minimal','header-divided','header-tabbed','header-vertical','header-vertical-compact','header-vertical-closed')
			)
		);

		satine_elated_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name'   => 'logo_menu_area_title',
				'title'  => esc_html__('Logo Area', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__('Logo Area In Grid', 'satine'),
				'description'   => esc_html__('Set menu area content to be in grid', 'satine'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltdf_logo_area_in_grid_container'
				)
			)
		);

		$logo_area_in_grid_container = satine_elated_add_admin_container(
			array(
				'parent'          => $logo_area_container,
				'name'            => 'logo_area_in_grid_container',
				'hidden_property' => 'logo_area_in_grid',
				'hidden_value'    => 'no'
			)
		);

			satine_elated_add_admin_field(
				array(
					'parent'        => $logo_area_in_grid_container,
					'type'          => 'color',
					'name'          => 'logo_area_grid_background_color',
					'default_value' => '',
					'label'         => esc_html__('Grid Background Color', 'satine'),
					'description'   => esc_html__('Set grid background color for logo area', 'satine'),
				)
			);

			satine_elated_add_admin_field(
				array(
					'parent'        => $logo_area_in_grid_container,
					'type'          => 'text',
					'name'          => 'logo_area_grid_background_transparency',
					'default_value' => '',
					'label'         => esc_html__('Grid Background Transparency', 'satine'),
					'description'   => esc_html__('Set grid background transparency', 'satine'),
					'args'          => array(
						'col_width' => 3
					)
				)
			);

			satine_elated_add_admin_field(
				array(
					'parent'        => $logo_area_in_grid_container,
					'type'          => 'yesno',
					'name'          => 'logo_area_in_grid_border',
					'default_value' => 'no',
					'label'         => esc_html__('Grid Area Border', 'satine'),
					'description'   => esc_html__('Set border on grid area', 'satine'),
					'args'          => array(
						'dependence'             => true,
						'dependence_hide_on_yes' => '',
						'dependence_show_on_yes' => '#eltdf_logo_area_in_grid_border_container'
					)
				)
			);

			$logo_area_in_grid_border_container = satine_elated_add_admin_container(
				array(
					'parent'          => $logo_area_in_grid_container,
					'name'            => 'logo_area_in_grid_border_container',
					'hidden_property' => 'logo_area_in_grid_border',
					'hidden_value'    => 'no'
				)
			);

				satine_elated_add_admin_field(
					array(
						'parent'        => $logo_area_in_grid_border_container,
						'type'          => 'color',
						'name'          => 'logo_area_in_grid_border_color',
						'default_value' => '',
						'label'         => esc_html__('Border Color', 'satine'),
						'description'   => esc_html__('Set border color for grid area', 'satine'),
					)
				);

		satine_elated_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'color',
				'name'          => 'logo_area_background_color',
				'default_value' => '',
				'label'         => esc_html__('Background color', 'satine'),
				'description'   => esc_html__('Set background color for logo area', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'text',
				'name'          => 'logo_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__('Background transparency', 'satine'),
				'description'   => esc_html__('Set background transparency for logo area', 'satine'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_border',
				'default_value' => 'no',
				'label'         => esc_html__('Logo Area Border', 'satine'),
				'description'   => esc_html__('Set border on logo area', 'satine'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltdf_logo_area_border_container'
				)
			)
		);

		$logo_area_border_container = satine_elated_add_admin_container(
			array(
				'parent'          => $logo_area_container,
				'name'            => 'logo_area_border_container',
				'hidden_property' => 'logo_area_border',
				'hidden_value'    => 'no'
			)
		);

			satine_elated_add_admin_field(
				array(
					'parent'        => $logo_area_border_container,
					'type'          => 'color',
					'name'          => 'logo_area_border_color',
					'default_value' => '',
					'label'         => esc_html__('Border Color', 'satine'),
					'description'   => esc_html__('Set border color for logo area', 'satine'),
				)
			);

		satine_elated_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'text',
				'name'          => 'logo_area_height',
				'default_value' => '',
				'label'         => esc_html__('Height', 'satine'),
				'description'   => esc_html__('Enter logo area height (default is 90px)', 'satine'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		do_action('satine_elated_header_logo_area_additional_options', $logo_area_container);
	}

	add_action('satine_elated_header_logo_area_options_map', 'satine_elated_header_logo_area_options_map', 10, 1);
}