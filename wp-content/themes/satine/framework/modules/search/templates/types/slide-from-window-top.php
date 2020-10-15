<?php ?>
<form action="<?php echo esc_url(home_url('/')); ?>" class="eltdf-search-slide-window-top" method="get">
	<?php if ( $search_in_grid ) { ?>
		<div class="eltdf-container">
			<div class="eltdf-container-inner clearfix">
				<?php } ?>
					<div class="form-inner">
						<i class="fa fa-search"></i>
						<input type="text" placeholder="<?php esc_html_e('Search', 'satine'); ?>" name="s" class="eltdf-search-field" autocomplete="off" />
						<input type="submit" value="Search" />
						<div class="eltdf-search-close">
							<a href="#">
                                <?php print $search_icon_close; ?>
							</a>
						</div>
					</div>
				<?php if ( $search_in_grid ) { ?>
			</div>
		</div>
	<?php } ?>
</form>