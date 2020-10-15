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
                            <?php switch ($type){
                                case 'standard': ?>
                                    <div class="eltdf-title-info eltdf-title-info-top">
                                        <?php satine_elated_get_module_template_part('templates/parts/post-info/date', 'blog'); ?>
                                    </div>
                                    <?php if(satine_elated_get_title_text() !== '') { ?>
                                        <h1 class="entry-title" <?php satine_elated_inline_style($title_color); ?>><span><?php satine_elated_title_text(); ?></span></h1>
                                    <?php } ?>
                                    <?php if($has_subtitle){ ?>
                                        <span class="eltdf-subtitle" <?php satine_elated_inline_style($subtitle_color); ?>><span><?php satine_elated_subtitle_text(); ?></span></span>
                                    <?php } ?>
                                    <?php if($enable_breadcrumbs){ ?>
                                        <div class="eltdf-breadcrumbs-holder"> <?php satine_elated_custom_breadcrumbs(); ?></div>
                                    <?php } ?>
                                    <div class="eltdf-title-info eltdf-title-info-bottom">
                                        <?php satine_elated_get_module_template_part('templates/parts/post-info/author', 'blog'); ?>
                                    </div>
                                    <?php break;
                                case 'breadcrumb': ?>
                                    <div class="eltdf-breadcrumbs-holder"> <?php satine_elated_custom_breadcrumbs(); ?></div>
                                    <?php break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php do_action('satine_elated_after_page_title'); ?>