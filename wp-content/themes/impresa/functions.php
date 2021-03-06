<?php

if ( function_exists( 'wp_nav_menu' ) ) {
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '';
           $append = '';
           $description  = ! empty( $item->description ) ? '<span class="descmenu">'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}
}


$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';

//Redirect admin to theme option upon activated
require_once $functions_path . 'admin-setup.php';

//Theme Options
require_once $functions_path . 'admin-options.php';

//Theme init
require_once $includes_path . 'theme-init.php';

//Widget and Sidebar
require_once $includes_path . 'sidebar-init.php';

require_once $includes_path . 'register-widgets.php';

//Additional function
require_once $includes_path . 'theme-function.php';

//Additional function
require_once $includes_path . 'shortcode.php';

//Loading jQuery
require_once $includes_path . 'theme-scripts.php';


/* -- Fitz -- this block of codes stops WordPress from randomly adding br tags for no reason
Plugin Name: Better wpautop 
Plugin URI: http://www.simonbattersby.com/blog/plugin-to-stop-wordpress-adding-br-tags/
Description: Amend the wpautop filter to stop wordpress doing its own thing
Version: 1.0
Author: Simon Battersby
Author URI: http://www.simonbattersby.com
*/

function better_wpautop($pee){
	return wpautop($pee, $br=0);
}

remove_filter('the_content','wpautop');
add_filter('the_content','better_wpautop');




function impresa_init() {
	add_filter('comment_form_defaults','impresa_comments_form_defaults');
}
add_action('after_setup_theme','impresa_init');

function impresa_comments_form_defaults($default) {
	unset($default['comment_notes_after']);
	return $default;
}




?>