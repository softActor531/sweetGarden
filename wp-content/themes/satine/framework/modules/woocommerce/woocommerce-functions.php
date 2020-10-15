<?php
/**
 * Woocommerce helper functions
 */

if(!function_exists('satine_elated_is_yith_wcqv_install')) {
	function satine_elated_is_yith_wcqv_install() {
		return defined('YITH_WCQV');
	}
}

if(!function_exists('satine_elated_is_yith_wcwl_install')) {
	function satine_elated_is_yith_wcwl_install() {
		return defined('YITH_WCWL');
	}
}

if(!function_exists('satine_elated_woocommerce_meta_box_functions')) {
	function satine_elated_woocommerce_meta_box_functions($post_types) {
		$post_types[] = 'product';
		
		return $post_types;
	}
	
	add_filter('satine_elated_meta_box_post_types_save', 'satine_elated_woocommerce_meta_box_functions');
}

if(!function_exists('satine_elated_get_woo_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 * @see satine_elated_get_template_part()
	 */
	function satine_elated_get_woo_shortcode_module_template_part($template, $module, $slug = '', $params = array()) {
		
		//HTML Content from template
		$html          = '';
		$template_path = 'framework/modules/woocommerce/shortcodes/'.$module;
		
		$temp = $template_path.'/'.$template;
		
		if(is_array($params) && count($params)) {
			extract($params);
		}
		
		$templates = array();
		
		if($temp !== '') {
			if($slug !== '') {
				$templates[] = "{$temp}-{$slug}.php";
			}
			
			$templates[] = $temp.'.php';
		}
		$located = satine_elated_find_template_path($templates);
		if($located) {
			ob_start();
			include($located);
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if(!function_exists('satine_elated_disable_woocommerce_pretty_photo')) {
    /**
     * Function that disable WooCommerce pretty photo script and style
     */
    function satine_elated_disable_woocommerce_pretty_photo() {
        //is woocommerce installed?
        if(satine_elated_is_woocommerce_installed()) {
            if(satine_elated_load_woo_assets()) {

                wp_deregister_style('woocommerce_prettyPhoto_css');
            }
        }
    }

    add_action('wp_enqueue_scripts', 'satine_elated_disable_woocommerce_pretty_photo');
}

if (!function_exists('satine_elated_woocommerce_body_class')) {
	/**
	 * Function that adds class on body for Woocommerce
	 *
	 * @param $classes
	 * @return array
	 */
	function satine_elated_woocommerce_body_class( $classes ) {
		if(satine_elated_is_woocommerce_page()) {
			$classes[] = 'eltdf-woocommerce-page';

			if(function_exists('is_shop') && is_shop()) {
				$classes[] = 'eltdf-woo-main-page';
			}

			if (is_singular('product')) {
				$classes[] = 'eltdf-woo-single-page';
			}
		}
		
		return $classes;
	}

	add_filter('body_class', 'satine_elated_woocommerce_body_class');
}

if(!function_exists('satine_elated_woocommerce_columns_class')) {
	/**
	 * Function that adds number of columns class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function satine_elated_woocommerce_columns_class($classes) {
		if(satine_elated_is_woocommerce_installed()) {
			$products_list_number = satine_elated_options()->getOptionValue('eltdf_woo_product_list_columns');
			
			$classes[] = $products_list_number;
		}

		return $classes;
	}

	add_filter('body_class', 'satine_elated_woocommerce_columns_class');
}

if(!function_exists('satine_elated_woocommerce_columns_space_class')) {
	/**
	 * Function that adds space between columns class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function satine_elated_woocommerce_columns_space_class($classes) {
		if(satine_elated_is_woocommerce_installed()) {
			$columns_space = satine_elated_options()->getOptionValue('eltdf_woo_product_list_columns_space');
			
			$classes[] = $columns_space;
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'satine_elated_woocommerce_columns_space_class');
}

if(!function_exists('satine_elated_woocommerce_pl_info_position_class')) {
	/**
	 * Function that adds product list info position class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function satine_elated_woocommerce_pl_info_position_class($classes) {
		if(satine_elated_is_woocommerce_installed()) {
			$info_position = satine_elated_options()->getOptionValue('eltdf_woo_product_list_info_position');
			$info_position_class = '';
			if($info_position === 'info_below_image') {
				$info_position_class = 'eltdf-woo-pl-info-below-image';
			} else if ($info_position === 'info_on_image_hover') {
				$info_position_class = 'eltdf-woo-pl-info-on-image-hover';
			}
			
			$classes[] = $info_position_class;
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'satine_elated_woocommerce_pl_info_position_class');
}

if(!function_exists('satine_elated_woocommerce_pl_show_ratings_class')) {
	/**
	 * Function that adds product list show ratings class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added woocommerce class
	 */
	function satine_elated_woocommerce_pl_show_ratings_class($classes) {
		if(satine_elated_is_woocommerce_installed()) {
			$show_ratings = satine_elated_options()->getOptionValue('eltdf_woo_product_list_show_ratings');
			$show_ratings_class = '';
			if($show_ratings === 'yes') {
				$show_ratings_class = 'eltdf-woo-pl-show-ratings';
			} else  {
				$show_ratings_class = 'eltdf-woo-pl-hide-ratings';
			}
			
			$classes[] = $show_ratings_class;
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'satine_elated_woocommerce_pl_show_ratings_class');
}

if(!function_exists('satine_elated_is_woocommerce_page')) {
	/**
	 * Function that checks if current page is woocommerce shop, product or product taxonomy
	 * @return bool
	 *
	 * @see is_woocommerce()
	 */
	function satine_elated_is_woocommerce_page() {
		if (function_exists('is_woocommerce') && is_woocommerce()) {
			return is_woocommerce();
		} elseif (function_exists('is_cart') && is_cart()) {
			return is_cart();
		} elseif (function_exists('is_checkout') && is_checkout()) {
			return is_checkout();
		} elseif (function_exists('is_account_page') && is_account_page()) {
			return is_account_page();
		}
	}
}

if(!function_exists('satine_elated_is_woocommerce_shop')) {
	/**
	 * Function that checks if current page is shop or product page
	 * @return bool
	 *
	 * @see is_shop()
	 */
	function satine_elated_is_woocommerce_shop() {
		return function_exists('is_shop') && (is_shop() || is_product());
	}
}

if(!function_exists('satine_elated_get_woo_shop_page_id')) {
	/**
	 * Function that returns shop page id that is set in WooCommerce settings page
	 * @return int id of shop page
	 */
	function satine_elated_get_woo_shop_page_id() {
		if(satine_elated_is_woocommerce_installed()) {
			return get_option('woocommerce_shop_page_id');
		}
	}
}

if(!function_exists('satine_elated_is_product_category')) {
	function satine_elated_is_product_category() {
		return function_exists('is_product_category') && is_product_category();
	}
}

if(!function_exists('satine_elated_is_product_tag')) {
	function satine_elated_is_product_tag() {
		return function_exists('is_product_tag') && is_product_tag();
	}
}

if(!function_exists('satine_elated_load_woo_assets')) {
	/**
	 * Function that checks whether WooCommerce assets needs to be loaded.
	 *
	 * @see satine_elated_is_woocommerce_page()
	 * @see satine_elated_has_woocommerce_shortcode()
	 * @see satine_elated_has_woocommerce_widgets()
	 * @return bool
	 */

	function satine_elated_load_woo_assets() {
		return satine_elated_is_woocommerce_installed() && (satine_elated_is_woocommerce_page() || satine_elated_has_woocommerce_shortcode() || satine_elated_has_woocommerce_widgets());
	}
}

if(!function_exists('satine_elated_return_woocommerce_global_variable')) {
	function satine_elated_return_woocommerce_global_variable() {
		if(satine_elated_is_woocommerce_installed()) {
			global $product;

			return $product;
		}
	}
}

if(!function_exists('satine_elated_has_woocommerce_shortcode')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function satine_elated_has_woocommerce_shortcode() {
		$woocommerce_shortcodes = array(
			'eltdf_product_info',
			'eltdf_product_list',
			'eltdf_product_list_carousel',
			'eltdf_product_list_simple',
			'add_to_cart',
			'add_to_cart_url',
			'product_page',
			'product',
			'products',
			'product_categories',
			'product_category',
			'recent_products',
			'featured_products',
			'sale_products',
			'best_selling_products',
			'top_rated_products',
			'product_attribute',
			'related_products',
			'woocommerce_messages',
			'woocommerce_cart',
			'woocommerce_checkout',
			'woocommerce_order_tracking',
			'woocommerce_my_account',
			'woocommerce_edit_address',
			'woocommerce_change_password',
			'woocommerce_view_order',
			'woocommerce_pay',
			'woocommerce_thankyou'
		);

		foreach($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = satine_elated_has_shortcode($woocommerce_shortcode);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('satine_elated_has_woocommerce_widgets')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function satine_elated_has_woocommerce_widgets() {
		$widgets_array = array(
			'eltdf_woocommerce_dropdown_cart',
			'woocommerce_widget_cart',
			'woocommerce_layered_nav',
			'woocommerce_layered_nav_filters',
			'woocommerce_price_filter',
			'woocommerce_product_categories',
			'woocommerce_product_search',
			'woocommerce_product_tag_cloud',
			'woocommerce_products',
			'woocommerce_recent_reviews',
			'woocommerce_recently_viewed_products',
			'woocommerce_top_rated_products'
		);

		foreach($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('satine_elated_add_woocommerce_shortcode_class')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return string
	 */
	function satine_elated_add_woocommerce_shortcode_class($classes){
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking'
		);

		foreach($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = satine_elated_has_shortcode($woocommerce_shortcode);

			if($has_shortcode) {
				$classes[] = 'eltdf-woocommerce-page woocommerce-account eltdf-'.str_replace('_', '-', $woocommerce_shortcode);
			}
		}

		return $classes;
	}

	add_filter('body_class', 'satine_elated_add_woocommerce_shortcode_class');
}

if(!function_exists('satine_elated_woocommerce_product_single_class')) {
	function satine_elated_woocommerce_product_single_class($classes) {
		if(in_array('woocommerce', $classes)) {
			$product_thumbnail_position = satine_elated_get_meta_field_intersect('woo_set_thumb_images_position');
			
			if(satine_elated_get_meta_field_intersect('woo_enable_single_thumb_featured_switch') === 'yes') {
				$classes[] = 'eltdf-woo-single-switch-image';
			}
			
			if(!empty($product_thumbnail_position)) {
				$classes[] = 'eltdf-woo-single-thumb-'.$product_thumbnail_position;
			}
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'satine_elated_woocommerce_product_single_class');
}

if (!function_exists('satine_elated_woocommerce_share_wish_tag_before')) {
	/**
	 * Function that adds tag before share and like section
	 */
	function satine_elated_woocommerce_share_wish_tag_before() {
		print '<div class="eltdf-single-product-share-wish">';
	}
}

if (!function_exists('satine_elated_woocommerce_share_wish_tag_after')) {
	/**
	 * Function that adds tag before share and like section
	 */
	function satine_elated_woocommerce_share_wish_tag_after() {
		print '</div>';
	}
}

if(!function_exists('satine_elated_woocommerce_share')) {
    /**
     * Function that social share for product page
     * Return array array of WooCommerce pages
     */
    function satine_elated_woocommerce_share() {
        if (satine_elated_is_woocommerce_installed()) {

            if (satine_elated_options()->getOptionValue('enable_social_share') == 'yes' && satine_elated_options()->getOptionValue('enable_social_share_on_product') == 'yes') :
                print '<div class="eltdf-woo-social-share-holder">';
                print '<span>'.esc_html__('Share', 'satine').'</span>';
                echo satine_elated_get_social_share_html();
                print '</div>';
            endif;
        }
    }
}

if(!function_exists('satine_elated_woocommerce_sale_percentage')) {
	/**
	 * Function that social share for product page
	 * Return string
	 */
	function satine_elated_woocommerce_sale_percentage($price, $sale_price){
		if($price > 0) {
			return '-' . (100 - round(($sale_price * 100) / $price)) . '%';
		}else{
			return esc_html__('SALE', 'satine');
		}
	}
}

/**
 * Loads more function for portfolio.
 */
if(!function_exists('eltdf_product_ajax_load_category')) {
	function eltdf_product_ajax_load_category() {
		$shortcode_params = array();

		if(!empty($_POST)) {
			foreach ($_POST as $key => $value) {
				if($key !== '') {
					$addUnderscoreBeforeCapitalLetter = preg_replace('/([A-Z])/', '_$1', $key);
					$setAllLettersToLowercase = strtolower($addUnderscoreBeforeCapitalLetter);

					$shortcode_params[$setAllLettersToLowercase] = $value;
				}
			}
		}

		$html = '';

		$product_list = new \ElatedCore\CPT\Shortcodes\ProductList\ProductList();

		$query_array = $product_list->generateProductQueryArray($shortcode_params);
		$query_results = new \WP_Query($query_array);

		if($query_results->have_posts()): while ($query_results->have_posts()) : $query_results->the_post();
			$html .= satine_elated_get_woo_shortcode_module_template_part('templates/parts/'.$shortcode_params['info_position'], 'product-list', '', $shortcode_params);
		endwhile; else:
			$html .= '<p class="eltdf-no-posts">'.esc_html__('No products were found!', 'satine').'</p>';
		endif;
		wp_reset_postdata();

		$return_obj = array(
			'html' => $html,
		);

		echo json_encode($return_obj); exit;
	}

	add_action('wp_ajax_nopriv_eltdf_product_ajax_load_category', 'eltdf_product_ajax_load_category');
	add_action( 'wp_ajax_eltdf_product_ajax_load_category', 'eltdf_product_ajax_load_category' );
}

