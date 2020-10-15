<?php if($show_header_top) : ?>

<?php do_action('satine_elated_before_header_top'); ?>
	<?php if($show_header_top_background_div){ ?>
		<div class="eltdf-top-bar-background"></div>
	<?php } ?>
<div class="eltdf-top-bar">
    <?php if($top_bar_in_grid) : ?>
    <div class="eltdf-grid">
    <?php endif; ?>
		<?php do_action( 'satine_elated_after_header_top_html_open' ); ?>
        <div class="eltdf-vertical-align-containers <?php echo esc_attr($column_widths); ?>">
            <div class="eltdf-position-left">
                <div class="eltdf-position-left-inner">
                    <?php if(is_active_sidebar('eltdf-top-bar-left')) : ?>
                        <?php dynamic_sidebar('eltdf-top-bar-left'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($show_widget_center){ ?>
                <div class="eltdf-position-center">
                    <div class="eltdf-position-center-inner">
                        <?php if(is_active_sidebar('eltdf-top-bar-center')) : ?>
                            <?php dynamic_sidebar('eltdf-top-bar-center'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php } ?>
            <div class="eltdf-position-right">
                <div class="eltdf-position-right-inner">
                    <?php if(is_active_sidebar('eltdf-top-bar-right')) : ?>
                        <?php dynamic_sidebar('eltdf-top-bar-right'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php if($top_bar_in_grid) : ?>
    </div>
    <?php endif; ?>
</div>

<?php do_action('satine_elated_after_header_top'); ?>

<?php endif; ?>