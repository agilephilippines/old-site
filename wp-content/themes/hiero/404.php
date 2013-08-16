<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package aThemes
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'athemes' ); ?></h1>
				<!-- .page-header --></header>

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'athemes' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts', '' , 'before_title=<h3 class="widget-title"><span>&after_title=</span></h3>' ); ?>

					<?php if ( athemes_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h3 class="widget-title"><span><?php _e( 'Most Used Categories', 'athemes' ); ?></span></h3>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					<!-- .widget --></div>
					<?php endif; ?>

					<?php
					/* translators: %1$s: smiley */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'athemes' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=0', 'before_title=<h3 class="widget-title"><span>&after_title=</span></h3>' );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud', '' , 'before_title=<h3 class="widget-title"><span>&after_title=</span></h3>' ); ?>

				<!-- .page-content --></div>
			<!-- .error-404 --></section>

		<!-- #content --></div>
	<!-- #primary --></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>