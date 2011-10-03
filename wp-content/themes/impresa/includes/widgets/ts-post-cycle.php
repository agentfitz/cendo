<?php
// =============================== TS Post Cycle widget ======================================
class TS_PostCycleWidget extends WP_Widget {
    /** constructor */
	function TS_PostCycleWidget() {
		$widget_ops = array('classname' => 'widget_ts_post_cycle', 'description' => __('TS - Post Cycle','templatesquare') );
		$this->WP_Widget('ts-post-cycle', __('TS - Post Cycle','templatesquare'), $widget_ops);
	}


    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$limit = apply_filters('widget_title', $instance['limit']);
		$cat = apply_filters('widget_title', $instance['cat']);
		$posttype = apply_filters('widget_posttype', $instance['posttype']);
		$effect = apply_filters('widget_effect', $instance['effect']);
		
		if($effect=="fade"){
		$boxslideshow="boxslideshow";
		}else{
		$boxslideshow="boxslideshow2";
		}
        ?>
		

              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						
						

						<div class="cycle_widget">
						
						<div class="pager_cycle"></div><!-- navigation cycle -->
						
						<?php if($posttype=="testimonial"){?>
							<div class="<?php echo $boxslideshow; ?>">
								
								<?php $limittext = $limit;?>
								<?php global $more;	$more = 0;?>
								<?php query_posts("post_type=" . $posttype);?>
								
								<?php while (have_posts()) : the_post(); ?>	
								
									<?php 
									$custom = get_post_custom($post->ID);
									$testiname = $custom["testimonial-name"][0];
									$testicompany = $custom["testimonial-company"][0];
									$testipic = $custom["testimonial-pic"][0];
									?>
								
								<div class="cycle">

								<?php if($limittext=="" || $limittext==0){ ?>
									<?php if($testipic !=""){?>
										<img src="<?php echo $testipic;?>" alt="" class="alignleft"/>
									<?php } ?>
									<blockquote class="quote">
									<?php the_excerpt(); ?>
									 </blockquote>
									 <?php if($testiname !="" || $testicompany !=""){?>
									 <br />
									 <div class="name-testi">
									 <span class="colortext"><?php echo $testiname; ?> - <?php echo $testicompany; ?></span>
									 </div>
									 <?php }?>
								<?php }else{ ?>
									<?php if($testipic !=""){?>
										<img src="<?php echo $testipic;?>" alt="" class="alignleft"/>
									<?php } ?>
									<blockquote class="quote">
									<?php $excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,$limittext).'... ';?>
									 </blockquote>
									 <?php if($testiname !="" || $testicompany !=""){?>
									 <br />
									 <div class="name-testi">
									 <span class="colortext"><?php echo $testiname; ?> - <?php echo $testicompany; ?></span>
									 </div>
									 <?php }?>
								<?php } ?>
								</div>
								<?php endwhile; ?>
								<?php wp_reset_query();?>
							</div>
							<!-- end of boxslideshow -->
						
						<?php } else { ?>
						
							<div class="<?php echo $boxslideshow; ?>">
								<?php $limittext = $limit;?>
								<?php global $more;	$more = 0;?>
							
								<?php if($posttype=="portfolio") { ?>
								<?php query_posts('&portfoliocat='.$cat .'&showposts=-1');?>
								<?php } else { ?>
								<?php query_posts("category_name=" . $cat);?>
								<?php }?>
								
								<?php while (have_posts()) : the_post(); ?>	
								<?php
									$custom = get_post_custom($post->ID);
									$cf_thumb = $custom["thumb-cycle"][0];
									if($cf_thumb!=""){
										$cf_thumb = "<img src='" . $cf_thumb . "' alt=''  width='215' height='120' />";
									}
								?>	
								<div class="cycle">
								<?php if($cf_thumb!=""){ echo $cf_thumb; } ?>
								<span class="wdt-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></span>
									<?php if($limittext=="" || $limittext==0){
									the_excerpt();
									}else{
									$excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,$limittext).'... ';
									?>
									<?php } ?>
								</div>
								<?php endwhile; ?>
								<?php wp_reset_query();?>
							</div>
							<!-- end of boxslideshow -->
							
							<?php }?>
					</div>
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
		$limit = esc_attr($instance['limit']);
		$cat = esc_attr($instance['cat']);
		$posttype = esc_attr($instance['posttype']);
		$effect = esc_attr($instance['effect']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'templatesquare'); ?> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
 <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit Text:', 'templatesquare'); ?> 
 <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
 			
            <p><label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e('Post Type:', 'templatesquare'); ?><br />

		<select id="<?php echo $this->get_field_id('posttype'); ?>" name="<?php echo $this->get_field_name('posttype'); ?>" style="width:150px;" > 
		<option value="testimonial" <?php echo ($posttype === 'testimonial' ? ' selected="selected"' : ''); ?>>Testimonials</option>
		<option value="portfolio" <?php echo ($posttype === 'portfolio' ? ' selected="selected"' : ''); ?> >Portfolio</option>
		<option value="" <?php echo ($posttype === '' ? ' selected="selected"' : ''); ?>>Default</option>
		</select>
			</label></p>
			
 <p><label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Category:', 'templatesquare'); ?> 
 <input class="widefat" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $cat; ?>" /></label></p>
 
  <p><label for="<?php echo $this->get_field_id('effect'); ?>"><?php _e('Effect:', 'templatesquare'); ?> <br />
 		<select id="<?php echo $this->get_field_id('effect'); ?>" name="<?php echo $this->get_field_name('effect'); ?>" style="width:150px;" > 
		<option value="fade" <?php echo ($effect === 'fade' ? ' selected="selected"' : ''); ?>>Fade</option>
		<option value="scroll" <?php echo ($effect === 'scroll' ? ' selected="selected"' : ''); ?> >Scroll</option>
		</select>

 </label></p>
			
        <?php 
    }

} // class Cycle Widget


?>