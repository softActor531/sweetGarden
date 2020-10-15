<?php
$product = satine_elated_return_woocommerce_global_variable();

if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
	$product_id = $product->get_id();
	$product_regular_price = $product->get_regular_price();
	$product_sale_price = $product->get_sale_price();
} else {
	$product_id = $product->id;
	$product_regular_price = $product->regular_price;
	$product_sale_price = $product->sale_price;
}

if (get_post_meta($product_id, 'eltdf_single_product_new_meta', true) === 'yes'){ ?>
    <span class="eltdf-<?php echo esc_attr($class_name); ?>-new-product"><?php esc_html_e('New', 'satine'); ?></span>
<?php } ?>

<?php if ($product->is_on_sale() && $product->is_in_stock()) { ?>
    <span class="eltdf-<?php echo esc_attr($class_name); ?>-onsale"><?php echo satine_elated_woocommerce_sale_percentage(intval($product_regular_price), intval($product_sale_price)); ?></span>
<?php } ?>

<?php if (!$product->is_in_stock()) { ?>
	<span class="eltdf-<?php echo esc_attr($class_name); ?>-out-of-stock"><?php esc_html_e('Sold', 'satine'); ?></span>
<?php }

$product_image_size = 'shop_catalog';
if($image_size === 'full') {
	$product_image_size = 'full';
} else if ($image_size === 'square') {
	$product_image_size = 'satine_square';
} else if ($image_size === 'landscape') {
	$product_image_size = 'satine_landscape';
} else if ($image_size === 'portrait') {
	$product_image_size = 'satine_portrait';
} else if ($image_size === 'medium') {
	$product_image_size = 'medium';
} else if ($image_size === 'large') {
	$product_image_size = 'large';
} else if ($image_size === 'shop_thumbnail') {
	$product_image_size = 'shop_thumbnail';
}

if(has_post_thumbnail()) {
	the_post_thumbnail(apply_filters( 'satine_elated_product_list_image_size', $product_image_size));
}