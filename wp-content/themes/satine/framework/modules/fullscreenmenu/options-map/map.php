<?php

if ( ! function_exists('satine_elated_fullscreen_menu_options_map')) {

	function satine_elated_fullscreen_menu_options_map() {

		$fullscreen_panel = satine_elated_add_admin_panel(
			array(
				'title'           => esc_html__('Fullscreen Menu', 'satine'),
				'name'            => 'panel_fullscreen_menu',
				'page'            => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-standard',
					'header-standard-extended',
					'header-box',
					'header-vertical',
					'header-divided',
					'header-centered',
					'header-tabbed',
					'header-vertical-compact',
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'select',
				'name' => 'fullscreen_menu_animation_style',
				'default_value' => 'fade-push-text-right',
				'label' => esc_html__('Fullscreen Menu Overlay Animation', 'satine'),
				'description' => esc_html__('Choose animation type for fullscreen menu overlay', 'satine'),
				'options' => array(
					'fade-push-text-right' => esc_html__('Fade Push Text Right', 'satine'),
					'fade-push-text-top' => esc_html__('Fade Push Text Top', 'satine'),
					'fade-text-scaledown' => esc_html__('Fade Text Scaledown', 'satine')
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'yesno',
				'name' => 'fullscreen_in_grid',
				'default_value' => 'no',
				'label' => esc_html__('Fullscreen Menu in Grid', 'satine'),
				'description' => esc_html__('Enabling this option will put fullscreen menu content in grid', 'satine'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'selectblank',
				'name' => 'fullscreen_alignment',
				'default_value' => '',
				'label' => esc_html__('Fullscreen Menu Alignment', 'satine'),
				'description' => esc_html__('Choose alignment for fullscreen menu content', 'satine'),
				'options' => array(
					'' => esc_html__('Default', 'satine'),
					'left' => esc_html__('Left', 'satine'),
					'center' => esc_html__('Center', 'satine'),
					'right' => esc_html__('Right', 'satine')
				)
			)
		);

		$background_group = satine_elated_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'background_group',
				'title' => esc_html__('Background', 'satine'),
				'description' => esc_html__('Select a background color and transparency for fullscreen menu (0 = fully transparent, 1 = opaque)', 'satine')
			)
		);

		$background_group_row = satine_elated_add_admin_row(
			array(
				'parent' => $background_group,
				'name' => 'background_group_row'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_background_color',
				'label' => esc_html__('Background Color', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_background_transparency',
				'label' => esc_html__('Background Transparency', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_background_image',
				'label' => esc_html__('Background Image', 'satine'),
				'description' => esc_html__('Choose a background image for fullscreen menu background', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_pattern_image',
				'label' => esc_html__('Pattern Background Image', 'satine'),
				'description' => esc_html__('Choose a pattern image for fullscreen menu background', 'satine')
			)
		);

		//1st level style group
		$first_level_style_group = satine_elated_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'first_level_style_group',
				'title' => esc_html__('1st Level Style', 'satine'),
				'description' => esc_html__('Define styles for 1st level in Fullscreen Menu', 'satine')
			)
		);

		$first_level_style_row1 = satine_elated_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row1'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'satine'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color',
				'default_value' => '',
				'label' => esc_html__('Hover Text Color', 'satine'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_active_color',
				'default_value' => '',
				'label' => esc_html__('Active Text Color', 'satine'),
			)
		);

		$first_level_style_row3 = satine_elated_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row3'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'satine'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'satine'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'satine'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$first_level_style_row4 = satine_elated_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row4'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'satine'),
				'options' => satine_elated_get_font_style_array()
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'satine'),
				'options' => satine_elated_get_font_weight_array()
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'satine'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'satine'),
				'options' => satine_elated_get_text_transform_array()
			)
		);

		//2nd level style group
		$second_level_style_group = satine_elated_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'second_level_style_group',
				'title' => esc_html__('2nd Level Style', 'satine'),
				'description' => esc_html__('Define styles for 2nd level in Fullscreen Menu', 'satine')
			)
		);

		$second_level_style_row1 = satine_elated_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row1'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_2nd',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'satine'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_2nd',
				'default_value' => '',
				'label' => esc_html__('Hover/Active Text Color', 'satine'),
			)
		);

		$second_level_style_row2 = satine_elated_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_2nd',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'satine'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'satine'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height_2nd',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'satine'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_style_row3 = satine_elated_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'satine'),
				'options' => satine_elated_get_font_style_array()
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'satine'),
				'options' => satine_elated_get_font_weight_array()
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing_2nd',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'satine'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform_2nd',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'satine'),
				'options' => satine_elated_get_text_transform_array()
			)
		);

		$third_level_style_group = satine_elated_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'third_level_style_group',
				'title' => esc_html__('3rd Level Style', 'satine'),
				'description' => esc_html__('Define styles for 3rd level in Fullscreen Menu', 'satine')
			)
		);

		$third_level_style_row1 = satine_elated_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'third_level_style_row1'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_3rd',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'satine'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_3rd',
				'default_value' => '',
				'label' => esc_html__('Hover/Active Text Color', 'satine'),
			)
		);

		$third_level_style_row2 = satine_elated_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_3rd',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'satine'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'satine'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height_3rd',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'satine'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_style_row3 = satine_elated_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'satine'),
				'options' => satine_elated_get_font_style_array()
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'satine'),
				'options' => satine_elated_get_font_weight_array()
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing_3rd',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'satine'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform_3rd',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'satine'),
				'options' => satine_elated_get_text_transform_array()
			)
		);

		$icon_colors_group = satine_elated_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'fullscreen_menu_icon_colors_group',
				'title' => esc_html__('Full Screen Menu Icon Style', 'satine'),
				'description' => esc_html__('Define styles for Fullscreen Menu Icon', 'satine')
			)
		);

		$icon_colors_row1 = satine_elated_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row1'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_color',
				'label' => esc_html__('Color', 'satine'),
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_hover_color',
				'label' => esc_html__('Hover Color', 'satine'),
			)
		);
	}

	add_action('satine_elated_header_options_map', 'satine_elated_fullscreen_menu_options_map', 17);
}