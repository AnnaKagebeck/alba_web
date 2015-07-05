<?php /* Template Name: Medlemssida
*/ ?>
<?php
/**
 * Medlemssidan //The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Innocente
 * @since Innocente 1.0
 */

get_header(); 
?>

		<div id="main">
			

				<?php if (is_user_logged_in()) { ?>
					<div id="content" class="pagepost">
						<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
							yoast_breadcrumb('<div id="breadcrumbs">','</div>');
							} ?>
				
			
						<?php
							if(!is_front_page()){
							//	include_once (TEMPLATEPATH . '/title.php');
							}
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
				
					</div><!-- end #content -->
						
					<div id="sideright">
					<?php get_sidebar();?>
					</div><!-- end #sideright -->
					<div class="clear"></div><!-- clear float -->
				<? } else { ?>
					<div height=600px">
						<h1>Denna sida är endast för Albas medlemmar!</h1>
						<br><br>
						<h3>Är du medlem? Logga in <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">HÄR</a></h3>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

						
					</div>
				<? } ?>				
		</div><!-- end #main -->
<?php get_footer(); ?>