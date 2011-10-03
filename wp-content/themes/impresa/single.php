<?php
/**
 * The Template for displaying all single posts.
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
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
		<div class="box-type2">
			<div class="main-box">

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="box-title-post">
						<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'templatesquare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<span class="cb"></span>
					</div>
					
					<div class="box-text">
					<div class="entry-utility">
						<?php  the_time('F j, Y') ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php comments_popup_link(__('No Comments', 'templatesquare'), __('1 Comments', 'templatesquare'), __('% Comments', 'templatesquare')); ?>&nbsp;&nbsp;|&nbsp;&nbsp;by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"> <?php the_author();?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php the_category(', ') ?>
					</div>


					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'templatesquare' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					
					
					<div class="entry-utility">
						<?php ts_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
					
					</div><!-- .boxt-text -->
					

				</div><!-- #post-## -->
				
			</div><!-- .main-box -->
		</div><!-- .box-type2 -->
		
		
					<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'templatesquare_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'templatesquare' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'templatesquare' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
					<?php endif; ?>
				

				<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
	<div id="sideright">
		<?php get_sidebar();?>
	</div><!-- #sideright -->
	<div class="clear"></div>
</div>
<!-- #main -->
<?php get_footer(); ?>
