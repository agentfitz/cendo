<?php
/*
Plugin Name: Providers Widget
Plugin URI: http://vedamedia.com
Version: 1.0
Description: This is a widget which contains provider info for Carolina Endocrine
Author: Brian FitzGerald
Author URI: http://vedamedia.com
*/
 
class Providers_Widget extends WP_Widget
{
  function Providers_Widget()
  {
    $widget_ops = array('classname' => 'Providers_Widget', 'description' => 'Carolina Endocrine Providers Widget');
    $this->WP_Widget('Providers_Widget', 'Providers Widget', $widget_ops);
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
      echo $before_title . $title . $after_title;
 
    // Do Your Widgety Stuff Here...
		echo "<div id='providersSidebarContainer'>";
		
		$posts = get_posts( 'post_type=providers&order=asc&numberposts=' . sizeof($posts) );
		// print_r($posts);
		for($i = 0; $i < sizeof($posts); $i++){
		 $thisPost = $posts[$i];
		 $providerUrl = "/?page_id=212#" . $thisPost->ID;
		 
		 $thumbId = get_post_thumbnail_id($thisPost->ID);
		 $imgArr = wp_get_attachment_image_src($thumbId, 'single-post-thumbnail');
		 $imgSrc = $imgArr[0];
		 
		 echo "<div class='providerSideBlock'><a href='" . $providerUrl . "'><img src='" . $imgSrc . "' width='110' height='81' /></a>";
		 echo "<h5><a href='" . $providerUrl . "'>" . $thisPost->post_title . '</a></h5>';
		 echo "<p>" . $thisPost->post_excerpt . " <a href='" . $providerUrl . "'>read more</a></p></div></a>";
		 
		}
		
    echo "</div>";
 
    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("Providers_Widget");') );
 
?>