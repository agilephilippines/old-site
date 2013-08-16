<?php
/**
 * The Template for displaying all single posts.
 *
 * @package aThemes
 */

get_header();
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<div class="clearfix author-info">
				<div class="author-photo"><?php echo get_avatar( get_the_author_id() , 75 ); ?></div>
				<div class="author-content">
					<h3><?php the_author(); ?></h3>
					<p><?php the_author_meta( 'description' ); ?></p>
					<div class="author-links">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="me">More Posts</a>

						<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
						<a href="http://twitter.com/<?php echo get_the_author_meta( 'twitter' ); ?>">Twitter</a>
						<?php endif; ?>

						<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
						<a href="https://facebook.com/<?php echo get_the_author_meta( 'facebook' ); ?>">Facebook</a>
						<?php endif; ?>

						<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
						<a href="http://linkedin.com/in/<?php echo get_the_author_meta( 'linkedin' ); ?>">LinkedIn</a>
						<?php endif; ?>
					</div>
				</div>
			<!-- .author-info --></div>

			<?php athemes_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>