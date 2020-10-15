<div class="eltdf-social-login-holder">
	<form method="post" class="eltdf-login-form">
		<?php
		$redirect = '';
		if ( isset( $_GET['redirect_uri'] ) ) {
			$redirect = $_GET['redirect_uri'];
		} ?>
		<fieldset>
			<div>
				<input type="text" name="user_login_name" id="user_login_name" placeholder="<?php esc_html_e( 'User Name', 'eltdf_membership' ) ?>" value="" required pattern=".{3,}" title="<?php esc_html_e( 'Three or more characters', 'eltdf_membership' ); ?>"/>
			</div>
			<div>
				<input type="password" name="user_login_password" id="user_login_password" placeholder="<?php esc_html_e( 'Password', 'eltdf_membership' ) ?>" value="" required/>
			</div>
			<div class="eltdf-lost-pass-remember-holder clearfix">
				<span class="eltdf-login-remember">
					<input name="rememberme" value="forever" id="rememberme" type="checkbox"/>
					<label for="rememberme" class="eltdf-checbox-label"><?php esc_html_e( 'Remember me', 'eltdf_membership' ) ?></label>
				</span>	
			</div>
			<input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url( $redirect ); ?>">
			<div class="eltdf-login-button-holder">
				<a href="<?php echo wp_lostpassword_url(); ?>" class="eltdf-login-action-btn" data-el="#eltdf-reset-pass-content" data-title="<?php esc_html_e( 'Lost Password?', 'eltdf_membership' ); ?>"><?php esc_html_e( 'Lost Your password?', 'eltdf_membership' ); ?></a>
				<?php
				if ( eltdf_membership_theme_installed() ) {
					echo satine_elated_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'LOGIN', 'eltdf_membership' ),
						'type'      => 'solid',
                        'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'LOGIN', 'eltdf_membership' ) . '</button>';
				}
				?>
				<?php wp_nonce_field( 'eltdf-ajax-login-nonce', 'eltdf-login-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'eltdf_membership_action_login_ajax_response' ); ?>
</div>