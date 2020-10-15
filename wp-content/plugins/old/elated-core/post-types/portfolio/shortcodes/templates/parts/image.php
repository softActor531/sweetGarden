<?php
$thumb_size = $this_object->getImageSize($params);
?>
<div class="eltdf-pli-image">
	<?php if(has_post_thumbnail()) { ?>
		<?php echo get_the_post_thumbnail(get_the_ID(), $thumb_size); ?>
	<?php } else { ?>
		<img itemprop="image" class="eltdf-pl-original-image" width="800" height="600" src="<?php echo ELATED_ASSETS_ROOT.'/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_html_e('Portfolio Featured Image', 'eltdf-core'); ?>" />
	<?php } ?>
</div>