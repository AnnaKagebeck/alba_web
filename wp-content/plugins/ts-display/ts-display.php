<?php
/*
Plugin Name: TS Display
Plugin URI: http://demowp.templatesquare.com/plugins/
Description: TS Display is a wordpress plugin for display portfolio and gallery.
Version: 1.5
Author: templatesquare
Author URI: http://www.templatesquare.com
License: GPL
*/

/*  Copyright 2010  TEMPLATESQUARE 

    TS Display is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//to block direct access
if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );

//global variable for this plugin
$pathinfo	= pathinfo(__FILE__);


require($pathinfo["dirname"]."/ts-function.php");


class TS_Display{
	
	var $imagesizes;
	var $frames;
	var $arrsmallframe;
	var	$frame;
	var	$longdesc;
	var	$langval;
	var	$version;
	var $paddingimg;
	var $borderwid;
	var $defaultattr;
	
	function __construct(){
		// Register the shortcode to the function ep_shortcode()
		add_shortcode("ts-display", array($this, "ts_display_shortcode"));
		
		// Register hooks for activation/deactivation.
		register_activation_hook( __FILE__, array($this, 'ts_display_activation') );
		register_deactivation_hook( __FILE__, array($this, 'ts_display_deactivation') );
		
		// Register the options menu
		add_action( 'admin_menu', array($this, 'ts_display_admin_menu') );
		
		//Register the Display Menu
		add_action('init', array($this, 'ts_display_post_type'));
		add_action('init', array($this, 'ts_display_action_init'));
		add_action('after_setup_theme', array($this, 'ts_display_setup'));
		
		//set image size for every column in here.
		$this->imagesizes = array(
			array(
				"num"		=> 'custom',
				"namesize"	=> 'ts-display-custom-post-thumbnail',
				"width" 	=> get_option('ts_display_widthimg'),
				"height" 	=> get_option('ts_display_heightimg'),
				"width2"	=> get_option('ts_display_widthimg'),
				"height2"	=> get_option('ts_display_heightimg')
			)
			
		);
		//Specify default attributes
		$this->defaultattr = array(
			"cat" => '',
			"col" => '3',
			"postperpage" => '8',
			"frame" => 'plain',
			"showdesc" => 'no',
			"showtitle" => 'no',
			"showmore"	=> 'no',
			"fbordercolor" => '#d5d5d5',
			"fbgcolor" => '#e9e9e9',
			"customclass" => '',
			"colspacing" => get_option('ts_display_colspacing'),
			"rowspacing" => get_option('ts_display_rowspacing'),
			"contentwidth" => get_option('ts_display_contentwidth'),
			"widthimg" => get_option('ts_display_widthimg'),
			"heightimg" => get_option('ts_display_heightimg')
		);
		
		$this->paddingimg = 7;
		$this->borderwid = 1;
		
		//Set all frames that available.
		$this->frames = array("plain","square", "rounded");
		
		//Set the frames that have different size.
		$this->arrsmallframe = array("square","rounded");
		
		//Get the setting option value
		$this->longdesc 	= 150;
		
		$this->langval 		= "ts_display";
		$this->version		= "1.0";
	}

	//Get the image size for every column
	function ts_display_setsize(){
		return $this->imagesizes;
	}
	
	function ts_display_smallframe(){
		return $this->arrsmallframe;
	}
	
	function ts_display_setup(){
		add_theme_support( 'post-thumbnails' );
		$imagesizes = $this->ts_display_setsize();
		foreach($imagesizes as $imgsize){
			add_image_size( $imgsize["namesize"], $imgsize["width"], $imgsize["height"], true ); // Portfolio Thumbnail
		}
	}
	
	function ts_display_getthumbinfo($col){
		$imagesizes = $this->ts_display_setsize();
		foreach($imagesizes as $imgsize){
			if($col==$imgsize["num"]){
				return $imgsize;
			}
		}
		return false;
	}
	
	//Count all posts from post type 'display'.	
	function ts_display_getnumposts($cat){
		global $wpdb;
		$qryString = "
			SELECT	Count(*) as totpost FROM ".$wpdb->posts." a 
			INNER 	JOIN ".$wpdb->term_relationships." b ON a.ID = b.object_id 
			INNER 	JOIN ".$wpdb->term_taxonomy." c ON b.term_taxonomy_id = c.term_taxonomy_id
			INNER	JOIN ".$wpdb->terms."  d ON c.term_id = d.term_id
			WHERE 	a.post_type = 'display'
		";
		if(strlen($cat)>0){
			$qryString .= " AND	d.slug = '".$cat."'";
		}
		$numposts = $wpdb->get_var($wpdb->prepare($qryString));
		return $numposts;
	}
	
	//make the shortcode
	function ts_display_shortcode($atts){
		global $more;
		
		$defattr = $this->defaultattr;		
		//make all shortcode attributes into single variable
		extract(shortcode_atts($defattr, $atts));
		
		$more = 0;
		
		//validate the postperpage, default value is -1.
		$postperpage = (is_numeric($postperpage)&& $postperpage >=-1)? $postperpage : -1;
				
		//validate the frame, default value is 'frame1'.
		$frame = (in_array($frame,$this->frames))? $frame : $defattr["frame"];
		$longdesc = $this->longdesc;
		
		//validates the column
		$col = (!is_numeric($col))? $defattr["col"] : $col;
		
		//validates the frame dimensions.
		$widthimg = (!is_numeric($widthimg))? $defattr["widthimg"] : $widthimg;
		$heightimg = (!is_numeric($heightimg))? $defattr["heightimg"] : $heightimg;
		$contentwidth = (!is_numeric($contentwidth))? $defattr["contentwidth"] : $contentwidth;
		$paddingimg = $this->paddingimg;
		
		//validates column spacing and row spacing
		$colspacing = (!is_numeric($colspacing) || $colspacing < 0)? $defattr["colspacing"] : $colspacing;
		$rowspacing = (!is_numeric($rowspacing) || $rowspacing < 0)? $defattr["rowspacing"] : $rowspacing;
		
		$framewidth = $widthimg;
		$frameheight = $heightimg;
		
		$thumbinfo = $this->ts_display_getthumbinfo("custom");
		if(in_array($frame,$this->ts_display_smallframe())){
			$thumbwidth 	= $framewidth  - ($this->paddingimg*2) - ($this->borderwid*2);
			$thumbheight 	= $frameheight - ($this->paddingimg*2) - ($this->borderwid*2);
			$thumbname		= $thumbinfo["namesize"];
		}else{
			$thumbwidth 	= $framewidth;
			$thumbheight 	= $frameheight;
			$thumbname		= $thumbinfo["namesize"];
		}
		$paged = (get_query_var('paged'))? get_query_var('paged') : 1 ;
		
		//Get total of all posts from post type 'display'.
		$numposts = $this->ts_display_getnumposts($cat);
		
		//Count the total page.
		$num_page = floor($numposts/$postperpage)+1;
		$num_page = ($numposts%$postperpage!=0)? $num_page : $num_page - 1; 

		//Get the post from the query.
		$catinclude = 'post_type=display';
		if(strlen($cat)){
			$catinclude .= '&display-category='.$cat;
		}
		query_posts('&' . $catinclude .' &paged='.$paged.'&posts_per_page='.$postperpage.'&orderby=date');
		
		//make a appologies content if the posts is zero or null
		if ( ! have_posts() ){
			$error404 =  '<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title">'.__( 'Not Found',$this->langval). '</h1>
				<div class="entry-content">
					<p>'.__( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.',$this->langval).'</p>
					';
			$error404 .= get_search_form();
			$error404 .= '
				</div>
			</div>';
			return $error404;
		}
		
		//generate the display HTML
		$htmldisp = "";
		$htmldisp .= '
			<style type="text/css" media="screen">
			
			/* To Overwrite #content img{width: auto; height:auto;} */
			.ts-display-'.$frame.' .ts-display-img-'.$frame.' a.image img{
				width: 	'.$thumbwidth.'px !important;
				height:	'.$thumbheight.'px !important;
			}
			
			#ts-display-list a.image{
				width:'.$thumbwidth.'px;
				height:'.$thumbheight.'px; 
			}
			#ts-display-list a.image:hover{
				width:'.$thumbwidth.'px;
				height:'.$thumbheight.'px;
			}
			</style>
		';
		$htmldisp .=	'
		<div id="ts-display" class="'.$customclass.'">
			<ul id="ts-display-list" class="ts-display-'.$frame.'">
			';
			$i=1;
			$addclass = "";
			if (have_posts()){
				while ( have_posts() ){ 
					the_post(); 
					$stylelist = 'width:'.$framewidth.'px;';
					$rowsstyle = $rowspacing;
					$colsstyle = $colspacing;
					if(($i%$col) == 0 && $col){ 
						$colsstyle = 0;
					}
					$stylelist .= 'margin:0px '.$colsstyle.'px '.$rowsstyle.'px 0px;';
					$custom = get_post_custom($post->ID);
					$cf_thumb = $custom["thumb"][0];
					$cf_lightbox = $custom["lightbox"][0];
					$imginfos = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),$thumbname);
					
					if($cf_thumb!=""){
						$cf_thumb = '<img src="'.$cf_thumb.'" alt=""  width="'.$thumbwidth.'" height="'.$thumbheight.'" class="fade"/>';
					}else{
						$cf_thumb = '<img src="'.$imginfos[0].'" alt=""  width="'.$thumbwidth.'" height="'.$thumbheight.'" class="fade"/>';
					}
					$styleframe = "";
					$addancclass = "";
					if($frame=="square" || $frame=="rounded"){
						$styleframe .= 'border:solid 1px '.$fbordercolor.' !important; background-color:'.$fbgcolor.' !important; padding:'.$paddingimg.'px;';
						if($frame=="rounded"){
							$addancclass .= " ts-display-rounded";
						}
					}
					if($thumbwidth<=150 || $thumbheight<=150){
						$addancclass .= " imagesmall";
					}
					
					$styleancimg = 'height:'.$thumbheight.'px; width:'.$thumbwidth.'px;';
					
					$htmldisp .= '
						<li class="'.$addclass.'" style="'.$stylelist.'">
						<div class="ts-display-img-'.$frame.'">
					';
					if($cf_lightbox!=""){ 
						$htmldisp .= '<a class="image '.$addancclass.'" href="'.$cf_lightbox.'" style="'.$styleancimg.$styleframe.'" rel="prettyPhoto[mixed]" title="'.get_the_title($post->ID).'">';
						$htmldisp .= $cf_thumb;
						$htmldisp .= '</a>';
					}else{ 
						$htmldisp .= '<a class="image '.$addancclass.'" style="'.$styleancimg.$styleframe.'" href="'.get_permalink($post->ID).'" title="'.__('Läs mer om ',$this->langval).the_title_attribute('echo=0').'" >';
						$htmldisp .= $cf_thumb;
						$htmldisp .= '</a>';
					}
					$htmldisp .= '	
						</div>
					';
					$textdescription = "";
					if($showtitle=="yes"){
						$textdescription .= '<h2>'. get_the_title($post->ID).'</h2>';
					}
					if($showdesc=="yes"){
						$excerpt = get_the_excerpt();
						if($col==99){
							$textdescription .= ts_display_limit_words($excerpt,$longdesc);
						}else{
							$textdescription .='<p>'.ts_display_limit_char($excerpt,$longdesc).'</p>';
						}
						if($showmore=="yes"){
							$textdescription .='<a href="'.get_permalink($post->ID).'" title="'.__( 'Permalink to ',$this->langval).the_title_attribute('echo=0').'" rel="bookmark" class="displaymore">'.__('Read More',$this->langval).'</a>';
						}
					}
					if($textdescription!=""){
						$htmldisp .= '<div class="ts-display-text-content">'.$textdescription.'</div>';
					}
					
					$displayclear = "";
					if($col==1){
						$displayclear .= '<div class="ts-display-clear"></div>';
					}
					$htmldisp .= $displayclear.'</li>';
					$i++;
					$addclass=""; 
				}//---------------end While(have_posts())--------------
			}//----------------end if(have_posts())-----------------
			
			$htmldisp .= '
				</ul>
				<div class="clr"></div>
			</div>';
			if($frame=="rounded"){
				$htmldisp .= '
				<!--[if IE]>
				<script type="text/JavaScript">
				$(document).ready(function() {
				
				 $("#ts-display-list .ts-display-'.$frame.'").cornerz({
					  radius: 6
					  })
				})
				</script>
				<![endif]-->
				';
			}
			
			if (  $num_page > 1 ){
				 if(function_exists('wp_pagenavi')) {
					 ob_start();
					 
					 wp_pagenavi();
					 $htmldisp .= ob_get_contents();
						 
					 ob_end_clean();
				 }else{
					$htmldisp .= '
					<div id="nav-below" class="navigation nav2">
						<div class="nav-previous">'.get_next_posts_link( __( '<span class="prev"><span class="meta-nav">&laquo;</span> Prev</span>', 'templatesquare' ) ).'</div>
						<div class="nav-next">'.get_previous_posts_link( __( '<span class="prev">Next <span class="meta-nav">&raquo;</span></span>', 'templatesquare' ) ).'</div>
					</div><!-- #nav-below -->';
				}
			}
			wp_reset_query();
			
			return $htmldisp;
	}
	
	/* Make a Display Post Type */
	function ts_display_post_type() {
		register_post_type( 'display',
					array( 
					'label' => __('Display'), 
					'public' => true, 
					'show_ui' => true,
					'show_in_nav_menus' => true,
					'rewrite' => true,
					'hierarchical' => true,
					'menu_position' => 5,
					'supports' => array(
										 'title',
										 'editor',
										 'thumbnail',
										 'excerpt',
										 'custom-fields',
										 'revisions')
						) 
					);
		register_taxonomy('display-category', 'display', array('hierarchical' => true, 'label' => __('Display Categories'), 'singular_name' => 'Category'));
	}
	
	function ts_display_settings(){
	// this is where we will display our admin options  
		$options['ts_display_widthimg'] 	= get_option('ts_display_widthimg');
		$options['ts_display_heightimg'] 	= get_option('ts_display_heightimg');
		$options['ts_display_contentwidth']	= get_option('ts_display_contentwidth');
		$options['ts_display_colspacing'] 	= get_option('ts_display_colspacing');
		$options['ts_display_rowspacing'] 	= get_option('ts_display_rowspacing');
		$messagetext = "";
		if ($_POST["action"] == "update"){
			$options['ts_display_widthimg'] = $_POST["ts_display_widthimg"];
			$options['ts_display_heightimg'] = $_POST["ts_display_heightimg"];
			$options['ts_display_contentwidth'] = $_POST["ts_display_contentwidth"];
			$options['ts_display_colspacing'] = $_POST["ts_display_colspacing"];
			$options['ts_display_rowspacing'] = $_POST["ts_display_rowspacing"];
			if(!is_numeric($_POST["ts_display_widthimg"])){
				$messagetext = "Please input image width with integer!";
			}elseif(!is_numeric($_POST["ts_display_heightimg"])){
				$messagetext = "Please input image height with integer!";
			}elseif(!is_numeric($_POST["ts_display_contentwidth"])){
				$messagetext = "Please input container width with integer!";
			}elseif(!is_numeric($_POST["ts_display_colspacing"])){
				$messagetext = "Please input column spacing with integer!";
			}elseif(!is_numeric($_POST["ts_display_rowspacing"])){
				$messagetext = "Please input row spacing with integer!";
			}else{
				update_option("ts_display_widthimg",$_POST['ts_display_widthimg']);
				update_option("ts_display_heightimg",$_POST['ts_display_heightimg']);
				update_option("ts_display_contentwidth",$_POST['ts_display_contentwidth']);
				update_option("ts_display_colspacing",$_POST['ts_display_colspacing']);
				update_option("ts_display_rowspacing",$_POST['ts_display_rowspacing']);
				$messagetext = "Options Saved";
			}
			$message = '<div id="message" class="updated fade"><p><strong>'.$messagetext.'</strong></p></div>';  
		}  
		
		$text = "";
		if($options["ts_displaytext"]) $text = $checkstr;
		
		 echo '  
		 <div class="wrap">  
			 '.$message.'  
			 <div id="icon-options-general" class="icon32"><br /></div>  
			 <h2>TS Display Settings</h2>  
	   
			 <form method="post" action="">  
			 <input type="hidden" name="action" value="update" />  
	   
			 <h3>'.__("Display Dimensions",$this->langval).'</h3>
			 <p>'.__("You can set default value and set the width and height for featured image in here.",$this->langval).'</p>
			 <table class="form-table" summary="'.__('Display Dimensions',$this->langval).'">
				<tr valign="top">
					<th scope="row"><label for="ts_display_widthimg">'. __( 'Image Width',$this->langval).'</label></th>
					<td>
						<fieldset>
							<legend class="hidden">'.__('Image Width',$this->langval).'</legend>
							<input name="ts_display_widthimg" type="text" id="ts_display_widthimg" value="'.$options['ts_display_widthimg'].'"/>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="ts_display_heightimg">'. __( 'Image Height',$this->langval).'</label></th>
					<td>
						<fieldset>
							<legend class="hidden">'.__('Image Height',$this->langval).'</legend>
							<input name="ts_display_heightimg" type="text" id="ts_display_heightimg" value="'.$options['ts_display_heightimg'].'"/>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="ts_display_contentwidth">'. __( 'Container Width',$this->langval).'</label></th>
					<td>
						<fieldset>
							<legend class="hidden">'.__('Container Width',$this->langval).'</legend>
							<input name="ts_display_contentwidth" type="text" id="ts_display_contentwidth" value="'.$options['ts_display_contentwidth'].'"/>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="ts_display_colspacing">'. __( 'Column Spacing',$this->langval).'</label></th>
					<td>
						<fieldset>
							<legend class="hidden">'.__('Column Spacing',$this->langval).'</legend>
							<input name="ts_display_colspacing" type="text" id="ts_display_colspacing" value="'.$options['ts_display_colspacing'].'"/>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="ts_display_rowspacing">'. __( 'Row Spacing',$this->langval).'</label></th>
					<td>
						<fieldset>
							<legend class="hidden">'.__('Row Spacing',$this->langval).'</legend>
							<input name="ts_display_rowspacing" type="text" id="ts_display_rowspacing" value="'.$options['ts_display_rowspacing'].'"/>
						</fieldset>
					</td>
				</tr>
			</table>
			 <br />  
			 <input type="submit" class="button-primary" value="Save Changes" />  
			 </form>
		 </div>';  
	}
	
	function ts_display_activation(){
		add_option("ts_display_widthimg",290,"","yes");
		add_option("ts_display_heightimg",180,"","yes");
		add_option("ts_display_contentwidth",940,"","yes");
		add_option("ts_display_colspacing",35,"","yes");
		add_option("ts_display_rowspacing",60,"","yes");
	}
	
	function ts_display_deactivation(){
		delete_option("ts_display_widthimg");
		delete_option("ts_display_heightimg");
		delete_option("ts_display_contentwidth");
		delete_option("ts_display_colspacing");
		delete_option("ts_display_rowspacing");
	}
	
	function ts_display_admin_menu(){  
		 // this is where we add our plugin to the admin menu  
		 add_options_page(__("TS Display",$this->langval),__("TS Display",$this->langval), 9, basename(__FILE__), array($this, "ts_display_settings"));  
	}
	
	function ts_display_action_init(){
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit posts and pages
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter('mce_buttons', array($this, 'ts_display_filter_mce_button'));
			add_filter('mce_external_plugins',array($this, 'ts_display_filter_mce_plugin'));
		}
		
		//Register jQuery and Pretty Photo plugin and use it
		wp_enqueue_script('jquery', plugin_dir_url( __FILE__ ).'js/jquery-1.4.2.min.js', false, '1.4.2');
		wp_enqueue_script("prettyphoto", plugin_dir_url( __FILE__ ).'js/jquery.prettyPhoto.js', array('jquery'), "3.0");
		wp_enqueue_script("fade",plugin_dir_url( __FILE__ ).'js/fade.js', array('jquery'));
		wp_enqueue_script("cornerz",plugin_dir_url( __FILE__ ).'js/cornerz.js', array('jquery'));
		wp_enqueue_script("lightbox-ts",plugin_dir_url( __FILE__ ).'js/lighbox.js', array('jquery'));
		
		//Register and use this plugin main CSS
		wp_register_style('ts-display-main', plugin_dir_url( __FILE__ ).'css/ts-display.css', array(), $version . time());
		wp_register_style('ts-display-prettyPhoto', plugin_dir_url( __FILE__ ).'css/prettyPhoto.css', array(), "2.5.6");
		wp_enqueue_style('ts-display-main');
		wp_enqueue_style('ts-display-prettyPhoto');
	}
	
	function ts_display_filter_mce_button( $buttons ) {
		// add a separation before our button, here our button's id is "mygallery_button"
		array_push( $buttons, '|', 'ts_display_button' );
		return $buttons;
	}
	
	function ts_display_filter_mce_plugin( $plugins ) {
		// this plugin file will work the magic of our button
		$plugins['ts_display'] = plugin_dir_url( __FILE__ ) . 'js/ts-display-plugin.js';
		return $plugins;
	}
	
}
$ts_display = new TS_Display();
?>