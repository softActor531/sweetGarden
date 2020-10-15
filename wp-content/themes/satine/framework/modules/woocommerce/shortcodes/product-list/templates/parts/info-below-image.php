<?php
$masonry_image_size = get_post_meta(get_the_ID(), 'eltdf_product_featured_image_size', true);
if(empty($masonry_image_size)) {
	$masonry_image_size = '';
}

$text_wrapper_class = '';
if($display_price == 'no' && $display_rating == 'no'){
    $text_wrapper_class .= 'eltdf-no-rating-price';
}
?>
<div class="eltdf-pli <?php echo esc_html($masonry_image_size); ?>">
	<div class="eltdf-pli-inner">
		<div class="eltdf-pli-image">
			<?php satine_elated_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
		</div>
		<?php if ($display_quicklook_wishlist == 'yes') { ?>
			<div class="eltdf-pli-text">
				<div class="eltdf-pli-text-outer">
					<div class="eltdf-pli-text-inner">
						<?php do_action('satine_elated_woocommerce_info_below_image_hover'); ?>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php satine_elated_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>
	</div>
	<div class="eltdf-pli-text-wrapper <?php echo esc_html($text_wrapper_class); ?>" <?php echo satine_elated_get_inline_style($text_wrapper_styles); ?>>
		<?php satine_elated_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
		
		<?php satine_elated_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>
		
		<?php satine_elated_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>
		
		<?php satine_elated_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
		
		<?php satine_elated_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>

		
	</div>
</div>