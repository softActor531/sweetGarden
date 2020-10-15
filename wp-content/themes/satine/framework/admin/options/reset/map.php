<?php

if ( ! function_exists('satine_elated_reset_options_map') ) {
	/**
	 * Reset options panel
	 */
	function satine_elated_reset_options_map() {

		satine_elated_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__('Reset', 'satine'),
				'icon'  => 'fa fa-retweet'
			)
		);

		$panel_reset = satine_elated_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__('Reset', 'satine')
			)
		);

		satine_elated_add_admin_field(array(
			'type'	=> 'yesno',
			'name'	=> 'reset_to_defaults',
			'default_value'	=> 'no',
			'label'			=> esc_html__('Reset to Defaults', 'satine'),
			'description'	=> esc_html__('This option will reset all Select Options values to defaults', 'satine'),
			'parent'		=> $panel_reset
		));
	}

	add_action( 'satine_elated_options_map', 'satine_elated_reset_options_map', 18);
}