<div class="eltdf-social-register-holder">
	<form method="post" class="eltdf-register-form">
		<fieldset>
			<div>
				<input type="text" name="user_register_name" id="user_register_name"
				       placeholder="<?php esc_html_e( 'User Name', 'eltdf_membership' ) ?>" value="" required
				       pattern=".{3,}"
				       title="<?php esc_html_e( 'Three or more characters', 'eltdf_membership' ); ?>"/>
			</div>
			<div>
				<input type="email" name="user_register_email" id="user_register_email"
				       placeholder="<?php esc_html_e( 'Email', 'eltdf_membership' ) ?>" value="" required/>
			</div>
            <div>
                <input type="password" name="user_register_password" id="user_register_password"
                       placeholder="<?php esc_html_e('Password','eltdf_membership') ?>" value="" required/>
            </div>
            <div>
                <input type="password" name="user_register_confirm_password" id="user_register_confirm_password"
                       placeholder="<?php esc_html_e('Repeat Password','eltdf_membership') ?>" value="" required/>
            </div>
			<div class="eltdf-register-button-holder">
				<?php
				if ( eltdf_membership_theme_installed() ) {
					echo satine_elated_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'REGISTER', 'eltdf_membership' ),
						'type'      => 'solid',
						'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'REGISTER', 'eltdf_membership' ) . '</button>';
				}
				wp_nonce_field( 'eltdf-ajax-register-nonce', 'eltdf-register-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'eltdf_membership_action_login_ajax_response' ); ?>
</div>