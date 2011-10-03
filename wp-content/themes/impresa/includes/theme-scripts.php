<?php
function my_script() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_bloginfo('template_url').'/js/jquery-1.4.2.min.js', false, '1.4.2');
		wp_enqueue_script('jquery');
		wp_enqueue_script('prettyphoto', get_bloginfo('template_url').'/js/jquery.prettyPhoto.js', array('jquery'), '2.5.6');
		wp_enqueue_script('cufon-yui', get_bloginfo('template_url').'/js/cufon-yui.js', array('jquery'), '1.0.9');
		wp_enqueue_script('tuffy', get_bloginfo('template_url').'/js/Tuffy_500-Tuffy_700-Tuffy_italic_500.font.js', array('jquery'));
		wp_enqueue_script('cycle', get_bloginfo('template_url').'/js/jquery.cycle.all.min.js', array('jquery'));
		wp_enqueue_script('nivo-slider', get_bloginfo('template_url').'/js/jquery.nivo.slider.pack.js', array('jquery'), '2.1');
		wp_enqueue_script('fade', get_bloginfo('template_url').'/js/fade.js', array('jquery'));
		wp_enqueue_script('dropdownmenu', get_bloginfo('template_url').'/js/dropdown.js', array('jquery'));

	}
}
add_action('init', 'my_script');
?>