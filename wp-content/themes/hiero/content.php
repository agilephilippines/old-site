<?php
/**
 * @package aThemes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
	<header class="clearfix entry-header">
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"> <?php comments_popup_link( __( '0', 'athemes' ), __( '1', 'athemes' ), __( '%', 'athemes' ) ); ?></span>
		<?php endif; ?>

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php athemes_posted_on(); ?>
		<!-- .entry-meta --></div>
		<?php endif; ?>
	<!-- .entry-header --></header>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail( 'thumb-featured' ); ?>
			</a>
		</div>

		<div class="entry-summary">
			<?php echo wpautop( $post->post_excerpt ? $post->post_excerpt : athemes_limit_string(strip_tags($post->post_content), 200) ); ?>
		<!-- .entry-summary --></div>

	<?php else : ?>

		<div class="clearfix entry-content">
			<?php the_content( __( 'Continue Reading <span class="meta-nav">&rarr;</span>', 'athemes' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'athemes' ), 'after' => '</div>' ) ); ?>
		<!-- .entry-content --></div>

	<?php endif; ?>

	<footer class="entry-meta entry-footer">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php
				$categories_list = get_the_category_list( __( ', ', 'athemes' ) );
				if ( $categories_list && athemes_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( '<i class="ico-folder"></i> %1$s', 'athemes' ), $categories_list ); ?>
			</span>
			<?php endif; ?>

			<?php
				$tags_list = get_the_tag_list( '', __( ', ', 'athemes' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( '<i class="ico-tags"></i> %1$s', 'athemes' ), $tags_list ); ?>
			</span>
			<?php endif; ?>
		<?php endif; ?>
	<!-- .entry-meta --></footer>
<!-- #post-<?php the_ID(); ?>--></article>