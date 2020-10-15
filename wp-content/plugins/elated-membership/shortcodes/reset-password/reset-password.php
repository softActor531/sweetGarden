<?php
namespace ElatedMembership\Shortcodes\ElatedUserResetPassword;

use ElatedMembership\Lib\ShortcodeInterface;
/**
 * Class ElatedUserResetPassword
 */
class ElatedUserResetPassword implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltdf_user_reset_password';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 *
	 * @see vc_map
	 */
	public function vcMap() {
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {

		$args = array();

		$params = shortcode_atts( $args, $atts );
		extract( $params );

		$html = eltdf_membership_get_shortcode_template_part( 'reset-password', 'reset-password-template', '', $params );

		return $html;
	}

}