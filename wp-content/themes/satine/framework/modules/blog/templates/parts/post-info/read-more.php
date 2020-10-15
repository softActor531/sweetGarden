<div class="eltdf-post-read-more-button">
<?php
    if(satine_elated_core_plugin_installed()) {
        echo satine_elated_get_button_html(
            apply_filters(
                'satine_elated_blog_template_read_more_button',
                array(
                    'type' => 'simple',
                    'size' => 'medium',
                    'link' => get_the_permalink(),
                    'text' => esc_html__('Read more', 'satine'),
                    'font_size' => '11px',
                    'font_weight' => '400',
                    'custom_class' => 'eltdf-blog-list-button',
                    'icon_pack' => 'linear_icons',
                    'linear_icon' => 'lnr-arrow-right'
                )
            )
        );
    } else { ?>
        <a itemprop="url" href="<?php echo esc_attr(get_the_permalink()); ?>" target="_self" class="eltdf-btn eltdf-btn-medium eltdf-btn-simple eltdf-blog-list-button">
            <span class="eltdf-btn-text">
                <?php echo esc_html__('Read more', 'satine'); ?>
            </span>
        </a>
<?php } ?>
</div>
