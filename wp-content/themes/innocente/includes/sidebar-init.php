<?php
function innocente_widgets_init() {
	register_sidebar( array(
		'name' 			=> __( 'Post Sidebar', 'templatesquare' ),
		'id' 			=> 'post-sidebar',
		'description' 	=> __( 'Located at the right side of archives, single and search.', 'templatesquare' ),
		'before_widget' => '<div class="sidebox"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '</li></ul></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
	
	register_sidebar(array(
		'name'          => __('Page Sidebar', 'templatesquare' ),
		'id'         	=> 'page-sidebar',
		'description'   => __( 'Located at the right side of page templates.', 'templatesquare' ),
		'before_widget' => '<div class="sidebox"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '</li></ul></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
	
}
/** Register sidebars by running innocente_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'innocente_widgets_init' );
?>