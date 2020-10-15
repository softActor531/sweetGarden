<form action="<?php echo esc_url(home_url('/')); ?>" class="eltdf-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="eltdf-container">
		<div class="eltdf-container-inner clearfix">
			<?php } ?>
			<div class="eltdf-form-holder-outer">
				<div class="eltdf-form-holder">
					<div class="eltdf-form-holder-inner">
						<input type="text" placeholder="<?php esc_html_e('Search', 'satine'); ?>" name="s" class="eltdf_search_field" autocomplete="off" />
						<div class="eltdf-search-close">
							<a href="#">
								<?php print $search_icon_close; ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>