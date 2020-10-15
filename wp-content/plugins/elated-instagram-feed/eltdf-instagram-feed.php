<?php
/*
Plugin Name: Elated Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Elated Themes
Version: 1.0
*/
define('ELATED_INSTAGRAM_FEED_VERSION', '1.0');
define('ELATED_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('ELATED_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';

if(!function_exists('eltdf_instagram_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function eltdf_instagram_feed_text_domain() {
        load_plugin_textdomain('eltdf-instagram-feed', false, ELATED_INSTAGRAM_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'eltdf_instagram_feed_text_domain');
}