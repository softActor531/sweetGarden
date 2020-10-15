<?php

class ElatedMembershipLoginRegister extends WP_Widget {
	protected $params;

	public function __construct() {
		parent::__construct(
			'eltdf_login_register_widget', // Base ID
			'Elated Login',
			array( 'description' => esc_html__( 'Login and register wordpress widget', 'eltdf_membership' ), )
		);
	}

	public function widget( $args, $instance ) {
		$additional_class = '';
		if(is_user_logged_in()){
			$additional_class .= 'eltdf-user-logged-in';
		}

		echo '<div class="widget eltdf-login-register-widget '.$additional_class.'">';
		if ( ! is_user_logged_in() ) {
			echo '<a href="#" class="eltdf-login-opener">' . esc_html__( 'Login', 'eltdf_membership' ) . '</a>';

			add_action( 'wp_footer', array( $this, 'eltdf_membership_render_login_form' ) );

		} else {
			echo eltdf_membership_get_widget_template_part( 'login-widget', 'login-widget-template' );
		}
		echo '</div>';

	}

	public function eltdf_membership_render_login_form() {

		//Render modal with login and register forms
		echo eltdf_membership_get_widget_template_part( 'login-widget', 'login-modal-template' );
	}
}

function eltdf_membership_login_widget_load() {
	register_widget( 'ElatedMembershipLoginRegister' );
}

add_action( 'widgets_init', 'eltdf_membership_login_widget_load' );