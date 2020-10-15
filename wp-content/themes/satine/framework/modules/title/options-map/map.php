<?php

if ( ! function_exists('satine_elated_title_options_map') ) {

	function satine_elated_title_options_map() {

		satine_elated_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => esc_html__('Title', 'satine'),
				'icon' => 'fa fa-list-alt'
			)
		);

		$panel_title = satine_elated_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => esc_html__('Title Settings', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'show_title_area',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => esc_html__('Show Title Area', 'satine'),
				'description' => esc_html__('This option will enable/disable Title Area', 'satine'),
				'parent' => $panel_title,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltdf_show_title_area_container"
				)
			)
		);

		

		$show_title_area_container = satine_elated_add_admin_container(
			array(
				'parent' => $panel_title,
				'name' => 'show_title_area_container',
				'hidden_property' => 'show_title_area',
				'hidden_value' => 'no'
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'title_in_grid',
				'default_value' => 'yes',
				'label' => esc_html__('Title in Grid', 'satine'),
				'description' => esc_html__('Enabling this option will place Title content in grid', 'satine'),
				'parent' =>$show_title_area_container,
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'title_area_type',
				'type' => 'select',
				'default_value' => 'standard',
				'label' => esc_html__('Title Area Type', 'satine'),
				'description' => esc_html__('Choose title type', 'satine'),
				'parent' => $show_title_area_container,
				'options' => array(
					'standard' => esc_html__('Standard', 'satine'),
					'breadcrumb' => esc_html__('Breadcrumb', 'satine')
				),
				'args' => array(
					"dependence" => true,
					"hide" => array(
						"standard" => "",
						"breadcrumb" => "#eltdf_title_area_type_container"
					),
					"show" => array(
						"standard" => "#eltdf_title_area_type_container",
						"breadcrumb" => ""
					)
				)
			)
		);

		$title_area_type_container = satine_elated_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_type_container',
				'hidden_property' => 'title_area_type',
				'hidden_value' => '',
				'hidden_values' => array('breadcrumb'),
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'title_area_enable_breadcrumbs',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__('Enable Breadcrumbs', 'satine'),
				'description' => esc_html__('This option will display Breadcrumbs in Title Area', 'satine'),
				'parent' => $title_area_type_container,
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'name' => 'title_area_title_tag',
				'type' => 'select',
				'default_value' => 'h5',
				'label' => esc_html__('Title Tag', 'satine'),
				'parent' => $title_area_type_container,
				'options' => satine_elated_get_title_tag()
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'title_area_vertical_alignment',
				'type' => 'select',
				'default_value' => 'header_bottom',
				'label' => esc_html__('Vertical Alignment', 'satine'),
				'description' => esc_html__('Specify title vertical alignment', 'satine'),
				'parent' => $show_title_area_container,
				'options' => array(
					'header_bottom' => esc_html__('From Bottom of Header', 'satine'),
					'window_top' => esc_html__('From Window Top', 'satine')
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'title_area_content_alignment',
				'type' => 'select',
				'default_value' => 'center',
				'label' => esc_html__('Horizontal Alignment', 'satine'),
				'description' => esc_html__('Specify title horizontal alignment', 'satine'),
				'parent' => $show_title_area_container,
				'options' => array(
					'left' => esc_html__('Left', 'satine'),
					'center' => esc_html__('Center', 'satine'),
					'right' => esc_html__('Right', 'satine')
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'title_area_background_color',
				'type' => 'color',
				'label' => esc_html__('Background Color', 'satine'),
				'description' => esc_html__('Choose a background color for Title Area', 'satine'),
				'parent' => $show_title_area_container
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'title_area_background_image',
				'type' => 'image',
				'label' => esc_html__('Background Image', 'satine'),
				'description' => esc_html__('Choose an Image for Title Area', 'satine'),
				'parent' => $show_title_area_container
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'title_area_background_image_responsive',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__('Background Responsive Image', 'satine'),
				'description' => esc_html__('Enabling this option will make Title background image responsive', 'satine'),
				'parent' => $show_title_area_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#eltdf_title_area_background_image_responsive_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$title_area_background_image_responsive_container = satine_elated_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_background_image_responsive_container',
				'hidden_property' => 'title_area_background_image_responsive',
				'hidden_value' => 'yes'
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'title_area_background_image_parallax',
				'type' => 'select',
				'default_value' => 'no',
				'label' => esc_html__('Background Image in Parallax', 'satine'),
				'description' => esc_html__('Enabling this option will make Title background image parallax', 'satine'),
				'parent' => $title_area_background_image_responsive_container,
				'options' => array(
					'no' => esc_html__('No', 'satine'),
					'yes' => esc_html__('Yes', 'satine'),
					'yes_zoom' => esc_html__('Yes, with zoom out', 'satine')
				)
			)
		);

		satine_elated_add_admin_field(array(
			'name' => 'title_area_height',
			'type' => 'text',
			'label' => esc_html__('Height', 'satine'),
			'description' => esc_html__('Set a height for Title Area', 'satine'),
			'parent' => $title_area_background_image_responsive_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));


		$panel_typography = satine_elated_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title_typography',
				'title' => esc_html__('Typography', 'satine')
			)
		);

        satine_elated_add_admin_section_title(array(
            'name' => 'type_section_title',
            'title' => esc_html__('Title', 'satine'),
            'parent' => $panel_typography
        ));

        $group_page_title_styles = satine_elated_add_admin_group(array(
			'name'			=> 'group_page_title_styles',
			'title'			=> esc_html__('Title', 'satine'),
			'description'	=> esc_html__('Define styles for page title', 'satine'),
			'parent'		=> $panel_typography
		));

		$row_page_title_styles_1 = satine_elated_add_admin_row(array(
			'name'		=> 'row_page_title_styles_1',
			'parent'	=> $group_page_title_styles
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_title_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Color', 'satine'),
			'parent'		=> $row_page_title_styles_1
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_font_size',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Size', 'satine'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_line_height',
			'default_value'	=> '',
			'label'			=> esc_html__('Line Height', 'satine'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_text_transform',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Transform', 'satine'),
			'options'		=> satine_elated_get_text_transform_array(),
			'parent'		=> $row_page_title_styles_1
		));

		$row_page_title_styles_2 = satine_elated_add_admin_row(array(
			'name'		=> 'row_page_title_styles_2',
			'parent'	=> $group_page_title_styles,
			'next'		=> true
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_title_google_fonts',
			'default_value'	=> '-1',
			'label'			=> esc_html__('Font Family', 'satine'),
			'parent'		=> $row_page_title_styles_2
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_font_style',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Style', 'satine'),
			'options'		=> satine_elated_get_font_style_array(),
			'parent'		=> $row_page_title_styles_2
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_font_weight',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Weight', 'satine'),
			'options'		=> satine_elated_get_font_weight_array(),
			'parent'		=> $row_page_title_styles_2
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_letter_spacing',
			'default_value'	=> '',
			'label'			=> esc_html__('Letter Spacing', 'satine'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_2
		));

        satine_elated_add_admin_section_title(array(
            'name' => 'type_section_subtitle',
            'title' => esc_html__('Subtitle', 'satine'),
            'parent' => $panel_typography
        ));

		$group_page_subtitle_styles = satine_elated_add_admin_group(array(
			'name'			=> 'group_page_subtitle_styles',
			'title'			=> esc_html__('Subtitle', 'satine'),
			'description'	=> esc_html__('Define styles for page subtitle', 'satine'),
			'parent'		=> $panel_typography
		));

		$row_page_subtitle_styles_1 = satine_elated_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_1',
			'parent'	=> $group_page_subtitle_styles
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_subtitle_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Color', 'satine'),
			'parent'		=> $row_page_subtitle_styles_1
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_font_size',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Size', 'satine'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_line_height',
			'default_value'	=> '',
			'label'			=> esc_html__('Line Height', 'satine'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_text_transform',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Transform', 'satine'),
			'options'		=> satine_elated_get_text_transform_array(),
			'parent'		=> $row_page_subtitle_styles_1
		));

		$row_page_subtitle_styles_2 = satine_elated_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_2',
			'parent'	=> $group_page_subtitle_styles,
			'next'		=> true
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_subtitle_google_fonts',
			'default_value'	=> '-1',
			'label'			=> esc_html__('Font Family', 'satine'),
			'parent'		=> $row_page_subtitle_styles_2
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_font_style',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Style', 'satine'),
			'options'		=> satine_elated_get_font_style_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_font_weight',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Weight', 'satine'),
			'options'		=> satine_elated_get_font_weight_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_letter_spacing',
			'default_value'	=> '',
			'label'			=> esc_html__('Letter Spacing', 'satine'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_2
		));

        satine_elated_add_admin_section_title(array(
            'name' => 'type_section_breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'satine'),
            'parent' => $panel_typography
        ));

		$group_page_breadcrumbs_styles = satine_elated_add_admin_group(array(
			'name'			=> 'group_page_breadcrumbs_styles',
			'title'			=> esc_html__('Breadcrumbs', 'satine'),
			'description'	=> esc_html__('Define styles for page breadcrumbs', 'satine'),
			'parent'		=> $panel_typography
		));

		$row_page_breadcrumbs_styles_1 = satine_elated_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_1',
			'parent'	=> $group_page_breadcrumbs_styles
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Color', 'satine'),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_font_size',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Size', 'satine'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_line_height',
			'default_value'	=> '',
			'label'			=> esc_html__('Line Height', 'satine'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_text_transform',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Transform', 'satine'),
			'options'		=> satine_elated_get_text_transform_array(),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		$row_page_breadcrumbs_styles_2 = satine_elated_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_2',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_breadcrumb_google_fonts',
			'default_value'	=> '-1',
			'label'			=> esc_html__('Font Family', 'satine'),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_font_style',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Style', 'satine'),
			'options'		=> satine_elated_get_font_style_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_font_weight',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Weight', 'satine'),
			'options'		=> satine_elated_get_font_weight_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_letter_spacing',
			'default_value'	=> '',
			'label'			=> esc_html__('Letter Spacing', 'satine'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		$row_page_breadcrumbs_styles_3 = satine_elated_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_3',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		satine_elated_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_hovercolor',
			'default_value'	=> '',
			'label'			=> esc_html__('Hover/Active Text Color', 'satine'),
			'parent'		=> $row_page_breadcrumbs_styles_3
		));
    }

	add_action( 'satine_elated_options_map', 'satine_elated_title_options_map', 4);
}