<?php

if (!function_exists('satine_elated_woocommerce_yith_template_single_title')) {
	/**
	 * Function for overriding product title template in YITH Quick View plugin template
	 */
	function satine_elated_woocommerce_yith_template_single_title() {

		the_title('<h3  itemprop="name" class="eltdf-yith-product-title entry-title">', '</h3>');
	}
}

if (!function_exists('satine_elated_woocommerce_show_product_images')) {
	/**
	 * Function for overriding product images template in YITH Quick View plugin template
	 */
	function satine_elated_woocommerce_show_product_images() {
		global $product;

		$html = '';
		$attachment_ids = $product->get_gallery_attachment_ids();
		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			$product_id = $product->get_id();
		} else {
			$product_id = $product->id;
		}

			$html .= '<div class="images eltdf-quick-view-gallery eltdf-owl-slider">';
			$image_title = esc_attr( get_the_title($product_id) );
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'shop_single');
			$html .= '<div class="item"><img src="'.esc_url($image_src[0]).'" alt="'.esc_html($image_title).'"></div>';
			if ( $attachment_ids ) {
				foreach ($attachment_ids as $attachment_id) {
					$image_link = wp_get_attachment_url($attachment_id);
					if ($image_link !== '') {
						$image_title = esc_attr(get_the_title($attachment_id));
						$image_src = wp_get_attachment_image_src($attachment_id, 'shop_single');
						$html .= '<div class="item"><img src="' . esc_url($image_src[0]) . '" alt="' . esc_html($image_title) . '"></div>';
					}
				}
			}
			$html .= '</div>';


		print $html;
	}
}