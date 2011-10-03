<?php
// =============================== TS Text widget ======================================
class TS_TextWidget extends WP_Widget {
    /** constructor */

	function TS_TextWidget() {
		$widget_ops = array('classname' => 'widget_ts_text', 'description' => __('TS - Text','templatesquare') );
		$this->WP_Widget('ts-text', __('TS - Text','templatesquare'), $widget_ops);
	}


  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$text = apply_filters('widget_text', $instance['text']);
        ?>
                  
						
				<div class="box-type1">
					<div class="main-box">
					 <?php if ( $title )
					 echo $before_title . $title . $after_title; ?>
					<div class="box-text">
						<?php echo $text;?>
					</div>
					</div><!-- .main-box -->
				</div><!-- .box-type1 -->
				
								
			 
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$text = esc_attr($instance['text']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'templatesquare'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
            <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'templatesquare'); ?><textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="10"><?php echo $text; ?></textarea>			</label></p>
        <?php 
    }

} // class  Widget
?>