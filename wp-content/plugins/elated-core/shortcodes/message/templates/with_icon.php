<?php
$icon_html = satine_elated_icon_collections()->renderIcon($icon, $icon_pack);
?>

<div class="eltdf-message-icon-holder">
	<div class="eltdf-message-icon" <?php satine_elated_inline_style($icon_attributes); ?>>
		<div class="eltdf-message-icon-inner">
			<?php
				print $icon_html;
			?>			
		</div> 
	</div>	 
</div>

