<div class="eltdf-ps-content-holder">
    <div class="eltdf-ps-title-holder">
        <?php eltdf_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>
    </div>
    <div class="eltdf-ps-info-holder">
        <?php
        //get portfolio custom fields section
        eltdf_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);

        //get portfolio date section
        eltdf_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);

        //get portfolio tags section
        eltdf_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
        ?>
    </div>
</div>
<div class="eltdf-ps-image-holder">
	<div class="eltdf-ps-image-inner eltdf-owl-slider">
		<?php
		$media = eltdf_core_get_portfolio_single_media();
		
		if(is_array($media) && count($media)) : ?>
			<?php foreach($media as $single_media) : ?>
				<div class="eltdf-ps-image">
					<?php eltdf_core_get_portfolio_single_media_html($single_media); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
<div class="eltdf-ps-social-info-holder">
    <?php
    //get portfolio share section
    eltdf_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
    ?>
</div>
