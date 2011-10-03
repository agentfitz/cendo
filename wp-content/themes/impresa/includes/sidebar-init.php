<?php
function impresa_widgets_init() {
	register_sidebar( array(
		'name' 			=> __( 'Post Sidebar', 'templatesquare' ),
		'id' 			=> 'post-sidebar',
		'description' 	=> __( 'Located at the right side of archives, single and search.', 'templatesquare' ),
		'before_widget' => '<ul><li id="%1$s" class="widget-container %2$s"><div class="side-box">',
		'after_widget' 	=> '</div></li></ul>',
		'before_title' 	=> '<div class="box-title"><h2 class="widget-title">',
		'after_title' 	=> '</h2><span class="cb"></span></div>',
	));
	
	register_sidebar(array(
		'name'          => __('Page Sidebar', 'templatesquare' ),
		'id'         	=> 'page-sidebar',
		'description'   => __( 'Located at the right side of page templates.', 'templatesquare' ),
		'before_widget' => '<ul><li id="%1$s" class="widget-container %2$s"><div class="side-box">',
		'after_widget' 	=> '</div></li></ul>',
		'before_title' 	=> '<div class="box-title"><h2 class="widget-title">',
		'after_title' 	=> '</h2><span class="cb"></span></div>',
	));
	
	
	register_sidebar(array(
		'name'          => __('Before Content', 'templatesquare' ),
		'id'         	=> 'before-content',
		'description'   => __( 'Located at the before content of page templates.', 'templatesquare' ),
		'before_widget' => '<div class="box-type2"><div class="main-box"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '</li></ul></div></div>',
		'before_title' 	=> '<div class="box-title"><h2 class="widget-title">',
		'after_title' 	=> '</h2><span class="cb"></span></div>',
	));
	
	register_sidebar(array(
		'name'          => __('After Content', 'templatesquare' ),
		'id'         	=> 'after-content',
		'description'   => __( 'Located at the after content of page templates.', 'templatesquare' ),
		'before_widget' => '<div class="box-type2"><div class="main-box"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '</li></ul></div></div>',
		'before_title' 	=> '<div class="box-title"><h2 class="widget-title">',
		'after_title' 	=> '</h2><span class="cb"></span></div>',
	));
	
}
/** Register sidebars by running impresa_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'impresa_widgets_init' );
?>