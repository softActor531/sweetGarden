<div class="eltdf-message  <?php echo esc_attr($message_classes)?>" <?php echo satine_elated_inline_style($message_styles); ?>>
	<div class="eltdf-message-inner">
		<?php		
		if($type == 'with_icon'){
			$icon_html = eltdf_core_get_shortcode_module_template_part('templates/' . $type, 'message', '', $params);
			print $icon_html;
		}
		?>
		<a href="javascript:void(0)" class="eltdf-close" <?php satine_elated_inline_style($close_icon_holder_style); ?>><i class="eltdf-font-elegant-icon icon_close" <?php satine_elated_inline_style($close_icon_style); ?>></i></a>
		<div class="eltdf-message-text-holder">
			<div class="eltdf-message-text">
				<div class="eltdf-message-text-inner"><?php echo do_shortcode($content); ?></div>
			</div>
		</div>
	</div>
</div>