<?php
/*-----------------------------------------------------------------------------------*/
/* TImeline Awesome Post Type
/*-----------------------------------------------------------------------------------*/


add_action('init', 'team_awesome_register');

function team_awesome_register() {

	$labels = array(
		'name'                => esc_html_x( 'Teams', 'Post Type General Name', 'team-awesome' ),
		'singular_name'       => esc_html_x( 'Teams', 'Post Type Singular Name', 'team-awesome' ),
		'menu_name'           => esc_html__( 'Teams', 'team-awesome' ),
		'parent_item_colon'   => esc_html__( 'Parent Teams:', 'team-awesome' ),
		'all_items'           => esc_html__( 'All Teams', 'team-awesome' ),
		'view_item'           => esc_html__( 'View Teams', 'team-awesome' ),
		'add_new_item'        => esc_html__( 'Add New Teams', 'team-awesome' ),
		'add_new'             => esc_html__( 'Add New', 'team-awesome' ),
		'edit_item'           => esc_html__( 'Edit Teams', 'team-awesome' ),
		'update_item'         => esc_html__( 'Update Teams', 'team-awesome' ),
		'search_items'        => esc_html__( 'Search Teams', 'team-awesome' ),
		'not_found'           => esc_html__( 'Not found', 'team-awesome' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'team-awesome' ),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => 'teams',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'rewrite'            => array( 'slug' => 'teams' ),
		'supports'           => array('title'),
		'menu_position'       => 7,
		'has_archive'           => false,
        'menu_icon'           => 'dashicons-groups',
		'exclude_from_search'   => true,
	);

	register_post_type( 'team-awesome', $args );

}

require dirname( __FILE__ ) .'/includes/hover-collections.php';

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'team_awesome_field_in_post' );
function team_awesome_field_in_post() {

	require dirname( __FILE__ ) .'/team-awesome-ctrl.php';

	Container::make( 'post_meta', 'team_repeater_cont', esc_html('Team Awesome') )
	->where( 'post_type', '=', 'team-awesome' )
	->set_priority( 'high' )
	->add_tab(  esc_html__( 'Layout', 'team-awesome' ), array(
		Field::make( 'select', 'team_style_choice', esc_html__( 'Select Style', 'team-awesome' ) )
		->add_options( array(
			'team-style-3' => 'Team Style 3',
			'team-style-5' => 'Team Style 5',
			'team-style-7' => 'Team Style 7',
			'team-style-17' => 'Team Style 17',
			'grid-card-1' => 'Grid Card',
			'grid-full-image-1' => 'Grid Full Image',
			'carousel-card-1' => 'Carousel Card',
			'carousel-full-image-1' => 'Carousel Full Image',
		) ),

		Field::make( 'select', 'team_style_choice_grid_col', esc_html__( 'Select Grid Column', 'team-awesome' ) )
		->set_width( 50 )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'team_style_choice',
				'value' => 'grid-full-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-3',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-7',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-16',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-4',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'grid-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'grid-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-15',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-9',
				'compare' => '=',
			),
		) )
		->add_options( array(
			'12' => '1',
			'6' => '2',
			'4' => '3',
			'3' => '4',
		) ),

		Field::make( 'text', 'team_style_choice_grid_gap', esc_html__( 'Padding', 'team-awesome' ) )
		->set_width( 50 )
		->set_attribute( 'placeholder', '30' )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'team_style_choice',
				'value' => 'grid-full-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-3',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-7',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-16',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-4',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'grid-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'grid-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-15',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-9',
				'compare' => '=',
			),
		) ),

		// HOVER IMAGE
		Field::make( 'select', 'team_hover_image_all', esc_html__( 'Select Hover Image', 'team-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-3d-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-3d-full-image-1',
				'compare' => '=',
			),
		) )
		->add_options( 
			team_awesome_hover_effect()
		),

		Field::make( 'text', 'team_space_item', esc_html__( 'Space Items', 'team-awesome' ) )
		->set_attribute( 'placeholder', '30' )
		->set_width(50)
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-full-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-3d-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-3d-full-image-1',
				'compare' => '=',
			),
			array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-full-card-1',
                'compare' => '=',
            ),
		) ),

		Field::make( 'text', 'team_slide_width', esc_html__( 'Team Width', 'team-awesome' ) )
		->set_attribute( 'placeholder', '500' )
		->set_width(50)
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-3d-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-3d-full-image-1',
				'compare' => '=',
			),
			array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-full-card-1',
                'compare' => '=',
            ),
		) ),

		Field::make( 'select', 'team_style_choice_car_col', esc_html__( 'Select Column', 'team-awesome' ) )
		->set_width(50)
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-17',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-full-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'carousel-full-image-1',
				'compare' => '=',
			),
		) )
		->add_options( array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		) ),
		Field::make( 'checkbox', 'team_use_arrow', esc_html__( 'Use Arrow Navigation', 'team-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-full-image-1',
                'compare' => '=',
			),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-full-image-1',
                'compare' => '=',
            ),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-card-1',
                'compare' => '=',
			),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-full-card-1',
                'compare' => '=',
			),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-card-1',
                'compare' => '=',
            ),
			array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-full-card-1',
                'compare' => '=',
            ),
        ) )
		->set_width( 33 )
    	->set_option_value( 'yes' ),

        Field::make( 'checkbox', 'team_use_pagination', esc_html__( 'Use Pagination', 'team-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-full-image-1',
                'compare' => '=',
			),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-full-image-1',
                'compare' => '=',
            ),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-card-1',
                'compare' => '=',
			),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-full-card-1',
                'compare' => '=',
			),
			array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-card-1',
                'compare' => '=',
            ),
			array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-full-card-1',
                'compare' => '=',
            ),
        ) )
		->set_width( 33 )
    	->set_option_value( 'yes' ),

        Field::make( 'checkbox', 'team_use_autoplay', esc_html__( 'Use Autoplay', 'team-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-full-image-1',
                'compare' => '=',
			),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-full-image-1',
                'compare' => '=',
            ),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-card-1',
                'compare' => '=',
			),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-full-card-1',
                'compare' => '=',
			),
            array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-card-1',
                'compare' => '=',
            ),
			array(
                'field' => 'team_style_choice',
                'value' => 'carousel-3d-full-card-1',
                'compare' => '=',
            ),
        ) )
		->set_width( 33 )
    	->set_option_value( 'yes' ),
	))
	->add_tab(  esc_html__( 'Content', 'team-awesome' ), array(

		// only for style 10 & 14
		Field::make( 'html', 'team_10_14_info', esc_html__( 'Team 10 & 14 Info', 'team-awesome' ) )
		->set_html( sprintf( esc_html__( 'Please use maximum to 4 items for this style.', 'team-awesome' ) ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-10',
				'compare' => '=',
			),
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-14',
				'compare' => '=',
			),
		) ),

		// only for style 10
		Field::make( 'color', 'team_10_overlay_color', esc_html__( 'Team Overlay Color', 'team-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-10',
				'compare' => '=',
			),
		) ),

		// only for style 12
		Field::make( 'text', 'team_12_height', esc_html__( 'Team 12 Slider Height (px)', 'team-awesome' ) )
		->set_attribute( 'placeholder', '600' )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'team_style_choice',
				'value' => 'team-style-12',
				'compare' => '=',
			),
		) ),

		Field::make( 'complex', 'team_items', esc_html__( 'Team Items', 'team-awesome' ) )
		->set_layout( 'tabbed-horizontal' )
		->add_fields( array(

				// only for style 6
				Field::make( 'select', 'team_hover_image', esc_html__( 'Select Hover Image', 'team-awesome' ) )
				->set_conditional_logic( array(
					'relation' => 'OR',
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'grid-card-1',
						'compare' => '=',
					),
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'grid-full-image-1',
						'compare' => '=',
					),
				) )
				->add_options( 
					team_awesome_hover_effect()
				)
				->set_width( 50 ),

				Field::make( 'color', 'team_6_hover_color', esc_html__( 'Team Hover Color', 'team-awesome' ) )
				->set_conditional_logic( array(
					'relation' => 'OR',
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'grid-card-1',
						'compare' => '=',
					),
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'grid-full-image-1',
						'compare' => '=',
					),
				) )
				->set_width( 50 ),

				// Global team item repetaer
				Field::make( 'text', 'team_item_name', esc_html__( 'Team Name', 'team-awesome' ) )
				->set_attribute( 'placeholder', 'John Doe' )
				->set_width( 40 ),

				Field::make( 'text', 'team_job', esc_html__( 'Team Job', 'team-awesome' ) )
				->set_attribute( 'placeholder', 'CEO' )
				->set_width( 25 ),

				Field::make( 'textarea', 'team_item_bio', esc_html__( 'Team Biography', 'team-awesome' ) )
				->set_attribute( 'placeholder', 'Put your text here...' )
				->set_width( 80 ),

				Field::make( 'image', 'team_item_img', esc_html__( 'Team Image', 'team-awesome' ) )
				->set_width( 20 ) ,
				Field::make( 'separator', 'team_custom_option', 'Optional' ),

				Field::make( 'color', 'team_bg_color_left', esc_html__( 'Team Background Left Color', 'team-awesome' ) )
				->set_width( 50 )
				->set_conditional_logic( array(
					'relation' => 'AND',
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-12',
						'compare' => '=',
					),
				) ),
				Field::make( 'color', 'team_bg_color_right', esc_html__( 'Team Background Right Color', 'team-awesome' ) )
				->set_width( 50 )
				->set_conditional_logic( array(
					'relation' => 'AND',
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-12',
						'compare' => '=',
					),
				) ),
				Field::make( 'complex', 'team_items_socials', esc_html__( 'Team Social', 'team-awesome' ) )
				->set_conditional_logic( array(
					'relation' => 'AND',
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-8',
						'compare' => '!=',
					),
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-10',
						'compare' => '!=',
					),
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-11',
						'compare' => '!=',
					),
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-13',
						'compare' => '!=',
					),
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-15',
						'compare' => '!=',
					),
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-18',
						'compare' => '!=',
					),
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-19',
						'compare' => '!=',
					)
				) )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(

					Field::make( 'icon', 'team_item_social_icon', esc_html__( 'Icon', 'team-awesome' ) )
					->set_width( 40 ),
					Field::make( 'text', 'team_item_social_link', esc_html__( 'Team Link', 'team-awesome' ) )
					->set_attribute( 'placeholder', 'http://' )
					->set_width( 40 ),
				))
				->set_default_value( array(
					array(
					),
				) ),


				Field::make( 'textarea', 'team_desc', esc_html__( 'Team Description', 'team-awesome' ) )
				->set_attribute( 'placeholder', 'Put your text here...' )
				->set_conditional_logic( array(
					array(
						'field' => 'parent.team_style_choice',
						'value' => 'team-style-3',
						'compare' => '=',
					)
				) ),
		) )
		->set_default_value( array(
			array(
			),
		) ),
	))
	->add_tab(  esc_html__( 'Customize', 'team-awesome' ), array(
		Field::make( 'html', 'asfafaf' )
   		->set_html( '<p>In order to customize colors, let&#39;s upgrade to pro</p><a href="https://1.envato.market/vRyXL" target="_blank" class="btn-buy">Upgrade to Pro</a>' )
	));

	// For Gutenberg Blocks
	Block::make( esc_html( 'Team Awesome' ) )
	->add_fields( array(
		Field::make( 'association', 'team_gutenberg_block', esc_html__( 'Team Awesome Post', 'team-awesome' ) )
		->set_min( 1 )
		->set_max( 1 )
		->set_types( array(
			array(
				'type'      => 'post',
				'post_type' => 'team-awesome',
			)
		) )
	) )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		require dirname( __FILE__ ) .'/gutenberg-blocks/team-block.php';
	} );

}