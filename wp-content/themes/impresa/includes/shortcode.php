<?php
/**
 * Theme Short-code Functions
 */


//************************************* Testimonials

function ts_testimonials($atts, $content = null) {
	extract(shortcode_atts(array(
                "numposts" => '5'
	), $atts));
	query_posts('post_type=testimonial&showposts='.$numposts);
			while(have_posts()) { the_post();
			$custom = get_post_custom($post->ID);
			$testiname = $custom["testimonial-name"][0];
			$testicompany = $custom["testimonial-company"][0];
			$text = get_the_content();
			$html.= '<blockquote class="code-testi">'.$text.'</blockquote><div class="code-name-testi">
									 <span class="user">'. $testiname .'</span>
									 <br style="line-height:4px" />'. $testicompany.'</div><hr/>';
	}
	wp_reset_query();
	
        return $html;

}
add_shortcode("testimonials", "ts_testimonials");

?>
