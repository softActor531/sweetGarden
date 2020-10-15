<div class="eltdf-testimonial-content" id="eltdf-testimonials-<?php echo esc_attr($current_id) ?>" <?php satine_elated_inline_style($box_styles); ?>>
    <div class="eltdf-testimonial-text-holder">
        <?php if(!empty($title)) { ?>
            <h3 itemprop="name" class="eltdf-testimonial-title entry-title"><?php echo esc_html($title); ?></h3>
        <?php } ?>
        <?php if(!empty($text)) { ?>
            <p class="eltdf-testimonial-text"><?php echo esc_html($text); ?></p>
        <?php } ?>
        <?php if(has_post_thumbnail() || !empty($author)) { ?>
            <div class="eltdf-testimonials-author-holder clearfix">
                <?php if(!empty($author)) { ?>
                    <h5 class="eltdf-testimonial-author"><span class="eltdf-testimonial-author-inner"><?php echo esc_html($author); ?></span></h5>
                <?php } ?>
                <?php if(!empty($position)) { ?>
                    <h6 class="eltdf-testimonial-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>