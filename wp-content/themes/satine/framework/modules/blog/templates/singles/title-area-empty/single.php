<?php

satine_elated_get_single_post_format_html($blog_single_type);

satine_elated_get_module_template_part('templates/parts/single/single-navigation', 'blog');

satine_elated_get_module_template_part('templates/parts/single/author-info', 'blog');

satine_elated_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

satine_elated_get_module_template_part('templates/parts/single/comments', 'blog');