<?php if($query_results->max_num_pages > 1) { ?>
	<div class="eltdf-pl-loading">
		<div class="eltdf-pl-loading-bounce1"></div>
		<div class="eltdf-pl-loading-bounce2"></div>
		<div class="eltdf-pl-loading-bounce3"></div>
	</div>
	<div class="eltdf-pl-load-more-holder">
		<div class="eltdf-pl-load-more">
			<?php 
				echo satine_elated_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => 'large',
					'text' => esc_html__('LOAD MORE', 'eltdf-core')
				));
			?>
		</div>
	</div>
<?php }