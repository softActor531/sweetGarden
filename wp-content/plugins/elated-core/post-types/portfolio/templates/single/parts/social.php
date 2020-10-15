<div class="eltdf-portfolio-single-likes">
    <?php echo satine_elated_like_portfolio_single(); ?>
</div>
<?php if(satine_elated_options()->getOptionValue('enable_social_share') == 'yes' && satine_elated_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="eltdf-ps-info-item eltdf-ps-social-share">
        <?php echo satine_elated_get_social_share_html() ?>
    </div>
<?php endif; ?>