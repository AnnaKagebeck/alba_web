<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Innocente
 * @since Innocente 1.0
 */

get_header(); ?>

		<div id="main" class="singlepost">
				<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
				yoast_breadcrumb('<div id="breadcrumbs">','</div>');
				} ?>
				
			
				<?php
				include_once (TEMPLATEPATH . '/title.php');
				 ?>
				 
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content( __( 'Continue Reading', 'templatesquare' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'templatesquare' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

				<?php endwhile; ?>
		</div><!-- end #main -->
<?php get_footer(); ?>
