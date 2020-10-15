<?php
	$attachment_meta = satine_elated_get_attachment_meta_from_url($logo_image);
	$hwstring = !empty($attachment_meta) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';

	if(!empty($logo_image_dark)) {
		$attachment_meta_dark = satine_elated_get_attachment_meta_from_url($logo_image_dark);
		$hwstring_dark = !empty($attachment_meta_dark) ? image_hwstring($attachment_meta_dark['width'], $attachment_meta_dark['height']) : '';
	}

	if(!empty($logo_image_light)) {
		$attachment_meta_light = satine_elated_get_attachment_meta_from_url( $logo_image_light );
		$hwstring_light = !empty($attachment_meta_light) ? image_hwstring($attachment_meta_light['width'], $attachment_meta_light['height']) : '';
	}
?>

<?php do_action('satine_elated_before_site_logo'); ?>

<div class="eltdf-logo-wrapper">
    <a itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" <?php satine_elated_inline_style($logo_styles); ?>>
        <img itemprop="image" class="eltdf-normal-logo" src="<?php echo esc_url($logo_image); ?>" <?php print $hwstring; ?> alt="<?php esc_html_e('logo','satine'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img itemprop="image" class="eltdf-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" <?php print $hwstring_dark; ?> alt="<?php esc_html_e('dark logo','satine'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img itemprop="image" class="eltdf-light-logo" src="<?php echo esc_url($logo_image_light); ?>" <?php print $hwstring_light; ?> alt="<?php esc_html_e('light logo','satine'); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('satine_elated_after_site_logo'); ?>