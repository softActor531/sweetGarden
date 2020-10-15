<?php
if(!function_exists('satine_elated_header_vertical_area_meta_options_map')) {

	function satine_elated_header_vertical_area_meta_options_map($header_meta_box){
		$header_vertical_area_meta_container = satine_elated_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_meta_container',
				'hidden_property' => 'eltdf_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-standard','header-extended','header-box','header-minimal','header-divided','header-centered','header-tabbed')
			)
		);

		satine_elated_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name' => 'vertical_area_style',
				'title' => esc_html__('Vertical Area Style', 'satine')
			)
		);

		$satine_custom_sidebars = satine_elated_get_custom_sidebars();
		if(count($satine_custom_sidebars) > 0) {
			satine_elated_add_meta_box_field(array(
				'name' => 'eltdf_custom_vertical_area_sidebar_meta',
				'type' => 'selectblank',
				'label' => esc_html__('Choose Custom Widget Area in Vertical area', 'satine'),
				'description' => esc_html__('Choose custom widget area to display in vertical menu"', 'satine'),
				'parent' => $header_vertical_area_meta_container,
				'options' => $satine_custom_sidebars
			));
		}

		satine_elated_add_meta_box_field(array(
			'name'        => 'eltdf_vertical_header_background_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'satine'),
			'description' => esc_html__('Set background color for vertical menu', 'satine'),
			'parent'      => $header_vertical_area_meta_container
		));

		satine_elated_add_meta_box_field(
			array(
				'name'          => 'eltdf_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__('Background Image', 'satine'),
				'description'   => esc_html__('Set background image for vertical menu', 'satine'),
				'parent'        => $header_vertical_area_meta_container
			)
		);

		satine_elated_add_meta_box_field(
			array(
				'name'          => 'eltdf_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Disable Background Image', 'satine'),
				'description'   => esc_html__('Enabling this option will hide background image in Vertical Menu', 'satine'),
				'parent'        => $header_vertical_area_meta_container
			)
		);

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_vertical_header_shadow_meta',
			'type'          => 'select',
			'label'         => esc_html__('Shadow', 'satine'),
			'description'   => esc_html__('Set shadow on vertical menu', 'satine'),
			'parent'        => $header_vertical_area_meta_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			)
		));

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_vertical_header_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Vertical Area Border', 'satine'),
			'description'   => esc_html__('Set border on vertical area', 'satine'),
			'parent'        => $header_vertical_area_meta_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#eltdf_vertical_header_border_container',
					'no'  => '#eltdf_vertical_header_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#eltdf_vertical_header_border_container'
				)
			)
		));

		$vertical_header_border_container = satine_elated_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'vertical_header_border_container',
			'parent'          => $header_vertical_area_meta_container,
			'hidden_property' => 'eltdf_vertical_header_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		satine_elated_add_meta_box_field(array(
			'name'        => 'eltdf_vertical_header_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'satine'),
			'description' => esc_html__('Choose color of border', 'satine'),
			'parent'      => $vertical_header_border_container
		));

		satine_elated_add_meta_box_field(array(
			'name'          => 'eltdf_vertical_header_center_content_meta',
			'type'          => 'select',
			'label'         => esc_html__('Center Content', 'satine'),
			'description'   => esc_html__('Set content in vertical center', 'satine'),
			'parent'        => $header_vertical_area_meta_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'satine'),
				'yes' => esc_html__('Yes', 'satine')
			)
		));
	}
	add_action('satine_elated_header_vertical_area_meta_options_map', 'satine_elated_header_vertical_area_meta_options_map', 10, 1);
}