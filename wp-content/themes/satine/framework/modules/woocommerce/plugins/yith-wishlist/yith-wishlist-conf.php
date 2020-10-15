<?php

/*************** YITH WISHLIST FILTERS - begin ***************/

//Change yith wishlist button position on single product page
//add_filter( 'yith_wcwl_positions', 'satine_elated_woocommerce_wishlist_position', 10 );

//Add yith wishlist button
add_action( 'satine_elated_woo_pl_info_below_image', 'satine_elated_woocommerce_wishlist_shortcode', 3 );
add_action('satine_elated_woocommerce_info_below_image_hover', 'satine_elated_woocommerce_wishlist_shortcode', 2);

//Remove quick view button from wishlist
remove_all_actions('yith_wcwl_table_after_product_name');


/*************** YITH WISHLIST FILTERS - end ***************/

