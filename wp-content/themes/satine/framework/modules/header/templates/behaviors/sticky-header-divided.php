<?php do_action('satine_elated_before_sticky_header'); ?>

    <div class="eltdf-sticky-header">

        <?php do_action('satine_elated_after_sticky_menu_html_open'); ?>
        <div class="eltdf-sticky-holder">
            <?php if ($sticky_header_in_grid) : ?>
            <div class="eltdf-grid">
                <?php endif; ?>
                <div class="eltdf-vertical-align-containers">
                    <div class="eltdf-position-left">
                        <div class="eltdf-position-left-inner">
                            <?php satine_elated_get_sticky_divided_left_main_menu('eltdf-sticky-nav'); ?>
                        </div>
                    </div>
                    <div class="eltdf-position-center">
                        <div class="eltdf-position-center-inner">
                            <?php if (!$hide_logo) {
                                satine_elated_get_logo('divided-sticky');
                            } ?>
                        </div>
                    </div>
                    <div class="eltdf-position-right">
                        <div class="eltdf-position-right-inner">
                            <?php satine_elated_get_sticky_divided_right_main_menu('eltdf-sticky-nav'); ?>
                            <div class="eltdf-main-menu-widget-area">
                                <div class="eltdf-main-menu-widget-area-inner">
                                    <?php satine_elated_get_header_widget_menu_area(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($sticky_header_in_grid) : ?>
            </div>
        <?php endif; ?>
        </div>
        <?php do_action('satine_elated_end_of_page_header_html'); ?>
    </div>

<?php do_action('satine_elated_after_sticky_header'); ?>