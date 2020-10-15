<div class="eltdf-price-table">
	<div class="eltdf-pt-inner" <?php echo satine_elated_get_inline_style($holder_styles); ?>>
		<ul>
			<li class="eltdf-pt-title-holder">
				<span class="eltdf-pt-title" <?php echo satine_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
			</li>
			<li class="eltdf-pt-prices">
				<span class="eltdf-pt-value" <?php echo satine_elated_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
				<span class="eltdf-pt-price" <?php echo satine_elated_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<span class="eltdf-pt-mark" <?php echo satine_elated_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></span>
			</li>
            <li class="eltdf-pt-subtitle-holder">
                <span class="eltdf-pt-subtitle" <?php echo satine_elated_get_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></span>
            </li>
			<li class="eltdf-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="eltdf-pt-button">
					<?php echo satine_elated_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => 'simple',
                        'font_size' => '11px',
                        'icon_pack' => 'linear_icons',
						'linear_icon' => 'lnr-arrow-right'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>