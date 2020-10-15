<?php

if(!function_exists('satine_elated_register_required_plugins')) {
    /**
     * Registers Visual Composer, Revolution Slider, Elated Core, Elated Instagram Feed, Elated Twitter Feed  as required plugins. Hooks to tgmpa_register hook
     */
    function satine_elated_register_required_plugins() {
        $plugins = array(
            array(
                'name'               => esc_html__('WPBakery Visual Composer', 'satine'),
                'slug'               => 'js_composer',
                'source'             => get_template_directory().'/includes/plugins/js_composer.zip',
                'required'           => true,
                'version'            => '5.4.5',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => esc_html__('Revolution Slider', 'satine'),
                'slug'               => 'revslider',
                'source'             => get_template_directory().'/includes/plugins/revslider.zip',
                'version'            => '5.4.6.4',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'         			=> esc_html__('Envato Market', 'satine'),
                'slug'         			=> 'envato-market',
                'source'       			=> get_template_directory().'/includes/plugins/envato-market.zip',
                'required'     			=> true,
                'force_activation' 			=> false,
                'force_deactivation' 		=> false,
                'external_url' 			=> '',
            ),
            array(
                'name'               => esc_html__('Elated Core', 'satine'),
                'slug'               => 'elated-core',
                'source'             => get_template_directory().'/includes/plugins/elated-core.zip',
                'required'           => true,
                'version'            => '1.0.1',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => esc_html__('Elated Instagram Feed', 'satine'),
                'slug'               => 'elated-instagram-feed',
                'source'             => get_template_directory().'/includes/plugins/elated-instagram-feed.zip',
                'required'           => true,
                'version'            => '1.0',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => esc_html__('Elated Twitter Feed', 'satine'),
                'slug'               => 'elated-twitter-feed',
                'source'             => get_template_directory().'/includes/plugins/elated-twitter-feed.zip',
                'required'           => true,
                'version'            => '1.0',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
			array(
				'name'               => esc_html__('Elated Membership', 'satine'),
				'slug'               => 'elated-membership',
				'source'             => get_template_directory().'/includes/plugins/elated-membership.zip',
				'required'           => true,
				'version'            => '1.0',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
            array(
                'name'         => esc_html__( 'WooCommerce plugin', 'satine' ),
                'slug'         => 'woocommerce',
                'external_url' => 'https://wordpress.org/plugins/woocommerce/',
                'required'     => false
            ),
            array(
                'name'         => esc_html__( 'Contact Form 7', 'satine' ),
                'slug'         => 'contact-form-7',
                'external_url' => 'https://wordpress.org/plugins/contact-form-7/',
                'required'     => false
            )
        );

        $config = array(
            'domain'           => 'satine',
            'default_path'     => '',
            'parent_slug' 	   => 'themes.php',
            'capability' 	   => 'edit_theme_options',
            'menu'             => 'install-required-plugins',
            'has_notices'      => true,
            'is_automatic'     => false,
            'message'          => '',
            'strings'          => array(
                'page_title'                      => esc_html__('Install Required Plugins', 'satine'),
                'menu_title'                      => esc_html__('Install Plugins', 'satine'),
                'installing'                      => esc_html__('Installing Plugin: %s', 'satine'),
                'oops'                            => esc_html__('Something went wrong with the plugin API.', 'satine'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'satine'),
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'satine'),
                'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'satine'),
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'satine'),
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'satine'),
                'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'satine'),
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'satine'),
                'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'satine'),
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'satine'),
                'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins', 'satine'),
                'return'                          => esc_html__('Return to Required Plugins Installer', 'satine'),
                'plugin_activated'                => esc_html__('Plugin activated successfully.', 'satine'),
                'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'satine'),
                'nag_type'                        => 'updated'
            )
        );

        tgmpa($plugins, $config);
    }

    add_action('tgmpa_register', 'satine_elated_register_required_plugins');
}