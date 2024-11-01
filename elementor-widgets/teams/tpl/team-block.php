<?php
// WP_Query arguments
    $args = array (
        'p'              => $team_awesome_select_team,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
        'post_type'         => 'team-awesome', // YOUR POST TYPE

    );

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() && $team_awesome_select_team != '' ) {

        wp_enqueue_style( 'ta-team-awesome-fontawesome', plugin_dir_url('README.txt') . TEAM_AWESOME_NAME . '/public/css/fontawesome.min.css', array(), '', 'all' );
        wp_enqueue_style( 'ta-team-awesome-thaw-flexgrid', plugin_dir_url('README.txt') . TEAM_AWESOME_NAME . '/public/css/thaw-flexgrid.css', array(), '', 'all' );
        wp_enqueue_style( 'ta-team-awesome-style', plugin_dir_url('README.txt') . TEAM_AWESOME_NAME . '/public/css/team-awesome-public.css', array(), '', 'all' );

        while ( $query->have_posts() ) {

			$query->the_post();

            //$html_src = get_the_title( get_the_ID() );  // GET HTML SOURCE FROM YOUR POST META

            $team_style = carbon_get_post_meta( get_the_ID(), 'team_style_choice' );

            if($team_style == 'team-style-3') {
                $team_style_part = TEAM_AWESOME_DIR .'/public/team-styles/team-style-3.php';
            }
            elseif($team_style == 'team-style-5') {
                $team_style_part = TEAM_AWESOME_DIR .'/public/team-styles/team-style-5.php';
            }
            elseif($team_style == 'team-style-7') {
                $team_style_part = TEAM_AWESOME_DIR .'/public/team-styles/team-style-7.php';
            }
            elseif($team_style == 'team-style-17') {
                $team_style_part = TEAM_AWESOME_DIR .'/public/team-styles/team-style-17.php';
            }
            elseif($team_style == 'grid-card-1') {
                $team_style_part = TEAM_AWESOME_DIR .'/public/team-styles/grid-card-1.php';
            }
            elseif($team_style == 'grid-full-image-1') {
                $team_style_part = TEAM_AWESOME_DIR .'/public/team-styles/grid-full-image-1.php';
            }
            elseif($team_style == 'carousel-full-image-1') {
                $team_style_part = TEAM_AWESOME_DIR .'/public/team-styles/carousel-full-image-1.php';
            }
            elseif($team_style == 'carousel-card-1') {
                $team_style_part = TEAM_AWESOME_DIR .'/public/team-styles/carousel-card-1.php';
            }
            include $team_style_part;

        } wp_reset_postdata();
    } else {
        // no posts found
        return esc_html__( 'Sorry You have set no html for this slug...', 'team-awesome' );

    }