<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class team_awesome_post_block extends Widget_Base {

	public function get_name() {
		return 'team_awesome-post-block';
	}

	public function get_title() {
		return esc_html__( 'Teams', 'team-awesome' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'team_awesome-general-category' ];
	}

	protected function _register_controls() {
		/*-----------------------------------------------------------------------------------
			POST BLOCK INDEX
			1. POST SETTING
		-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/*  1. POST SETTING
		/*-----------------------------------------------------------------------------------*/
		$this->start_controls_section(
			'section_team_awesome_post_block_post_setting',
			[
				'label' => esc_html__( 'Post Setting', 'team-awesome' ),
			]
		);

		$this->add_control(
			'team_awesome_select_team',
			[
				'label' => esc_html__( 'Select Team', 'team-awesome' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => team_awesome_select_team_post(),
				'description' => esc_html__( 'Select post order by (default to latest post).', 'team-awesome' ),
			]
		);

		$this->end_controls_section();
		/*-----------------------------------------------------------------------------------
			end of post block post setting
		-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
		'section_team_awesome_block_setting',
			[
				'label' => esc_html__( 'Title', 'team-awesome' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_team_awesome_fff_setting',
			[
				'name' => 'fff_schemes_notice',
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( '<p>In order to customize fonts, let&#39;s upgrade to pro</p><br /><a href="https://1.envato.market/vRyXL" class="btn-buy" target="_blank">Upgrade to Pro</a>', 'team-awesome' ), Settings::get_url() ),
				'content_classes' => 'fasgag',
				'render_type' => 'ui',
			]
		);

	}

	protected function render() {

		$instance = $this->get_settings();

		/*-----------------------------------------------------------------------------------*/
		/*  VARIABLES LIST
		/*-----------------------------------------------------------------------------------*/

		/* POST SETTING VARIBALES */
		$team_awesome_select_team 			= ! empty( $instance['team_awesome_select_team'] ) ? $instance['team_awesome_select_team'] : '';


		/* end of variables list */


		/*-----------------------------------------------------------------------------------*/
		/*  THE CONDITIONAL AREA
		/*-----------------------------------------------------------------------------------*/

		include ( plugin_dir_path(__FILE__).'tpl/team-block.php' );

		?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new team_awesome_post_block() );