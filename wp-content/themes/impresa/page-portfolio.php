<?php
/**
 * Template Name: Portfolio
 *
 * A custom page template for portfolio page.
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
				 
				<?php the_content( __( 'Read More', 'templatesquare' ) ); ?>
				
				<?php 
				global $wp_query;
				global $more;	$more = 0;
				$postid = $wp_query->post->ID;
				$cat=get_post_meta($postid, 'category-include', true);
				?>
				<?php $catinclude = 'portfoliocat='.$cat;?>
				<?php query_posts('&' . $catinclude .' &paged='.$paged.'&showposts=4'); ?>
				
				<div id="gallery-pf">
					<ul id="pf-one-col">
					<?php 
					if ( have_posts() ) while ( have_posts() ) : the_post(); 
					?>
					
					
					<?php
						$custom = get_post_custom($post->ID);
						$cf_thumb = $custom["thumb"][0];
						$cf_lightbox = $custom["lightbox"][0];
						
						if($cf_thumb!=""){
							$cf_thumb = "<img src='" . $cf_thumb . "' alt=''  width='280' height='150' class='fade alignleft'/>";
						}
					?>
					
						<li>
						<div class="pf-glow">
						<?php if($cf_lightbox!=""){ ?>
						<a class="image" href="<?php echo $cf_lightbox;?>" rel="prettyPhoto[mixed]" title="<?php the_title();?>"><?php if($cf_thumb!=""){ echo $cf_thumb; }else{ the_post_thumbnail( 'portfolio-post-thumbnail', array('class' => 'fade alignleft') );} ?></a>
					<?php }else{ ?>
						<a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link to', 'templatesquare');?> <?php the_title_attribute(); ?>" ><?php if($cf_thumb!=""){ echo $cf_thumb; }else{ the_post_thumbnail( 'portfolio-post-thumbnail', array('class' => 'fade alignleft') );} ?></a>
						<?php } ?>
						</div>
						<div class="pf-text">
						<h3><?php the_title(); ?></h3>
						<?php $excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,20);?>
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'templatesquare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="more-link"><?php _e('Read more', 'templatesquare');?></a>
						</div>
						<div class="clear"></div>
						</li>
					
				
					<?php endwhile; ?>
					</ul>
					<div class="clear"></div>
				</div>
				
				
				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
			
					 <?php if(function_exists('wp_pagenavi')) { ?>
						 <?php wp_pagenavi(); ?>
					 <?php }else{ ?>
				<div id="nav-below" class="navigation nav2">
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
