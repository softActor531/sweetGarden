<div class="eltdf-eh-item <?php echo esc_attr($elements_holder_item_class); ?>" <?php echo satine_elated_get_inline_attrs($elements_holder_item_responsive_data); ?>>
	<div class="eltdf-eh-item-background-holder">
		<div class="eltdf-eh-item-background-holder">
			<div class="eltdf-eh-item-background" <?php echo satine_elated_get_inline_style($elements_holder_item_style); ?>></div>
		</div>
	</div>
	<div class="eltdf-eh-item-inner">
		<div class="eltdf-eh-item-content <?php echo esc_attr($elements_holder_item_content_class); ?>" <?php echo satine_elated_get_inline_style($elements_holder_item_content_style); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>