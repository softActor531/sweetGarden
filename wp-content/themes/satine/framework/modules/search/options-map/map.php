<?php

if ( ! function_exists('satine_elated_search_options_map') ) {

	function satine_elated_search_options_map() {

		satine_elated_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => esc_html__('Search', 'satine'),
				'icon' => 'fa fa-search'
			)
		);

		$search_page_panel = satine_elated_add_admin_panel(
			array(
				'title' => esc_html__('Search Page', 'satine'),
				'name' => 'search_template',
				'page' => '_search_page'
			)
		);

		satine_elated_add_admin_field(array(
			'name'        => 'search_page_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'satine'),
            'description' 	=> esc_html__("Choose a sidebar layout for search page", 'satine'),
            'default_value' => 'no-sidebar',
            'options'       => array(
                'no-sidebar'        => esc_html__('No Sidebar', 'satine'),
                'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'satine'),
                'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'satine'),
                'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'satine'),
                'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'satine')
            ),
			'parent'      => $search_page_panel
		));

        $satine_custom_sidebars = satine_elated_get_custom_sidebars();
        if(count($satine_custom_sidebars) > 0) {
            satine_elated_add_admin_field(array(
                'name' => 'search_custom_sidebar_area',
                'type' => 'selectblank',
                'label' => esc_html__('Sidebar to Display', 'satine'),
                'description' => esc_html__('Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'satine'),
                'parent' => $search_page_panel,
                'options' => $satine_custom_sidebars
            ));
        }

		$search_panel = satine_elated_add_admin_panel(
			array(
				'title' => esc_html__('Search', 'satine'),
				'name' => 'search',
				'page' => '_search_page'
			)
		);

		satine_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_type',
				'default_value'	=> 'slide-from-header-bottom',
				'label' 		=> esc_html__('Select Search Type', 'satine'),
				'description' 	=> esc_html__("Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'satine'),
				'options' 		=> array(
					'fullscreen' => esc_html__('Fullscreen Search', 'satine'),
					'slide-from-header-bottom' => esc_html__('Slide From Header Bottom', 'satine'),
                    'covers-header' => esc_html__('Search Covers Header', 'satine'),
                    'slide-from-window-top' => esc_html__('Slide from Window Top' , 'satine')
				)
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_icon_pack',
				'default_value'	=> 'font_elegant',
				'label'			=> esc_html__('Search Icon Pack', 'satine'),
				'description'	=> esc_html__('Choose icon pack for search icon', 'satine'),
				'options'		=> satine_elated_icon_collections()->getIconCollectionsExclude(array('linea_icons'))
			)
		);

        satine_elated_add_admin_field(
            array(
                'parent'		=> $search_panel,
                'type'			=> 'yesno',
                'name'			=> 'search_in_grid',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Enable Grid Layout', 'satine'),
                'description'	=> esc_html__('Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'satine'),
            )
        );
		
		satine_elated_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'initial_header_icon_title',
				'title'		=> esc_html__('Initial Search Icon in Header', 'satine')
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'text',
				'name'			=> 'header_search_icon_size',
				'default_value'	=> '',
				'label'			=> esc_html__('Icon Size', 'satine'),
				'description'	=> esc_html__('Set size for icon', 'satine'),
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);
		
		$search_icon_color_group = satine_elated_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> esc_html__('Icon Colors', 'satine'),
				'description' => esc_html__('Define color style for icon', 'satine'),
				'name'		=> 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = satine_elated_add_admin_row(
			array(
				'parent'	=> $search_icon_color_group,
				'name'		=> 'search_icon_color_row'
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'	=> $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_color',
				'label'		=> esc_html__('Color', 'satine')
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_hover_color',
				'label'		=> esc_html__('Hover Color', 'satine')
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'enable_search_icon_text',
				'default_value'	=> 'no',
				'label'			=> esc_html__('Enable Search Icon Text', 'satine'),
				'description'	=> esc_html__("Enable this option to show 'Search' text next to search icon in header", 'satine'),
				'args'			=> array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltdf_enable_search_icon_text_container'
				)
			)
		);
		
		$enable_search_icon_text_container = satine_elated_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'enable_search_icon_text_container',
				'hidden_property'	=> 'enable_search_icon_text',
				'hidden_value'		=> 'no'
			)
		);
		
		$enable_search_icon_text_group = satine_elated_add_admin_group(
			array(
				'parent'	=> $enable_search_icon_text_container,
				'title'		=> esc_html__('Search Icon Text', 'satine'),
				'name'		=> 'enable_search_icon_text_group',
				'description'	=> esc_html__('Define style for search icon text', 'satine')
			)
		);
		
		$enable_search_icon_text_row = satine_elated_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row'
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color',
				'label'			=> esc_html__('Text Color', 'satine')
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color_hover',
				'label'			=> esc_html__('Text Hover Color', 'satine')
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_font_size',
				'label'			=> esc_html__('Font Size', 'satine'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_line_height',
				'label'			=> esc_html__('Line Height', 'satine'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = satine_elated_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row2',
				'next'		=> true
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_text_transform',
				'label'			=> esc_html__('Text Transform', 'satine'),
				'default_value'	=> '',
				'options'		=> satine_elated_get_text_transform_array()
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_icon_text_google_fonts',
				'label'			=> esc_html__('Font Family', 'satine'),
				'default_value'	=> '-1',
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_font_style',
				'label'			=> esc_html__('Font Style', 'satine'),
				'default_value'	=> '',
				'options'		=> satine_elated_get_font_style_array(),
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_font_weight',
				'label'			=> esc_html__('Font Weight', 'satine'),
				'default_value'	=> '',
				'options'		=> satine_elated_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = satine_elated_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row3',
				'next'		=> true
			)
		);
		
		satine_elated_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row3,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_letter_spacing',
				'label'			=> esc_html__('Letter Spacing', 'satine'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
	}

	add_action('satine_elated_options_map', 'satine_elated_search_options_map', 7);
}