<?php

if ( ! function_exists('satine_elated_sidearea_options_map') ) {

	function satine_elated_sidearea_options_map() {

		satine_elated_add_admin_page(
			array(
				'slug' => '_side_area_page',
				'title' => esc_html__('Side Area', 'satine'),
				'icon' => 'fa fa-indent'
			)
		);

		$side_area_panel = satine_elated_add_admin_panel(
			array(
				'title' => esc_html__('Side Area', 'satine'),
				'name' => 'side_area',
				'page' => '_side_area_page'
			)
		);

		$side_area_icon_style_group = satine_elated_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_icon_style_group',
				'title' => esc_html__('Side Area Icon Style', 'satine'),
				'description' => esc_html__('Define styles for Side Area icon', 'satine')
			)
		);

		$side_area_icon_style_row1 = satine_elated_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row1'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_color',
				'label' => esc_html__('Color', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_hover_color',
				'label' => esc_html__('Hover Color', 'satine')
			)
		);

		$side_area_icon_style_row2 = satine_elated_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row2',
				'next'		=> true
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_color',
				'label' => esc_html__('Close Icon Color', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_hover_color',
				'label' => esc_html__('Close Icon Hover Color', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_width',
				'default_value' => '',
				'label' => esc_html__('Side Area Width', 'satine'),
				'description' => esc_html__('Enter a width for Side Area', 'satine'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'color',
				'name' => 'side_area_background_color',
				'label' => esc_html__('Background Color', 'satine'),
				'description' => esc_html__('Choose a background color for Side Area', 'satine')
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_padding',
				'label' => esc_html__('Padding', 'satine'),
				'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'satine'),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'selectblank',
				'name' => 'side_area_aligment',
				'default_value' => '',
				'label' => esc_html__('Text Alignment', 'satine'),
				'description' => esc_html__('Choose text alignment for side area', 'satine'),
				'options' => array(
					'' => esc_html__('Default', 'satine'),
					'left' => esc_html__('Left', 'satine'),
					'center' => esc_html__('Center', 'satine'),
					'right' => esc_html__('Right', 'satine')
				)
			)
		);
	}

	add_action('satine_elated_options_map', 'satine_elated_sidearea_options_map', 8);
}