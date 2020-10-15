<?php

if(!function_exists('satine_elated_map_general_meta')) {

    function satine_elated_map_general_meta() {

        $general_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('General', 'satine'),
                'name' => 'general_meta'
            )
        );

		satine_elated_add_meta_box_field(
			array(
				'name'          => 'eltdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'satine' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'satine' ),
				'parent'        => $general_meta_box,
				'options'     => satine_elated_get_yes_no_select_array(),
				'args'          => array(
					"dependence"             => true,
					"hide"       => array(
						""    => "#eltdf_page_transitions_container_meta",
						"no"  => "#eltdf_page_transitions_container_meta",
						"yes" => ""
					),
					"show"       => array(
						""    => "",
						"no"  => "",
						"yes" => "#eltdf_page_transitions_container_meta"
					)
				)
			)
		);

		$page_transitions_container_meta = satine_elated_add_admin_container(
			array(
				'parent'          => $general_meta_box,
				'name'            => 'page_transitions_container_meta',
				'hidden_property' => 'eltdf_smooth_page_transitions_meta',
				'hidden_values'   => array('','no')
			)
		);

		satine_elated_add_meta_box_field(
			array(
				'name'          => 'eltdf_page_transition_preloader_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Preloading Animation', 'satine' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'satine' ),
				'parent'        => $page_transitions_container_meta,
				'options'     => satine_elated_get_yes_no_select_array(),
				'args'          => array(
					"dependence"             => true,
					"hide"       => array(
						""    => "#eltdf_page_transition_preloader_container_meta",
						"no"  => "#eltdf_page_transition_preloader_container_meta",
						"yes" => ""
					),
					"show"       => array(
						""    => "",
						"no"  => "",
						"yes" => "#eltdf_page_transition_preloader_container_meta"
					)
				)
			)
		);

		$page_transition_preloader_container_meta = satine_elated_add_admin_container(
			array(
				'parent'          => $page_transitions_container_meta,
				'name'            => 'page_transition_preloader_container_meta',
				'hidden_property' => 'eltdf_page_transition_preloader_meta',
				'hidden_values'   => array('','no')
			)
		);

		satine_elated_add_meta_box_field(
			array(
				'name'   => 'eltdf_smooth_pt_bgnd_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'satine' ),
				'parent' => $page_transition_preloader_container_meta
			)
		);

		$group_pt_spinner_animation_meta = satine_elated_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation_meta',
				'title'       => esc_html__( 'Loader Style', 'satine' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'satine' ),
				'parent'      => $page_transition_preloader_container_meta
			)
		);

		$row_pt_spinner_animation_meta = satine_elated_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation_meta',
				'parent' => $group_pt_spinner_animation_meta
			)
		);

		satine_elated_add_meta_box_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'eltdf_smooth_pt_spinner_type_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'satine' ),
				'parent'        => $row_pt_spinner_animation_meta,
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

		satine_elated_add_meta_box_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'eltdf_smooth_pt_spinner_color_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'satine' ),
				'parent'        => $row_pt_spinner_animation_meta
			)
		);

		satine_elated_add_meta_box_field(
			array(
				'name'          => 'eltdf_page_transition_fadeout_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'satine' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'satine' ),
				'options'     => satine_elated_get_yes_no_select_array(),
				'parent'        => $page_transitions_container_meta

			)
		);

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_page_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Page Background Color', 'satine'),
                'description' => esc_html__('Choose background color for page content', 'satine'),
                'parent' => $general_meta_box
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_page_slider_meta',
                'type' => 'text',
                'default_value' => '',
                'label' => esc_html__('Slider Shortcode', 'satine'),
                'description' => esc_html__('Paste your slider shortcode here', 'satine'),
                'parent' => $general_meta_box
            )
        );

        $eltdf_content_padding_group = satine_elated_add_admin_group(array(
            'name' => 'content_padding_group',
            'title' => esc_html__('Content Style', 'satine'),
            'description' => esc_html__('Define styles for Content area', 'satine'),
            'parent' => $general_meta_box
        ));

        $eltdf_content_padding_row = satine_elated_add_admin_row(array(
            'name' => 'eltdf_content_padding_row',
            'next' => true,
            'parent' => $eltdf_content_padding_group
        ));

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_page_content_top_padding',
                'type' => 'textsimple',
                'default_value' => '',
                'label' => esc_html__('Content Top Padding', 'satine'),
                'parent' => $eltdf_content_padding_row,
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_page_content_top_padding_mobile',
                'type' => 'selectsimple',
                'label' => esc_html__('Set this top padding for mobile header', 'satine'),
                'parent' => $eltdf_content_padding_row,
                'options' => satine_elated_get_yes_no_select_array(false)
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_page_comments_meta',
                'type' => 'select',
                'label' => esc_html__('Show Comments', 'satine'),
                'description' => esc_html__('Enabling this option will show comments on your page', 'satine'),
                'parent' => $general_meta_box,
                'options' => satine_elated_get_yes_no_select_array()
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'          => 'eltdf_boxed_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Boxed Layout', 'satine'),
                'parent'        => $general_meta_box,
                'options'     => array(
                    '' => '',
                    'yes' => esc_html__('Yes', 'satine'),
                    'no' => esc_html__('No', 'satine'),
                ),
                'args'          => array(
                    "dependence" => true,
                    'show' => array(
                        '' => '',
                        'yes' => '#eltdf_eltdf_boxed_container_meta',
                        'no' => '',

                    ),
                    'hide' => array(
                        '' => '#eltdf_eltdf_boxed_container_meta',
                        'yes' => '',
                        'no' => '#eltdf_eltdf_boxed_container_meta',
                    )
                )
            )
        );

        $boxed_container = satine_elated_add_admin_container(
            array(
                'parent'            => $general_meta_box,
                'name'              => 'eltdf_boxed_container_meta',
                'hidden_property'   => 'eltdf_boxed_meta',
                'hidden_values'     => array('','no')
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_page_background_color_in_box_meta',
                'type'        => 'color',
                'label'       => esc_html__('Page Background Color', 'satine'),
                'description' => esc_html__('Choose the page background color outside box.', 'satine'),
                'parent'      => $boxed_container
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_boxed_pattern_background_image_meta',
                'type'        => 'image',
                'label'       => esc_html__('Background Pattern', 'satine'),
                'description' => esc_html__('Choose an image to be used as background pattern', 'satine'),
                'parent'      => $boxed_container
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_boxed_background_image_meta',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'satine'),
                'description' => esc_html__('Choose an image to be displayed in background', 'satine'),
                'parent'      => $boxed_container,
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'          => 'eltdf_boxed_background_image_attachment_meta',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'satine'),
                'description'   => esc_html__('Choose background image attachment if background image option is set', 'satine'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'  => esc_html__('Fixed', 'satine'),
                    'scroll' => esc_html__('Scroll', 'satine')
                )
            )
        );
    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_general_meta', 10);
}