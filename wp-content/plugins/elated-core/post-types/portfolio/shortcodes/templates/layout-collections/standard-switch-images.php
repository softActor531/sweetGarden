<?php echo eltdf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/image', $item_style, $params); ?>

<?php if ($enable_title === 'yes' || $enable_category === 'yes' || $enable_excerpt === 'yes') { ?>
<div class="eltdf-pli-text-holder">
	<div class="eltdf-pli-text-wrapper">
		<div class="eltdf-pli-text">
			<?php echo eltdf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/title', $item_style, $params); ?>
			
			<?php echo eltdf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/category', $item_style, $params); ?>
			
			<?php echo eltdf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/excerpt', $item_style, $params); ?>
		</div>
	</div>
</div>
<?php } ?>