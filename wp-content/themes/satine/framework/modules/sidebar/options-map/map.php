<?php

if ( ! function_exists('satine_elated_sidebar_options_map') ) {

	function satine_elated_sidebar_options_map() {

		$sidebar_panel = satine_elated_add_admin_panel(
			array(
				'title' => esc_html__('Sidebar Area', 'satine'),
				'name' => 'sidebar',
				'page' => '_page_page'
			)
		);
		
		satine_elated_add_admin_field(array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__('Sidebar Layout', 'satine'),
			'description'   => esc_html__('Choose a sidebar layout for pages', 'satine'),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
			'options'       => array(
				'no-sidebar'        => esc_html__('No Sidebar', 'satine'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'satine'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'satine'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'satine'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'satine')
			)
		));
		
		$satine_custom_sidebars = satine_elated_get_custom_sidebars();
		if(count($satine_custom_sidebars) > 0) {
			satine_elated_add_admin_field(array(
				'name' => 'custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'satine'),
				'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'satine'),
				'parent' => $sidebar_panel,
				'options' => $satine_custom_sidebars
			));
		}
	}

	add_action('satine_elated_page_options_map', 'satine_elated_sidebar_options_map', 6);
}