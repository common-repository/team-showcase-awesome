<?php
    $teams = carbon_get_post_meta( get_the_ID(), 'team_items' );
    $team_column_grid = carbon_get_post_meta( get_the_ID(), 'team_style_choice_grid_col' );
?>
<div id="style-tujuh" class="team-post-<?php echo esc_attr(get_the_ID()); ?> style-tujuh">
    <div class="team-block grid grid-cols-12">
        <?php foreach ( $teams as $team ) {
        $team_items_socials = $team['team_items_socials']; ?>
        <div class="team-inner-block col-span-<?php echo esc_attr($team_column_grid); ?> sm:col-span-12">
            <?php team_avatar_view($team['team_item_img']); ?>
            <div class="team-details clearfix">
                <div class="inner-team-details">
                    <?php team_title_view($team['team_item_name']); ?>

                    <?php team_job_view($team['team_job']); ?>
                    
                    <?php team_bio_view($team['team_item_bio']); ?>
                    <div class="team-socials clearfix">
                        <ul class="social-list">
                            <?php 
                            foreach ( $team_items_socials as $team_items_social ) {
                                if(!empty($team_items_social['team_item_social_link'])) {
                                    $icon = "";
                                    if(!empty($team_items_social['team_item_social_icon'])) {
                                    $icon = $team_items_social['team_item_social_icon']['class'];
                                    } ?>
                            <li class="social-item">
                                <a href="<?php echo esc_url($team_items_social['team_item_social_link']); ?>">
                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                </a>
                            </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>



