<?php $icon_html = satine_elated_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="eltdf-icon-list-holder" <?php echo satine_elated_get_inline_style($holder_styles); ?>>
	<div class="eltdf-il-icon-holder">
		<?php print $icon_html;	?>
	</div>
	<p class="eltdf-il-text" <?php echo satine_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
</div>