<div class="eltdf-testimonial-content" id="eltdf-testimonials-<?php echo esc_attr($current_id) ?>">
    <div class="eltdf-testimonial-text-holder">
        <div class="eltdf-testimonial-quote"><span aria-hidden="true" class="icon_quotations"></span></div>
        <?php if(!empty($text)) { ?>
            <p class="eltdf-testimonial-text"><?php echo esc_html($text); ?></p>
        <?php } ?>
        <?php if(has_post_thumbnail()) { ?>
            <div class="eltdf-testimonial-image">
                <?php echo get_the_post_thumbnail(get_the_ID(), array(66, 66)); ?>
            </div>
        <?php } ?>
        <?php if(!empty($author)) { ?>
            <h4 class="eltdf-testimonial-author"><?php echo esc_html($author); ?></h4>
        <?php } ?>
        <?php if(!empty($position)) { ?>
            <h6 class="eltdf-testimonial-position"><?php echo esc_html($position); ?></h6>
        <?php } ?>
    </div>
</div>