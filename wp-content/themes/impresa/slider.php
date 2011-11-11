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
				
			<div style="background: #fff; opacity: .8; position: absolute; top: 0px; left: 690px; padding: 0px; margin: 20px; width: 200px; z-index: 100;">
				<div style="background: #6895b6; height: 20px; padding: 6px 15px 8px 15px;">
					<h2 style="color: white; font-size: 16px;">Patient Portal</h2>
				</div>
				<div style="padding: 15px 15px 0 15px;">
					<img src="/wp-content/themes/impresa/images/portalThumb.jpg" width="170" height="120" />
					<p style="margin: 0; font-size: 12px;">Login to our Patient Portal to schedule appointments, refill prescriptions, and more!</p>
					<div style="margin: 10px 0 15px 0;">
						<a href="/?page_id=162" id="patientPortal" style="padding: 4px 8px; background: #66b451; border: 1px solid #5daa48; color: #fff; font-weight: bold; text-transform: uppercase; font-size: 10px;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;">get started</a>
					</div>
				</div>
			</div>
			</div>			
			<!-- #header -->