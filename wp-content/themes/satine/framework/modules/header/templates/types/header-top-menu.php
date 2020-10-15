<?php do_action('satine_elated_before_page_header'); ?>

<header class="eltdf-page-header">
	<div class="eltdf-menu-area">
		<?php if($menu_area_in_grid) : ?>
		<div class="eltdf-grid">
			<?php endif; ?>
			<div class="eltdf-vertical-align-containers">
				<div class="eltdf-position-left">
					<div class="eltdf-position-left-inner">
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
        <?php do_action('satine_elated_end_of_page_header_html'); ?>
	</div>
	<div class="eltdf-logo-area">
        <?php if($logo_area_in_grid) : ?>
        <div class="eltdf-grid">
        <?php endif; ?>
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
</header>

<?php do_action('satine_elated_after_page_header'); ?>

