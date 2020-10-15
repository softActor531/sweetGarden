<div class="eltdf-section-title-holder" <?php echo satine_elated_get_inline_style($holder_styles); ?>>
	<?php if(!empty($subtitle)) { ?>
		<div class="eltdf-st-subtitle-holder" <?php echo satine_elated_get_inline_style($subtitle_holder_styles); ?>>
			<<?php echo esc_attr($subtitle_tag); ?> class="eltdf-st-subtitle" <?php echo satine_elated_get_inline_style($subtitle_styles); ?>>
				<span><?php echo esc_html($subtitle); ?></span>
			</<?php echo esc_attr($subtitle_tag); ?>>
		</div>
	<?php } ?>
	<?php if(!empty($title)) { ?>
		<<?php echo esc_attr($title_tag); ?> class="eltdf-st-title" <?php echo satine_elated_get_inline_style($title_styles); ?>>
			<span><?php echo esc_html($title); ?></span>
		</<?php echo esc_attr($title_tag); ?>>
	<?php } ?>
	<?php if(!empty($text)) { ?>
		<p class="eltdf-st-text" <?php echo satine_elated_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
	<?php } ?>
</div>