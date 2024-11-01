<?php
$teams = carbon_get_post_meta( get_the_ID(), 'team_items' );
$team_column = carbon_get_post_meta( get_the_ID(), 'team_style_choice_car_col' );

wp_enqueue_style( 'ta-team-awesome-swiper', plugin_dir_url(__DIR__ ) . 'css/swiper.css', array(), '', 'all' );
?>
<div class="team-container">
    <div class="grid grid-cols-12 gap-12 team-post-<?php echo esc_attr(get_the_ID()); ?> style-tujuhbelas" id="style-tujuhbelas">
        <!-- Tab panes -->
        <div class="team-profile-tab col-span-4 sm:col-span-12 flex items-center">
		    <?php $no = 0; foreach ( $teams as $team ) { $no++;
                $team_items_socials = $team['team_items_socials']; ?>
            <div class="team-desc fade in <?php if($no == 1) { ?>active <?php } ?>" data-id="team-tujuh-<?php echo esc_attr($no); ?>">
                <div class="heading-block">
					<?php team_job_view($team['team_job']); ?>

					<?php team_title_view($team['team_item_name']); ?>
				</div>
				<?php team_bio_view($team['team_item_bio']); ?>
                <div class="socials flex flex-wrap gap-4">
                    <?php 
                    foreach ( $team_items_socials as $team_items_social ) {
                    if(!empty($team_items_social['team_item_social_link'])) {
                        $icon = "";
                        if(!empty($team_items_social['team_item_social_icon'])) {
                            $icon = $team_items_social['team_item_social_icon']['class'];
                        } ?>
                    <div class="social-item">
                        <a href="<?php echo esc_url($team_items_social['team_item_social_link']); ?>" target="_blank">
                            <i class="<?php echo esc_attr($icon); ?>"></i>
                        </a>
                    </div>
                    <?php } } ?>
                </div>
            </div>
			<?php } ?>
        </div>
        <!-- Tab Panes End -->


        <!-- Nav Tabs -->
        <div class="team-photo col-span-8 sm:col-span-12">
            <div class="team-team">
                <div class="swiper-container">
				    <div class="swiper-wrapper">
		                <?php $no = 0; foreach ( $teams as $team ) { $no++; ?>
				      	<div class="swiper-slide">
					      	<div role="presentation" class="team-photo-box">
								<a href="#team-tujuh-1" aria-controls="team-tujuh-<?php echo esc_attr($no); ?>">
									<?php echo wp_get_attachment_image( $team['team_item_img'], 'full', "", array( "class" => "userProfile__image" ) ); ?>
								</a>
							</div>
					    </div>
						<?php } ?>
				    </div>
				    <!-- Add Arrows -->
				    <div class="swiper-button-next"></div>
				    <div class="swiper-button-prev"></div>
				</div>
            </div>
        </div>
        <!-- Nav Tabs End -->
    </div>

</div>

<?php wp_enqueue_script( 'ta-team-awesome-swiper-min', plugin_dir_url(__DIR__ ) . 'js/swiper.min.js', array( 'jquery' ), '', false ); ?>

<script>
(function ($) {
	'use strict';

	$(document).ready(function() {
	    var swiper = new Swiper('.team-team .swiper-container', {
	    	slidesPerView: <?php echo intval($team_column); ?>,
	    	spaceBetween: 0,
		    breakpoints: {
		      	480: {
		        	slidesPerView: 1,
		        	spaceBetween: 0,
		      	},
		      	640: {
		        	slidesPerView: <?php echo intval($team_column); ?>,
		        	spaceBetween: 0,
		      	}
		    },
	      	navigation: {
	        	nextEl: '.swiper-button-next',
	        	prevEl: '.swiper-button-prev',
	      	},
	    });

	    var coba = $('.team-desc.active').attr('data-id');
	    $("a[aria-controls=" + coba + "]").find('img').css('opacity', '1');

	    $(document).on('click', '.team-photo-box', function() {
	        $(this).find('img').css('opacity', 1);
	        $(this).parent().siblings('.swiper-slide').find('img').css('opacity', '0.3');
	    });

	    $('.team-desc').each(function() {
	        var coba = $('.team-desc.active').attr('data-id');
	         $("a[aria-controls=" + coba + "]").find('img').css('opacity', '1');
	    });

	   	$('.swiper-slide a').on('click', function() {  
	      	$(".team-desc").removeClass('active');
	      	$(".team-desc[data-id='"+$(this).attr('aria-controls')+"']").addClass("active");
	    });


    	function team_awesome_style17_cs() {
			$('.swiper-slide').removeClass('cur-slide');
			$('.swiper-slide-active').addClass('cur-slide');

	      	$(".team-desc").removeClass('active');
			$(".team-desc[data-id='"+$('.cur-slide a').attr('aria-controls')+"']").addClass("active");


	        $('.team-photo-box').find('img').css('opacity', 1);
	        $('.team-photo-box').parent().siblings('.swiper-slide').find('img').css('opacity', '0.3');

			var coba = $('.team-desc.active').attr('data-id');
	        $(".cur-slide a[aria-controls=" + coba + "]").find('img').css('opacity', '1');
	    }

	    var windowWidth = $(window).width();
	    if(windowWidth < 640) {
		    team_awesome_style17_cs();
		    swiper.on('slideChangeTransitionEnd', function () {
		    	team_awesome_style17_cs();
		    });
	    }
	});
})( jQuery );
</script>
