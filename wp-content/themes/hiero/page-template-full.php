<?php
/**
 * Template Name: Full Width Page
 *
 * This is the template that displays full width pages.
 * 
 * @package aThemes
*/

get_header(); ?>

		<div id="content" class="site-content-wide" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		<!-- #content --></div>
    
<?php get_footer(); ?>