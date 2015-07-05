<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Innocente
 * @since Innocente 1.0
 */

get_header(); ?>

		<div id="main">
			<div id="content" class="singlepost">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="posttitle"><?php the_title(); ?></h1>
					
					<div class="entry-utility-date"><span class="cd"><?php  the_time('d') ?></span> <span class="cm"><?php  the_time('M') ?></span></div>
					<div class="entry-utility">
					<?php _e('by', 'templatesquare');?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"> <?php the_author();?></a>, <?php _e('posted in', 'templatesquare');?> <?php the_category(', ') ?> &nbsp;&nbsp;|&nbsp;&nbsp;<?php comments_popup_link(__('No Comments', 'templatesquare'), __('1 Comments', 'templatesquare'), __('% Comments', 'templatesquare')); ?>
					</div>


					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'templatesquare' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					
					
					<div class="entry-utility">
					<?php
						$tags_list = get_the_tag_list( '', ', ' );
						if ( $tags_list ):
					?>
					<span class="tag-links">
						<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'templatesquare' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
				<?php endif; ?>
						<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
					
					<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'templatesquare_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'templatesquare' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'templatesquare' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
					<?php endif; ?>

				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- end #content -->
			<div id="sideright">
				<?php get_sidebar();?>
			</div><!-- end #sideright -->
			<div class="clear"></div>
		</div><!-- end #main -->
<?php get_footer(); ?>
