<?php
namespace ElatedCore\CPT\Shortcodes\ProductInfoMinimal;

use ElatedCore\Lib;

class ProductInfoMinimal implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_product_info_minimal';
		
		add_action('vc_before_init', array($this,'vcMap'));
		
		//Product id filter
		add_filter( 'vc_autocomplete_eltdf_product_info_minimal_product_id_callback', array( &$this, 'productIdAutocompleteSuggester', ), 10, 1 );
		
		//Product id render
		add_filter( 'vc_autocomplete_eltdf_product_info_minimal_product_id_render', array( &$this, 'productIdAutocompleteRender', ), 10, 1 );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
        vc_map( array(
            'name' => esc_html__('Elated Product Info Minimal', 'satine'),
            'base' => $this->getBase(),
            'category' => esc_html__('by ELATED', 'satine'),
            'icon' => 'icon-wpb-product-info-minimal extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params' => array(
	                array(
		                'type'       => 'autocomplete',
		                'param_name' => 'product_id',
		                'heading'    => esc_html__('Selected Product', 'satine'),
		                'settings'   => array(
			                'sortable'      => true,
			                'unique_values' => true
		                ),
		                'admin_label' => true,
		                'save_always' => true,
		                'description' => esc_html__('If you left this field empty then product ID will be of the current page', 'satine')
	                ),
	                array(
		                'type'       => 'dropdown',
		                'param_name' => 'featured_image',
		                'heading'    => esc_html__('Show Featured Image', 'satine'),
		                'value'      => array(
					        esc_html__('Yes', 'satine') => 'yes',
					        esc_html__('No', 'satine') => 'no',
		                ),
		                'admin_label' => true
	                ),

	                array(
		                'type'       => 'dropdown',
		                'param_name' => 'featured_image_size',
		                'heading'    => esc_html__('Featured Image Proportions', 'satine'),
		                'value'      => array(
			                esc_html__('Default', 'satine')        => '',
			                esc_html__('Original', 'satine')       => 'full',
			                esc_html__('Square', 'satine')         => 'satine_square',
			                esc_html__('Landscape', 'satine')      => 'satine_landscape',
			                esc_html__('Portrait', 'satine')       => 'satine_portrait',
			                esc_html__('Medium', 'satine')         => 'medium',
			                esc_html__('Large', 'satine')          => 'large',
			                esc_html__('Shop Catalog', 'satine')   => 'shop_catalog',
			                esc_html__('Shop Single', 'satine')    => 'shop_single',
			                esc_html__('Shop Thumbnail', 'satine') => 'shop_thumbnail'
		                ),
		                'dependency'  => array('element' => 'featured_image', 'value' => array('yes'))
	                ),
	                array(
		                'type'        => 'dropdown',
		                'param_name'  => 'title_tag',
		                'heading'     => esc_html__('Title Tag', 'satine'),
		                'value'       => array_flip(satine_elated_get_title_tag(true, array('p' => 'p'))),
		                'description' => esc_html__('Set title tag for product title element', 'satine')
		            )
				)
			)
	    );
     }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'product_id'          => '',
	        'featured_image_size' => 'full',
	        'featured_image'      => 'yes',
	        'title_tag'           => 'h2',
        );

		$params = shortcode_atts($args, $atts);
		extract($params);

	    $params['product_id'] = !empty($params['product_id']) ? $params['product_id'] : get_the_ID();
	    $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];

	   
		    
		$html = '';
			$html .= '<div class="eltdf-product-info-minimal">';
						if ($featured_image == 'yes') {
							$html .= $this->getItemFeaturedImageHtml($params);
						}
	            
			            $html .= $this->getItemTitleHtml($params);
			            			            
			            $html .= $this->getItemExcerptHtml($params);
			            
			            $html .= $this->getItemPriceHtml($params);
			            			            
			            $html .= $this->getSingleProductButtonHtml($params);
			            			            			            
			$html .= '</div>';

        return $html;
	}

	/**
	 * Generates product title html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemTitleHtml($params){
		$html = '';
		$product_id = $params['product_id'];
		$title = get_the_title($product_id);
		$title_tag = $params['title_tag'];

		if(!empty($title)) {
			$html = '<'.esc_attr($title_tag).' itemprop="name" class="eltdf-pi-title entry-title">';
				$html .= '<a itemprop="url" href="'.esc_url(get_the_permalink($product_id)).'">'.esc_html($title).'</a>';
			$html .= '</'.esc_attr($title_tag).'>';
		}

		return $html;
	}
	
	/**
	 * Generates product featured image html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemFeaturedImageHtml($params){
		$html = '';
		$product_id = $params['product_id'];
		$featured_image_size = !empty($params['featured_image_size']) ? $params['featured_image_size'] : 'full';
		$featured_image = get_the_post_thumbnail($product_id, $featured_image_size);
		
		if(!empty($featured_image)) {
			$html = '<a itemprop="url" class="eltdf-pi-image" href="'.esc_url(get_the_permalink($product_id)).'">'.$featured_image.'</a>';
		}
		
		return $html;
	}

	
	
	/**
	 * Generates product excerpt html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemExcerptHtml($params){
		$html = '';
		$product_id = $params['product_id'];
		$excerpt = get_the_excerpt($product_id);
		
		if(!empty($excerpt)) {
			$html = '<div class="eltdf-pi-excerpt"><p itemprop="description" class="eltdf-pi-excerpt-item">'.esc_html($excerpt).'</p></div>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product price html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemPriceHtml($params){
		$html = '';
		$product_id = $params['product_id'];
		$product = wc_get_product($product_id);
		
		if ( $price_html = $product->get_price_html() ) {
			$html = '<div class="eltdf-pi-price">'.$price_html.'</div>';
		}
		
		return $html;
	}
	
	
	/**
	 * Generates product add to cart html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getSingleProductButtonHtml($params){
		$html = '';
		$product_id = $params['product_id'];
		$product = wc_get_product($product_id);


		$html = '<div class="eltdf-single-button-container">';
        if(satine_elated_core_plugin_installed()) {
            $html .= satine_elated_get_button_html(array(
            	'type' => 'with-arrow',
                'size' => 'medium',
                'link' => get_permalink( $product_id ),
                'text' => esc_html__('Shop Now', 'satine'),
                'font_size' => '13px',
                'font_weight' => '600',

            ));
        } else {
            $html .='<a itemprop="url" href="' . get_permalink($product_id) . '" target="_self" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid">';
            $html .= '<span class="eltdf-btn-text">';
            $html .= esc_html__('Shop Now', 'satine');
            $html .= '</span></a>';
        }

		$html .= '</div>';

		return $html;

		
	}

	/**
	 * Filter product by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function productIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$product_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'product' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'satine' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'satine' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;

	}

	/**
	 * Find product by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function productIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			
			$product = get_post( (int) $query );
			if ( ! is_wp_error( $product ) ) {
				
			    $product_id = $product->get_id();
				
				$product_title = $product->post_title;
				
				$product_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$product_title_display = ' - ' . esc_html__( 'Title', 'satine' ) . ': ' . $product_title;
				}
				
				$product_id_display = esc_html__( 'Id', 'satine' ) . ': ' . $product_id;

				$data          = array();
				$data['value'] = $product_id;
				$data['label'] = $product_id_display . $product_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}