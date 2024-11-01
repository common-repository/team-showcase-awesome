<?php
    $teams = carbon_get_post_meta( get_the_ID(), 'team_items' );
    $team_column = carbon_get_post_meta( get_the_ID(), 'team_style_choice_grid_col' );
?>
<div class="team-container team-post-<?php echo esc_attr(get_the_ID()); ?>">
    <div id="style-tiga" class="team-content style-tiga">
        <div class="team-list grid grid-cols-12">
            <?php foreach ( $teams as $team ) {
            $team_items_socials = $team['team_items_socials']; ?>
            <div class="item-holder col-span-<?php echo esc_attr($team_column); ?> sm:col-span-12">
                <div class="team-img clearfix"> 
                    <?php echo wp_get_attachment_image( $team['team_item_img'], 'full' ); ?>
                </div>
                <div class="member-info">
                    <?php team_title_view($team['team_item_name']); ?>

                    <?php team_job_view($team['team_job']); ?>
                    
                    <?php team_bio_view($team['team_item_bio']); ?>
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
                    <?php } } ?>
                  </ul>
                    <a href="#" class="more-btn">
                        <span>+</span>
                    </a>
                </div>
                <div class="clear"></div>
                <div class="member-info-plus">
                    <p>
                        <?php echo esc_html($team['team_desc']); ?>
                    </p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    (function($) {
    'use strict';

        $(document).ready(function() {
            $('.more-btn').on('click', function(e) {
                e.preventDefault();
                $(this).toggleClass('opened')
                $(this).parent().parent().find('.member-info-plus').slideToggle();
            });
        });

    })(jQuery);
</script>