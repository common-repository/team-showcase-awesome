<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themesawesome.com/
 * @since             1.0.0
 * @package           Team_Awesome
 *
 * @wordpress-plugin
 * Plugin Name:       Team Showcase Awesome
 * Plugin URI:        https://team.themesawesome.com/
 * Description:       An awesome plugin that helps You to showcase team member interface element into your WordPress Site.
 * Version:           1.0.4
 * Author:            Themes Awesome
 * Author URI:        https://themesawesome.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       team-awesome
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TEAM_AWESOME_VERSION', '1.0.4' );

define( 'TEAM_AWESOME', __FILE__ );

define( 'TEAM_AWESOME_BASENAME', plugin_basename( TEAM_AWESOME ) );

define( 'TEAM_AWESOME_NAME', trim( dirname( TEAM_AWESOME_BASENAME ), '/' ) );

define( 'TEAM_AWESOME_DIR', untrailingslashit( dirname( TEAM_AWESOME ) ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-team-awesome-activator.php
 */
function activate_team_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-team-awesome-activator.php';
	Team_Awesome_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-team-awesome-deactivator.php
 */
function deactivate_team_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-team-awesome-deactivator.php';
	Team_Awesome_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_team_awesome' );
register_deactivation_hook( __FILE__, 'deactivate_team_awesome' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-team-awesome.php';

require plugin_dir_path( __FILE__ ) . 'team-awesome-post-type.php';

require_once plugin_dir_path( __FILE__ ).'includes/element-helper.php';
require_once plugin_dir_path( __FILE__ ).'includes/hover-collections.php';
require_once plugin_dir_path( __FILE__ ).'public/partials/get-views-part.php';

function team_awesome_new_elements(){
	require_once plugin_dir_path( __FILE__ ).'elementor-widgets/teams/team-control.php';
}

add_action('elementor/widgets/widgets_registered','team_awesome_new_elements');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_team_awesome() {

	$plugin = new Team_Awesome();
	$plugin->run();

}
run_team_awesome();

/* Shortcode Function */
add_filter('manage_team-awesome_posts_columns', function($columns) {
	return array_merge($columns, ['shortcode' => esc_html__('Shortcode', 'team-awesome')]);
});
 
add_action('manage_team-awesome_posts_custom_column', function($column_key, $post_id) {
	echo '<pre"><code>[team_awesome id="'. esc_attr( $post_id ) .'"]</code></pre>';
}, 10, 2);

add_filter( 'single_template', 'team_awesome_post_custom_template', 50, 1 );
function team_awesome_post_custom_template( $template ) {

	if ( is_singular( 'team-awesome' ) ) {
		$template = TEAM_AWESOME_DIR . '/single-team-awesome.php';
	}
	
	return $template;
}


add_action( 'after_setup_theme', 'team_awesome_crb_load' );
function team_awesome_crb_load() {
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'elementor/preview/enqueue_styles', function() {
	wp_enqueue_style( 'ta-logo-awesome-swiper', plugin_dir_url( __FILE__ ) . 'public/css/swiper.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-logo-awesome-hovers', plugin_dir_url( __FILE__ ) . 'public/css/hovers.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-logo-awesome-fontawesome', plugin_dir_url( __FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-logo-awesome-thaw-flexgrid', plugin_dir_url( __FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-logo-awesome-style', plugin_dir_url( __FILE__ ) . 'public/css/team-awesome-public.css', array(), '1.0.4', 'all' );

	wp_enqueue_script( 'ta-logo-awesome-stopExecution', plugin_dir_url(__FILE__ ) . 'public/js/stopExecution.js', array( 'jquery' ), '', false );
} );

function team_awesome( $atts ) {

	// Get Attributes
	extract( shortcode_atts(
			array(
				'id' => ''   // DEFAULT SLUG SET TO EMPTY
			), $atts )
	);

	// WP_Query arguments
	$args = array (
		'page_id'              =>  $id,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
		'post_type'         => 'team-awesome', // YOUR POST TYPE

	);
	ob_start();

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() && $id != '' ) {

		wp_enqueue_style( 'ta-team-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-team-awesome-thaw-flexgrid', plugin_dir_url( __FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-team-awesome-style', plugin_dir_url( __FILE__ ) . 'public/css/team-awesome-public.css', array(), '1.0.4', 'all' );

		while ( $query->have_posts() ) {

			$query->the_post();

			$team_style = carbon_get_post_meta( get_the_ID(), 'team_style_choice' );

			if($team_style == 'team-style-3') {
				$team_style_part = dirname( __FILE__ ) .'/public/team-styles/team-style-3.php';
			}
			elseif($team_style == 'team-style-5') {
				$team_style_part = dirname( __FILE__ ) .'/public/team-styles/team-style-5.php';
			}
			elseif($team_style == 'team-style-7') {
				$team_style_part = dirname( __FILE__ ) .'/public/team-styles/team-style-7.php';
			}
			elseif($team_style == 'team-style-17') {
				$team_style_part = dirname( __FILE__ ) .'/public/team-styles/team-style-17.php';
			}
			elseif($team_style == 'grid-card-1') {
				$team_style_part = dirname( __FILE__ ) .'/public/team-styles/grid-card-1.php';
			}
			elseif($team_style == 'grid-full-image-1') {
				$team_style_part = dirname( __FILE__ ) .'/public/team-styles/grid-full-image-1.php';
			}
			elseif($team_style == 'carousel-full-image-1') {
				$team_style_part = dirname( __FILE__ ) .'/public/team-styles/carousel-full-image-1.php';
			}
			elseif($team_style == 'carousel-card-1') {
				$team_style_part = dirname( __FILE__ ) .'/public/team-styles/carousel-card-1.php';
			}
			include $team_style_part;

		}
	} else {
		// no posts found
		return esc_html__( 'Sorry You have set no html for this slug...', 'team-awesome' );

	}


// Restore original Post Data
	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode( 'team_awesome', 'team_awesome' );

function team_awesome_select_team_post() {
	$teams_array = array();

	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'team-awesome',
	);

	$teams = get_posts($args);

	foreach( $teams as $post ) { setup_postdata( $post );
		$teams_array[$post->ID] = $post->post_title;
	}

	return $teams_array;

	wp_reset_postdata();
}

add_action( 'wp_head', 'team_awesome_fonts_custom_styles', 10 );
function team_awesome_fonts_custom_styles() {

	$team_awesome_custom_args = array(
		'post_type'         => 'team-awesome',
		'posts_per_page'    => -1,
	);
	$team_awesome_custom = new WP_Query($team_awesome_custom_args);
	if ($team_awesome_custom->have_posts()) : ?>

	<style>
		<?php while($team_awesome_custom->have_posts()) : $team_awesome_custom->the_post();

        $team_column_gap = carbon_get_post_meta( get_the_ID(), 'team_style_choice_grid_gap' );
        if($team_column_gap != "" || $team_column_gap === 0) {
            $team_column_gap = $team_column_gap;
        } else {
            $team_column_gap = 30;
        } ?>

		<?php if(!empty($team_column_gap)) { ?>
            .team-post-<?php echo esc_attr(get_the_ID()); ?> .grid,
            .team-post-<?php echo esc_attr(get_the_ID()); ?>.grid {
                gap: <?php echo esc_html($team_column_gap); ?>px;
            }
        <?php } ?>

		<?php endwhile; wp_reset_postdata(); ?>
	</style>

<?php endif;
}