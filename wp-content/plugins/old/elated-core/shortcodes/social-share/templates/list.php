<div class="eltdf-social-share-holder eltdf-list">
	<?php if(!empty($title)) { ?>
		<p class="eltdf-social-title"><?php echo esc_html($title); ?></p>
	<?php } ?>
	<ul>
		<?php foreach ($networks as $net) {
			print $net;
		} ?>
	</ul>
</div>