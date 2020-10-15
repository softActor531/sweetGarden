<?php do_action('satine_elated_before_page_header'); ?>

<header class="eltdf-page-header">
    <div class="eltdf-logo-area">
        <?php if($logo_area_in_grid) : ?>
        <div class="eltdf-grid">
        <?php endif; ?>
			<?php do_action( 'satine_elated_after_header_logo_area_html_open' )?>
            <div class="eltdf-vertical-align-containers">
                <div class="eltdf-position-center">
                    <div class="eltdf-position-center-inner">
                        <?php if(!$hide_logo) {
                            satine_elated_get_logo();
                        } ?>
                    </div>
                </div>
            </div>
        <?php if($logo_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($show_fixed_wrapper) : ?>
        <div class="eltdf-fixed-wrapper">
    <?php endif; ?>
    <div class="eltdf-menu-area">
        <?php if($menu_area_in_grid) : ?>
            <div class="eltdf-grid">
        <?php endif; ?>
			<?php do_action( 'satine_elated_after_header_menu_area_html_open' )?>
            <div class="eltdf-vertical-align-containers">
                <div class="eltdf-position-left">
                    <div class="eltdf-position-left-inner">
                        <?php satine_elated_get_header_widget_menu_area_left(); ?>
                    </div>
                </div>
                <div class="eltdf-position-center">
                    <div class="eltdf-position-center-inner">
                        <?php satine_elated_get_main_menu(); ?>
                    </div>
                </div>
                <div class="eltdf-position-right">
                    <div class="eltdf-position-right-inner">
                        <?php satine_elated_get_header_widget_menu_area(); ?>
                    </div>
                </div>
            </div>
        <?php if($menu_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php do_action('satine_elated_end_of_page_header_html'); ?>
    <?php if($show_fixed_wrapper) : ?>
        </div>
    <?php endif; ?>
    <?php if($show_sticky) {
        satine_elated_get_sticky_header('centered');
    } ?>
</header>

<?php do_action('satine_elated_after_page_header'); ?>

