<?php

if (!function_exists('satine_elated_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 9
	 * @return int number of products to be shown per page
	 */
	function satine_elated_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (satine_elated_options()->getOptionValue('eltdf_woo_products_per_page')) {
			$products_per_page = satine_elated_options()->getOptionValue('eltdf_woo_products_per_page');
		}
		if(isset($_GET['woo-products-count']) && $_GET['woo-products-count'] === 'view-all') {
			$products_per_page = 9999;
		}

		return $products_per_page;
	}
}

if (!function_exists('satine_elated_woocommerce_thumbnails_per_row')) {
	/**
	 * Function that sets number of thumbnails on single product page per row. Default is 4
	 * @return int number of thumbnails to be shown on single product page per row
	 */
	function satine_elated_woocommerce_thumbnails_per_row() {

		return 4;
	}
}

if (!function_exists('satine_elated_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function satine_elated_woocommerce_related_products_args($args) {
		$related = satine_elated_options()->getOptionValue('eltdf_woo_product_list_columns');
		
		if (!empty($related)) {
			switch ($related) {
				case 'eltdf-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'eltdf-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}
		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;
	}
}

if (!function_exists('satine_elated_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function satine_elated_woocommerce_template_loop_product_title() {

		$tag = satine_elated_options()->getOptionValue('eltdf_products_list_title_tag');
		if($tag === '') {
			$tag = 'h5';
		}
		the_title('<' . $tag . ' class="eltdf-product-list-title"><a href="'.get_the_permalink().'">', '</a></' . $tag . '>');
	}
}

if (!function_exists('satine_elated_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function satine_elated_woocommerce_template_single_title() {

		$tag = satine_elated_options()->getOptionValue('eltdf_single_product_title_tag');
		if($tag === '') {
			$tag = 'h2';
		}
		the_title('<' . $tag . '  itemprop="name" class="eltdf-single-product-title">', '</' . $tag . '>');
	}
}

if (!function_exists('satine_elated_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function satine_elated_woocommerce_sale_flash() {
		global $product;

		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			$product_regular_price = $product->get_regular_price();
			$product_sale_price = $product->get_sale_price();
		} else {
			$product_regular_price = $product->regular_price;
			$product_sale_price = $product->sale_price;
		}

		if ($product->is_in_stock() && !$product->has_child()) { //second condition is for variable products that has variations with different prices
			return '<span class="eltdf-onsale">' . satine_elated_woocommerce_sale_percentage(intval($product_regular_price), intval($product_sale_price)) . '</span>';
		}
	}
}

if (!function_exists('satine_elated_woocommerce_product_out_of_stock')) {
	/**
	 * Function for adding Out Of Stock Template
	 *
	 * @return string
	 */
	function satine_elated_woocommerce_product_out_of_stock() {

		global $product;

		if (!$product->is_in_stock()) {
			print '<span class="eltdf-out-of-stock">' . esc_html__('Sold', 'satine') . '</span>';
		}
	}
}

if (!function_exists('satine_elated_woocommerce_new_product_mark')) {
	/**
	 * Function for adding New Product Template
	 *
	 * @return string
	 */
	function satine_elated_woocommerce_new_product_mark() {
		global $product;

		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			$product_id = $product->get_id();
		} else {
			$product_id = $product->id;
		}

		if (get_post_meta($product_id, 'eltdf_single_product_new_meta', true) === 'yes') {
			print '<span class="eltdf-new-product">' . esc_html__('New', 'satine') . '</span>';
		}

	}
}

if (!function_exists('satine_elated_woocommerce_view_all_pagination')) {
	/**
	 * Function for adding New WooCommerce Pagination Template
	 *
	 * @return string
	 */
	function satine_elated_woocommerce_view_all_pagination() {

		global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		$html = '';

		if(get_option('woocommerce_shop_page_id')) {
			$html .= '<div class="eltdf-woo-view-all-pagination">';
			$html .= '<a href="'.get_permalink(get_option('woocommerce_shop_page_id')).'?woo-products-count=view-all">'.esc_html__('View All', 'satine').'</a>';
			$html .= '</div>';
		}

		print $html;
	}
}
if (!function_exists('satine_elated_woocommerce_template_loop_add_to_cart')) {
	/**
	 * Function for adding woo button to list
	 *
	 * @return string
	 */
	function satine_elated_woocommerce_template_loop_add_to_cart() {
		global $product;

		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			$product_id = $product->get_id();
			$product_type = $product->get_type();
		} else {
			$product_id = $product->id;
			$product_type = $product->product_type;
		}

		if (!$product->is_in_stock()) {
			$button_classes = 'ajax_add_to_cart eltdf-button';
		} else if ($product_type === 'variable') {
			$button_classes = 'product_type_variable add_to_cart_button eltdf-button';
		} else if ($product_type === 'external') {
			$button_classes = 'product_type_external eltdf-button';
		} else {
			$button_classes = 'add_to_cart_button ajax_add_to_cart eltdf-button';
		}

		echo '<div class="eltdf-pl-add-to-cart">';
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s<span  class="eltdf-add-to-cart-icon icon-arrows-circle-plus"></span></a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product_id ),
				esc_attr( $product->get_sku() ),
				esc_attr( $button_classes ),
				esc_html( $product->add_to_cart_text() )
			),
			$product );
		echo '</div>';
	}
}

if (!function_exists('satine_elated_woo_view_all_pagination_additional_tag_before')) {
	function satine_elated_woo_view_all_pagination_additional_tag_before() {

		print '<div class="eltdf-woo-pagination-holder"><div class="eltdf-woo-pagination-inner">';
	}
}

if (!function_exists('satine_elated_woo_view_all_pagination_additional_tag_after')) {
	function satine_elated_woo_view_all_pagination_additional_tag_after() {

		print '</div></div>';
	}
}

if (!function_exists('satine_elated_woocommerce_product_thumbnail_column_size')) {
	function satine_elated_woocommerce_product_thumbnail_column_size() {
		
		return 4;
	}
}

if (!function_exists('satine_elated_single_product_content_additional_tag_before')) {
	function satine_elated_single_product_content_additional_tag_before() {

		print '<div class="eltdf-single-product-content">';
	}
}

if (!function_exists('satine_elated_single_product_content_additional_tag_after')) {
	function satine_elated_single_product_content_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('satine_elated_single_product_summary_additional_tag_before')) {
	function satine_elated_single_product_summary_additional_tag_before() {

		print '<div class="eltdf-single-product-summary">';
	}
}

if (!function_exists('satine_elated_single_product_summary_additional_tag_after')) {
	function satine_elated_single_product_summary_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('satine_elated_pl_holder_additional_tag_before')) {
	function satine_elated_pl_holder_additional_tag_before() {

		print '<div class="eltdf-pl-main-holder">';
	}
}

if (!function_exists('satine_elated_pl_holder_additional_tag_after')) {
	function satine_elated_pl_holder_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('satine_elated_pl_inner_additional_tag_before')) {
	function satine_elated_pl_inner_additional_tag_before() {

		print '<div class="eltdf-pl-inner">';
	}
}

if (!function_exists('satine_elated_pl_inner_additional_tag_after')) {
	function satine_elated_pl_inner_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('satine_elated_pl_image_additional_tag_before')) {
	function satine_elated_pl_image_additional_tag_before() {

		print '<div class="eltdf-pl-image">';
	}
}

if (!function_exists('satine_elated_pl_image_additional_tag_after')) {
	function satine_elated_pl_image_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('satine_elated_pl_inner_text_additional_tag_before')) {
	function satine_elated_pl_inner_text_additional_tag_before() {

		print '<div class="eltdf-pl-text"><div class="eltdf-pl-text-outer"><div class="eltdf-pl-text-inner">';
	}
}

if (!function_exists('satine_elated_pl_inner_text_additional_tag_after')) {
	function satine_elated_pl_inner_text_additional_tag_after() {

		print '</div></div></div>';
	}
}

if (!function_exists('satine_elated_pl_text_wrapper_additional_tag_before')) {
	function satine_elated_pl_text_wrapper_additional_tag_before() {

		print '<div class="eltdf-pl-text-wrapper">';
	}
}

if (!function_exists('satine_elated_pl_text_wrapper_additional_tag_after')) {
	function satine_elated_pl_text_wrapper_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('satine_elated_pl_rating_additional_tag_before')) {
	function satine_elated_pl_rating_additional_tag_before() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

			// this condition is only for woocommerce 3.0, because get_rating_html function is deprecated, when they release new update remove else
			if(function_exists('wc_get_rating_html')) {
				$rating_html = wc_get_rating_html( $product->get_average_rating() );
			} else {
				$rating_html = $product->get_rating_html();
			}

			if($rating_html !== '') {
				print '<div class="eltdf-pl-rating-holder">';
			}
		}
	}
}

if (!function_exists('satine_elated_pl_rating_additional_tag_after')) {
	function satine_elated_pl_rating_additional_tag_after() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

			// this condition is only for woocommerce 3.0, because get_rating_html function is deprecated, when they release new update remove else
			if(function_exists('wc_get_rating_html')) {
				$rating_html = wc_get_rating_html( $product->get_average_rating() );
			} else {
				$rating_html = $product->get_rating_html();
			}


			if($rating_html !== '') {
				print '</div>';
			}
		}
	}
}

if (!function_exists('satine_elated_woocommerce_cart_title')) {
	function satine_elated_woocommerce_cart_title(){
		print '<h2>'.esc_html__('Shopping Cart','satine').'</h2>';
	}
}

if (!function_exists('satine_elated_woocommerce_cart_back_to_home')) {
	function satine_elated_woocommerce_cart_back_to_home(){
		print '<a class="eltdf-cart-go-back" itemprop="url" href="' . esc_url(home_url('/')) . '">' . esc_html__('Go Back Shopping', 'satine') . '</a>';
	}
}

if (!function_exists('satine_elated_woocommerce_empty_cart_text')) {
    function satine_elated_woocommerce_empty_cart_text(){
        print '<p>'.esc_html__('Why not return to our amazing shop and start filling it with products. Just click on the button below to instantly get back to the shop page. Oh, and while you are there, check out all of our mind-blowing discounts.','satine').'</p>';
    }
}

if (!function_exists('satine_elated_woocommerce_div_before_account_navigation')) {
	function satine_elated_woocommerce_div_before_account_navigation(){
		print '<div class="eltdf-woocommerce-account-navigation">';
	}
}

if (!function_exists('satine_elated_woocommerce_div_after_account_navigation')) {
	function satine_elated_woocommerce_div_after_account_navigation(){
		print '</div>';
	}
}

if (!function_exists('satine_elated_woocommerce_account_profile_image')) {
	function satine_elated_woocommerce_account_profile_image(){
		$current_user    = wp_get_current_user();
		$name            = $current_user->display_name;
		$current_user_id = $current_user->ID;

		$html = '';

		$profile_image = get_user_meta( $current_user_id, 'social_profile_image', true );
		if ( $profile_image == '' ) {
			$profile_image = get_avatar( $current_user_id );
		} else {
			$profile_image = '<img src="' . esc_url( $profile_image ) . '" />';
		}
		$html .= '<div class="eltdf-user-info">';
		$html .= satine_elated_kses_img( $profile_image, 96 );
		$html .= '<h3>Hello</h3>';
		$html .= '<span class="eltdf-username">@'.esc_html( $name ).'</span>';
		$html .= '</div>';


		print $html;
	}
}

if (!function_exists('satine_elated_login_form_additional_tag_before')) {
	function satine_elated_login_form_additional_tag_before(){
		print '<div class="eltdf-woocommerce-account-login-form">';
	}
}

if (!function_exists('satine_elated_login_form_additional_tag_after')) {
	function satine_elated_login_form_additional_tag_after(){
		print '</div>';
	}
}



