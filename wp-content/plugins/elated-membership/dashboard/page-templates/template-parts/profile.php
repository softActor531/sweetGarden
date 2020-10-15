<div class="eltdf-membership-dashboard-page">
	<h3 class="eltdf-membership-dashboard-page-title">
		<?php esc_html_e( 'Profile', 'eltdf_membership' ); ?>
	</h3>
	<div class="eltdf-membership-dashboard-page-content">
		<div class="eltdf-profile-image">
            <?php echo eltdf_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'First Name', 'eltdf_membership' ); ?>:</span>
			<?php echo $first_name; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last Name', 'eltdf_membership' ); ?>:</span>
			<?php echo $last_name; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'eltdf_membership' ); ?>:</span>
			<?php echo $email; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'eltdf_membership' ); ?>:</span>
			<?php echo $description; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'eltdf_membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo $website; ?></a>
		</p>
	</div>
</div>
