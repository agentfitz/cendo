<?php
/**
 * Template Name: News
 *
 * A custom page template for news page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
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
				<div class="box-text">
					<?php
					  global $wp_query;
					  $postid = $wp_query->post->ID;
					  $values = get_post_meta($postid, 'category-include', true);
					  $strinclude = $values;
					  query_posts('&category_name=' . $strinclude .' &paged='.$paged. '&showposts=5');
					?>
							
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					
					<?php
						$custom = get_post_custom($post->ID);
						$cf_thumb = $custom["thumb"][0];
						
						if($cf_thumb!=""){
							$cf_thumb = "<img src='" . $cf_thumb . "' alt='' width='72' height='72' />";
						}
					?>
						
					<div class="box-news">
						<?php if($cf_thumb!=""){ echo $cf_thumb; }else{ the_post_thumbnail( );} ?>
						<div class="news-txt">
						<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'templatesquare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<span class="postdate"><?php  the_time('l, F j, Y') ?></span>
						<p><?php $excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,20).'... ';?></p>
						</div> 
					</div><!-- end box-news-->
					<?php endwhile; ?>
					
					<div class="clear"></div>
					
					<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				
					<?php if(function_exists('wp_pagenavi')) { ?>
							 <?php wp_pagenavi(); ?>
					<?php }else{ ?>
							<div id="nav-below" class="navigation">
								<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Prev', 'templatesquare' ) ); ?></div>
								<div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&raquo;</span>', 'templatesquare' ) ); ?></div>
							</div><!-- #nav-below -->
					<?php }?>
					<?php endif; ?>
					
					<?php wp_reset_query();?>
					
				</div><!-- .boxt-text -->
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
