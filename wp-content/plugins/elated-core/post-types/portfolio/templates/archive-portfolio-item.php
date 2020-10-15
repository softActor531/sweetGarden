<?php
get_header();
satine_elated_get_title(); ?>
<div class="eltdf-container eltdf-default-page-template">
	<?php do_action('satine_elated_after_container_open'); ?>
	<div class="eltdf-container-inner clearfix">
		<?php
			$eltdf_taxonomy_id = get_queried_object_id();
			$eltdf_taxonomy = !empty($eltdf_taxonomy_id) ? get_category($eltdf_taxonomy_id) : '';
			$eltdf_taxonomy_slug = !empty($eltdf_taxonomy) ? $eltdf_taxonomy->slug : '';
			$eltdf_taxonomy_name = !empty($eltdf_taxonomy) ? $eltdf_taxonomy->taxonomy : '';
		
			eltdf_core_get_archive_portfolio_list($eltdf_taxonomy_slug, $eltdf_taxonomy_name);
		?>
	</div>
	<?php do_action('satine_elated_before_container_close'); ?>
</div>
<?php get_footer(); ?>
