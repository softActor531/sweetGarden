<?php do_action('satine_elated_before_page_header'); ?>
<aside class="eltdf-vertical-menu-area eltdf-with-scroll">
    <div class="eltdf-vertical-menu-area-inner">
        <div class="eltdf-vertical-area-background"></div>
        <?php if(!$hide_logo) {
            satine_elated_get_logo();
        } ?>
        <?php satine_elated_get_vertical_main_menu('compact'); ?>
        <div class="eltdf-vertical-area-widget-holder">
			<?php satine_elated_get_header_vertical_widget_areas(); ?>
        </div>
    </div>
</aside>
<?php do_action('satine_elated_after_page_header'); ?>