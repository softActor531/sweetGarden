<?php do_action('satine_elated_after_sticky_header'); ?>

<div class="eltdf-sticky-header">
    <?php do_action('satine_elated_after_sticky_menu_html_open'); ?>
    <div class="eltdf-sticky-holder">
        <?php if ($sticky_header_in_grid) : ?>
        <div class="eltdf-grid">
            <?php endif; ?>
            <div class=" eltdf-vertical-align-containers">
                <div class="eltdf-position-left">
                    <div class="eltdf-position-left-inner">
                        <?php if (!$hide_logo) {
                            satine_elated_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="eltdf-position-right">
                    <div class="eltdf-position-right-inner">
                        <a href="javascript:void(0)" class="eltdf-fullscreen-menu-opener">
                                <span class="eltdf-fm-lines">
									<span class="eltdf-fm-line eltdf-line-1"></span>
									<span class="eltdf-fm-line eltdf-line-2"></span>
									<span class="eltdf-fm-line eltdf-line-3"></span>
								</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php if ($sticky_header_in_grid) : ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php do_action('satine_elated_after_sticky_header'); ?>
