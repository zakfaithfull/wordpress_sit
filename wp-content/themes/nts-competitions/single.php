<?php get_header(); ?>

		<!--<p class="back-button"><a href="<?php bloginfo('url'); ?>" class="button">&#8592; &nbsp;Back to Competitions</a></p>-->

		<div id="content" class="twelvecol first clearfix">
		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<h2><?php the_title(); ?></h2>
					
					<?php the_content(); ?>

				<?php endwhile; ?>

				<?php else : ?>

				<?php endif; ?>

		</div> <!-- end #content -->

<?php get_footer(); ?>
