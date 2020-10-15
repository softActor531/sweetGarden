<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="eltdf-post-content">
        <div class="eltdf-post-text">
            <div class="eltdf-post-text-inner">
                <div class="eltdf-post-text-main">
                    <div class="eltdf-post-mark">
                        <span class="fa fa-link eltdf-link-mark"></span>
                    </div>
                    <?php satine_elated_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="eltdf-post-additional-content">
        <?php the_content(); ?>
    </div>
    <div class="eltdf-post-info-bottom clearfix">
        <?php satine_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
    </div>
</article>