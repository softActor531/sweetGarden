<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="eltdf-post-content">
        <div class="eltdf-post-heading">
            <?php satine_elated_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
            <?php satine_elated_get_module_template_part('templates/parts/post-type/audio', 'blog', '', $part_params); ?>
        </div>
        <div class="eltdf-post-text">
            <div class="eltdf-post-text-inner">
                <div class="eltdf-post-text-main">
                    <?php the_content(); ?>
                    <?php do_action('satine_elated_single_link_pages'); ?>
                </div>
                <div class="eltdf-post-info-bottom clearfix">
                    <?php satine_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>