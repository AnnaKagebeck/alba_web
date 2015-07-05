<?php
/**
 * The Header for our theme.
 *
 *
 * @package WordPress
 * @subpackage Innocente
 * @since Innocente 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'templatesquare' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link href="<?php bloginfo('template_url'); ?>/prettyPhoto.css" rel="stylesheet" type="text/css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php 
$favicon = get_option('templatesquare_favicon');
if($favicon =="" ){
?>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
<?php }else{?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php }?>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<!-- ////////////////////////////////// -->
<!-- //      Javascript Files        // -->
<!-- ////////////////////////////////// -->
<script type="text/javascript">
	 Cufon.replace('h1') ('h1 a') ('h2') ('h3') ('h4') ('h5') ('h6') ('#top-navigation ul#topnav > li > a', {hover:true}) ('.datebox') ('.slider-text') ('.entry-utility-date') ('.fn') ('#twitter a', {hover:true}) ('.cnumber') ('.cmail');
</script>
<?php 
	$time = get_option('templatesquare_slider_timeout');
?>

<script type="text/javascript">
var $ = jQuery.noConflict();

	$(document).ready(function(){
		/* homepage slideshow */
		$('#slider').cycle({
			timeout: <?php echo $time ;?>,  // milliseconds between slide transitions (0 to disable auto advance)
			fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
			pager:   '#pager',  // selector for element to use as pager container
			next:   '#next-slider',  // selector for element to use as click trigger for next slide
			prev:  '#prev-slider',  // selector for element to use as click trigger for previous slide
			pause:   0,	  // true to enable "pause on hover"
			cleartypeNoBg:   true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides)
			pauseOnPagerHover: 0 // true to pause when hovering over pager link
		});
	
		/* widget slideshow */
		$('.boxslideshow').cycle({
			timeout: 6000,  // milliseconds between slide transitions (0 to disable auto advance)
			fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
			pause:   0,	  // true to enable "pause on hover"
			next:".next",  // selector for element to use as click trigger for next slide 
			prev:".prev",  // selector for element to use as click trigger for previous slide 
			cleartypeNoBg:true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
			pauseOnPagerHover: 0 // true to pause when hovering over pager link
		});
		
		$('.boxslideshow2').cycle({
			timeout: 6000,  // milliseconds between slide transitions (0 to disable auto advance)
			fx:      'scrollVert', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
			pause:   0,	  // true to enable "pause on hover"
			next:".next",  // selector for element to use as click trigger for next slide 
			prev:".prev",  // selector for element to use as click trigger for previous slide 
			cleartypeNoBg:true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
			pauseOnPagerHover: 0 // true to pause when hovering over pager link
	});
	
});

</script>
<?php
	$linkcolor = get_option('templatesquare_linkcolor');
	$linkhover = get_option('templatesquare_linkhover');
	$topnavcolor = get_option('templatesquare_topnavcolor');
	$topnavcoloractive = get_option('templatesquare_topnavcoloractive');
	$buttonbgcolor = get_option('templatesquare_buttonbgcolor');
	$buttonbgcolorhover = get_option('templatesquare_buttonbgcolorhover');
	$buttontextcolor = get_option('templatesquare_buttontextcolor');
	$bgcolor = get_option('templatesquare_bgcolor');
	$bgimage = get_option('templatesquare_bgimage');
	$disablebgimage = get_option('templatesquare_disable_bgimage');
	
	if($bgimage==""){$bgimage= get_bloginfo('template_url'). "/images/bg-body.gif";}
 ?>
<style type="text/css"> 
body{background-color:<?php echo $bgcolor;?>; <?php if($disablebgimage!=true){ echo 'background-image:url("'.$bgimage.'")'; }?>}
a:link, a:visited, .titlecolor, .pagetitle, .sidebox .more, .posttitle, .posttitle a, .posttitle a:visited {color:<?php echo $linkcolor;?>;}
a:hover, .sidebox .more:hover{color:<?php echo $linkhover;?>;}

#topnav a{
	color:<?php echo $topnavcolor;?>;
}
#topnav li.current_page_item a, #topnav ul.sub-menu li.current_page_item a,
#topnav li.current_menu_item a, #topnav ul.sub-menu li.current_menu_item a,
#topnav li.current-menu-parent a, #topnav li.current-page-parent a, #topnav a:hover, #topnav li ul a:hover
{
	color:<?php echo $topnavcoloractive;?>;
}
.button, input[type=submit], div.formcontainer form.contact-form fieldset div.form-submit input.button{
	background-color:<?php echo $buttonbgcolor;?>;
	color:<?php echo $buttontextcolor;?> !important;
}
.button:hover, input[type=submit]:hover, div.form-submit input.button:hover{background-color:<?php echo $buttonbgcolorhover;?> !important;}

.displaymore{
	background-color:<?php echo $buttonbgcolor;?>;
	color:<?php echo $buttontextcolor;?> !important;
}
.displaymore:hover{background-color:<?php echo $buttonbgcolorhover;?> !important;}
</style>



<!--[if IE]>
<script type="text/JavaScript">
$(document).ready(function() {
	  
	$(".sidebox:last-child")
	.css({marginBottom:"0px"})
	
	$("#ts-display-pf-col-1 li:last-child")
	.css({marginBottom:"25px"})

	  
})
</script>
<![endif]-->

</head>

<body <?php if(is_page()){echo 'class="page"';}?>>
		<div id="outer-container">
			<div id="outer-glow-top"></div>
			<div id="container">
			<div id="container-pattern">
				<div id="top">
					<div id="topleft">
					<?php
					$logotype = get_option('templatesquare_logo_type');
					$logoimage = get_option('templatesquare_logo_image'); 
					$sitename = get_option('templatesquare_site_name');
					if($logoimage == ""){ $logoimage = get_bloginfo('template_url') . "/images/logo.png"; }
					?>
					<?php if($logotype == 'textlogo'){ ?>
					<div id="logo">
							<?php if($sitename==""){?>
								<h1><a href="<?php echo get_option('home'); ?>/" title="<?php _e('Click for Home','templatesquare'); ?>"><?php bloginfo('name'); ?></a></h1>
							<?php }else{ ?>
								<h1><a href="<?php echo get_option('home'); ?>/" title="<?php _e('Click for Home','templatesquare'); ?>"><?php echo $sitename; ?></a></h1>
							<?php }?>
					</div><!-- end #logo -->
					<?php } else { ?>
							<div id="logo"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $logoimage;?>" alt="" /></a></div><!-- end #logo -->
					<?php }?>
					</div><!-- end #topleft -->
					<div id="topright">
							<div id="searchtop">
							<form  method="get" action="<?php echo get_option('home'); ?>/" id="searchform">
									<div><input name="s" type="text" class="inputbox" value="" onBlur="" onFocus=""/></div>
							  </form>
							</div><!-- end #searchtop -->
					</div><!-- end #topright -->
				</div><!-- end #top -->
				<div class="clear"></div><!-- clear float -->
				<div id="top-navigation">
					<?php wp_nav_menu( array(
						  'container'       => 'ul', 
						  'menu_class'      => '', 
						  'menu_id'         => 'topnav',
						  'depth'           => 0,
						  'sort_column'    => 'menu_order',
						  'fallback_cb'     => 'nav_page_fallback',
						  'theme_location' => 'mainmenu' 
						  )); 
					?>
					<div class="clear"></div><!-- clear float -->
				</div>
				<!-- end #top-navigation -->
				<?php if(is_front_page()){?>
				<?php
				include(TEMPLATEPATH . '/slider.php');
				 ?>
				<?php } ?>
