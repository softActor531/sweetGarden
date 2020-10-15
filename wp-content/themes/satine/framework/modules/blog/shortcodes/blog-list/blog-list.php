<?php
namespace ElatedCore\CPT\Shortcodes\BlogList;

use ElatedCore\Lib;

class BlogList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_blog_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
		
		//Category filter
		add_filter( 'vc_autocomplete_eltdf_blog_list_category_callback', array( &$this, 'blogCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Category render
		add_filter( 'vc_autocomplete_eltdf_blog_list_category_render', array( &$this, 'blogCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Elated Blog List', 'satine'),
			'base' => $this->base,
			'icon' => 'icon-wpb-blog-list extended-custom-icon',
			'category' => esc_html__('by ELATED', 'satine'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type'       => 'dropdown',
						'param_name' => 'type',
						'heading'    => esc_html__('Type', 'satine'),
						'value'      => array(
							esc_html__('Standard', 'satine') => 'standard',
							esc_html__('Boxed', 'satine')    => 'boxed',
							esc_html__('Masonry', 'satine')  => 'masonry',
							esc_html__('Simple', 'satine')   => 'simple',
							esc_html__('Minimal', 'satine')  => 'minimal'
						),
						'save_always' => true
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__('Number of Posts', 'satine')
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
							esc_html__('Five', 'satine')  => '5'
                        ),
                        'dependency'  => Array('element' => 'type', 'value' => array('standard', 'boxed', 'masonry'))
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'space_between_columns',
                        'heading'    => esc_html__('Space Between Columns', 'satine'),
                        'value' => array(
                            esc_html__('Large', 'satine') => 'large',
	                        esc_html__('Normal', 'satine') => 'normal',
	                        esc_html__('Small', 'satine') => 'small',
	                        esc_html__('Tiny', 'satine') => 'tiny',
	                        esc_html__('No Space', 'satine') => 'no'
                        ),
                        'dependency'  => Array('element' => 'type', 'value' => array('standard', 'boxed', 'masonry'))
                    ),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order_by',
						'heading'     => esc_html__('Order By', 'satine'),
						'value'       => array_flip(satine_elated_get_query_order_by_array()),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__('Order', 'satine'),
						'value'       => array_flip(satine_elated_get_query_order_array()),
						'save_always' => true
					),
					array(
						'type'        => 'autocomplete',
						'param_name'  => 'category',
						'heading'     => esc_html__('Category', 'satine'),
						'description' => esc_html__('Enter one category slug (leave empty for showing all categories)', 'satine')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'image_size',
						'heading'    => esc_html__('Image Size', 'satine'),
						'value'      => array(
							esc_html__('Original', 'satine') => 'full',
							esc_html__('Square', 'satine') => 'square',
							esc_html__('Landscape', 'satine') => 'landscape',
							esc_html__('Portrait', 'satine') => 'portrait',
							esc_html__('Medium', 'satine') => 'medium',
							esc_html__('Large', 'satine') => 'large'
                        ),
						'dependency'  => Array('element' => 'type', 'value' => array('standard', 'boxed', 'masonry'))
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_tag',
						'heading'     => esc_html__('Title Tag', 'satine'),
						'value'       => array_flip(satine_elated_get_title_tag(true)),
						'group'       => esc_html__('Post Info', 'satine')
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'excerpt_length',
						'heading'     => esc_html__('Text Length', 'satine'),
						'description' => esc_html__('Number of characters', 'satine'),
						'dependency'  => Array('element' => 'type', 'value' => array('standard', 'boxed', 'masonry', 'simple')),
						'group'       => esc_html__('Post Info', 'satine')
					),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'post_info_image',
                        'heading'     => esc_html__('Enable Post Info Image', 'satine'),
                        'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
                        'dependency'  => Array('element' => 'type', 'value' => array('standard', 'boxed', 'masonry')),
                        'group'       => esc_html__('Post Info', 'satine')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'post_info_date',
                        'heading'     => esc_html__('Enable Post Info Date', 'satine'),
                        'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
                        'dependency'  => Array('element' => 'type', 'value' => array('standard', 'boxed', 'masonry')),
                        'group'       => esc_html__('Post Info', 'satine')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'post_info_section',
                        'heading'     => esc_html__('Enable Post Info Section', 'satine'),
                        'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
                        'dependency'  => Array('element' => 'type', 'value' => array('standard', 'boxed', 'masonry')),
                        'group'       => esc_html__('Post Info', 'satine')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'post_info_author',
                        'heading'     => esc_html__('Enable Post Info Author', 'satine'),
                        'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
                        'dependency'  => Array('element' => 'post_info_section', 'value' => array('yes')),
                        'group'       => esc_html__('Post Info', 'satine')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'post_info_category',
                        'heading'     => esc_html__('Enable Post Info Category', 'satine'),
                        'value'       => array_flip(satine_elated_get_yes_no_select_array(false, true)),
                        'dependency'  => Array('element' => 'post_info_section', 'value' => array('yes')),
                        'group'       => esc_html__('Post Info', 'satine')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'post_info_comments',
                        'heading'     => esc_html__('Enable Post Info Comments', 'satine'),
                        'value'       => array_flip(satine_elated_get_yes_no_select_array(false)),
                        'dependency'  => Array('element' => 'post_info_section', 'value' => array('yes')),
                        'group'       => esc_html__('Post Info', 'satine')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'post_info_share',
                        'heading'     => esc_html__('Enable Post Info Share', 'satine'),
                        'value'       => array_flip(satine_elated_get_yes_no_select_array(false)),
                        'dependency'  => Array('element' => 'post_info_section', 'value' => array('yes')),
                        'group'       => esc_html__('Post Info', 'satine')
                    ),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'pagination_type',
						'heading'     => esc_html__( 'Pagination Type', 'satine' ),
						'value'       => array(
							esc_html__( 'None', 'satine' )  => 'no-pagination',
							esc_html__( 'Standard', 'satine' ) => 'standard-blog-list',
							esc_html__( 'Load More', 'satine' )    => 'load-more',
							esc_html__( 'Infinite Scroll', 'satine' )  => 'infinite-scroll'
						),
						'group'       => esc_html__( 'Additional Features', 'satine' )
					)
				)
		) );
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'type'                  => 'standard',
            'number_of_posts'       => '-1',
            'number_of_columns'     => '3',
            'space_between_columns' => 'large',
			'category'              => '',
			'order_by'              => 'title',
			'order'                 => 'ASC',
			'image_size'            => 'full',
            'title_tag'             => 'h3',
			'excerpt_length'        => '90',
            'post_info_section'     => 'yes',
			'post_info_image'       => 'yes',
			'post_info_author'      => 'yes',
			'post_info_date'        => 'yes',
			'post_info_category'    => 'yes',
			'post_info_comments'    => 'no',
			'post_info_share'       => 'no',
            'pagination_type'       => 'no-pagination'
        );

		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		
		$queryArray = $this->generateQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$params['holder_data'] = $this->getHolderData($params);
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['module'] = 'list';
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		$params['paged'] = isset($query_result->query['paged']) ? $query_result->query['paged'] : 1;

        $params['featured_image_size'] = $this->generateImageSize($params);

		$params['this_object'] = $this;
		
		ob_start();
		
		satine_elated_get_module_template_part('shortcodes/blog-list/holder', 'blog', $params['type'], $params);
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		return $html;	
	}
	
	/**
	 * Generates query array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function generateQueryArray($params){
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['order_by'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option('sticky_posts')
		);

		if(!empty($params['category'])){
			$queryArray['category_name'] = $params['category'];
		}

		if(!empty($params['next_page'])) {
			$queryArray['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $queryArray;
	}

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	public function getHolderClasses($params){
		$holderClasses = '';
		
		$listType = !empty($params['type']) ? 'eltdf-bl-'.$params['type'] : 'eltdf-bl-standard';
		$columnNumber = $this->getColumnNumberClass($params);
		$columnsSpace = !empty($params['space_between_columns']) ? 'eltdf-bl-' . $params['space_between_columns'] . '-space' : 'eltdf-bl-large-space';
		$paginationClasses = !empty($params['pagination_type']) ? 'eltdf-bl-pag-'.$params['pagination_type'] : 'eltdf-bl-pag-no-pagination';
		
		$holderClasses .= $listType . ' ' . $columnNumber . ' ' . $columnsSpace . ' ' . $paginationClasses;
		
		return $holderClasses;
	}
	
	/**
	 * Generates columns number classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getColumnNumberClass($params){
		$classes = '';
		$columns = $params['number_of_columns'];
		
		switch ($columns) {
			case 1:
				$classes = 'eltdf-bl-one-column';
				break;
			case 2:
				$classes = 'eltdf-bl-two-columns';
				break;
			case 3:
				$classes = 'eltdf-bl-three-columns';
				break;
			case 4:
				$classes = 'eltdf-bl-four-columns';
				break;
			case 5:
				$classes = 'eltdf-bl-five-columns';
				break;
			default:
				$classes = 'eltdf-bl-three-columns';
				break;
		}
		
		return $classes;
	}
	
	/**
	 * Generates datta attributes array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getHolderData($params){
		$dataString = '';
		
		if(get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		$query_result = $params['query_result'];
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		
		if(!empty($paged)) {
			$params['next-page'] = $paged+1;
		}
		
		foreach ($params as $key => $value) {
			if($key !== 'query_result' && $value !== '') {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-'.$new_key.'='.esc_attr($value);
			}
		}
		
		return $dataString;
	}

	/**
	   * Generates image size option
	   *
	   * @param $params
	   *
	   * @return string
	*/
	public function generateImageSize($params){
		$thumb_size = '';
		$image_size = $params['image_size'];

		switch ($image_size) {
			case 'landscape':
				$thumb_size = 'satine_landscape';
				break;
			case 'portrait':
				$thumb_size = 'satine_portrait';
				break;
			case 'square':
				$thumb_size = 'satine_square';
				break;
			case 'medium':
				$thumb_size = 'medium';
				break;
			case 'large':
				$thumb_size = 'large';
				break;
			case 'full':
				$thumb_size = 'full';
				break;
		}

		return $thumb_size;
	}

	/**
	 * Filter blog categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'satine' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find blog category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function blogCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {
				
				$category_slug = $category->slug;
				$category_title = $category->name;
				
				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'satine' ) . ': ' . $category_title;
				}
				
				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}