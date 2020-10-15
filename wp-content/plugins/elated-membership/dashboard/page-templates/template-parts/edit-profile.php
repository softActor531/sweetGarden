<div class="eltdf-membership-dashboard-page">
	<h3 class="eltdf-membership-dashboard-page-title">
		<?php esc_html_e( 'Edit Profile', 'eltdf_membership' ); ?>
	</h3>
	<div>
		<form method="post" id="eltdf-membership-update-profile-form">
			<div class="eltdf-membership-input-holder">
				<label for="first_name"><?php esc_html_e( 'First Name', 'eltdf_membership' ); ?></label>
				<input class="eltdf-membership-input" type="text" name="first_name" id="first_name"
				       value="<?php echo $first_name; ?>">
			</div>
			<div class="eltdf-membership-input-holder">
				<label for="last_name"><?php esc_html_e( 'Last Name', 'eltdf_membership' ); ?></label>
				<input class="eltdf-membership-input" type="text" name="last_name" id="last_name"
				       value="<?php echo $last_name; ?>">
			</div>
			<div class="eltdf-membership-input-holder">
				<label for="email"><?php esc_html_e( 'Email', 'eltdf_membership' ); ?></label>
				<input class="eltdf-membership-input" type="email" name="email" id="email"
				       value="<?php echo $email; ?>">
			</div>
			<div class="eltdf-membership-input-holder">
				<label for="url"><?php esc_html_e( 'Website', 'eltdf_membership' ); ?></label>
				<input class="eltdf-membership-input" type="text" name="url" id="url" value="<?php echo $website; ?>">
			</div>
			<div class="eltdf-membership-input-holder">
				<label for="description"><?php esc_html_e( 'Description', 'eltdf_membership' ); ?></label>
				<input class="eltdf-membership-input" type="text" name="description" id="description"
				       value="<?php echo $description; ?>">
			</div>
			<div class="eltdf-membership-input-holder">
				<label for="password"><?php esc_html_e( 'Password', 'eltdf_membership' ); ?></label>
				<input class="eltdf-membership-input" type="password" name="password" id="password" value="">
			</div>
			<div class="eltdf-membership-input-holder">
				<label for="password2"><?php esc_html_e( 'Repeat Password', 'eltdf_membership' ); ?></label>
				<input class="eltdf-membership-input" type="password" name="password2" id="password2" value="">
			</div>
			<?php
			if ( eltdf_membership_theme_installed() ) {
				echo satine_elated_get_button_html( array(
					'text'      => esc_html__( 'UPDATE PROFILE', 'eltdf_membership' ),
					'html_type' => 'button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('UPDATING PROFILE', 'eltdf_membership'),
						'data-updated-text' => esc_html__('PROFILE UPDATED', 'eltdf_membership'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'UPDATE PROFILE', 'eltdf_membership' ) . '</button>';
			}
			wp_nonce_field( 'eltdf_validate_edit_profile', 'eltdf_nonce_edit_profile' )
			?>
		</form>
		<?php
		do_action( 'eltdf_membership_action_login_ajax_response' );
		?>
	</div>
</div>