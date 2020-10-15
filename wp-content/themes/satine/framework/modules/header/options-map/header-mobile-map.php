<?php

if ( ! function_exists('satine_elated_mobile_header_options_map') ) {

	function satine_elated_mobile_header_options_map() {

		$panel_mobile_header = satine_elated_add_admin_panel(array(
			'title' => esc_html__('Mobile Header', 'satine'),
			'name'  => 'panel_mobile_header',
			'page'  => '_header_page'
		));

		$mobile_header_group = satine_elated_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'mobile_header_group',
				'title' => esc_html__('Mobile Header Styles', 'satine')
			)
		);

		$mobile_header_row1 = satine_elated_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name' => 'mobile_header_row1'
			)
		);

			satine_elated_add_admin_field(array(
				'name'        => 'mobile_header_height',
				'type'        => 'textsimple',
				'label'       => esc_html__('Height', 'satine'),
				'parent'      => $mobile_header_row1,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			));

			satine_elated_add_admin_field(array(
				'name'        => 'mobile_header_background_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Background Color', 'satine'),
				'parent'      => $mobile_header_row1
			));

			satine_elated_add_admin_field(array(
				'name'        => 'mobile_header_border_bottom_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Border Bottom Color', 'satine'),
				'parent'      => $mobile_header_row1
			));

		$mobile_menu_group = satine_elated_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'mobile_menu_group',
				'title' => esc_html__('Mobile Menu Styles', 'satine')
			)
		);

		$mobile_menu_row1 = satine_elated_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name' => 'mobile_menu_row1'
			)
		);

			satine_elated_add_admin_field(array(
				'name'        => 'mobile_menu_background_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Background Color', 'satine'),
				'parent'      => $mobile_menu_row1
			));

			satine_elated_add_admin_field(array(
				'name'        => 'mobile_menu_border_bottom_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Border Bottom Color', 'satine'),
				'parent'      => $mobile_menu_row1
			));

			satine_elated_add_admin_field(array(
				'name'        => 'mobile_menu_separator_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Menu Item Separator Color', 'satine'),
				'parent'      => $mobile_menu_row1
			));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Header', 'satine'),
			'description' => esc_html__('Define logo height for screen size smaller than 1024px', 'satine'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Devices', 'satine'),
			'description' => esc_html__('Define logo height for screen size smaller than 480px', 'satine'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		satine_elated_add_admin_section_title(array(
			'parent' => $panel_mobile_header,
			'name'   => 'mobile_header_fonts_title',
			'title'  => esc_html__('Typography', 'satine')
		));

		$first_level_group = satine_elated_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'first_level_group',
				'title' => esc_html__('1st Level Menu', 'satine'),
				'description' => esc_html__('Define styles for 1st level in Mobile Menu Navigation', 'satine')
			)
		);

		$first_level_row1 = satine_elated_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row1'
			)
		);

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_text_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'satine'),
			'parent'      => $first_level_row1
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Hover/Active Text Color', 'satine'),
			'parent'      => $first_level_row1
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_google_fonts',
			'type'        => 'fontsimple',
			'label'       => esc_html__('Font Family', 'satine'),
			'parent'      => $first_level_row1
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_font_size',
			'type'        => 'textsimple',
			'label'       => esc_html__('Font Size', 'satine'),
			'parent'      => $first_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$first_level_row2 = satine_elated_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row2'
			)
		);

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_line_height',
			'type'        => 'textsimple',
			'label'       => esc_html__('Line Height', 'satine'),
			'parent'      => $first_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_text_transform',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Text Transform', 'satine'),
			'parent'      => $first_level_row2,
			'options'     => satine_elated_get_text_transform_array()
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_font_style',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Style', 'satine'),
			'parent'      => $first_level_row2,
			'options'     => satine_elated_get_font_style_array()
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_font_weight',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Weight', 'satine'),
			'parent'      => $first_level_row2,
			'options'     => satine_elated_get_font_weight_array()
		));

		$first_level_row3 = satine_elated_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row3'
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'mobile_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'satine'),
				'default_value' => '',
				'parent' => $first_level_row3,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_group = satine_elated_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'second_level_group',
				'title' => esc_html__('Dropdown Menu', 'satine'),
				'description' => esc_html__('Define styles for drop down menu items in Mobile Menu Navigation', 'satine')
			)
		);

		$second_level_row1 = satine_elated_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row1'
			)
		);

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'satine'),
			'parent'      => $second_level_row1
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Hover/Active Text Color', 'satine'),
			'parent'      => $second_level_row1
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_dropdown_google_fonts',
			'type'        => 'fontsimple',
			'label'       => esc_html__('Font Family', 'satine'),
			'parent'      => $second_level_row1
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_size',
			'type'        => 'textsimple',
			'label'       => esc_html__('Font Size', 'satine'),
			'parent'      => $second_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$second_level_row2 = satine_elated_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row2'
			)
		);

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_dropdown_line_height',
			'type'        => 'textsimple',
			'label'       => esc_html__('Line Height', 'satine'),
			'parent'      => $second_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_transform',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Text Transform', 'satine'),
			'parent'      => $second_level_row2,
			'options'     => satine_elated_get_text_transform_array()
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_style',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Style', 'satine'),
			'parent'      => $second_level_row2,
			'options'     => satine_elated_get_font_style_array()
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_weight',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Weight', 'satine'),
			'parent'      => $second_level_row2,
			'options'     => satine_elated_get_font_weight_array()
		));

		$second_level_row3 = satine_elated_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row3'
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'mobile_dropdown_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'satine'),
				'default_value' => '',
				'parent' => $second_level_row3,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_section_title(array(
			'name' => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title' => esc_html__('Mobile Menu Opener', 'satine')
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_menu_title',
			'type'        => 'text',
			'label'       => esc_html__('Mobile Navigation Title', 'satine'),
			'description' => esc_html__('Enter title for mobile menu navigation', 'satine'),
			'parent'      => $panel_mobile_header,
			'default_value' => esc_html__('Menu', 'satine'),
			'args' => array(
				'col_width' => 3
			)
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Color', 'satine'),
			'parent'      => $panel_mobile_header
		));

		satine_elated_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Hover Color', 'satine'),
			'parent'      => $panel_mobile_header
		));
	}

	add_action( 'satine_elated_header_mobile_header_options_map', 'satine_elated_mobile_header_options_map', 5);
}