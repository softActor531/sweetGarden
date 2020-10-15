<div class="eltdf-pl-holder <?php echo esc_attr($holder_classes) ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php if($query_result->have_posts()){ ?>
        <?php echo satine_elated_get_woo_shortcode_module_template_part('templates/parts/categories-filter', 'product-list', '', $params); ?>
		<?php echo satine_elated_get_woo_shortcode_module_template_part('templates/parts/ordering-filter', 'product-list', '', $params); ?>
        <div class="eltdf-prl-loading">
            <span class="eltdf-prl-loading-msg"><?php esc_html_e('Loading...', 'satine') ?></span>
        </div>
        <div class="eltdf-pl-outer">
            <div class="eltdf-pl-sizer"></div>
            <div class="eltdf-pl-gutter"></div>
            <?php while ($query_result->have_posts()) : $query_result->the_post();
                echo satine_elated_get_woo_shortcode_module_template_part('templates/parts/' . $params['info_position'], 'product-list', '', $params);
                endwhile;
			?>
        </div>
	<?php }else {
		satine_elated_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
	}
	wp_reset_postdata();
	?>
</div>