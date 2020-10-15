<div class="eltdf-quote-section-holder">
	<span class="eltdf-quote-section-line eltdf-quote-section-line-before-text"></span>
	<?php if(!empty($quote_text)) { ?>
		<div class="eltdf-qs-quote-text-holder">
			<h2 class="eltdf-qs-quote-text">
				<span><?php echo esc_html($quote_text); ?></span>
			</h2>
		</div>
	<?php } ?>
	<?php if(!empty($additional_text)) { ?>
		<div class="eltdf-qs-quote-additional-text">
			<span><?php echo esc_html($additional_text); ?></span>
		</div>
	<?php } ?>
	<span class="eltdf-quote-section-line eltdf-quote-section-line-after-text"></span>
</div>