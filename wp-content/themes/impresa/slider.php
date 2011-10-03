			<div id="header">
				<div id="slider">
					<?php $stext = array();?>
					<?php
						query_posts("post_type=slider&post_status=publish&posts_per_page=-1");
						while ( have_posts() ) : the_post();
					?>
					
					<?php
						$custom = get_post_custom($post->ID);
						$cf_thumb = $custom["thumb"][0];
						$cf_slideurl = $custom["slider-url"][0];
					?>	
					<?php if(has_post_thumbnail( $the_ID) || $cf_thumb!=""){ ?>		
						<?php 
							if($cf_thumb!=""){
								if(get_the_excerpt()!=""){
								echo "<img src='" . $cf_thumb . "' alt=''  width='940' height='394' title='#post". get_the_ID()."'  />";
								}else{
								echo "<img src='" . $cf_thumb . "' alt=''  width='940' height='394' title=''  />";
								}
							}else{
								if(get_the_excerpt()!=""){
								the_post_thumbnail( 'slider-post-thumbnail', array("alt" => "", "title" => "#post".get_the_ID()) );
								}else{
								the_post_thumbnail( 'slider-post-thumbnail', array("alt" => "", "title" => "") );
								}
							}
						?>
					<?php } ?>
					<?php 
						$stext[] = array(
							"sID" => "post".get_the_ID(),
							"textdesc" => get_the_excerpt(),
							"sliderurl" => $cf_slideurl
						);
					?>
					<?php endwhile; ?>
					<?php wp_reset_query();?>
				</div>
				<?php
					foreach($stext as $slide){
						echo '<div id="'.$slide["sID"].'" class="nivo-html-caption">';
						
							if($slide["sliderurl"]!=""){
							
							echo "<a href='" . $slide["sliderurl"] . "'>" . $slide['textdesc'] . " &raquo;</a>";
							
							}else{
							
							echo $slide['textdesc'];
							
							}
							
						echo '</div>';
					}
				?>
			</div>
			<!-- #header -->
