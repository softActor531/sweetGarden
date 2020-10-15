<?php
/**
 * Plugin Name: Elated Membership
 * Description: Plugin that adds social login and user dashboard page
 * Author: Elated Themes
 * Version: 1.0
 */

require_once 'load.php';

if ( ! function_exists( 'eltdf_membership_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function eltdf_membership_text_domain() {
		load_plugin_textdomain( 'eltdf_membership', false, ELATED_MEMBERSHIP_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'eltdf_membership_text_domain' );
}

if ( ! function_exists( 'eltdf_membership_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function eltdf_membership_scripts() {

		wp_enqueue_style( 'eltdf_membership_style', plugins_url( ELATED_MEMBERSHIP_REL_PATH . '/assets/css/membership.min.css' ) );
		wp_enqueue_style( 'eltdf_membership_responsive_style', plugins_url( ELATED_MEMBERSHIP_REL_PATH . '/assets/css/membership-responsive.min.css' ) );

		$array_deps = array(
			'underscore',
			'jquery-ui-tabs'
		);
		if ( eltdf_membership_theme_installed() ) {
			$array_deps[] = 'satine_elated_modules';
		}
		wp_enqueue_script( 'eltdf_membership_script', plugins_url( ELATED_MEMBERSHIP_REL_PATH . '/assets/js/membership.min.js' ), $array_deps, false, true );
	}

	add_action( 'wp_enqueue_scripts', 'eltdf_membership_scripts' );
}