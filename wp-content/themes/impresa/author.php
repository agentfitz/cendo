<?php
/**
 * The template for displaying Author Archive pages.
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
					/* Queue the first post, that way we know who
					 * the author is when we try to get their name,
					 * URL, description, avatar, etc.
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					if ( have_posts() )
						the_post();
				?>
				

				<?php
				// If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) : ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'templatesquare_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( __( 'About %s', 'templatesquare' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
						</div><!-- #author-description	-->
					</div><!-- #entry-author-info -->
				<?php endif; ?>

				<?php
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
				
					/* Run the loop for the author archive page to output the authors posts
					 * If you want to overload this in a child theme then include a file
					 * called loop-author.php and that will be used instead.
					 */
					 get_template_part( 'loop', 'author' );
				?>
		
	</div><!-- #content -->
	<div id="sideright">
		<?php get_sidebar();?>
	</div><!-- #sideright -->
	<div class="clear"></div>
</div>
<!-- #main -->
<?php get_footer(); ?>
