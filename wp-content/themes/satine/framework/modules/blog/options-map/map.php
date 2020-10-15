<?php

if ( ! function_exists('satine_elated_blog_options_map') ) {

	function satine_elated_blog_options_map() {

		satine_elated_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => esc_html__('Blog', 'satine'),
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */
		$panel_blog_lists = satine_elated_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => esc_html__('Blog Lists', 'satine')
			)
		);

		satine_elated_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label'       => esc_html__('Blog Layout for Archive Pages', 'satine'),
			'description' => esc_html__('Choose a default blog layout for archived blog post lists', 'satine'),
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'masonry'               => esc_html__('Blog: Masonry', 'satine'),
				'masonry-gallery'       => esc_html__('Blog: Masonry Gallery', 'satine'),
                'standard'              => esc_html__('Blog: Standard', 'satine'),
			)
		));

		satine_elated_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout for Archive Pages', 'satine'),
			'description' => esc_html__('Choose a sidebar layout for archived blog post lists', 'satine'),
			'default_value' => '',
			'parent'      => $panel_blog_lists,
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
			satine_elated_add_admin_field(array(
				'name' => 'archive_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display for Archive Pages', 'satine'),
				'description' => esc_html__('Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'satine'),
				'parent' => $panel_blog_lists,
				'options' => satine_elated_get_custom_sidebars()
			));
		}

        satine_elated_add_admin_field(array(
            'name'        => 'blog_masonry_layout',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'satine'),
            'default_value' => 'in-grid',
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'satine'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'in-grid'    => esc_html__('In Grid', 'satine'),
                'full-width' => esc_html__('Full Width', 'satine')
            )
        ));
		
		satine_elated_add_admin_field(array(
			'name'        => 'blog_masonry_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Number of Columns', 'satine'),
			'default_value' => 'three',
			'description' => esc_html__('Set number of columns for your masonry blog lists. Default value is 4 columns', 'satine'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'two'   => esc_html__('2 Columns', 'satine'),
				'three' => esc_html__('3 Columns', 'satine'),
				'four'  => esc_html__('4 Columns', 'satine'),
				'five'  => esc_html__('5 Columns', 'satine')
			)
		));
		
		satine_elated_add_admin_field(array(
			'name'        => 'blog_masonry_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Space Between Items', 'satine'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between posts for your masonry blog lists. Default value is normal', 'satine'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'normal'  => esc_html__('Normal', 'satine'),
				'small'   => esc_html__('Small', 'satine'),
				'tiny'    => esc_html__('Tiny', 'satine'),
				'no'      => esc_html__('No Space', 'satine')
			)
		));

        satine_elated_add_admin_field(array(
            'name'        => 'blog_list_featured_image_proportion',
            'type'        => 'select',
            'label'       => esc_html__('Featured Image Proportion', 'satine'),
            'default_value' => 'fixed',
            'description' => esc_html__('Choose type of proportions you want to use for featured images on blog lists.', 'satine'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'fixed'    => esc_html__('Fixed', 'satine'),
                'original' => esc_html__('Original', 'satine')
            )
        ));

		satine_elated_add_admin_field(array(
			'name'        => 'blog_pagination_type',
			'type'        => 'select',
			'label'       => esc_html__('Pagination Type', 'satine'),
			'description' => esc_html__('Choose a pagination layout for Blog Lists', 'satine'),
			'parent'      => $panel_blog_lists,
			'default_value' => 'standard',
			'options'     => array(
				'standard'		  => esc_html__('Standard', 'satine'),
				'load-more'		  => esc_html__('Load More', 'satine'),
				'infinite-scroll' => esc_html__('Infinite Scroll', 'satine'),
				'no-pagination'   => esc_html__('No Pagination', 'satine')
			)
		));
	
		satine_elated_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '40',
				'label' => esc_html__('Number of Words in Excerpt', 'satine'),
				'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'satine'),
				'parent' => $panel_blog_lists,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = satine_elated_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => esc_html__('Blog Single', 'satine')
			)
		);

        satine_elated_add_admin_field(array(
            'name'        => 'blog_single_type',
            'type'        => 'select',
            'label'       => esc_html__('Blog Layout for Single Post Pages', 'satine'),
            'description' => esc_html__('Choose a default blog layout for single post pages', 'satine'),
            'default_value' => 'standard',
            'parent'      => $panel_blog_single,
            'options'     => array(
                'standard'              => esc_html__('Standard', 'satine'),
                'title-area-empty'		=> esc_html__('Title Area Empty', 'satine'),
                'title-area-info' 		=> esc_html__('Title Area Info', 'satine')
            )
        ));

		satine_elated_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'satine'),
			'description' => esc_html__('Choose a sidebar layout for Blog Single pages', 'satine'),
			'default_value'	=> '',
			'parent'      => $panel_blog_single,
			'options'     => array(
				''		            => esc_html__('Default', 'satine'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'satine'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'satine'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'satine'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'satine'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'satine')
			)
		));

		if(count($satine_custom_sidebars) > 0) {
			satine_elated_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'satine'),
				'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'satine'),
				'parent' => $panel_blog_single,
				'options' => satine_elated_get_custom_sidebars()
			));
		}
		
		satine_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_blog',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'satine'),
				'description' => esc_html__('Enabling this option will show title area on single post pages', 'satine'),
				'parent'      => $panel_blog_single,
                'options' => array(
                    '' => esc_html__('Default', 'satine'),
                    'yes' => esc_html__('Yes', 'satine'),
                    'no' => esc_html__('No', 'satine')
                ),
				'args' => array(
					'col_width' => 3
				)
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'full_height_title_area_blog',
				'default_value' => 'no',
				'label'       => esc_html__('Full Height Title', 'satine'),
				'description' => esc_html__('Enabling this option will show standard title area in full height on single post pages', 'satine'),
				'parent'      => $panel_blog_single,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		satine_elated_add_admin_field(array(
			'name'          => 'blog_single_title_in_title_area',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Post Title in Title Area', 'satine'),
			'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'satine'),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		satine_elated_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> esc_html__('Show Related Posts', 'satine'),
			'description'   => esc_html__('Enabling this option will show related posts on single post pages', 'satine'),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		satine_elated_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments Form', 'satine'),
			'description'   => esc_html__('Enabling this option will show comments form on single post pages', 'satine'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => esc_html__('Enable Prev/Next Single Post Navigation Links', 'satine'),
				'description' => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'satine'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltdf_eltdf_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = satine_elated_add_admin_container(
			array(
				'name' => 'eltdf_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => esc_html__('Enable Navigation Only in Current Category', 'satine'),
				'description' => esc_html__('Limit your navigation only through current category', 'satine'),
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'yes',
				'label' => esc_html__('Show Author Info Box', 'satine'),
				'description' => esc_html__('Enabling this option will display author name and descriptions on single post pages', 'satine'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltdf_eltdf_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = satine_elated_add_admin_container(
			array(
				'name' => 'eltdf_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		satine_elated_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => esc_html__('Show Author Email', 'satine'),
				'description' => esc_html__('Enabling this option will show author email', 'satine'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		satine_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'       => esc_html__('Show Author Social Icons', 'satine'),
				'description' => esc_html__('Enabling this option will show author social icons on single post pages', 'satine'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);
	}

	add_action( 'satine_elated_options_map', 'satine_elated_blog_options_map', 12);
}