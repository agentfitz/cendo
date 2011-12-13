<?php
/**
 * The Header for our theme.
 *
 *
 * @package WordPress
 * @subpackage Impresa
 * @since Impresa 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'templatesquare' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link href="<?php bloginfo('template_url'); ?>/prettyPhoto.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_url'); ?>/nivo-slider.css" rel="stylesheet" type="text/css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php 
$favicon = get_option('templatesquare_favicon');
if($favicon =="" ){
?>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
<?php }else{?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php }?>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<!-- ////////////////////////////////// -->
<!-- //      Javascript Files        // -->
<!-- ////////////////////////////////// -->
<script type="text/javascript">
	 Cufon.replace('h1')('h1 a') ('h2') ('h3') ('h4') ('h5') ('h6') ('#topnavigation li', { hover: true});
</script>
<?php 
	$effect = get_option('templatesquare_slider_effect');
	$slices = get_option('templatesquare_slider_slices');
	$speed = get_option('templatesquare_slider_speed');
	$timeout = get_option('templatesquare_slider_timeout');
 ?>
<script type="text/javascript">
   jQuery(document).ready(function($) {     
		
         $('.boxslideshow').cycle({
            timeout: 5000,  // milliseconds between slide transitions (0 to disable auto advance)
            fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
            pause:   0,	  // true to enable "pause on hover"
						pager:   '.pager_cycle',  // selector for element to use as pager container
						cleartypeNoBg:true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
            pauseOnPagerHover: 1 // true to pause when hovering over pager link
        });
		
         $('.boxslideshow2').cycle({
            timeout: 5000,  // milliseconds between slide transitions (0 to disable auto advance)
            fx:      'scrollVert', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
            pause:   0,	  // true to enable "pause on hover"
						pager:   '.pager_cycle',  // selector for element to use as pager container
						cleartypeNoBg:true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
            pauseOnPagerHover: 1 // true to pause when hovering over pager link
        });
		
		/* for portfolio prettyPhoto */
		$("#gallery-pf a[rel^='prettyPhoto']").prettyPhoto({theme:'dark_rounded'});
		
		
     });
	 
	$(window).load(function() {
		$('#slider').nivoSlider({
			effect:'<?php echo $effect; ?>', //Specify sets like: 'fold,fade,sliceDown'
			slices:<?php echo $slices; ?>,
			animSpeed:<?php echo $speed; ?>, //Slide transition speed
			pauseTime:<?php echo $timeout; ?>,
			directionNav:false, //Next &amp; Prev
			startSlide:0, //Set starting Slide (0 index)
			afterChange: updateSliderTitles
		});
		
		function updateSliderTitles(){
			Cufon.replace('span.sliderTitle');
			Cufon.refresh();
		}
		updateSliderTitles();
		
	});
	 
</script>
<!--[if lt IE 8]>
<script type="text/JavaScript" src="<?php bloginfo('template_url'); ?>/js/DD_belatedPNG.js"></script>
<![endif]-->
</head>

<body <?php if(!is_front_page()){echo 'class="body-page"';}?>>
	<div id="wrapper">
		<div id="container">
			<div id="top">
			<?php
				$logotype = get_option('templatesquare_logo_type');
				$logoimage = get_option('templatesquare_logo_image'); 
				$sitename = get_option('templatesquare_site_name');
				if($logoimage == ""){ $logoimage = get_bloginfo('template_url') . "/images/logo.png"; }
			?>
			<?php if($logotype == 'textlogo'){ ?>
			<div id="logo">
				<div id="logo-text">
					<?php if($sitename==""){?>
						<h1><a href="<?php echo get_option('home'); ?>/" title="<?php _e('Click for Home','templatesquare'); ?>"><?php bloginfo('name'); ?></a></h1>
					<?php }else{ ?>
						<h1><a href="<?php echo get_option('home'); ?>/" title="<?php _e('Click for Home','templatesquare'); ?>"><?php echo $sitename; ?></a></h1>
					<?php }?>
				</div>
			</div><!-- end #logo -->
			<?php } else { ?>
				<div id="logo">
					<div id="logo-img">
						<a href="<?php echo home_url( '/' ); ?>" title="<?php _e('Click for Home','templatesquare'); ?>"><img src="<?php echo $logoimage;?>" alt=""  /></a>
					</div>
				</div><!-- #logo -->
				<?php }?>
				<div id="topnavigation">
				<?php wp_nav_menu( array(
					  'container'       => 'ul', 
					  'menu_class'      => 'menu', 
					  'menu_id'         => 'topnav',
					  'depth'           => 0,
					  'sort_column'    => 'menu_order',
					  'theme_location' => 'mainmenu' 
					  )); 
				?>
				</div><!-- #topnavigation -->
			</div><!-- #top -->
			
			<?php 
			if(is_front_page()){
				include_once(TEMPLATEPATH .'/slider.php');
			}
			?>