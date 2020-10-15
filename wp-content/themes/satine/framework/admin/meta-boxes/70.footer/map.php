<?php

if(!function_exists('satine_elated_map_footer_meta')) {
    function satine_elated_map_footer_meta() {
        $footer_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Footer', 'satine'),
                'name' => 'footer_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_disable_footer_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Disable Footer for this Page', 'satine'),
                'description' => esc_html__('Enabling this option will hide footer on this page', 'satine'),
                'parent' => $footer_meta_box
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_show_footer_top_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Top', 'satine'),
                'description' => esc_html__('Enabling this option will show Footer Top area', 'satine'),
                'parent' => $footer_meta_box,
                'options' => satine_elated_get_yes_no_select_array()
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'eltdf_footer_top_skin_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer Top Skin', 'satine'),
                'description'   => esc_html__('Choose a footer top style to make footer top widgets in that predefined style', 'satine'),
                'options'       => array(
                    ''         => '',
                    'standard' => esc_html__('Standard', 'satine'),
                    'light'    => esc_html__('Light', 'satine'),
                    'dark'     => esc_html__('Dark', 'satine')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        satine_elated_add_meta_box_field(
            array(
            'name' => 'eltdf_footer_background_color_meta',
            'type' => 'color',
            'label' => esc_html__('Footer  Background Color', 'satine'),
            'description' => esc_html__('Set background color for footer area', 'satine'),
            'parent' => $footer_meta_box
        ));

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_show_footer_bottom_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Bottom', 'satine'),
                'description' => esc_html__('Enabling this option will show Footer Bottom area', 'satine'),
                'parent' => $footer_meta_box,
                'options' => satine_elated_get_yes_no_select_array()
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_show_footer_bottom_border_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Bottom Border', 'satine'),
                'description' => esc_html__('Enabling this option will show Footer Bottom border', 'satine'),
                'parent' => $footer_meta_box,
                'options' => satine_elated_get_yes_no_select_array()
            )
        );


        satine_elated_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'eltdf_footer_bottom_skin_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer Bottom Skin', 'satine'),
                'description'   => esc_html__('Choose a footer bottom style to make footer bottom widgets in that predefined style', 'satine'),
                'options'       => array(
                    ''         => '',
                    'standard' => esc_html__('Standard', 'satine'),
                    'light'    => esc_html__('Light', 'satine'),
                    'dark'     => esc_html__('Dark', 'satine')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_footer_background_image_meta',
                'type' => 'image',
                'default_value' => '',
                'label' => esc_html__('Footer Background Image for this Page', 'satine'),
                'parent' => $footer_meta_box,
            )
        );
        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_show_footer_image_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Background Image For This Page', 'satine'),
                'description' => esc_html__('Enabling this option will show footer background image for this page', 'satine'),
                'parent' => $footer_meta_box,
                'options' => array(
                    '' => '',
                    'no' => esc_html__('No', 'satine'),
                    'yes' => esc_html__('Yes', 'satine')
                )
            )


        );

        satine_elated_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'eltdf_footer_in_grid_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer in Grid', 'satine'),
                'description'   => esc_html__('Enabling this option will place Footer content in grid', 'satine'),
                'options'       => array(
                    ''    => esc_html__('Default', 'satine'),
                    'yes' => esc_html__('Yes', 'satine'),
                    'no'  => esc_html__('No', 'satine')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        $satine_custom_sidebars = satine_elated_get_custom_sidebars();
        satine_elated_add_meta_box_field(
            array(
                'type'          => 'yesno',
                'name'          => 'show_footer_custom_widget_areas',
                'default_value' => 'no',
                'label'         => esc_html__('Use Custom Widget Areas in Footer', 'satine'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#eltdf_footer_custom_widget_areas'
                ),
                'parent'        => $footer_meta_box,
            )
        );

        $show_footer_custom_widget_areas = satine_elated_add_admin_container(
            array(
                'name'            => 'footer_custom_widget_areas',
                'hidden_property' => 'show_footer_custom_widget_areas',
                'hidden_value'    => 'no',
                'parent'          => $footer_meta_box
            )
        );

        $top_cols_num = 4;

        for ($i = 1; $i <= $top_cols_num; $i++) {

            satine_elated_add_meta_box_field(array(
                'name'        => 'eltdf_footer_top_meta_' . $i,
                'type'        => 'selectblank',
                'label'       => esc_html__('Choose Widget Area in Footer Top Column ', 'satine') . $i,
                'description' => esc_html__('Choose Custom Widget area to display in Footer Top Column ', 'satine') . $i,
                'parent'      => $show_footer_custom_widget_areas,
                'options'     => $satine_custom_sidebars
            ));

        }

        $bottom_cols_num = 3;

        for ($i = 1; $i <= $bottom_cols_num; $i++) {

            satine_elated_add_meta_box_field(array(
                'name'        => 'eltdf_footer_bottom_meta_' . $i,
                'type'        => 'selectblank',
                'label'       => esc_html__('Choose Widget Area in Footer Bottom Column ', 'satine') . $i,
                'description' => esc_html__('Choose Custom Widget area to display in Footer Bottom Column ', 'satine') . $i,
                'parent'      => $show_footer_custom_widget_areas,
                'options'     => $satine_custom_sidebars
            ));

        }


    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_footer_meta', 70);
}