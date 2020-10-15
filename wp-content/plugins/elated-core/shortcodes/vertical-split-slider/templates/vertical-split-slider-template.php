<div <?php satine_elated_class_attribute($vertical_split_classes); ?>>
    <?php if($custom_sidebar !== ''){ ?>
        <div class="eltdf-vertical-split-slider-widget-area">
            <?php dynamic_sidebar($custom_sidebar); ?>
        </div>
    <?php } ?>
    <?php echo do_shortcode($content); ?>
</div>