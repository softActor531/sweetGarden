<?php

if(!function_exists('satine_elated_map_blog_meta')) {
    function satine_elated_map_blog_meta() {
        $eltdf_blog_categories = array();
        $categories = get_categories();
        foreach($categories as $category) {
            $eltdf_blog_categories[$category->slug] = $category->name;
        }

        $blog_meta_box = satine_elated_add_meta_box(
            array(
                'scope' => array('page'),
                'title' => esc_html__('Blog', 'satine'),
                'name' => 'blog_meta'
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_blog_category_meta',
                'type'        => 'selectblank',
                'label'       => esc_html__('Blog Category', 'satine'),
                'description' => esc_html__('Choose category of posts to display (leave empty to display all categories)', 'satine'),
                'parent'      => $blog_meta_box,
                'options'     => $eltdf_blog_categories
            )
        );

        satine_elated_add_meta_box_field(
            array(
                'name'        => 'eltdf_show_posts_per_page_meta',
                'type'        => 'text',
                'label'       => esc_html__('Number of Posts', 'satine'),
                'description' => esc_html__('Enter the number of posts to display', 'satine'),
                'parent'      => $blog_meta_box,
                'options'     => $eltdf_blog_categories,
                'args'        => array("col_width" => 3)
            )
        );

        satine_elated_add_meta_box_field(array(
            'name'        => 'eltdf_blog_masonry_layout_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'satine'),
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'satine'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''      => esc_html__('Default', 'satine'),
                'in-grid'   => esc_html__('In Grid', 'satine'),
                'full-width' => esc_html__('Full Width', 'satine')
            )
        ));

        satine_elated_add_meta_box_field(array(
            'name'        => 'eltdf_blog_masonry_number_of_columns_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Number of Columns', 'satine'),
            'description' => esc_html__('Set number of columns for your masonry blog lists', 'satine'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''      => esc_html__('Default', 'satine'),
                'two'   => esc_html__('2 Columns', 'satine'),
                'three' => esc_html__('3 Columns', 'satine'),
                'four'  => esc_html__('4 Columns', 'satine'),
                'five'  => esc_html__('5 Columns', 'satine')
            )
        ));

        satine_elated_add_meta_box_field(array(
            'name'        => 'eltdf_blog_masonry_space_between_items_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Space Between Items', 'satine'),
            'description' => esc_html__('Set space size between posts for your masonry blog lists', 'satine'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''        => esc_html__('Default', 'satine'),
                'normal'  => esc_html__('Normal', 'satine'),
                'small'   => esc_html__('Small', 'satine'),
                'tiny'    => esc_html__('Tiny', 'satine'),
                'no'      => esc_html__('No Space', 'satine')
            )
        ));

        satine_elated_add_meta_box_field(array(
            'name'        => 'eltdf_blog_list_featured_image_proportion_meta',
            'type'        => 'select',
            'label'       => esc_html__('Featured Image Proportion', 'satine'),
            'description' => esc_html__('Choose type of proportions you want to use for featured images on blog lists.', 'satine'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''		   => esc_html__('Default', 'satine'),
                'fixed'    => esc_html__('Fixed', 'satine'),
                'original' => esc_html__('Original', 'satine')
            )
        ));

        satine_elated_add_meta_box_field(array(
            'name'        => 'eltdf_blog_pagination_type_meta',
            'type'        => 'select',
            'label'       => esc_html__('Pagination Type', 'satine'),
            'description' => esc_html__('Choose a pagination layout for Blog Lists', 'satine'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''                => esc_html__('Default', 'satine'),
                'standard'		  => esc_html__('Standard', 'satine'),
                'load-more'		  => esc_html__('Load More', 'satine'),
                'infinite-scroll' => esc_html__('Infinite Scroll', 'satine'),
                'no-pagination'   => esc_html__('No Pagination', 'satine')
            )
        ));

        satine_elated_add_meta_box_field(
            array(
                'type' => 'text',
                'name' => 'eltdf_number_of_chars_meta',
                'default_value' => '',
                'label' => esc_html__('Number of Words in Excerpt', 'satine'),
                'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'satine'),
                'parent' => $blog_meta_box,
                'args' => array(
                    'col_width' => 3
                )
            )
        );



    }

    add_action('satine_elated_meta_boxes_map', 'satine_elated_map_blog_meta', 30);
}