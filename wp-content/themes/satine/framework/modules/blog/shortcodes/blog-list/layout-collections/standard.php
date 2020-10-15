<li class="eltdf-bl-item clearfix">
	<div class="eltdf-bli-inner">
        <?php if($post_info_image == 'yes') { ?>
        <?php satine_elated_get_module_template_part('templates/parts/image', 'blog', '', $params); ?>
        <?php } ?>
        <div class="eltdf-bli-content">
            <?php if ($post_info_date == 'yes') { ?>
                <?php satine_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
            <?php } ?>
            <?php satine_elated_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>
            <?php
            if($post_info_section == 'yes') { ?>
                <div class="eltdf-bli-info">
	                <?php
	                    if ($post_info_author == 'yes') {
	                        satine_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params);
	                    }
	                    if ($post_info_comments == 'yes') {
	                        satine_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $params);
	                    }
	                    if ($post_info_category == 'yes') {
	                        satine_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params);
	                    }
	                    if ($post_info_share == 'yes') {
	                        satine_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $params);
	                    }
	                ?>
                </div>
            <?php } ?>
            <div class="eltdf-bli-excerpt">
                <?php satine_elated_get_module_template_part('templates/parts/excerpt', 'blog', '', $params); ?>
                <?php satine_elated_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $params); ?>
            </div>
        </div>
	</div>
</li>