<?php

if(!function_exists('satine_elated_map_title_meta')) {
    function satine_elated_map_title_meta() {
        $title_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Title', 'satine'),
                'name' => 'title_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_show_title_area_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Title Area', 'satine'),
                'description' => esc_html__('Disabling this option will turn off page title area', 'satine'),
                'parent' => $title_meta_box,
                'options' => satine_elated_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "#eltdf_eltdf_show_title_area_meta_container",
                        "yes" => ""
                    ),
                    "show" => array(
                        "" => "#eltdf_eltdf_show_title_area_meta_container",
                        "no" => "",
                        "yes" => "#eltdf_eltdf_show_title_area_meta_container"
                    )
                )
            )
        );

        $show_title_area_meta_container = satine_elated_add_admin_container(
            array(
                'parent' => $title_meta_box,
                'name' => 'eltdf_show_title_area_meta_container',
                'hidden_property' => 'eltdf_show_title_area_meta',
                'hidden_value' => 'no'
            )
        );

         satine_elated_add_meta_box_field(
            array(
                'type' => 'select',
                'name' => 'eltdf_title_in_grid_meta',
                'default_value' => '',
                'label' => esc_html__('Title in Grid', 'satine'),
                'description' => esc_html__('Enabling this option will place Title content in grid', 'satine'),
                'parent' => $show_title_area_meta_container,
                'options' => satine_elated_get_yes_no_select_array(),
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_area_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Title Area Type', 'satine'),
                'description' => esc_html__('Choose title type', 'satine'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'satine'),
                    'standard' => esc_html__('Standard', 'satine'),
                    'breadcrumb' => esc_html__('Breadcrumb', 'satine')
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "standard" => "",
                        "breadcrumb" => "#eltdf_eltdf_title_area_type_meta_container"
                    ),
                    "show" => array(
                        "" => "#eltdf_eltdf_title_area_type_meta_container",
                        "standard" => "#eltdf_eltdf_title_area_type_meta_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_meta_container = satine_elated_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'eltdf_title_area_type_meta_container',
                'hidden_property' => 'eltdf_title_area_type_meta',
                'hidden_value' => 'breadcrumb'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_area_enable_breadcrumbs_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Breadcrumbs', 'satine'),
                'description' => esc_html__('This option will display Breadcrumbs in Title Area', 'satine'),
                'parent' => $title_area_type_meta_container,
                'options' => satine_elated_get_yes_no_select_array()
            )
        );



        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_area_vertical_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Vertical Alignment', 'satine'),
                'description' => esc_html__('Specify title vertical alignment', 'satine'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'satine'),
                    'header_bottom' => esc_html__('From Bottom of Header', 'satine'),
                    'window_top' => esc_html__('From Window Top', 'satine')
                )
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_area_content_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Horizontal Alignment', 'satine'),
                'description' => esc_html__('Specify title horizontal alignment', 'satine'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'satine'),
                    'left' => esc_html__('Left', 'satine'),
                    'center' => esc_html__('Center', 'satine'),
                    'right' => esc_html__('Right', 'satine')
                )
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_area_title_tag_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Title Tag', 'satine'),
                'parent' => $title_area_type_meta_container,
                'options' => satine_elated_get_title_tag(true)
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_text_color_meta',
                'type' => 'color',
                'label' => esc_html__('Title Color', 'satine'),
                'description' => esc_html__('Choose a color for title text', 'satine'),
                'parent' => $show_title_area_meta_container
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_area_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Background Color', 'satine'),
                'description' => esc_html__('Choose a background color for title area', 'satine'),
                'parent' => $show_title_area_meta_container
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_hide_background_image_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Hide Background Image', 'satine'),
                'description' => esc_html__('Enable this option to hide background image in title area', 'satine'),
                'parent' => $show_title_area_meta_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#eltdf_eltdf_hide_background_image_meta_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_background_image_meta_container = satine_elated_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'eltdf_hide_background_image_meta_container',
                'hidden_property' => 'eltdf_hide_background_image_meta',
                'hidden_value' => 'yes'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_area_background_image_meta',
                'type' => 'image',
                'label' => esc_html__('Background Image', 'satine'),
                'description' => esc_html__('Choose an Image for title area', 'satine'),
                'parent' => $hide_background_image_meta_container
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_area_background_image_responsive_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Background Responsive Image', 'satine'),
                'description' => esc_html__('Enabling this option will make Title background image responsive', 'satine'),
                'parent' => $hide_background_image_meta_container,
                'options' => satine_elated_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "",
                        "yes" => "#eltdf_eltdf_title_area_background_image_responsive_meta_container, #eltdf_eltdf_title_area_height_meta"
                    ),
                    "show" => array(
                        "" => "#eltdf_eltdf_title_area_background_image_responsive_meta_container, #eltdf_eltdf_title_area_height_meta",
                        "no" => "#eltdf_eltdf_title_area_background_image_responsive_meta_container, #eltdf_eltdf_title_area_height_meta",
                        "yes" => ""
                    )
                )
            )
        );

        $title_area_background_image_responsive_meta_container = satine_elated_add_admin_container(
            array(
                'parent' => $hide_background_image_meta_container,
                'name' => 'eltdf_title_area_background_image_responsive_meta_container',
                'hidden_property' => 'eltdf_title_area_background_image_responsive_meta',
                'hidden_value' => 'yes'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_title_area_background_image_parallax_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Background Image in Parallax', 'satine'),
                'description' => esc_html__('Enabling this option will make Title background image parallax', 'satine'),
                'parent' => $title_area_background_image_responsive_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'satine'),
                    'no' => esc_html__('No', 'satine'),
                    'yes' => esc_html__('Yes', 'satine'),
                    'yes_zoom' => esc_html__('Yes, with zoom out', 'satine')
                )
            )
        );

        satine_elated_add_meta_box_field(array(
            'name' => 'eltdf_title_area_height_meta',
            'type' => 'text',
            'label' => esc_html__('Height', 'satine'),
            'description' => esc_html__('Set a height for Title Area', 'satine'),
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        ));

        satine_elated_add_meta_box_field(array(
            'name' => 'eltdf_title_area_subtitle_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => esc_html__('Subtitle Text', 'satine'),
            'description' => esc_html__('Enter your subtitle text', 'satine'),
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 6
            )
        ));

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_subtitle_color_meta',
                'type' => 'color',
                'label' => esc_html__('Subtitle Color', 'satine'),
                'description' => esc_html__('Choose a color for subtitle text', 'satine'),
                'parent' => $show_title_area_meta_container
            )
        );
    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_title_meta', 60);
}