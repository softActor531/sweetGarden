<?php do_action('satine_elated_before_top_navigation'); ?>
<div class="eltdf-vertical-menu-outer">
    <div class="eltdf-vertical-menu-inner">
        <nav class="eltdf-vertical-menu eltdf-vertical-dropdown-on-click">
            <?php
                wp_nav_menu(array(
                    'theme_location'  => 'vertical-navigation',
                    'container'       => '',
                    'container_class' => '',
                    'menu_class'      => '',
                    'menu_id'         => '',
                    'fallback_cb'     => 'top_navigation_fallback',
                    'link_before'     => '<span>',
                    'link_after'      => '</span>',
                    'walker'          => new SatineElatedTopNavigationWalker()
                ));
            ?>
        </nav>
        <div class="eltdf-vertical-area-top-widget-holder">
            <?php satine_elated_get_header_vertical_widget_top_areas(); ?>
        </div>
    </div>
</div>
<?php do_action('satine_elated_after_top_navigation'); ?>