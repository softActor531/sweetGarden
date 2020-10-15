<?php

if(!function_exists('eltdf_core_add_blockquote_shortcodes')) {
    function eltdf_core_add_blockquote_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'ElatedCore\CPT\Shortcodes\Blockquote\Blockquote'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('eltdf_core_filter_add_vc_shortcode', 'eltdf_core_add_blockquote_shortcodes');
}