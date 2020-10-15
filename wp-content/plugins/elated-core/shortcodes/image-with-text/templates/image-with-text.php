<div class="eltdf-image-with-text-holder">
    <div class="eltdf-iwt-image">
        <?php if ($enable_lightbox) { ?>
            <a itemprop="image" href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
        <?php } else if ($link) { ?>
            <a itemprop="url" href="<?php echo esc_url($link) ?>" title="" target="<?php echo esc_attr($target); ?>">
        <?php } ?>
            <?php if(is_array($image_size) && count($image_size)) : ?>
                <?php echo satine_elated_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
        <?php if ($enable_lightbox || $link) { ?>
            </a>
        <?php } ?>
    </div>
    <div class="eltdf-iwt-text-holder">
        <?php if(!empty($title)) { ?>
            <<?php echo esc_attr($title_tag); ?> class="eltdf-iwt-title" <?php echo satine_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        <?php } ?>
		<?php if(!empty($text)) { ?>
            <p class="eltdf-iwt-text" <?php echo satine_elated_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
        <?php } ?>
    </div>
</div>