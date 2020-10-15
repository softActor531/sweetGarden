<?php if($show_category_filter == 'yes'){ ?>
<div class="eltdf-pl-categories">
    <h6 class="eltdf-pl-categories-label"><?php esc_html_e('Categories','satine'); ?></h6>
	<ul>
        <?php print $categories_filter_list; ?>
    </ul>
</div>
<?php } ?>