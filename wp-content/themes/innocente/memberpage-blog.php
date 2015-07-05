<?php
/**
 * Template Name: Medlemsmeddelande
 *
 * A custom page template for blog page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Innocente
 * @since Innocente 1.0
 */

get_header(); ?>

		<div id="main">			<?php if (is_user_logged_in()) { ?>
				<div id="content">
					<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
					yoast_breadcrumb('<div id="breadcrumbs">','</div>');
					} ?>
					
					<?php
					include_once (TEMPLATEPATH . '/title.php');
					 ?>
					
				<?php $values = get_post_custom_values("category-include"); $cat=$values[0];  ?>
				<?php global $more;	$more = 0;?>
				<?php $strinclude = $cat;?>
				<?php $catinclude = 'category_name=' . $strinclude ;?>
				<?php query_posts('&' . $catinclude .' &paged='.$paged); ?>
				<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			
				/* Run the loop for the archives page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-archives.php and that will be used instead.
				 */
				get_template_part( 'loop', 'archive' );
				?>		
				<?php wp_reset_query();?>
			</div><!-- end #content -->
			<div id="sideright">
				<?php get_sidebar('');?>
			</div><!-- end #sideright -->
			<div class="clear"></div>			<? } else { ?>					<div height=600px">						<h1>Denna sida är endast för Albas medlemmar!</h1>						<br><br>						<h3>Är du medlem? Logga in <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">HÄR</a></h3>						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>					</div>				<? } ?>	
		</div><!-- end #main -->
		 
<?php get_footer(); ?>
