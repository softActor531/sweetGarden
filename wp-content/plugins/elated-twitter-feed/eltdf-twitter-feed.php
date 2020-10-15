<?php
/*
Plugin Name: Elated Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Elated Themes
Version: 1.0
*/
define('ELATED_TWITTER_FEED_VERSION', '1.0');
define('ELATED_TWITTER_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';


if(!function_exists('eltdf_twitter_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function eltdf_twitter_feed_text_domain() {
        load_plugin_textdomain('eltdf-twitter-feed', false, ELATED_TWITTER_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'eltdf_twitter_feed_text_domain');
}