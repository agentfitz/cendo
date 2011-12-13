<?php
/**
 * Template Name: Contact
 *
 * A custom page template for contact page.
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
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="box-text">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content( __( 'Continue Reading', 'templatesquare' ) ); ?>
						
						
						<script>
							$(function(){

								var $msg = $("#message");

								$("#contactform").submit(function(e){
									if(!hasMsgVal()){
										updateMsgStyle(false);
										e.preventDefault();
									}
								});

								function hasMsgVal(){
									var msgVal = $.trim($msg.val());
									var result = false;
									if(msgVal != ''){
										result = true;
									}
									return result;
								}

								function updateMsgStyle(hasContent){
									if(hasContent){
										$msg.css({ "border": "1px solid #ECECEC", "background": "#fff" });
									}
									else{
										$msg.css({ "border": "1px solid red", "background": "#ffd7d7" });
									}
								}

								$msg.keypress(function(){
									if(hasMsgVal()){
										updateMsgStyle(true);
									}
								});
								
							});
						</script>
						
						<div id="respond" class="respondContact">
						<?php if($_POST['submit_button']) :
							$emailTo = 'bmfitzgerald3@gmail.com';
							$emailFrom = $_POST['contact_email'];
							$subject = 'Contact Form Submission from CarolinaEndocrine.com';
							$body = "Name: " . $_POST['contact_name'] . " Phone: " . $_POST['contact_phone_number'] . " Email: " . $_POST['contact_email'] . " Message: " . $_POST['contact_message'];
							$headers = 'From: Carolina Endocrine <' . $emailFrom . '>' . "\r\n" . 'Reply-To: ' . $emailFrom;
							mail($emailTo, $subject, $body, $headers);
							echo "<h2>Your message has been sent successfully!  We will be in touch shortly if a response is required.</h2>";
						?>
						<script>
							$(function(){
								$("#respond").removeClass("respondContact").addClass("respondSuccess");
							});
						</script>
						<?php else :?>
							<h2>Share your feedback</h2>
							<form action="" method="post" id="contactform">
								<p class="comment-notes">We invite you to contact us directly with the form below. If you would like your message to be sent anonymously, feel free to leave the necessary fields blank.</p>
								<p class="comment-form-author">
									<label for="author">Name</label>
									<input id="author" name="contact_name" type="text" value="" size="30">
								</p>
								<p class="comment-form-email">
									<label for="email">Email</label>
									<input id="email" name="contact_email" type="text" value="" size="30">
								</p>
								<p class="comment-form-url">
									<label for="url">Phone Number</label>
									<input id="url" name="contact_phone_number" type="text" value="" size="30">
								</p>
								<p class="comment-form-comment">
									<label for="message">Message <span class="required">*</span></label>
									<textarea id="message" name="contact_message" cols="45" rows="8"></textarea>
								</p>				
								<p class="form-submit">
									<input name="submit_button" type="submit" id="submit" value="Send Message">
								</p>
							</form>
						<?php endif;?>
						</div>						
						
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