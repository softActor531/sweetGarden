<?php do_action('satine_elated_before_page_header'); ?>

<header class="eltdf-page-header">
	<?php if($show_fixed_wrapper) : ?>
	<div class="eltdf-fixed-wrapper">
		<?php endif; ?>
		<div class="eltdf-menu-area">
			<?php if($menu_area_in_grid) : ?>
			<div class="eltdf-grid">
				<?php endif; ?>
				<?php do_action('satine_elated_after_header_menu_area_html_open') ?>
				<div class="eltdf-vertical-align-containers">
					<div class="eltdf-position-left">
						<div class="eltdf-position-left-inner">
							<?php if(!$hide_logo) {
								satine_elated_get_logo();
							} ?>
						</div>
					</div>
					<div class="eltdf-position-right">
						<div class="eltdf-position-right-inner">
							<a href="javascript:void(0)" class="eltdf-fullscreen-menu-opener">
								<span class="eltdf-fm-lines">
									<span class="eltdf-fm-line eltdf-line-1"></span>
									<span class="eltdf-fm-line eltdf-line-2"></span>
									<span class="eltdf-fm-line eltdf-line-3"></span>
								</span>
							</a>
						</div>
					</div>
				</div>
				<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
		</div>
		<?php if($show_fixed_wrapper) : ?>
	</div>
<?php endif; ?>
	<?php if($show_sticky) {
		satine_elated_get_sticky_header('minimal');
	} ?>
</header>

<?php do_action('satine_elated_after_page_header'); ?>

