<?php get_header();

$template = get_template();

global $wp;
if ( have_posts() ):

wp_enqueue_style( 'ta-team-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
wp_enqueue_style( 'ta-team-awesome-thaw-flexgrid', plugin_dir_url( __FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
wp_enqueue_style( 'ta-team-awesome-style', plugin_dir_url( __FILE__ ) . 'public/css/team-awesome-public.css', array(), '', 'all' );

while ( have_posts() ) : the_post();

	$team_style = carbon_get_post_meta( get_the_ID(), 'team_style_choice' );

    if($team_style == 'grid-full-card-1') {
    	echo '<div class="team-container">';
        	include_once dirname( __FILE__ ) .'/public/team-styles/grid-full-card-1.php';
        echo '</div>';
    }
    elseif($team_style == 'team-style-2') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-2.php';
    }
    elseif($team_style == 'team-style-3') {
        echo '<div class="team-container">';
            include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-3.php';
        echo '</div>';
    }
    elseif($team_style == 'team-style-4') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-4.php';
    }
    elseif($team_style == 'team-style-5') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-5.php';
    }
    elseif($team_style == 'team-style-7') {
        echo '<div class="team-container">';
            include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-7.php';
        echo '</div>';
    }
    elseif($team_style == 'team-style-8') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-8.php';
    }
    elseif($team_style == 'team-style-9') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-9.php';
    }
    elseif($team_style == 'team-style-10') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-10.php';
    }
    elseif($team_style == 'team-style-12') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-12.php';
    }
    elseif($team_style == 'team-style-14') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-14.php';
    }
    elseif($team_style == 'team-style-15') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-15.php';
    }
    elseif($team_style == 'team-style-16') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-16.php';
    }
    elseif($team_style == 'team-style-17') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-17.php';
    }
    elseif($team_style == 'team-style-18') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-18.php';
    }
    elseif($team_style == 'team-style-19') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-19.php';
    }
    elseif($team_style == 'team-style-20') {
        include_once  dirname( __FILE__ ) .'/public/team-styles/team-style-20.php';
    }
    elseif($team_style == 'grid-card-1') {
        echo '<div class="team-container">';
            include_once  dirname( __FILE__ ) .'/public/team-styles/grid-card-1.php';
        echo '</div>';
    }
    elseif($team_style == 'grid-full-image-1') {
        echo '<div class="team-container">';
            include_once  dirname( __FILE__ ) .'/public/team-styles/grid-full-image-1.php';
        echo '</div>';
    }
    elseif($team_style == 'carousel-full-image-1') {
        include_once dirname( __FILE__ ) .'/public/team-styles/carousel-full-image-1.php';
    }
    elseif($team_style == 'carousel-card-1') {
        include_once dirname( __FILE__ ) .'/public/team-styles/carousel-card-1.php';
    }
    elseif($team_style == 'carousel-full-card-1') {
        include_once dirname( __FILE__ ) .'/public/team-styles/carousel-full-card-1.php';
    }
    elseif($team_style == 'carousel-3d-full-image-1') {
        include_once dirname( __FILE__ ) .'/public/team-styles/carousel-3d-full-image-1.php';
    }
    elseif($team_style == 'carousel-3d-card-1') {
        include_once dirname( __FILE__ ) .'/public/team-styles/carousel-3d-card-1.php';
    }
    elseif($team_style == 'carousel-3d-full-card-1') {
        include_once dirname( __FILE__ ) .'/public/team-styles/carousel-3d-full-card-1.php';
    }
   

$template = get_template();

endwhile; 
endif;
wp_reset_postdata();
get_footer(); ?>