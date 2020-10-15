<?php

foreach(glob(ELATED_FRAMEWORK_MODULES_ROOT_DIR.'/header/options-map/*/*.php') as $options_load) {
	include_once $options_load;
}

if ( ! function_exists('satine_elated_header_options_map') ) {

	function satine_elated_header_options_map() {

		satine_elated_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => esc_html__('Header', 'satine'),
				'icon' => 'fa fa-header'
			)
		);

		$panel_header = satine_elated_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header',
				'title' => esc_html__('Header', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'radiogroup',
				'name' => 'header_type',
				'default_value' => 'header-standard',
				'label' => esc_html__('Choose Header Type', 'satine'),
				'description' => esc_html__('Select the type of header you would like to use', 'satine'),
				'options' => array(
					'header-standard'          => array(
						'image' => ELATED_FRAMEWORK_ROOT.'/admin/assets/img/header-standard.png',
						'label' => esc_html__('Standard', 'satine')
					),
					'header-minimal'           => array(
						'image' => ELATED_FRAMEWORK_ROOT.'/admin/assets/img/header-minimal.png',
						'label' => esc_html__('Minimal', 'satine')
					),
					'header-divided'           => array(
						'image' => ELATED_FRAMEWORK_ROOT.'/admin/assets/img/header-divided.png',
						'label' => esc_html__('Divided', 'satine')
					),
					'header-centered'          => array(
						'image' => ELATED_FRAMEWORK_ROOT.'/admin/assets/img/header-centered.png',
						'label' => esc_html__('Centered', 'satine')
					),
					'header-vertical'          => array(
						'image' => ELATED_FRAMEWORK_ROOT.'/admin/assets/img/header-vertical.png',
						'label' => esc_html__('Vertical', 'satine')
					)
				),
				'args' => array(
					'use_images' => true,
					'hide_labels' => true,
					'dependence' => true,
					'show' => array(
						'header-standard'          => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header,#eltdf_menu_area_position_header_standard_container',
						'header-standard-extended' => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_logo_area_container,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header',
						'header-box'               => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header',
						'header-minimal'           => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_panel_fullscreen_menu,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header',
						'header-divided'           => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header',
						'header-centered'          => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_logo_area_container,#eltdf_logo_wrapper_padding_header_centered,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header',
						'header-top-menu'		   => '#eltdf_menu_area_container,#eltdf_logo_area_container,#eltdf_panel_main_menu',
						'header-tabbed'            => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header',
						'header-vertical'          => '#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu',
						'header-vertical-compact'  => '#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu',
						'header-vertical-closed'   => '#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu',
					),
					'hide' => array(
						'header-standard'          => '#eltdf_logo_area_container,#eltdf_panel_fullscreen_menu,#eltdf_logo_wrapper_padding_header_centered,#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu',
						'header-standard-extended' => '#eltdf_panel_fullscreen_menu,#eltdf_logo_wrapper_padding_header_centered,#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu,#eltdf_menu_area_position_header_standard_container',
						'header-box'               => '#eltdf_logo_area_container,#eltdf_panel_fullscreen_menu,#eltdf_logo_wrapper_padding_header_centered,#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu,#eltdf_menu_area_position_header_standard_container',
						'header-minimal'           => '#eltdf_logo_area_container,#eltdf_logo_wrapper_padding_header_centered,#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu,#eltdf_menu_area_position_header_standard_container',
						'header-divided'           => '#eltdf_logo_area_container,#eltdf_panel_fullscreen_menu,#eltdf_logo_wrapper_padding_header_centered,#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu,#eltdf_menu_area_position_header_standard_container',
						'header-centered'          => '#eltdf_panel_fullscreen_menu,#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu,#eltdf_menu_area_position_header_standard_container',
						'header-top-menu'		   => '#eltdf_top_header_container,#eltdf_panel_fullscreen_menu,#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu,#eltdf_logo_wrapper_padding_header_centered,#eltdf_header_behaviour,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header,#eltdf_menu_area_position_header_standard_container',
						'header-tabbed'            => '#eltdf_logo_area_container,#eltdf_panel_fullscreen_menu,#eltdf_logo_wrapper_padding_header_centered,#eltdf_vertical_area_container,#eltdf_panel_vertical_main_menu,#eltdf_menu_area_position_header_standard_container',
						'header-vertical'          => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_logo_area_container,#eltdf_panel_fullscreen_menu,#eltdf_logo_wrapper_padding_header_centered,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header',
						'header-vertical-compact'  => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_logo_area_container,#eltdf_panel_fullscreen_menu,#eltdf_logo_wrapper_padding_header_centered,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header',
						'header-vertical-closed'  => '#eltdf_top_header_container,#eltdf_header_behaviour,#eltdf_menu_area_container,#eltdf_logo_area_container,#eltdf_panel_fullscreen_menu,#eltdf_logo_wrapper_padding_header_centered,#eltdf_panel_main_menu,#eltdf_panel_sticky_header,#eltdf_panel_fixed_header',
					)
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_behaviour',
				'default_value' => 'fixed-on-scroll',
				'label' => esc_html__('Choose Header Behaviour', 'satine'),
				'description' => esc_html__('Select the behaviour of header when you scroll down to page', 'satine'),
				'options' => array(
					'sticky-header-on-scroll-up' => esc_html__('Sticky on scroll up', 'satine'),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scroll up/down', 'satine'),
					'fixed-on-scroll' => esc_html__('Fixed on scroll', 'satine')
				),
                'hidden_property' => 'header_type',
                'hidden_values' => array('header-vertical','header-vertical-compact','header-vertical-closed','header-top-menu')
			)
		);

		/***************** Top Header Layout - start **********************/

		do_action('satine_elated_header_top_options_map', $panel_header);

		/***************** Top Header Layout - end **********************/
		
		/***************** Header Skin Options -start ********************/
		
			satine_elated_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'select',
					'name' => 'header_style',
					'default_value' => '',
					'label' => esc_html__('Header Skin', 'satine'),
					'description' => esc_html__('Choose a predefined header style for header elements (logo, main menu, side menu opener...)', 'satine'),
					'options' => array(
						'' => esc_html__('Default', 'satine'),
						'light-header' => esc_html__('Light', 'satine'),
						'dark-header' => esc_html__('Dark', 'satine')
					)
				)
			);
		/***************** Header Skin Options - end ********************/

		/***************** Logo Area Style - start **********************/
		do_action('satine_elated_header_logo_area_options_map', $panel_header);
		/***************** Logo Area Style - end **********************/

		/***************** Menu Area Style - start **********************/
		do_action('satine_elated_header_menu_area_options_map', $panel_header);
		/***************** Menu Area Style - end **********************/

		/***************** Vertical Header Layout *****************/
		do_action('satine_elated_header_vertical_options_map', $panel_header);
		/***************** Vertical Header Layout *****************/

		/***************** Full Screen Menu Style - start **********************/
		do_action('satine_elated_header_options_map');
		/***************** Full Screen Menu Style - end **********************/

        /***************** Sticky Header Layout *******************/
		do_action('satine_elated_header_sticky_options_map');
		/***************** Sticky Header Layout *******************/	

		/***************** Fixed Header Layout ********************/
		do_action('satine_elated_header_fixed_options_map');
		/***************** Fixed Header Layout ********************/	

		/******************* Main Menu Layout *********************/
		do_action('satine_elated_header_main_navigation_options_map');
        /******************* Main Menu Layout *********************/

		/****************** Vertical Main Menu Layout ********************/
		do_action('satine_elated_header_vertical_navigation_options_map');
		/****************** Vertical Main Menu Layout ********************/

		/****************** Vertical Main Menu Layout ********************/
		do_action('satine_elated_header_mobile_header_options_map');
		/****************** Vertical Main Menu Layout ********************/

	}

	add_action( 'satine_elated_options_map', 'satine_elated_header_options_map', 3);
}