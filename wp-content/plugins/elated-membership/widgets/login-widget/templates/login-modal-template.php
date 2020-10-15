<div class="eltdf-login-register-holder">
	<div class="eltdf-login-register-content">
		<ul>
			<li><a href="#eltdf-login-content"><?php esc_html_e( 'Login', 'eltdf_membership' ); ?></a></li>
			<li><a href="#eltdf-register-content"><?php esc_html_e( 'Register', 'eltdf_membership' ); ?></a></li>
		</ul>
		<div class="eltdf-login-content-inner" id="eltdf-login-content">
			<div class="eltdf-wp-login-holder"><?php echo eltdf_membership_execute_shortcode( 'eltdf_user_login', array() ); ?></div>
		</div>
		<div class="eltdf-register-content-inner" id="eltdf-register-content">
			<div class="eltdf-wp-register-holder"><?php echo eltdf_membership_execute_shortcode( 'eltdf_user_register', array() ) ?></div>
		</div>
	</div>
</div>