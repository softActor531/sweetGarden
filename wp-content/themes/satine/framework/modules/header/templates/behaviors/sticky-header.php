<?php do_action('satine_elated_before_sticky_header'); ?>

<div class="eltdf-sticky-header">
    <?php do_action( 'satine_elated_after_sticky_menu_html_open' ); ?>
    <div class="eltdf-sticky-holder">
    <?php if($sticky_header_in_grid) : ?>
        <div class="eltdf-grid">
            <?php endif; ?>
            <div class=" eltdf-vertical-align-containers">
                <div class="eltdf-position-left">
                    <div class="eltdf-position-left-inner">
                        <?php if(!$hide_logo) {
                            satine_elated_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <?php if($menu_area_position == 'center') { ?>
                    <div class="eltdf-position-center">
                        <div class="eltdf-position-center-inner">
                            <?php satine_elated_get_sticky_menu('eltdf-sticky-nav');; ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="eltdf-position-right">
                    <div class="eltdf-position-right-inner">
                        <?php if($menu_area_position != 'center') { ?>
						    <?php satine_elated_get_sticky_menu('eltdf-sticky-nav'); ?>
                        <?php } ?>
                        <div class="eltdf-main-menu-widget-area">
                            <div class="eltdf-main-menu-widget-area-inner">
                                <?php if(is_active_sidebar('eltdf-sticky-right')) : ?>
                                    <?php dynamic_sidebar('eltdf-sticky-right'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php do_action('satine_elated_end_of_page_header_html'); ?>
</div>

<?php do_action('satine_elated_after_sticky_header'); ?>