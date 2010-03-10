<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>



	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
            	<span class="top"></span>
            	<div class="entry">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<!--<small><?php the_time('F jS, Y') ?>by <?php the_author() ?> </small>-->
                    
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				
					<div class="meta">
					<a href="<?php the_permalink() ?>" rel="bookmark" class="all" title="Permanent Link to <?php the_title_attribute(); ?>">Read all</a>
					
			
					<?php // de facut comments ?>
					<?php comments_popup_link('<b>No</b> Comments', '<b>1</b> Comment', '<b>%</b> Comments', 'comments'); ?></p>
					</div>
			</div>
            <span class="bottom"></span>
          </div>
		<?php endwhile; ?>

		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
