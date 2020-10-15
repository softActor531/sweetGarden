<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <?php
        $eltdf_blog_single_type = satine_elated_get_meta_field_intersect('blog_single_type');
        satine_elated_include_blog_helper_functions('singles', $eltdf_blog_single_type);
		//Action added for applying module specific filters that couldn't be applied on init
		do_action('satine_elated_blog_single_loaded');
        $eltdf_holder_params = satine_elated_get_holder_params_blog();

        $module_title = isset($eltdf_holder_params['module_title']) ? $eltdf_holder_params['module_title'] : false;
        $module_title_layout = isset($eltdf_holder_params['module_title_layout']) ? $eltdf_holder_params['module_title_layout'] : "";
        ?>

        <?php satine_elated_get_title($module_title, 'blog', $module_title_layout); ?>
            <?php get_template_part('slider'); ?>
            <div class="<?php echo esc_attr($eltdf_holder_params['holder']); ?>">
                <?php do_action('satine_elated_after_container_open'); ?>
                <div class="<?php echo esc_attr($eltdf_holder_params['inner']); ?>">
                    <?php satine_elated_get_blog_single($eltdf_blog_single_type); ?>
                </div>
            <?php do_action('satine_elated_before_container_close'); ?>
            </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>