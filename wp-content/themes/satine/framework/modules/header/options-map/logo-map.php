<?php

if ( ! function_exists('satine_elated_logo_options_map') ) {
    /**
     * Logo options page
     */
    function satine_elated_logo_options_map() {

        satine_elated_add_admin_page(
            array(
                'slug'  => '_logo_page',
                'title' => esc_html__('Logo', 'satine'),
                'icon'  => 'fa fa-coffee'
            )
        );

		$panel_logo = satine_elated_add_admin_panel(
			array(
				'page' => '_logo_page',
				'name' => 'panel_logo',
				'title' => esc_html__('Logo', 'satine')
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent' => $panel_logo,
				'type' => 'yesno',
				'name' => 'hide_logo',
				'default_value' => 'no',
				'label' => esc_html__('Hide Logo', 'satine'),
				'description' => esc_html__('Enabling this option will hide logo image', 'satine'),
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#eltdf_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$hide_logo_container = satine_elated_add_admin_container(
			array(
				'parent' => $panel_logo,
				'name' => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value' => 'yes'
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'logo_image',
				'type' => 'image',
				'default_value' => ELATED_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Default', 'satine'),
				'parent' => $hide_logo_container
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'logo_image_dark',
				'type' => 'image',
				'default_value' => ELATED_ASSETS_ROOT."/img/logo_dark.png",
				'label' => esc_html__('Logo Image - Dark', 'satine'),
				'parent' => $hide_logo_container
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'logo_image_light',
				'type' => 'image',
				'default_value' => ELATED_ASSETS_ROOT."/img/logo_white.png",
				'label' => esc_html__('Logo Image - Light', 'satine'),
				'parent' => $hide_logo_container
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'logo_image_sticky',
				'type' => 'image',
				'default_value' => ELATED_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Sticky', 'satine'),
				'parent' => $hide_logo_container
			)
		);

		satine_elated_add_admin_field(
			array(
				'name' => 'logo_image_mobile',
				'type' => 'image',
				'default_value' => ELATED_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Mobile', 'satine'),
				'parent' => $hide_logo_container
			)
		);

    }

    add_action( 'satine_elated_options_map', 'satine_elated_logo_options_map', 2);
}