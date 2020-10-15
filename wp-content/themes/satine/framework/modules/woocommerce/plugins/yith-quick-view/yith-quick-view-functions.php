<?php

if(!function_exists('satine_elated_woocommerce_quickview_link')) {
	/**
	 * Function that returns quick view link
	 */
	function satine_elated_woocommerce_quickview_link(){
		global $product;

		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			$product_id = $product->get_id();
		} else {
			$product_id = $product->id;
		}

		print '<div class="eltdf-yith-wcqv-holder"><a href="#" class="yith-wcqv-button" data-product_id="'.$product_id.'"><span>'.esc_html__('Quicklook', 'satine').'</span></a></div>';

	}
	add_action('satine_elated_woocommerce_info_below_image_hover', 'satine_elated_woocommerce_quickview_link',1);
}

if(!function_exists('satine_elated_woocommerce_disable_yith_pretty_photo')) {
	/**
	 * Function that disable YITH Quick View pretty photo style
	 */
	function satine_elated_woocommerce_disable_yith_pretty_photo() {
		//is woocommerce installed?
		if(satine_elated_is_woocommerce_installed() && satine_elated_is_yith_wcqv_install()) {

			wp_deregister_style('woocommerce_prettyPhoto_css');
		}
	}

	add_action('wp_footer', 'satine_elated_woocommerce_disable_yith_pretty_photo');
}

