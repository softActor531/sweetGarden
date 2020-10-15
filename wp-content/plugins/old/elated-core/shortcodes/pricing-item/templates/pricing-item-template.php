<div class="eltdf-price-item">
        <div class="eltdf-pi-inner">
            <div class="eltdf-pi-prices">
                <span class="eltdf-pi-currency" <?php echo satine_elated_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
                <p class="eltdf-pi-price" <?php echo satine_elated_get_inline_style($price_styles); ?>><?php echo esc_html($price_value); ?></p>
            </div>

            <div class="eltdf-pi-content-holder">
                <h2 class="eltdf-pi-title"><?php echo esc_html($title); ?></h2>
                <p class="eltdf-pi-subtitle"><?php echo esc_html($subtitle); ?></p>
                <div class="eltdf-pi-content">
                    <?php echo do_shortcode($content); ?>
                </div>
            </div>
        </div>
</div>