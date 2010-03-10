<?php
/**
 * Template Name: Lifestream
 *
 * @package LifeCollage
 * @subpackage Template
 */

get_header(); ?>

	<div class="hfeed content">

		<?php hybrid_before_content(); // Before content hook ?>

		<div class="blog-stream">

			<?php query_posts( array( 'showposts' => 10 ) ); ?>

			<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

				<div class="<?php hybrid_entry_class(); ?>">

					<div class="post-header">

						<?php the_title( '<h2 class="entry-title post-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">', '</a></h2>' ); ?>

						<p class="byline">
							<span class="time"><abbr class="published" title="<?php the_time(__('l, F jS, Y, g:i a', 'collage')); ?>"><?php the_time( __('F jS, Y', 'collage') ); ?></abbr></span> 
							<?php edit_post_link( __('Edit', 'collage' ), ' <span class="separator">|</span> <span class="edit">', '</span> ' ); ?>
						</p>

					</div>

					<?php comments_popup_link( __('0', 'collage'), __('1', 'collage'), __('%', 'collage'), 'comments-link', __('X', 'collage') ); ?>

				</div>

				<?php endwhile; ?>

			<?php endif; ?>

			<?php wp_reset_query(); ?>

		</div>

		<?php if ( function_exists( 'get_flickrRSS' ) ) : ?>

			<div id="gallery-stream" class="gallery-stream">

				<?php get_flickrRSS(); ?>

			</div>

		<?php endif; ?>

		<?php if ( is_sidebar_active( 'utility-lifestream' ) ) : ?>

			<div id="utility-lifestream">

				<?php dynamic_sidebar( 'utility-lifestream' ); ?>

			</div>

		<?php endif; ?>

		<?php hybrid_after_page(); // After page hook ?>

		<?php hybrid_after_content(); // After content hook ?>

	</div>

<?php get_footer(); ?>