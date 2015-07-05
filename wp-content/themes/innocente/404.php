<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Innocente
 * @since Innocente 1.0
 */

get_header(); ?>

		<div id="main">

			<div id="post-0" class="error404 not-found">
				<h1 class="entry-title"><?php _e( 'Ingen tr&auml;ff', 'templatesquare' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Det du s&ouml;kte kan inte hittas p&aring; den h&auml;r webbsidan. ', 'templatesquare' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- end #main -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>