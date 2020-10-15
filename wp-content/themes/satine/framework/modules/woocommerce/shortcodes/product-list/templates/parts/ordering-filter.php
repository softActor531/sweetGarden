<?php if($show_ordering_filter == 'yes'){ ?>
<div class="eltdf-pl-ordering-outer">
    <h6><?php esc_html_e('Filter','satine'); ?></h6>
    <div class="eltdf-pl-ordering">
        <div>
            <span class="eltdf-pl-ordering-title"><?php esc_html_e('Sort By','satine'); ?></span>
            <ul>
                <?php print $ordering_filter_list; ?>
            </ul>
        </div>
        <div>
            <span class="eltdf-pl-ordering-title"><?php esc_html_e('Price Range','satine'); ?></span>
            <ul class="eltdf-pl-ordering-price">
                <?php print $pricing_filter_list; ?>
            </ul>
        </div>
    </div>
</div>
<?php } ?>