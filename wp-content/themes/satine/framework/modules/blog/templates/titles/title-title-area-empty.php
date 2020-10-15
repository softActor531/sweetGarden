<?php do_action('satine_elated_before_page_title'); ?>
<?php if($show_title_area) { ?>
    <div class="eltdf-title <?php echo satine_elated_title_classes(array(), $module); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <?php if(!empty($title_background_image_src)) { ?>
            <div class="eltdf-title-image">
                <img itemprop="image" src="<?php echo esc_url($title_background_image_src); ?>" alt="<?php esc_html_e('Title Image', 'satine'); ?>" />
            </div>
        <?php } ?>
        <div class="eltdf-title-holder" <?php satine_elated_inline_style($title_holder_height); ?>>
            <div class="eltdf-container clearfix">
                <div class="eltdf-container-inner">
                    <div class="eltdf-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="eltdf-title-subtitle-holder-inner">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php do_action('satine_elated_after_page_title'); ?>