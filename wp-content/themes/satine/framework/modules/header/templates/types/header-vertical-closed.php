<?php do_action('satine_elated_before_page_header'); ?>
<aside class="eltdf-vertical-menu-area <?php echo esc_html($holder_class); ?>">
    <div class="eltdf-vertical-menu-area-inner">
		<a href="#" class="eltdf-vertical-area-opener"><span class="eltdf-vertical-area-opener-line"></span></a>
        <div class="eltdf-vertical-area-background"></div>
        <?php if(!$hide_logo) {
			satine_elated_get_logo();
        } ?>
        <?php satine_elated_get_vertical_main_menu(); ?>
        <div class="eltdf-vertical-area-widget-holder">
			<?php satine_elated_get_header_vertical_widget_areas(); ?>
        </div>
    </div>
</aside>
<div class="eltdf-vertical-area-bottom-logo">
	<div class="eltdf-vertical-area-bottom-logo-inner">
		<?php if(!$hide_logo) {
			satine_elated_get_logo();
		} ?>
	</div>
</div>
<?php do_action('satine_elated_after_page_header'); ?>