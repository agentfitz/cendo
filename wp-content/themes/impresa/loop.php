<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Impresa
 * @since Impresa 1.0
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
<div class="box-type2">
<div class="main-box">
	<div class="box-text">
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'templatesquare' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'templatesquare' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
	</div><!-- .boxt-text -->
</div><!-- .main-box -->
</div><!-- .box-type2 -->
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display all posts. */ ?>
		<div class="box-type2">
		<div class="main-box">
		
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="box-title-post">
				<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'templatesquare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<span class="cb"></span>
				</div>
				
				<div class="box-text">
				<?php if(!is_search()){?>
					<div class="entry-utility">
						<?php  the_time('F j, Y') ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php comments_popup_link(__('No Comments', 'templatesquare'), __('1 Comments', 'templatesquare'), __('% Comments', 'templatesquare')); ?>&nbsp;&nbsp;|&nbsp;&nbsp;by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"> <?php the_author();?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php the_category(', ') ?>
					</div>
				<?php } ?>
	
		<?php if (is_search() ) : // Only display excerpts for archives and search. ?>
				<div class="entry-summary">
					<?php $excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,25).'...';?>
				</div><!-- .entry-summary -->
		<?php else : ?>
	
				<div class="entry-content">
					<?php the_content( __( 'Read More', 'templatesquare' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'templatesquare' ), 'after' => '</div>' ) ); ?>
					<div class="clear"></div><!-- end clear float -->
				</div><!-- .entry-content -->
		<?php endif; ?>
	
					<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .boxt-text -->
			</div><!-- #post-## -->
			
		</div><!-- .main-box -->
		</div><!-- .box-type2 -->

		<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>


<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<div id="navigation-bottom">
	 <?php if(function_exists('wp_pagenavi')) { ?>
		 <?php wp_pagenavi(); ?>
	 <?php }else{ ?>
		<div id="nav-below" class="navigation">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older', 'templatesquare' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&raquo;</span>', 'templatesquare' ) ); ?></div>
		</div><!-- #nav-below -->
	<?php }?>
</div>
<?php endif; ?>

