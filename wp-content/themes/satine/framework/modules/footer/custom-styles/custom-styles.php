<?php

if(!function_exists('satine_elated_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function satine_elated_footer_top_general_styles() {
        $item_styles = array();
        $background_color = satine_elated_options()->getOptionValue('footer_top_background_color');

        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        echo satine_elated_dynamic_css('footer.eltdf-page-footer .eltdf-footer-top-holder', $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_footer_top_general_styles');
}

if(!function_exists('satine_elated_footer_bottom_general_styles')) {
    /**
     * Generates general custom styles for footer bottom area
     */
    function satine_elated_footer_bottom_general_styles() {
        $item_styles = array();
	    $background_color = satine_elated_options()->getOptionValue('footer_bottom_background_color');
	
	    if(!empty($background_color)) {
		    $item_styles['background-color'] = $background_color;
	    }

        echo satine_elated_dynamic_css('footer.eltdf-page-footer .eltdf-footer-bottom-holder', $item_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_footer_bottom_general_styles');
}