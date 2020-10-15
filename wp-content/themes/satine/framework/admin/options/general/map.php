<?php

if ( ! function_exists('satine_elated_general_options_map') ) {
    /**
     * General options page
     */
    function satine_elated_general_options_map() {

        satine_elated_add_admin_page(
            array(
                'slug'  => '',
                'title' => esc_html__('General', 'satine'),
                'icon'  => 'fa fa-institution'
            )
        );

        $panel_appearance_style = satine_elated_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_appearance',
                'title' => esc_html__('Appearance', 'satine')
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Google Font Family', 'satine'),
                'description'   => esc_html__('Choose a default Google font for your site', 'satine'),
                'parent' => $panel_appearance_style
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Additional Google Fonts', 'satine'),
                'parent'        => $panel_appearance_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#eltdf_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = satine_elated_add_admin_container(
            array(
                'parent'            => $panel_appearance_style,
                'name'              => 'additional_google_fonts_container',
                'hidden_property'   => 'additional_google_fonts',
                'hidden_value'      => 'no'
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'satine'),
                'description'   => esc_html__('Choose additional Google font for your site', 'satine'),
                'parent'        => $additional_google_fonts_container
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'satine'),
                'description'   => esc_html__('Choose additional Google font for your site', 'satine'),
                'parent'        => $additional_google_fonts_container
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'satine'),
                'description'   => esc_html__('Choose additional Google font for your site', 'satine'),
                'parent'        => $additional_google_fonts_container
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'satine'),
                'description'   => esc_html__('Choose additional Google font for your site', 'satine'),
                'parent'        => $additional_google_fonts_container
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'satine'),
                'description'   => esc_html__('Choose additional Google font for your site', 'satine'),
                'parent'        => $additional_google_fonts_container
            )
        );

        satine_elated_add_admin_field(
            array(
                'name' => 'google_font_weight',
                'type' => 'checkboxgroup',
                'default_value' => '',
                'label' => esc_html__('Google Fonts Style & Weight', 'satine'),
                'description' => esc_html__('Choose a default Google font weights for your site. Impact on page load time', 'satine'),
                'parent' => $panel_appearance_style,
                'options' => array(
                    '100'       => esc_html__('100 Thin', 'satine'),
                    '100italic' => esc_html__('100 Thin Italic', 'satine'),
                    '200'       => esc_html__('200 Extra-Light', 'satine'),
                    '200italic' => esc_html__('200 Extra-Light Italic', 'satine'),
                    '300'       => esc_html__('300 Light', 'satine'),
                    '300italic' => esc_html__('300 Light Italic', 'satine'),
                    '400'       => esc_html__('400 Regular', 'satine'),
                    '400italic' => esc_html__('400 Regular Italic', 'satine'),
                    '500'       => esc_html__('500 Medium', 'satine'),
                    '500italic' => esc_html__('500 Medium Italic', 'satine'),
                    '600'       => esc_html__('600 Semi-Bold', 'satine'),
                    '600italic' => esc_html__('600 Semi-Bold Italic', 'satine'),
                    '700'       => esc_html__('700 Bold', 'satine'),
                    '700italic' => esc_html__('700 Bold Italic', 'satine'),
                    '800'       => esc_html__('800 Extra-Bold', 'satine'),
                    '800italic' => esc_html__('800 Extra-Bold Italic', 'satine'),
                    '900'       => esc_html__('900 Ultra-Bold', 'satine'),
                    '900italic' => esc_html__('900 Ultra-Bold Italic', 'satine')
                )
            )
        );

        satine_elated_add_admin_field(
            array(
                'name' => 'google_font_subset',
                'type' => 'checkboxgroup',
                'default_value' => '',
                'label' => esc_html__('Google Fonts Subset', 'satine'),
                'description' => esc_html__('Choose a default Google font subsets for your site', 'satine'),
                'parent' => $panel_appearance_style,
                'options' => array(
                    'latin' => esc_html__('Latin', 'satine'),
                    'latin-ext' => esc_html__('Latin Extended', 'satine'),
                    'cyrillic' => esc_html__('Cyrillic', 'satine'),
                    'cyrillic-ext' => esc_html__('Cyrillic Extended', 'satine'),
                    'greek' => esc_html__('Greek', 'satine'),
                    'greek-ext' => esc_html__('Greek Extended', 'satine'),
                    'vietnamese' => esc_html__('Vietnamese', 'satine')
                )
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'first_color',
                'type'          => 'color',
                'label'         => esc_html__('First Main Color', 'satine'),
                'description'   => esc_html__('Choose the most dominant theme color. Default color is #00bbb3', 'satine'),
                'parent'        => $panel_appearance_style
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'page_background_color',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color', 'satine'),
                'description'   => esc_html__('Choose the background color for page content. Default color is #ffffff', 'satine'),
                'parent'        => $panel_appearance_style
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'selection_color',
                'type'          => 'color',
                'label'         => esc_html__('Text Selection Color', 'satine'),
                'description'   => esc_html__('Choose the color users see when selecting text', 'satine'),
                'parent'        => $panel_appearance_style
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Boxed Layout', 'satine'),
                'description'   => '',
                'parent'        => $panel_appearance_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#eltdf_boxed_container"
                )
            )
        );

        $boxed_container = satine_elated_add_admin_container(
            array(
                'parent'            => $panel_appearance_style,
                'name'              => 'boxed_container',
                'hidden_property'   => 'boxed',
                'hidden_value'      => 'no'
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'page_background_color_in_box',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color', 'satine'),
                'description'   => esc_html__('Choose the page background color outside box', 'satine'),
                'parent'        => $boxed_container
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'boxed_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Image', 'satine'),
                'description'   => esc_html__('Choose an image to be displayed in background', 'satine'),
                'parent'        => $boxed_container
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'boxed_pattern_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Pattern', 'satine'),
                'description'   => esc_html__('Choose an image to be used as background pattern', 'satine'),
                'parent'        => $boxed_container
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'satine'),
                'description'   => esc_html__('Choose background image attachment', 'satine'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'     => esc_html__('Fixed', 'satine'),
                    'scroll'    => esc_html__('Scroll', 'satine')
                )
            )
        );
        
        satine_elated_add_admin_field(
            array(
                'name'          => 'paspartu',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Passepartout', 'satine'),
                'description'   => esc_html__('Enabling this option will display passepartout around site content', 'satine'),
                'parent'        => $panel_appearance_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#eltdf_paspartu_container"
                )
            )
        );

        $paspartu_container = satine_elated_add_admin_container(
            array(
                'parent'            => $panel_appearance_style,
                'name'              => 'paspartu_container',
                'hidden_property'   => 'paspartu',
                'hidden_value'      => 'no'
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'paspartu_color',
                'type'          => 'color',
                'label'         => esc_html__('Passepartout Color', 'satine'),
                'description'   => esc_html__('Choose passepartout color, default value is #ffffff', 'satine'),
                'parent'        => $paspartu_container
            )
        );

        satine_elated_add_admin_field(
            array(
                'name' => 'paspartu_width',
                'type' => 'text',
                'label' => esc_html__('Passepartout Size', 'satine'),
                'description' => esc_html__('Enter size amount for passepartout', 'satine'),
                'parent' => $paspartu_container,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => '%'
                )
            )
        );

        satine_elated_add_admin_field(
            array(
                'parent' => $paspartu_container,
                'type' => 'yesno',
                'default_value' => 'no',
                'name' => 'disable_top_paspartu',
                'label' => esc_html__('Disable Top Passepartout', 'satine')
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => 'eltdf-grid-1300',
                'label'         => esc_html__('Initial Width of Content', 'satine'),
                'description'   => esc_html__('Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'satine'),
                'parent'        => $panel_appearance_style,
                'options'       => array(
                    'eltdf-grid-1100' => esc_html__('1100px', 'satine'),
                    'eltdf-grid-1300' => esc_html__('1300px - default', 'satine'),
                    'eltdf-grid-1200' => esc_html__('1200px', 'satine'),
                    'eltdf-grid-1000' => esc_html__('1000px', 'satine'),
                    'eltdf-grid-800'  => esc_html__('800px', 'satine')
                )
            )
        );

        $panel_settings = satine_elated_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => esc_html__('Behaviour', 'satine')
            )
        );

		satine_elated_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'satine' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'satine' ),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltdf_page_transitions_container, #eltdf_svg_path_container"
				)
			)
		);

		$page_transitions_container = satine_elated_add_admin_container(
			array(
				'parent'          => $panel_settings,
				'name'            => 'page_transitions_container',
				'hidden_property' => 'smooth_page_transitions',
				'hidden_value'    => 'no'
			)
		);

		satine_elated_add_admin_field(
			array(
				'name'          => 'page_transition_preloader',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Preloading Animation', 'satine' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'satine' ),
				'parent'        => $page_transitions_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltdf_page_transition_preloader_container"
				)
			)
		);

		$page_transition_preloader_container = satine_elated_add_admin_container(
			array(
				'parent'          => $page_transitions_container,
				'name'            => 'page_transition_preloader_container',
				'hidden_property' => 'page_transition_preloader',
				'hidden_value'    => 'no'
			)
		);


		satine_elated_add_admin_field(
			array(
				'name'   => 'smooth_pt_bgnd_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'satine' ),
				'parent' => $page_transition_preloader_container
			)
		);

		$group_pt_spinner_animation = satine_elated_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation',
				'title'       => esc_html__( 'Loader Style', 'satine' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'satine' ),
				'parent'      => $page_transition_preloader_container
			)
		);

		$row_pt_spinner_animation = satine_elated_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation',
				'parent' => $group_pt_spinner_animation
			)
		);

		satine_elated_add_admin_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'smooth_pt_spinner_type',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'satine' ),
				'parent'        => $row_pt_spinner_animation,
				'options'       => array(
                    'satine'                => esc_html__( 'Satine', 'satine'),
					'rotate_circles'        => esc_html__( 'Rotate Circles', 'satine' ),
					'pulse'                 => esc_html__( 'Pulse', 'satine' ),
					'double_pulse'          => esc_html__( 'Double Pulse', 'satine' ),
					'cube'                  => esc_html__( 'Cube', 'satine' ),
					'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'satine' ),
					'stripes'               => esc_html__( 'Stripes', 'satine' ),
					'wave'                  => esc_html__( 'Wave', 'satine' ),
					'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'satine' ),
					'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'satine' ),
					'atom'                  => esc_html__( 'Atom', 'satine' ),
					'clock'                 => esc_html__( 'Clock', 'satine' ),
					'mitosis'               => esc_html__( 'Mitosis', 'satine' ),
					'lines'                 => esc_html__( 'Lines', 'satine' ),
					'fussion'               => esc_html__( 'Fussion', 'satine' ),
					'wave_circles'          => esc_html__( 'Wave Circles', 'satine' ),
					'pulse_circles'         => esc_html__( 'Pulse Circles', 'satine' )
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'smooth_pt_spinner_color',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'satine' ),
				'parent'        => $row_pt_spinner_animation
			)
		);

		satine_elated_add_admin_field(
			array(
				'name'          => 'page_transition_fadeout',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'satine' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'satine' ),
				'parent'        => $page_transitions_container
			)
		);

        satine_elated_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show "Back To Top Button"', 'satine'),
                'description'   => esc_html__('Enabling this option will display a Back to Top button on every page', 'satine'),
                'parent'        => $panel_settings
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Responsiveness', 'satine'),
                'description'   => esc_html__('Enabling this option will make all pages responsive', 'satine'),
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = satine_elated_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => esc_html__('Custom Code', 'satine')
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'custom_css',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom CSS', 'satine'),
                'description'   => esc_html__('Enter your custom CSS here', 'satine'),
                'parent'        => $panel_custom_code
            )
        );

        satine_elated_add_admin_field(
            array(
                'name'          => 'custom_js',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom JS', 'satine'),
                'description'   => esc_html__('Enter your custom Javascript here', 'satine'),
                'parent'        => $panel_custom_code
            )
        );
	
	    $panel_google_api = satine_elated_add_admin_panel(
		    array(
			    'page'  => '',
			    'name'  => 'panel_google_api',
			    'title' => esc_html__('Google API', 'satine')
		    )
	    );
	
	    satine_elated_add_admin_field(
		    array(
			    'name'        => 'google_maps_api_key',
			    'type'        => 'text',
			    'label'       => esc_html__('Google Maps Api Key', 'satine'),
			    'description' => esc_html__('Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'satine'),
			    'parent'      => $panel_google_api
		    )
	    );
    }

    add_action( 'satine_elated_options_map', 'satine_elated_general_options_map', 1);
}