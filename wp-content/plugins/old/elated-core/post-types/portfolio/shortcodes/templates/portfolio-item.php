<article class="eltdf-pl-item <?php echo esc_attr($this_object->getArticleClasses($params)); ?>">
	<div class="eltdf-pl-item-inner">
		<?php echo eltdf_core_get_cpt_shortcode_module_template_part('portfolio', 'layout-collections/'.$item_style, '', $params); ?>
		
		<a itemprop="url" class="eltdf-pli-link" href="<?php echo esc_url($this_object->getItemLink()); ?>" target="<?php echo esc_attr($this_object->getItemLinkTarget()); ?>"></a>
	</div>
</article>