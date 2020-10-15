<?php

/*** Post Settings ***/

if(!function_exists('satine_elated_map_post_meta')) {
    function satine_elated_map_post_meta() {

        $post_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('post'),
                'title' => esc_html__('Post', 'satine'),
                'name' => 'post-meta'
            )
        );

        satine_elated_add_meta_box_field(array(
            'name'        => 'eltdf_blog_single_type_meta',
            'type'        => 'select',
            'label'       => esc_html__('Blog Layout for Single Post Pages', 'satine'),
            'description' => esc_html__('Choose a default blog layout for single post pages', 'satine'),
            'default_value' => 'standard',
            'parent'      => $post_meta_box,
            'options'     => array(
                ''		                => esc_html__('Default', 'satine'),
                'standard'              => esc_html__('Standard', 'satine'),
                'title-area-empty'		=> esc_html__('Title Area Empty', 'satine'),
                'title-area-info' 		=> esc_html__('Title Area Info', 'satine')
            )
        ));
	
	    satine_elated_add_meta_box_field(array(
		    'name'        => 'eltdf_blog_single_sidebar_layout_meta',
		    'type'        => 'select',
		    'label'       => esc_html__('Sidebar Layout', 'satine'),
		    'description' => esc_html__('Choose a sidebar layout for Blog single page', 'satine'),
		    'default_value'	=> '',
		    'parent'      => $post_meta_box,
		    'options'     => array(
			    ''		            => esc_html__('Default', 'satine'),
			    'no-sidebar'		=> esc_html__('No Sidebar', 'satine'),
			    'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'satine'),
			    'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'satine'),
			    'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'satine'),
			    'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'satine')
		    )
	    ));
	
	    $satine_custom_sidebars = satine_elated_get_custom_sidebars();
	    if(count($satine_custom_sidebars) > 0) {
		    satine_elated_add_meta_box_field(array(
			    'name' => 'eltdf_blog_single_custom_sidebar_area_meta',
			    'type' => 'selectblank',
			    'label' => esc_html__('Sidebar to Display', 'satine'),
			    'description' => esc_html__('Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'satine'),
			    'parent' => $post_meta_box,
			    'options' => satine_elated_get_custom_sidebars()
		    ));
	    }

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_blog_list_featured_image_meta',
                'type' => 'image',
                'label' => esc_html__('Blog List Image', 'satine'),
                'description' => esc_html__('Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'satine'),
                'parent' => $post_meta_box
            )
        );

        satine_elated_add_meta_box_field(array(
            'name' => 'eltdf_blog_masonry_gallery_fixed_dimensions_meta',
            'type' => 'select',
            'label' => esc_html__('Dimensions for Fixed Proportion', 'satine'),
            'description' => esc_html__('Choose image layout when it appears in Masonry lists in fixed proportion', 'satine'),
            'default_value' => 'default',
            'parent' => $post_meta_box,
            'options' => array(
                'default' => esc_html__('Default', 'satine'),
                'large-width' => esc_html__('Large Width', 'satine'),
                'large-height' => esc_html__('Large Height', 'satine'),
                'large-width-height' => esc_html__('Large Width/Height', 'satine')
            )
        ));

        satine_elated_add_meta_box_field(array(
            'name' => 'eltdf_blog_masonry_gallery_original_dimensions_meta',
            'type' => 'select',
            'label' => esc_html__('Dimensions for Original Proportion', 'satine'),
            'description' => esc_html__('Choose image layout when it appears in Masonry lists in original proportion', 'satine'),
            'default_value' => 'default',
            'parent' => $post_meta_box,
            'options' => array(
                'default' => esc_html__('Default', 'satine'),
                'large-width' => esc_html__('Large Width', 'satine')
            )
        ));

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_show_title_area_blog_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'satine'),
                'description' => esc_html__('Enabling this option will show title area on your single post page', 'satine'),
                'parent'      => $post_meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'satine'),
                    'yes' => esc_html__('Yes', 'satine'),
                    'no' => esc_html__('No', 'satine')
                )
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name' => 'eltdf_full_height_title_area_blog_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Full Height Title', 'satine'),
                'description' => esc_html__('Enabling this option will show title area in full height on your single post page standard title', 'satine'),
                'parent'      => $post_meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'satine'),
                    'yes' => esc_html__('Yes', 'satine'),
                    'no' => esc_html__('No', 'satine')
                )
            )
        );
    }
    
    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_post_meta', 20);
}
