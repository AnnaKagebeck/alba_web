				<div id="header">
				
				<ul id="slider">
					<?php
						query_posts("post_type=slider&post_status=publish&posts_per_page=-1&order=ASC");
						while ( have_posts() ) : the_post();
					?>
					<?php
						$custom = get_post_custom($post->ID);
						$cf_slideurl = $custom["slider-url"][0];
						$cf_thumb = $custom["thumb"][0];
					?>	
					<li>
				
					<div class="header-left">
						<div class="slider-image">
							<?php if(has_post_thumbnail( $the_ID) || $cf_thumb!=""){ ?>		
								<?php 
									if($cf_thumb!=""){
										echo "<img src='" . $cf_thumb . "' alt=''  width='616' height='356' />";
									}else{
										the_post_thumbnail( 'slider-post-thumbnail' );
									}
								?>
							<?php } ?>
						</div>
						
					
					</div><!-- end #header-left -->
					<div class="header-right">
						<?php 
							$arr = explode(" ",get_the_title());
							$titletext = "";
							for($i=0;$i<count($arr);$i++){
								$titletext .= ($i==0)? $arr[$i] : " <span class='titlecolor'>".$arr[$i]."</span>";
							}
						?>
						<h1><?php echo $titletext;?></h1>
						<div class="slider-text"><?php the_excerpt();?></div>
						<?php if($cf_slideurl!=""){?><a href="<?php echo $cf_slideurl ;?>" class="button"><?php _e('Read More','templatesquare');?></a><?php } ?>
					</div><!-- end #header-right -->
					
					</li>
					<?php endwhile; ?>
					<?php wp_reset_query();?>
				</ul>
				
				<div id="slider-navigation">
					<div id="pager"></div>
					<a href="#" id="prev-slider"></a>
					<a href="#" id="next-slider"></a>
				</div>
				
				</div><!-- end #header -->



