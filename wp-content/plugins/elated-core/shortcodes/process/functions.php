<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Eltdf_Process_Holder extends WPBakeryShortCodesContainer {}
}

if(!function_exists('eltdf_core_add_process_shortcodes')) {
    function eltdf_core_add_process_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'ElatedCore\CPT\Shortcodes\ProcessHolder\ProcessHolder',
            'ElatedCore\CPT\Shortcodes\ProcessItem\ProcessItem'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('eltdf_core_filter_add_vc_shortcode', 'eltdf_core_add_process_shortcodes');
}