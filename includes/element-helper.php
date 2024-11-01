<?php
namespace Elementor;

function team_awesome_general_elementor_init(){
	Plugin::instance()->elements_manager->add_category(
		'team_awesome-general-category',
		[
			'title'  => 'Team Awesome',
			'icon' => 'font'
		],
		1
	);
}
add_action('elementor/init','Elementor\team_awesome_general_elementor_init');
