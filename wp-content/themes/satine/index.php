<?php
$eltdf_blog_type = satine_elated_get_archive_blog_list_layout();
satine_elated_include_blog_helper_functions('lists', $eltdf_blog_type);
$eltdf_holder_params = satine_elated_get_holder_params_blog();
?>
<?php get_header(); ?>
<?php satine_elated_get_title(); ?>
	<div class="<?php echo esc_attr($eltdf_holder_params['holder']); ?>">
		<?php do_action('satine_elated_after_container_open'); ?>
		<div class="<?php echo esc_attr($eltdf_holder_params['inner']); ?>">
			<?php satine_elated_get_blog($eltdf_blog_type); ?>
		</div>
		<?php do_action('satine_elated_before_container_close'); ?>
	</div>
<?php do_action('satine_elated_blog_list_additional_tags'); ?>
<?php get_footer(); ?>
