<?php
/**
 * Template Name: Documents
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
				
					<?php the_content(); ?>
					
					<hr />				
				
					<?php $files = get_posts('post_type=attachment&post_mime_type=application/pdf'); ?>					
					<ul>
					<?php for($i = 0; $i < count($files); $i++ ):?>						
						<?php $this_file = $files[$i]; ?>
						<li>
							<h2 style="font-size: 18px; margin-bottom: 5px;"><a href="<?php echo $this_file->guid ?>"><?php echo $this_file->post_title ?></a></h2>
							<p><?php echo $this_file->post_content ?></p>
						</li>						
					<?php endfor; ?>
					</ul>

					
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
