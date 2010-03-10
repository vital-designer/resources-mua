<?php

get_header(); ?>


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
        <span class="top"></span>
       		<div class="entry">
				<h2 class="title"><?php the_title(); ?></h2>
			
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
         <span class="bottom"></span>
		</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	
      
		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>