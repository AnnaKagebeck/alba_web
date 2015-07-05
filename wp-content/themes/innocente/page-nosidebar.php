<?php
/**
 * Template Name: No sidebar
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Innocente
 * @since Innocente 1.0
 */

get_header(); ?>

		<div id="main">
				<div class="pagepost">
				
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
				</div><!-- end pagepost -->
		</div><!-- end #main -->
		
<?php get_footer(); ?>
