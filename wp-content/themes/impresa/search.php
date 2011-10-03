<?php
/**
 * The template for displaying Search Results pages.
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
		<div id="searchresult">
			<?php if ( have_posts() ) : ?>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
			?>
			<?php else : ?>
			<div class="box-type2">
			<div class="main-box">
				<div class="box-text">
					<div id="post-0" class="post no-results not-found">
						<h2 class="entry-title"><?php _e( 'Nothing Found', 'templatesquare' ); ?></h2>
						<div class="entry-content">
							<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'templatesquare' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</div><!-- #post-0 -->
				</div><!-- .boxt-text -->
			</div><!-- .main-box -->
			</div><!-- .box-type2 -->
			<?php endif; ?>
		</div><!-- end #searchresult -->
	</div><!-- #content -->
	<div id="sideright">
		<?php get_sidebar();?>
	</div><!-- #sideright -->
	<div class="clear"></div>
</div>
<!-- #main -->
<?php get_footer(); ?>
