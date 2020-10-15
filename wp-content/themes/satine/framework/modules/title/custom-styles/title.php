<?php

if (!function_exists('satine_elated_title_area_typography_style')) {

    function satine_elated_title_area_typography_style(){

        // title default/small style
	    
	    $item_styles = satine_elated_get_typography_styles('page_title');
	
	    $item_selector = array(
		    '.eltdf-title .eltdf-title-holder .eltdf-page-title'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
	
	    // subtitle style
	
	    $item_styles = satine_elated_get_typography_styles('page_subtitle');
	
	    $item_selector = array(
		    '.eltdf-title .eltdf-title-holder .eltdf-subtitle'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
	
	    // breadcrumb style
	
	    $item_styles = satine_elated_get_typography_styles('page_breadcrumb');
	
	    $item_selector = array(
		    '.eltdf-title .eltdf-title-holder .eltdf-breadcrumbs a',
		    '.eltdf-title .eltdf-title-holder .eltdf-breadcrumbs span'
	    );
	
	    echo satine_elated_dynamic_css($item_selector, $item_styles);
	    

	    $breadcrumb_hover_color = satine_elated_options()->getOptionValue('page_breadcrumb_hovercolor');
	    
        $breadcrumb_hover_styles = array();
        if(!empty($breadcrumb_hover_color)) {
            $breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
        }

        $breadcrumb_hover_selector = array(
            '.eltdf-title .eltdf-title-holder .eltdf-breadcrumbs a:hover'
        );

        echo satine_elated_dynamic_css($breadcrumb_hover_selector, $breadcrumb_hover_styles);
    }

    add_action('satine_elated_style_dynamic', 'satine_elated_title_area_typography_style');
}