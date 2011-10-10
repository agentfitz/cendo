<?php
/*
Plugin Name: Contact Widget
Plugin URI: http://vedamedia.com
Version: 1.0
Description: This is a widget which contains contact info for Carolina Endocrine
Author: Brian FitzGerald
Author URI: http://vedamedia.com
*/
 
class Contact_Widget extends WP_Widget
{
  function Contact_Widget()
  {
    $widget_ops = array('classname' => 'Contact_Widget', 'description' => 'Carolina Endocrine Contact Widget');
    $this->WP_Widget('Contact_Widget', 'Contact Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array( 'title' => '' ));
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      // echo $before_title . $title . $after_title;;
 
    // Do Your Widgety Stuff Here...
    echo 
		"			
			<a href='/?page_id=164'><img id='contactThumb' src='/wp-content/themes/impresa/images/contactThumb.jpg' width='256' height='125' /></a>
			<h5>2605 Blue Ridge Rd., Ste. 190</h5>
			<h5>Raleigh NC 27607</h5>
			<h5>919-571-3661, Phone</h5>
			<h5>919-571-3290, Fax</h5>
						
		";
 
    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("Contact_Widget");') );
 
?>