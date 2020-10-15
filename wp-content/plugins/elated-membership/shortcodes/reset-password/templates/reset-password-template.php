<div class="eltdf-social-reset-password-holder">
	<form action="<?php echo site_url( 'wp-login.php?action=lostpassword' ); ?>" method="post" id="eltdf-lost-password-form" class="eltdf-reset-pass-form">
		<div>
			<input type="text" name="user_reset_password_login" class="eltdf-input-field" id="user_reset_password_login" placeholder="<?php esc_html_e( 'Enter username or email', 'eltdf_membership' ) ?>" value="" size="20" required>
		</div>
		<?php do_action( 'lostpassword_form' ); ?>
		<div class="eltdf-reset-password-button-holder">
			<?php
			if ( eltdf_membership_theme_installed() ) {
				echo satine_elated_get_button_html( array(
					'html_type' => 'button',
					'text'      => esc_html__( 'NEW PASSWORD', 'eltdf_membership' ),
					'type'      => 'solid',
					'size'      => 'small'
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'NEW PASSWORD', 'eltdf_membership' ) . '</button>';
			}
			?>
		</div>
	</form>
	<?php do_action( 'eltdf_membership_action_login_ajax_response' ); ?>
</div>