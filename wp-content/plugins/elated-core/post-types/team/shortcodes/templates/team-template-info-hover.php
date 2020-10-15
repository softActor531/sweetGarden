<div class="eltdf-team <?php echo esc_attr($team_member_layout) ?>">
    <div class="eltdf-team-inner">
        <?php if (get_the_post_thumbnail($member_id) !== '') { ?>
            <div class="eltdf-team-image">
                <?php echo get_the_post_thumbnail($member_id); ?>
                <div class="eltdf-team-info-tb">
                    <div class="eltdf-team-info-tc">
                        <div class="eltdf-team-title-holder">
                            <h5 itemprop="name" class="eltdf-team-name entry-title">
                                <?php echo esc_html($title) ?>
                            </h5>
                            <?php if (!empty($position)) { ?>
                                <h6 class="eltdf-team-position"><?php echo esc_html($position); ?></h6>
                            <?php } ?>
                        </div>
                        <div class="eltdf-team-social-holder-between">
                            <div class="eltdf-team-social">
                                <div class="eltdf-team-social-inner">
                                    <div class="eltdf-team-social-wrapp">
                                        <?php foreach($team_social_icons as $team_social_icon) {
                                            print $team_social_icon;
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>