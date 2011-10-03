<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Impresa
 * @since Impresa 1.0
 */

get_header(); ?>

<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
yoast_breadcrumb('<div id="con-breadcrumbs"><div id="breadcrumbs">','</div></div>');
} ?>
				
<div id="main">
	<div id="content" class="fullwidth">
	
		<div class="box-type2">
			<div class="main-box">
			<div class="box-text">
			<div id="post-0" class="error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', 'templatesquare' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'templatesquare' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->
			</div><!-- .boxt-text -->
			</div><!-- .main-box -->
		</div><!-- .box-type2 -->

	</div><!-- #content -->
</div><!-- #main -->
		
<script type="text/javascript">
	// focus on search field after it has loaded
	document.getElementById('s') && document.getElementById('s').focus();
</script>

<?php get_footer(); ?>