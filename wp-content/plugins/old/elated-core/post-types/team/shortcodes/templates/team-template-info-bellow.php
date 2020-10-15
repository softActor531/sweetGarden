<div class="eltdf-team <?php echo esc_attr($team_member_layout) ?> <?php echo esc_attr($team_member_image_layout) ?>">
	<div class="eltdf-team-inner">
		<?php if (get_the_post_thumbnail($member_id) !== '') { ?>
			<div class="eltdf-team-image">
                <?php if($team_member_image_layout == 'circle') {
                    echo get_the_post_thumbnail($member_id, 'satine_square');
                } else {
                    echo get_the_post_thumbnail($member_id, 'full');
                }
                ?>
			</div>
		<?php } ?>
		<div class="eltdf-team-info">
            <div class="eltdf-team-title-holder">
                <h5 itemprop="name" class="eltdf-team-name entry-title">
                   <?php echo esc_html($title) ?>
                </h5>

                <?php if (!empty($position)) { ?>
                    <h6 class="eltdf-team-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
			<?php if (!empty($excerpt) && ($display_description === "yes") ) { ?>
				<div class="eltdf-team-text">
					<div class="eltdf-team-text-inner">
						<div class="eltdf-team-description">
							<p itemprop="description" class="eltdf-team-excerpt"><?php echo esc_html($excerpt); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
            <?php if ($display_social === "yes") { ?>
			<div class="eltdf-team-social-holder-between">
				<div class="eltdf-team-social">
					<div class="eltdf-team-social-inner">
						<div class="eltdf-team-social-wrapp">
							<?php foreach ($team_social_icons as $team_social_icon) {
								print $team_social_icon;
							} ?>
						</div>
					</div>
				</div>
			</div>
            <?php } ?>
		</div>
	</div>
</div>