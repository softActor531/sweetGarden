<div <?php satine_elated_class_attribute($holder_classes); ?> <?php echo satine_elated_get_inline_style($holder_styles); ?>>
	<?php if(!empty($background_text)) { ?>
		<div class="eltdf-ot-background-text-holder">
			<span><?php echo esc_html($background_text); ?></span>
		</div>
	<?php } ?>
	<?php if(!empty($background_text_mark)) { ?>
		<div class="eltdf-ot-background-text-mark-holder">
			<span><?php echo esc_html($background_text_mark); ?></span>
		</div>
	<?php } ?>
	<?php if(!empty($foreground_text)) { ?>
		<div class="eltdf-ot-foreground-text-holder">
			<h2 class="eltdf-ot-foreground-text" <?php echo satine_elated_get_inline_style($holder_styles); ?> >
				<span><?php echo esc_html($foreground_text); ?></span>
			</h2>
		</div>
	<?php } ?>

</div>