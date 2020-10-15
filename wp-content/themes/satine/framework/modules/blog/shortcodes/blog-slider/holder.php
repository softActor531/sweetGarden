<div class="eltdf-blog-slider-holder">
    <ul class="eltdf-blog-slider eltdf-owl-slider" <?php echo satine_elated_get_inline_attrs($slider_data); ?>>
        <?php
            if($query_result->have_posts()):
                while ($query_result->have_posts()) : $query_result->the_post();
                    satine_elated_get_module_template_part('shortcodes/blog-slider/layout-collections/blog-slide', 'blog', '', $params);
                endwhile;
            else: ?>
                <div class="eltdf-blog-slider-messsage">
                    <p><?php esc_html_e('No posts were found.', 'satine'); ?></p>
                </div>
            <?php endif;

            wp_reset_postdata();
        ?>
    </ul>
</div>
