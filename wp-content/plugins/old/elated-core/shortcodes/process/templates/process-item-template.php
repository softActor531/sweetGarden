<div <?php satine_elated_class_attribute($item_classes); ?>>
    <div class="eltdf-pi-holder-inner">
        <div class="eltdf-pi-holder-inner-wrapper">
            <?php if(!empty($process_image)) : ?>
                <div class="eltdf-image-holder-inner">
                    <img src="<?php echo $image_style; ?>">
                </div>
            <?php endif; ?>
        </div>
            <div class="eltdf-pi-content-holder">
                <?php if(!empty($title)) : ?>
                    <div class="eltdf-pi-title-holder">
                        <h5 class="eltdf-pi-title"><?php echo esc_html($title); ?></h5>
                    </div>
                <?php endif; ?>
                <?php if(!empty($text)) : ?>
                    <div class="eltdf-pi-text-holder">
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                <?php endif; ?>
            </div>
    </div>
</div>