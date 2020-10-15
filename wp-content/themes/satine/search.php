<?php
$eltdf_sidebar_layout = satine_elated_sidebar_layout();

get_header();
satine_elated_get_title();
?>
<div class="eltdf-container">
    <?php do_action('satine_elated_after_container_open'); ?>
    <div class="eltdf-container-inner clearfix">
        <div class="eltdf-container">
            <?php do_action('satine_elated_after_container_open'); ?>
            <div class="eltdf-container-inner">
	            <div class="eltdf-grid-row">
		            <div <?php echo satine_elated_get_content_sidebar_class(); ?>>
                        <div class="eltdf-search-page-holder">
                            <form action="<?php echo esc_url(home_url('/')); ?>" class="eltdf-search-page-form" method="get">
                                <h2 class="eltdf-search-title"><?php esc_html_e('Search results:', 'satine'); ?></h2>
                                <div class="eltdf-form-holder">
                                    <div class="eltdf-column-left">
                                        <input type="text" name="s" class="eltdf-search-field" autocomplete="off" value="" placeholder="<?php esc_html_e('Type here', 'satine'); ?>"/>
                                    </div>
                                    <div class="eltdf-column-right">
                                        <button type="submit" class="eltdf-search-submit"><span class="icon_search"></span></button>
                                    </div>
                                </div>
                                <div class="eltdf-search-label">
                                    <?php esc_html_e("If you are not happy with the results below please do another search", "satine"); ?>
                                </div>
                            </form>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="eltdf-post-content">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <div class="eltdf-post-image">
                                                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="eltdf-post-title-area <?php if (!has_post_thumbnail()) { echo esc_attr('eltdf-no-thumbnail'); } ?>">
                                            <div class="eltdf-post-title-area-inner">
                                                <h4 itemprop="name" class="eltdf-post-title entry-title">
                                                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                                <?php
                                                $eltdf_my_excerpt = get_the_excerpt();
                                                if ($eltdf_my_excerpt != '') { ?>
                                                    <p itemprop="description" class="eltdf-post-excerpt"><?php echo esc_html($eltdf_my_excerpt); ?></p>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                            <?php else: ?>
                                <p class="eltdf-blog-no-posts"><?php esc_html_e('No posts were found.', 'satine'); ?></p>
                            <?php endif; ?>
                            <?php
                                if ( get_query_var('paged') ) { $eltdf_paged = get_query_var('paged'); }
                                elseif ( get_query_var('page') ) { $eltdf_paged = get_query_var('page'); }
                                else { $eltdf_paged = 1; }

                                $eltdf_params['max_num_pages'] = satine_elated_get_max_number_of_pages();
                                $eltdf_params['paged'] = $eltdf_paged;
                                satine_elated_get_module_template_part('templates/parts/pagination/standard', 'blog', '', $eltdf_params);
                            ?>
                        </div>
                        <?php do_action('satine_elated_page_after_content'); ?>
                    </div>
		            <?php if($eltdf_sidebar_layout !== 'no-sidebar') { ?>
			            <div <?php echo satine_elated_get_sidebar_holder_class(); ?>>
				            <?php get_sidebar(); ?>
			            </div>
		            <?php } ?>
                </div>
				<?php do_action('satine_elated_before_container_close'); ?>
            </div>
        </div>
    </div>
    <?php do_action('satine_elated_before_container_close'); ?>
</div>
<?php get_footer(); ?>