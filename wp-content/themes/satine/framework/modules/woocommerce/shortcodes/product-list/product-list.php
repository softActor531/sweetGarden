<?php
namespace ElatedCore\CPT\Shortcodes\ProductList;

use ElatedCore\Lib;

class ProductList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_product_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Elated Product List', 'satine'),
			'base' => $this->base,
			'icon' => 'icon-wpb-product-list extended-custom-icon',
			'category' => esc_html__('by ELATED', 'satine'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type'       => 'dropdown',
						'param_name' => 'type',
						'heading'    => esc_html__('Type', 'satine'),
						'value'      => array(
							esc_html__('Standard', 'satine') => 'standard',
							esc_html__('Masonry', 'satine')  => 'masonry'
						),
						'admin_label' => true
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'info_position',
						'heading'    => esc_html__('Product Info Position', 'satine'),
						'value'      => array(
							esc_html__('Info On Image Hover', 'satine') => 'info-on-image',
							esc_html__('Info Below Image', 'satine')    => 'info-below-image'
						),
						'admin_label' => true,
						'dependency'  => array('element' => 'type', 'value' => array('standard')),
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__('Number of Products', 'satine')
					),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'number_of_columns',
                        'heading'    => esc_html__('Number of Columns', 'satine'),
                        'value'      => array(
							esc_html__('One', 'satine')   => '1',
							esc_html__('Two', 'satine')   => '2',
							esc_html__('Three', 'satine') => '3',
							esc_html__('Four', 'satine')  => '4',
							esc_html__('Five', 'satine')  => '5',
							esc_html__('Six', 'satine')   => '6'
                        ),
                        'save_always' => true
                    ),
                    array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_items',
						'heading'    => esc_html__('Space Between Items', 'satine'),
						'value'      => array(
							esc_html__('Large', 'satine')    => 'large',
							esc_html__('Normal', 'satine')   => 'normal',
							esc_html__('Small', 'satine')    => 'small',
							esc_html__('Tiny', 'satine')     => 'tiny',
							esc_html__('No Space', 'satine') => 'no'
						),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'show_ordering_filter',
						'heading'     => esc_html__('Show Ordering Filter', 'satine'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false, false)),
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'price_range',
						'heading'    => esc_html__('Price range for pricing filter', 'satine'),
						'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('yes')),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'orderby',
						'heading'     => esc_html__('Order By', 'satine'),
						'value'       => array_flip(satine_elated_get_query_order_by_array()),
						'save_always' => true,
						'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('no')),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__('Order', 'satine'),
						'value'       => array_flip(satine_elated_get_query_order_array()),
						'save_always' => true,
						'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('no')),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'show_category_filter',
						'heading'     => esc_html__('Show Category Filter', 'satine'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false, false)),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'category_values',
						'heading'     => esc_html__('Enter Category Values', 'satine'),
						'description' => esc_html__('Separate values (category slugs) with a comma', 'satine'),
						'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
					),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'show_all_item_in_filter',
					'heading'     => esc_html__('Show "All" Item in Filter', 'satine'),
					'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
					'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
				),
					array(
	                    'type'       => 'dropdown',
	                    'param_name' => 'taxonomy_to_display',
	                    'heading'    => esc_html__('Choose Sorting Taxonomy', 'satine'),
	                    'value' => array(
							esc_html__('Category', 'satine') => 'category',
							esc_html__('Tag', 'satine')      => 'tag',
							esc_html__('Id', 'satine')       => 'id'
	                    ),
	                    'description' => esc_html__('If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'satine'),
						'dependency'  => array('element' => 'show_category_filter', 'value' => array('no')),
	                ),
	                array(
	                    'type'        => 'textfield',
	                    'param_name'  => 'taxonomy_values',
	                    'heading'     => esc_html__('Enter Taxonomy Values', 'satine'),
	                    'description' => esc_html__('Separate values (category slugs, tags, or post IDs) with a comma', 'satine'),
						'dependency'  => array('element' => 'show_category_filter', 'value' => array('no')),
	                ),
	                array(
						'type'       => 'dropdown',
						'param_name' => 'image_size',
						'heading'    => esc_html__('Image Proportions', 'satine'),
						'value'      => array(
							esc_html__('Default', 'satine')        => '',
							esc_html__('Original', 'satine')       => 'full',
							esc_html__('Square', 'satine')         => 'square',
							esc_html__('Landscape', 'satine')      => 'landscape',
							esc_html__('Portrait', 'satine')       => 'portrait',
							esc_html__('Medium', 'satine')         => 'medium',
							esc_html__('Large', 'satine')          => 'large',
							esc_html__('Shop Catalog', 'satine')   => 'shop_catalog',
							esc_html__('Shop Single', 'satine')    => 'shop_single',
							esc_html__('Shop Thumbnail', 'satine') => 'shop_thumbnail'
						)
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_title',
						'heading'     => esc_html__('Display Title', 'satine'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'satine')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'product_info_skin',
						'heading'    => esc_html__('Product Info Skin', 'satine'),
						'value'      => array(
							esc_html__('Default', 'satine')  => 'default',
							esc_html__('Light', 'satine') => 'light',
							esc_html__('Dark', 'satine') => 'dark'
						),
						'dependency'  => array('element' => 'info_position', 'value' => array('info-on-image')),
						'group'	      => esc_html__('Product Info Style', 'satine')
					),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'product_info_hover_skin',
                        'heading'    => esc_html__('Product Info Hover Background Skin', 'satine'),
                        'value'      => array(
                            esc_html__('Light', 'satine') => 'light',
                            esc_html__('Dark', 'satine') => 'dark'
                        ),
                        'dependency'  => array('element' => 'info_position', 'value' => array('info-on-image')),
                        'group'	      => esc_html__('Product Info Style', 'satine')
                    ),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_tag',
						'heading'     => esc_html__('Title Tag', 'satine'),
						'value'       => array_flip(satine_elated_get_title_tag(true)),
						'dependency'  => array('element' => 'display_title', 'value' => array('yes')),
						'group'	      => esc_html__('Product Info Style', 'satine')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_transform',
						'heading'     => esc_html__('Title Text Transform', 'satine'),
						'value'       => array_flip(satine_elated_get_text_transform_array(true)),
						'dependency'  => array('element' => 'display_title', 'value' => array('yes')),
						'group'	      => esc_html__('Product Info Style', 'satine')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_category',
						'heading'     => esc_html__('Display Category', 'satine'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false)),
						'group'	      => esc_html__('Product Info', 'satine')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_excerpt',
						'heading'     => esc_html__('Display Excerpt', 'satine'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false)),
						'group'	      => esc_html__('Product Info', 'satine')
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'excerpt_length',
						'heading'     => esc_html__('Excerpt Length', 'satine'),
						'description' => esc_html__('Number of characters', 'satine'),
						'dependency'  => array('element' => 'display_excerpt', 'value' => array('yes')),
						'group'	      => esc_html__('Product Info Style', 'satine')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_rating',
						'heading'     => esc_html__('Display Rating', 'satine'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'satine')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_price',
						'heading'     => esc_html__('Display Price', 'satine'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'satine')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_quicklook_wishlist',
						'heading'     => esc_html__('Display Quicklook and Wishlist Buttons', 'satine'),
						'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'satine'),
						'dependency'  => array('element' => 'info_position', 'value' => array('info-below-image')),
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'info_bottom_text_align',
						'heading'    => esc_html__('Product Info Text Alignment', 'satine'),
						'value'      => array(
							esc_html__('Default', 'satine')  => '',
							esc_html__('Left', 'satine') => 'left',
							esc_html__('Center', 'satine') => 'center',
							esc_html__('Right', 'satine') => 'right'
						),
						'dependency'  => array('element' => 'info_position', 'value' => array('info-below-image')),
						'group'	      => esc_html__('Product Info Style', 'satine')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'info_bottom_margin',
						'heading'    => esc_html__('Product Info Bottom Margin (px)', 'satine'),
						'dependency' => array('element' => 'info_position', 'value' => array('info-below-image')),
						'group'	     => esc_html__('Product Info Style', 'satine')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'button_skin',
						'heading'    => esc_html__('Add To Cart Button Skin', 'satine'),
						'value'      => array(
							esc_html__('Light', 'satine')  => 'light',
							esc_html__('Dark', 'satine')   => 'dark',
						),
						'dependency'  => array('element' => 'info_position', 'value' => array('info-below-image')),
						'group'	      => esc_html__('Product Info Style', 'satine')
					),
				)
		) );
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'type'					  => 'standard',
			'info_position'			  => 'info-on-image',
            'number_of_posts' 		  => '8',
            'number_of_columns' 	  => '4',
            'space_between_items'	  => '',
            'show_ordering_filter'	  => 'no',
            'price_range'	  		  => '',
            'orderby' 				  => 'date',
            'order' 				  => 'ASC',
            'show_category_filter' 	  => 'no',
            'category_values' 	  	  => '',
			'show_all_item_in_filter' => 'yes',
            'taxonomy_to_display' 	  => 'category',
            'taxonomy_values' 		  => '',
            'image_size'			  => 'full',
            'display_title' 		  => 'yes',
			'product_info_skin'       => '',
            'product_info_hover_skin' => '',
            'title_tag'				  => 'h5',
            'title_transform'		  => '',
			'display_category'        => 'no',
            'display_excerpt' 		  => 'no',
            'excerpt_length' 		  => '20',
			'display_rating' 		  => 'yes',
			'display_price' 		  => 'yes',
			'display_quicklook_wishlist' => 'yes',
			'info_bottom_text_align'  => '',
            'info_bottom_margin' 	  => '',
            'button_skin'   		  => 'light'
        );

		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$params['type'] = !empty($params['type']) ? $params['type'] : $default_atts['type'];
		if($params['type'] == 'masonry'){
			$params['info_position'] = 'info-on-image';
		}
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['class_name'] = 'pli';
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);
		$params['text_wrapper_styles'] = $this->getTextWrapperStyles($params);
		$params['categories_filter_list'] = $this->getProductCategoriesList($params);
		$params['ordering_filter_list'] = $this->getProductOrderingList($params);
		$params['pricing_filter_list'] = $this->getProductPricingList($params);
		$params['holder_data'] = $this->getHolderData($params);

		$params['category'] = ''; //used for ajax calling in category filter
		$params['meta_key'] = ''; //used for ajax calling in category filter
		$params['min_price'] = ''; //used for ajax calling in ordering filter
		$params['max_price'] = ''; //used for ajax calling in ordering filter

		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$html = satine_elated_get_woo_shortcode_module_template_part('templates/product-list-'.$params['type'], 'product-list', '', $params);
		
		return $html;
	}

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getHolderClasses($params){
		$holderClasses = '';

		$productListType = !empty($params['type']) ? 'eltdf-'.$params['type'].'-layout' : 'eltdf-standard-layout';

        $columnsSpace = !empty($params['space_between_items']) ? 'eltdf-'.$params['space_between_items'].'-space' : 'eltdf-normal-space';

        $columnNumber = $this->getColumnNumberClass($params);

		$infoPosition = !empty($params['info_position']) ? 'eltdf-'.$params['info_position'] : 'eltdf-info-on-image';
		
		$productInfoClasses = !empty($params['product_info_skin']) ? 'eltdf-product-info-'.$params['product_info_skin'] : '';

        $productInfoHoverClasses = !empty($params['product_info_hover_skin']) ? 'eltdf-product-info-hover-'.$params['product_info_hover_skin'] : '';

        $productInfoHoverButtonClasses = !empty($params['button_skin']) ? 'eltdf-product-info-button-'.$params['button_skin'] : '';

        $holderClasses .= $productListType . ' ' . $columnsSpace . ' ' . $columnNumber . ' ' . $infoPosition . ' ' . $productInfoClasses . ' ' . $productInfoHoverClasses . ' ' . $productInfoHoverButtonClasses;
		
		return $holderClasses;
	}

    /**
     * Generates columns number classes for product list holder
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params){

        $columns = $params['number_of_columns'];

        switch ($columns) {
            case 1:
                $columnsNumber = 'eltdf-one-column';
                break;
            case 2:
                $columnsNumber = 'eltdf-two-columns';
                break;
            case 3:
                $columnsNumber = 'eltdf-three-columns';
                break;
            case 4:
                $columnsNumber = 'eltdf-four-columns';
                break;
            case 5:
                $columnsNumber = 'eltdf-five-columns';
                break;
            case 6:
                $columnsNumber = 'eltdf-six-columns';
                break;        
            default:
                $columnsNumber = 'eltdf-four-columns';
                break;
        }

        return $columnsNumber;
    }

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateProductQueryArray($params){
		$queryArray = array(
			'post_status' => 'publish',
			'post_type' => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $params['number_of_posts'],
			'orderby' => $params['orderby'],
			'order' => $params['order']
		);

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' && $params['show_category_filter'] == 'no') {
            $queryArray['product_cat'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' && $params['show_category_filter'] == 'no') {
            $queryArray['product_tag'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' && $params['show_category_filter'] == 'no') {
            $idArray = $params['taxonomy_values'];
            $ids = explode(',', $idArray);
            $queryArray['post__in'] = $ids;
        }


		//used for ajax calling in ordering filter
        if($params['show_ordering_filter'] == 'yes') {
			unset($queryArray['orderby'], $queryArray['order']);

			if ($params['meta_key'] !== ''){
				$queryArray['orderby'] = $params['orderby'];
				$queryArray['order'] = $params['order'];
				$queryArray['meta_key'] = $params['meta_key'];
			}

			if($params['min_price'] !== '' || $params['max_price'] !== ''){
				$queryArray['meta_query'] = array(
					array(
						'key' => '_price',
						'value' => array($params['min_price'], $params['max_price']),
						'compare' => 'BETWEEN',
						'type' => 'NUMERIC'
					),
				);
			}
		}

        //used for ajax calling in category filter
        if($params['show_category_filter'] == 'yes'){
        	if($params['category_values'] !== '' && $params['category'] == '') {
				$queryArray['product_cat'] = $params['category_values'];
			}else {
				$queryArray['product_cat'] = $params['category'];
			}
		}

        return $queryArray;
	}

	/**
     * Return Style for Title
     *
     * @param $params
     * @return string
     */
    public function getTitleStyles($params) {
        $styles = array();
	
	    if (!empty($params['title_transform'])) {
		    $styles[] = 'text-transform: '.$params['title_transform'];
	    }

		return implode(';', $styles);
    }

    /**
     * Return Style for Text Wrapper Holder
     *
     * @param $params
     * @return string
     */
	public function getTextWrapperStyles($params) {
	    $styles = array();
	
	    if (!empty($params['info_bottom_text_align'])) {
		    $styles[] = 'text-align: '.$params['info_bottom_text_align'];
	    }
		
        if ($params['info_bottom_margin'] !== '') {
	        $styles[] = 'margin-bottom: '.satine_elated_filter_px($params['info_bottom_margin']).'px';
        }

		return implode(';', $styles);
    }

	/**
	 * Return product categories
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductCategoriesList($params) {
		$category_html = '';

		if($params['show_category_filter'] == 'yes') {
			$taxonomy = 'product_cat';
			$orderby = 'name';
			$show_count = 0;      // 1 for yes, 0 for no
			$pad_counts = 0;      // 1 for yes, 0 for no
			$hierarchical = 1;      // 1 for yes, 0 for no
			$title = '';
			$empty = 0;
			$parent = 0;

			$args = array(
				'taxonomy' => $taxonomy,
				'orderby' => $orderby,
				'show_count' => $show_count,
				'pad_counts' => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li' => $title,
				'hide_empty' => $empty,
				'parent' => $parent
			);

			$all_categories = array();
			$all_categories_string = '';
			if($params['category_values'] == ''){

				$all_categories = get_categories($args);

			}else{
				$categories = explode(',',$params['category_values']);
				foreach ($categories as $cat){
					$all_categories[] = get_term_by( 'slug', $cat, 'product_cat' );
					$all_categories_string .= $cat.',';
				}
			}

			if($params['show_all_item_in_filter'] == 'yes' && ! empty ( $all_categories_string ) ) {
				$category_html .= '<li><a class="eltdf-no-smooth-transitions active" data-category="' . $all_categories_string . '" href="#">' . esc_html__('All', 'satine') . '</a></li>';
			}
			foreach ($all_categories as $cat) {
				if (is_object($cat)) {
					$category_html .= '<li><a class="eltdf-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($cat->slug, 'product_cat') . '">' . $cat->name . '</a></li>';

					$termchildren = get_term_children( $cat->term_id, 'product_cat' );

					if(!empty($termchildren)){
						foreach ( $termchildren as $child ) {
							$cat = get_term_by( 'id', $child, 'product_cat' );
							$category_html .= '<li><a class="eltdf-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($child, 'product_cat') . '">' . $cat->name . '</a></li>';
						}
					}
				}
			}
		}

		return $category_html;
	}

	/**
	 * Return products sort by
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductOrderingList($params) {
		$sorting_list_html = '';

		if($params['show_ordering_filter'] == 'yes') {
			$orderby_options = apply_filters('woocommerce_catalog_orderby', array(
				'menu_order' => esc_html__('Default', 'satine'),
				'popularity' => esc_html__('Popularity', 'satine'),
				'rating' => esc_html__('Average rating', 'satine'),
				'newness' => esc_html__('Newness', 'satine'),
				'price' => esc_html__('Price: Low to High', 'satine'),
				'price-desc' => esc_html__('Price: High to Low', 'satine')
			));

			if (get_option('woocommerce_enable_review_rating') === 'no') {
				unset($orderby_options['rating']);
			}

			foreach ($orderby_options as $key => $value) {
				$sorting_list_html .= '<li><a class="eltdf-no-smooth-transitions" data-ordering="'. $key .'" href="#">'. $value .'</a></li>';
			}
		}

		return $sorting_list_html;
	}

	/**
	 * Return products sort by
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductPricingList($params) {
		$pricing_list_html = '';

		if($params['show_ordering_filter'] == 'yes') {
			$range = $params['price_range'] !== '' ? $params['price_range'] : 10;
			$value = 0;

			$pricing_list_html .= '<li><a data-minPrice="" data-maxPrice="" href="#">' . esc_html__('All', 'satine') . '</a></li>';
			for ($i = 1; $i <= 5; $i++){
				if($i !== 5){
					$pricing_list_html .= '<li><a data-minPrice="'. $value .'" data-maxPrice="'. ($value+$range) .'" href="#">'. get_woocommerce_currency_symbol().$value .'-'.get_woocommerce_currency_symbol().($value+$range). '</a></li>';

				}else{
					$pricing_list_html .= '<li><a data-minPrice="'. ($value) .'" data-maxPrice="'.(100000000000).'" href="#">'. ($value).get_woocommerce_currency_symbol(). '+</a></li>';
				}

				$value += $range;
			}

		}

		return $pricing_list_html;
	}

	/**
	 * Generates data attributes array
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getHolderData($params){
		$dataString = '';
		unset($params['categories_filter_list'], $params['ordering_filter_list'], $params['pricing_filter_list'] );
		foreach ($params as $key => $value) {
			if($value !== '') {
				$new_key = str_replace( '_', '-', $key );

				$dataString .= ' data-'.$new_key.'="'.esc_attr($value).'"';
			}
		}

		return $dataString;
	}
}