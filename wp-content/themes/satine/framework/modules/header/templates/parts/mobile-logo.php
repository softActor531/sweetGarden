<?php
	$attachment_meta = satine_elated_get_attachment_meta_from_url($logo_image);
	$hwstring = !empty($attachment_meta) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';
?>

<?php do_action('satine_elated_before_mobile_logo'); ?>

<div class="eltdf-mobile-logo-wrapper">
    <a itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" <?php satine_elated_inline_style($logo_styles); ?>>
        <img itemprop="image" src="<?php  echo get_site_url();?>/wp-content/uploads/2018/10/Logo.png" <?php print $hwstring; ?> alt="<?php esc_html_e('mobile logo','satine'); ?>"/>
    </a>
</div>

<?php  do_action('satine_elated_after_mobile_logo'); ?>