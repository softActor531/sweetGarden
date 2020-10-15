<?php

if ( ! function_exists('satine_elated_footer_options_map') ) {
	/**
	 * Add footer options
	 */
	function satine_elated_footer_options_map() {

		satine_elated_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => esc_html__('Footer', 'satine'),
				'icon' => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = satine_elated_add_admin_panel(
			array(
				'title' => esc_html__('Footer', 'satine'),
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);


		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'yes',
				'label' => esc_html__('Footer in Grid', 'satine'),
				'description' => esc_html__('Enabling this option will place Footer content in grid', 'satine'),
				'parent' => $footer_panel,
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Top', 'satine'),
				'description' => esc_html__('Enabling this option will show Footer Top area', 'satine'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltdf_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_image',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Background Image', 'satine'),
				'description' => esc_html__('Disabling this option will hide footer background image', 'satine'),
				'parent' => $footer_panel,
			)
		);

		satine_elated_add_admin_field (
			array(
				'type' => 'image',
				'name' => 'footer_background_image',
				'default_value' => '',
				'label' => esc_html__('Footer Background Image', 'satine'),
				'description' => '',
				'parent' => $footer_panel,
			)
		);

		satine_elated_add_admin_field(array(
			'name' => 'footer_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'satine'),
			'description' => esc_html__('Set background color for footer area', 'satine'),
			'parent' => $footer_panel,
		));

		$show_footer_top_container = satine_elated_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns',
				'parent' => $show_footer_top_container,
				'default_value' => '4',
				'label' => esc_html__('Footer Top Columns', 'satine'),
				'description' => esc_html__('Choose number of columns for Footer Top area', 'satine'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				)
			)
		);

        satine_elated_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_skin',
                'default_value' => 'light',
                'label'         => esc_html__('Footer Top Skin', 'satine'),
                'description'   => esc_html__('Choose a footer top style to make footer top widgets in that predefined style', 'satine'),
                'options'       => array(
                    'standard' => esc_html__('Standard', 'satine'),
                    'light'    => esc_html__('Light', 'satine'),
                    'dark'     => esc_html__('Dark', 'satine')
                ),
                'parent'        => $show_footer_top_container,
            )
        );

		satine_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label' => esc_html__('Footer Top Columns Alignment', 'satine'),
				'description' => esc_html__('Text Alignment in Footer Columns', 'satine'),
				'options' => array(
					''       => esc_html__('Default', 'satine'),
					'left'   => esc_html__('Left', 'satine'),
					'center' => esc_html__('Center', 'satine'),
					'right'  => esc_html__('Right', 'satine')
				),
				'parent' => $show_footer_top_container,
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Bottom', 'satine'),
				'description' => esc_html__('Enabling this option will show Footer Bottom area', 'satine'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltdf_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = satine_elated_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_bottom_columns',
				'default_value' => '3',
				'label' => esc_html__('Footer Bottom Columns', 'satine'),
				'description' => esc_html__('Choose number of columns for Footer Bottom area', 'satine'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent' => $show_footer_bottom_container,
			)
		);

        satine_elated_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_bottom_skin',
                'default_value' => 'light',
                'label'         => esc_html__('Footer Bottom Skin', 'satine'),
                'description'   => esc_html__('Choose a footer bottom style to make footer bottom widgets in that predefined style', 'satine'),
                'options'       => array(
                    'standard' => esc_html__('Standard', 'satine'),
                    'light'    => esc_html__('Light', 'satine'),
                    'dark'     => esc_html__('Dark', 'satine')
                ),
                'parent'        => $show_footer_bottom_container,
            )
        );

        satine_elated_add_admin_field(
            array(
                'type' => 'yesno',
				'name' => 'show_footer_bottom_border',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Bottom Border', 'satine'),
				'description' => esc_html__('Enabling this option will show Footer Bottom border', 'satine'),
                'parent'      => $show_footer_bottom_container,
            )
        );

	}

	add_action( 'satine_elated_options_map', 'satine_elated_footer_options_map', 9);
}
