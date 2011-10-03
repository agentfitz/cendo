<?php
/**
 * Template Name: Providers Page
 *
 * Selectable from a dropdown menu on the edit page screen.
*/

get_header(); ?>

				
<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
yoast_breadcrumb('<div id="con-breadcrumbs"><div id="breadcrumbs">','</div></div>');
} ?>

<div id="main">
	<div id="content">
	

	
		<?php 
		if ( is_active_sidebar('before-content') ) {
		get_sidebar('before-content');
		}
		?>
				
		<div class="box-type2">
		<div class="main-box">	
		
		

		
	
				<?php
				 include_once (TEMPLATEPATH . '/title.php');
				?>
				
				<div id="providersIntro">
				<?php				 				
				 $page_data = get_page($page_id = 212);
				 $content = apply_filters('the_content', $page_data -> post_content); // Get Content and retain Wordpress filters such as paragraph tags. Origin from: http://wordpress.org/support/topic/get_pagepost-and-no-paragraphs-problem
				 $title = $page_data->post_title; // Get title
				 echo $content; // Output Content				 
				?>
				</div>
				
				<?php query_posts( 'post_type=providers&order=asc'); ?>
				 
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="box-text">
				
				
						
		
				
				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_post_thumbnail(); ?>
						<h2><?php the_title(); ?></h2>
						<?php the_content( __( 'Continue Reading', 'templatesquare' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'templatesquare' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
				</div><!-- .boxt-text -->
				<?php comments_template( '', true ); ?>

				<?php endwhile; ?>
				
		</div><!-- .main-box -->
		</div><!-- .box-type2 -->
		
		<?php 
		if ( is_active_sidebar('after-content') ) {
		get_sidebar('after-content');
		}
		?>
		
	</div><!-- #content -->
	<div id="sideright">
		<?php get_sidebar('page');?>
	</div><!-- #sideright -->
	<div class="clear"></div>
</div>
<!-- #main -->
<?php get_footer(); ?>
