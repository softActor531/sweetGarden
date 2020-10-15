<?php
$excerpt_length = isset($params['excerpt_length']) ? $params['excerpt_length'] : '';
$excerpt = satine_elated_excerpt($excerpt_length);
?>
<?php if($excerpt !== '') { ?>
    <div class="eltdf-post-excerpt-holder">
        <p itemprop="description" class="eltdf-post-excerpt">
            <?php echo wp_kses_post($excerpt); ?>
        </p>
    </div>
<?php } ?>
