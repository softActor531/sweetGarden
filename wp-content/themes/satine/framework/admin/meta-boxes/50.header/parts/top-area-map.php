<?php
if(!function_exists('satine_elated_header_top_area_meta_options_map')) {

	function satine_elated_header_top_area_meta_options_map($header_meta_box){

		$top_header_container = satine_elated_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'eltdf_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-top-menu','header-vertical','header-vertical-compact','header-vertical-closed')
			));

		satine_elated_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name' => 'top_area_style',
				'title' => esc_html__('Top Area', 'satine')
			)
		);

		satine_elated_add_meta_box_field(
			array(
				'name' => 'eltdf_top_bar_meta',
				'type' => 'select',
				'default_value' => '',
				'label' => esc_html__('Header Top Bar', 'satine'),
				'description' => esc_html__('Enabling this option will show header top bar area', 'satine'),
				'parent' => $top_header_container,
				'options' => satine_elated_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#eltdf_top_bar_container_no_style',
						'no'  => '#eltdf_top_bar_container_no_style',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#eltdf_top_bar_container_no_style'
					)
				)
			)
		);

		$top_bar_container = satine_elated_add_admin_container_no_style(array(
			'name'            => 'top_bar_container_no_style',
			'parent'          => $top_header_container,
			'hidden_property' => 'eltdf_top_bar_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('','no')
		));

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_top_bar_in_grid_meta',
			'type'          => 'select',
			'label'         => esc_html__('Top Bar In Grid', 'satine'),
			'description'   => esc_html__('Set top bar content to be in grid', 'satine'),
			'parent'        => $top_bar_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			)
		));

		satine_elated_add_meta_box_field(array(
			'name'    => 'eltdf_top_bar_skin_meta',
			'type'    => 'select',
			'label'   => esc_html__('Top Bar Skin', 'satine'),
			'options' => array(
				''      => esc_html__('Default', 'satine'),
				'light' => esc_html__('White', 'satine'),
				'dark'  => esc_html__('Black', 'satine'),
				'gray'  => esc_html__('Gray', 'satine'),
			),
			'parent'  => $top_bar_container
		));

		satine_elated_add_meta_box_field(array(
			'name'   => 'eltdf_top_bar_background_color_meta',
			'type'   => 'color',
			'label'  => esc_html__('Top Bar Background Color', 'satine'),
			'parent' => $top_bar_container
		));

		satine_elated_add_meta_box_field(array(
			'name'        => 'eltdf_top_bar_background_transparency_meta',
			'type'        => 'text',
			'label'       => esc_html__('Top Bar Background Color Transparency', 'satine'),
			'description' => esc_html__('Set top bar background color transparenct. Value should be between 0 and 1', 'satine'),
			'parent'      => $top_bar_container,
			'args'        => array(
				'col_width' => 3
			)
		));

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_top_bar_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Top Bar Border', 'satine'),
			'description'   => esc_html__('Set border on top bar', 'satine'),
			'parent'        => $top_bar_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#eltdf_top_bar_border_container',
					'no'  => '#eltdf_top_bar_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#eltdf_top_bar_border_container'
				)
			)
		));

		$top_bar_border_container = satine_elated_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'top_bar_border_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'eltdf_top_bar_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		satine_elated_add_meta_box_field(array(
			'name'        => 'eltdf_top_bar_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'satine'),
			'description' => esc_html__('Choose color for top bar border', 'satine'),
			'parent'      => $top_bar_border_container
		));
	}
	add_action('satine_elated_header_top_area_meta_options_map', 'satine_elated_header_top_area_meta_options_map', 10, 1);
}