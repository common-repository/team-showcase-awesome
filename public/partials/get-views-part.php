<?php

// Team Title
function team_title_view($content) { ?>
	<div class="team-name">
		<h1><?php echo esc_html($content); ?></h1>
	</div>
<?php }

// Team Avatar
function team_avatar_view($content) { ?>
	<div class="team-avatar">
		<?php echo wp_get_attachment_image( $content, 'full' ); ?>
	</div>
<?php }

// Team Job
function team_job_view($content) { ?>
	<div class="team-job">
		<span><?php echo esc_html($content); ?></span>
	</div>
<?php }

// Team Bio
function team_bio_view($content) { ?>
	<div class="team-bio">
		<p><?php echo wp_specialchars_decode($content); ?></p>
	</div>
<?php }

// Team Title
function team_style_script($post_id) {
	$team_style_choice = carbon_get_post_meta( $post_id, 'team_style_choice' ); 
	$team_column = carbon_get_post_meta( $post_id, 'team_style_choice_car_col' );
	$spacebetween = carbon_get_post_meta( $post_id, 'team_space_item' );
	if($spacebetween != "" || $spacebetween === 0) {
		$spacebetween = $spacebetween;
	} else {
		$spacebetween = 30;
	}

	$team_use_arrow = carbon_get_post_meta( $post_id, 'team_use_arrow' );
	$team_use_pagination = carbon_get_post_meta( $post_id, 'team_use_pagination' );
	$team_use_autoplay = carbon_get_post_meta( $post_id, 'team_use_autoplay' );

	if($team_style_choice == 'carousel-card-1' || $team_style_choice == 'carousel-full-image-1') { ?>
	<script>
		(function( $ ) {
		'use strict';

			$(document).ready(function() {
			    var swiper = new Swiper('.team-post-<?php echo esc_attr($post_id); ?> .swiper-container', {
			    	<?php if($team_style_choice == 'carousel-full-image-1' || $team_style_choice == 'carousel-card-1') { ?>
			    	slidesPerView: <?php echo intval($team_column); ?>,
			    	loop: true,
			    	<?php } ?>
			    	spaceBetween: <?php echo intval($spacebetween); ?>,
			    	<?php if($team_use_autoplay == true) { ?>
			    	autoplay: {
				        delay: 2500,
				        disableOnInteraction: false,
			      	},
			      	<?php } ?>
				    breakpoints: {
				      	480: {
				        	slidesPerView: 1,
				        	spaceBetween: 0,
				      	},
				      	640: {
				        	slidesPerView: <?php echo intval($team_column); ?>,
				        	spaceBetween: <?php echo intval($spacebetween); ?>,
				      	}
				    },
			      	navigation: {
			        	nextEl: '.team-post-<?php echo esc_attr($post_id); ?> .swiper-button-next',
			        	prevEl: '.team-post-<?php echo esc_attr($post_id); ?> .swiper-button-prev',
			      	},
			      	<?php if($team_use_pagination == true) { ?>
			      	pagination: {
			      		clickable: true,
			        	el: '.team-post-<?php echo esc_attr($post_id); ?> .swiper-pagination',
			      	},
			      	<?php } ?>
				    <?php if($team_use_arrow == true) { ?>
			      	navigation: {
				        nextEl: '.team-post-<?php echo esc_attr($post_id); ?> .swiper-button-next',
				        prevEl: '.team-post-<?php echo esc_attr($post_id); ?> .swiper-button-prev',
			      	},
			      	<?php } ?>
			    });
			});

		})( jQuery );
	</script>
	<?php }
	elseif($team_style_choice == 'masonry-card-2') { ?>
	<script>
		(function ($) {
		    'use strict';

		    $(document).ready(function () {
		        $('.team-post-<?php echo esc_attr($post_id); ?> .grid-masonry').masonry({
		            // options
		            itemSelector: '.team-post-<?php echo esc_attr($post_id); ?> .grid-item-masonry',
		            columnWidth: '.team-post-<?php echo esc_attr($post_id); ?> .grid-item-masonry',
		        });
		    });

		})( jQuery );
	</script>
	<?php }
}