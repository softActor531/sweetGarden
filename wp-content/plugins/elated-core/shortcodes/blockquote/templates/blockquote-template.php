<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="eltdf-blockquote-shortcode" <?php satine_elated_get_inline_style($blockquote_style); ?> >
	<h5 class="eltdf-blockquote-text">
        <span>&#8220;</span><span><?php echo esc_attr($text); ?></span><span>&#8221;</span>
	</h5>
    <span class="eltdf-blockquote-author">
        <?php echo esc_attr($author); ?>
    </span>
</blockquote>