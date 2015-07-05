<?php
// =============================== TS Recent Posts widget ======================================
class TS_RecentPostWidget extends WP_Widget {
    /** constructor */

	function TS_RecentPostWidget() {
		$widget_ops = array('classname' => 'widget_ts_recent_posts', 'description' => __('TS - Recent Posts','templatesquare') );
		$this->WP_Widget('ts-recent-posts', __('TS - Recent Posts','templatesquare'), $widget_ops);
	}


  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('TS Recent Posts','templatesquare') : $instance['title']);
		$category = apply_filters('widget_category', $instance['category']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						
								<?php  if (have_posts()) : ?>
								<ul class="latestpost">
								<?php $querycat = $category;?>
								<?php query_posts("showposts=3&category_name=" . $querycat);?>
								<?php while (have_posts()) : the_post(); ?>	
								<li>
								<span class="datebox"><span class="datetime"><?php  the_time('d') ?></span><?php  the_time('M') ?></span>
								<span class="wd-title"><?php the_title();?></span><br />
								<a href="<?php the_permalink() ?>" class="more" rel="bookmark" title="<?php _e('Permanent Link to', 'templatesquare');?> <?php the_title_attribute(); ?>"><?php _e('L&auml;s mer &raquo;', 'templatesquare');?></a>
								</li>
								<?php endwhile; ?>
								</ul>
								<?php 
								$category_id = get_cat_ID($category);
								$category_link = get_category_link( $category_id );
								?>
								<a href="<?php echo $category_link; ?>" class="button"><?php _e('Fler '.$category.' ', 'templatesquare');?></a>
								<?php endif; ?>
								<div class="clear"></div><!-- clear float -->

								<?php wp_reset_query();?>
								
              <?php echo $after_widget; ?>
			 
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$category = esc_attr($instance['category']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'templatesquare'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
            <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'templatesquare'); ?> <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo $category; ?>" /></label></p>
        <?php 
    }

} // class  Widget
?>