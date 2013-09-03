<?php
/*
Template Name: Custom Page Example
*/
?>

<?php get_header(); ?>

		<div id="content">
									
			<div class="twelvecols first clearfix">
			
				<!--<div class="slider clearfix">
				
					<a href="#" title=""><img src="<?php bloginfo('template_directory'); ?>/library/images/arrowleft.png" class="arrowleft"></a>
					<a href="#" title=""><img src="<?php bloginfo('template_directory'); ?>/library/images/arrowright.png" class="arrowright"></a>
					
					<img src="<?php bloginfo('template_directory'); ?>/library/images/rohan-comp.png">
					
					<div class="description">
						
						<img src="<?php bloginfo('template_directory'); ?>/library/images/rohan.png">
						
						<h2>Win A Countrywide Jacket</h2>
						
						<a href="<?php bloginfo('url'); ?>/win-a-countrywide-jacket/" class="button enter">Enter Now</a>
					</div>
					
				</div>-->
				
				<?php the_featured_posts_slider(); ?>
			
			</div>
				
		</div> <!-- end #content -->

<?php get_footer(); ?>
