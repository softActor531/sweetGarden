<?php

if(!function_exists('satine_elated_map_sidebar_meta')) {
    function satine_elated_map_sidebar_meta() {
        $eltdf_sidebar_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'team-member'),
                'title' => esc_html__('Sidebar', 'satine'),
                'name' => 'sidebar_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_sidebar_layout_meta',
                'type'        => 'select',
                'label'       => esc_html__('Layout', 'satine'),
                'description' => esc_html__('Choose the sidebar layout', 'satine'),
                'parent'      => $eltdf_sidebar_meta_box,
                'options'     => array(
                    ''			        => esc_html__('Default', 'satine'),
                    'no-sidebar'		=> esc_html__('No Sidebar', 'satine'),
                    'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'satine'),
                    'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'satine'),
                    'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'satine'),
                    'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'satine')
                )
            )
        );

        $eltdf_custom_sidebars = satine_elated_get_custom_sidebars();
        if(count($eltdf_custom_sidebars) > 0) {
            satine_elated_add_meta_box_field(array(
                'name' => 'eltdf_custom_sidebar_area_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Widget Area in Sidebar', 'satine'),
                'description' => esc_html__('Choose Custom Widget area to display in Sidebar"', 'satine'),
                'parent' => $eltdf_sidebar_meta_box,
                'options' => $eltdf_custom_sidebars
            ));
        }
    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_sidebar_meta', 31);
}