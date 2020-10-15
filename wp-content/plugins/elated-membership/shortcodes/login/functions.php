<?php

if(!function_exists('eltdf_membership_add_login_shortcodes')) {
    function eltdf_membership_add_login_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'ElatedMembership\Shortcodes\ElatedUserLogin\ElatedUserLogin'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('eltdf_membership_filter_add_vc_shortcode', 'eltdf_membership_add_login_shortcodes');
}