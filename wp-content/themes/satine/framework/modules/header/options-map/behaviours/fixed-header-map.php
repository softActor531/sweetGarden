<?php
if(!function_exists('satine_elated_header_fixed_options_map')) {

	function satine_elated_header_fixed_options_map(){

		$panel_fixed_header = satine_elated_add_admin_panel(
			array(
				'title' => esc_html__('Fixed Header', 'satine'),
				'name' => 'panel_fixed_header',
				'page' => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-vertical','header-vertical-compact','header-top-menu')
			)
		);

		satine_elated_add_admin_field(array(
			'name' => 'fixed_header_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => esc_html__('Background Color', 'satine'),
			'description' => esc_html__('Choose a background color for header area', 'satine'),
			'parent' => $panel_fixed_header
		));

		satine_elated_add_admin_field(array(
			'name' => 'fixed_header_transparency',
			'type' => 'text',
			'label' => esc_html__('Background Transparency', 'satine'),
			'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'satine'),
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));

		satine_elated_add_admin_field(
			array(
				'parent' => $panel_fixed_header,
				'type' => 'color',
				'name' => 'fixed_header_border_bottom_color',
				'default_value' => '',
				'label' => esc_html__('Border Color', 'satine'),
				'description' => esc_html__('Set border bottom color for header area', 'satine'),
			)
		);

		$group_fixed_header_menu = satine_elated_add_admin_group(array(
			'title' => esc_html__('Fixed Header Menu', 'satine'),
			'name' => 'group_fixed_header_menu',
			'parent' => $panel_fixed_header,
			'description' => esc_html__('Define styles for fixed menu items', 'satine')
		));

		$row1_fixed_header_menu = satine_elated_add_admin_row(array(
			'name' => 'row1',
			'parent' => $group_fixed_header_menu
		));

		satine_elated_add_admin_field(array(
			'name' => 'fixed_color',
			'type' => 'colorsimple',
			'label' => esc_html__('Text Color', 'satine'),
			'description' => '',
			'parent' => $row1_fixed_header_menu
		));

		satine_elated_add_admin_field(array(
			'name' => 'fixed_hovercolor',
			'type' => 'colorsimple',
			'label' => esc_html__(esc_html__('Hover/Active Color', 'satine'), 'satine'),
			'description' => '',
			'parent' => $row1_fixed_header_menu
		));

		$row2_fixed_header_menu = satine_elated_add_admin_row(array(
			'name' => 'row2',
			'parent' => $group_fixed_header_menu
		));

		satine_elated_add_admin_field(
			array(
				'name' => 'fixed_google_fonts',
				'type' => 'fontsimple',
				'label' => esc_html__('Font Family', 'satine'),
				'default_value' => '-1',
				'parent' => $row2_fixed_header_menu,
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'fixed_font_size',
				'label' => esc_html__('Font Size', 'satine'),
				'default_value' => '',
				'parent' => $row2_fixed_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'fixed_line_height',
				'label' => esc_html__('Line Height', 'satine'),
				'default_value' => '',
				'parent' => $row2_fixed_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'fixed_text_transform',
				'label' => esc_html__('Text Transform', 'satine'),
				'default_value' => '',
				'options' => satine_elated_get_text_transform_array(),
				'parent' => $row2_fixed_header_menu
			)
		);

		$row3_fixed_header_menu = satine_elated_add_admin_row(array(
			'name' => 'row3',
			'parent' => $group_fixed_header_menu
		));

		satine_elated_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'fixed_font_style',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'satine'),
				'options' => satine_elated_get_font_style_array(),
				'parent' => $row3_fixed_header_menu
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'fixed_font_weight',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'satine'),
				'options' => satine_elated_get_font_weight_array(),
				'parent' => $row3_fixed_header_menu
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'fixed_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'satine'),
				'default_value' => '',
				'parent' => $row3_fixed_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

	}

	add_action('satine_elated_header_fixed_options_map', 'satine_elated_header_fixed_options_map', 10, 1);
}