<?php

// Theme Setting
	$themename 				= "Impresa Theme";
	$shortname 				= "templatesquare";
	
// Options panel
$logotype 	= array(
			'imagelogo' => 'Image logo',
			'textlogo' => 'Text-based logo'
   			 );
			 
$optEffect 	= array(
			'random' => 'Random',
			'sliceDown' => 'Slice Down',
			'sliceDownLeft' => 'Slice Down Left',
			'sliceUp' => 'Slice Up',
			'sliceUpLeft' => 'Slice Up Left',
			'sliceUpDown' => 'Slice Up Down',
			'sliceUpDownLeft' => 'Slice Up Down Left',
			'fold' => 'Fold',
			'fade' => 'Fade'
   			 );

		  
// Setting header
$options = array (
				array(	"name" => "General",
											"type" => "open"),
											
																		
				array(	"name" => __('Header Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('', 'templatesquare')),
									
											
				array(	"name" => __('Logo Type', 'templatesquare'),
											"desc" => __('If text-based logo is activated, enter the sitename and tagline in the fields below.', 'templatesquare'),
											"options" => $logotype,
											"id" => $shortname."_logo_type",
											"std" => "imagelogo",
											"type" => "select"),
				
				
				array(	"name" => __('Site name', 'templatesquare'),
											"desc" => '',
											"id" => $shortname."_site_name",
											"std" => "",
											"type" => "text"),												
				
				array(	"name" => __('Logo Image URL', 'templatesquare'),
											"desc" => __('If image logo is activated, enter the logo image url (http://www.fullurl.com/logo.png).', 'templatesquare'),
											"id" => $shortname."_logo_image",
											"std" => "",
											"type" => "text"),
											
				array(	"name" => __('Favicon URL', 'templatesquare'),
											"desc" => __('Enter the favicon image url (http://www.fullurl.com/favicon.ico).', 'templatesquare'),
											"id" => $shortname."_favicon",
											"std" => "",
											"type" => "text"),

				array(	"name" => __('Footer Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('Footer and Analytics Settings', 'templatesquare')),					
				array(	"name" => __('Footer Text', 'templatesquare'),
											"desc" => __('You can use html tag in here.', 'templatesquare'),
											"id" => $shortname."_footer",
											"std" => "",
											"type" => "textarea"),
		
				array(	"name" => __('Google Analytics', 'templatesquare'),
											"desc" => __('Enter the full google analytics code here.', 'templatesquare'),
											"id" => $shortname."_google",
											"std" => "",
											"type" => "textarea"),
											
											
				array(	"type" => "close"),	
				
				array(	"name" => "Slider",
											"type" => "open"),
				
				array(	"name" => __('Slider Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('', 'templatesquare')),
											
				array(	"name" => __('Slider Effect', 'templatesquare'),
											"desc" => __('Select slider effect.', 'templatesquare'),
									"options" => $optEffect,
									"id" => $shortname."_slider_effect",
									"std" => "random",
									"type" => "select"),

											
				array( 	"name" => __('Slider Timeout', 'templatesquare'),
											"desc" => __('Please enter number for slider timeout(pause time). Default is 3000', 'templatesquare'),
											"id" => $shortname."_slider_timeout",
											"std" => "3000",
											"type" => "text"),
											
				array( 	"name" => __('Slider Animation Speed', 'templatesquare'),
											"desc" => __('Please enter number for slider animation speed. Default is 500', 'templatesquare'),
											"id" => $shortname."_slider_speed",
											"std" => "500",
											"type" => "text"),
											
											
				array( 	"name" => __('Number of Slices', 'templatesquare'),
											"desc" => __('Please enter number for slider slices. Default is 15', 'templatesquare'),
											"id" => $shortname."_slider_slices",
											"std" => "15",
											"type" => "text"),

											
				array(	"name" => "Close",
											"type" => "close"),
											
);


		function mytheme_add_admin() {
	    global $themename, $shortname, $options;
	    if ( $_GET['page'] == basename(__FILE__) ) {
	      if ( 'save' == $_REQUEST['action'] ) {
		      foreach ($options as $value) {
		      	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
		      foreach ($options as $value) {
		      	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
		      header("Location: themes.php?page=admin-options.php&saved=true");
		      die;
	      }
	    }
	    add_theme_page($themename." Options", "Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
		}
		
		function mytheme_admin() {
	
	    global $themename, $shortname, $options;
	
	    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	    
?>

	<div class="wrap">
	<div id="icon-themes" class="icon32"><br></div>
	<h2><?php echo $themename; ?> <?php _e('Options','templatesquare');?></h2>
	<div class="bordertitle"></div>
	<style type="text/css">
	table, td {font-size:13px; }
	th {font-weight:normal; width:250px;}
	span.setting-description { font-size:11px; line-height:16px; font-style:italic;}
	</style>
	
	<link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_directory'); ?>/functions/tabs/tabs.css" />
	<!-- Javascript for the tabs -->
	<script type="text/javascript">
	var $ = jQuery.noConflict();
		$(document).ready(function(){
			/* For Tab */
			$(".tab_content").hide(); //Hide all content
			$("ul.tabs li:first").addClass("active").show(); //Activate first tab
			$(".tab_content:first").show(); //Show first tab content
			//On Click Event
			$("ul.tabs li").click(function() {
				$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab_content").hide(); //Hide all tab content
				var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
				$(activeTab).fadeIn(900); //Fade in the active content
				return false;
			});
	});	
	</script><br />
	<ul class="tabs"> 
		<li><a href="#General"><?php _e('General','templatesquare'); ?></a></li>
		<li><a href="#Slider"><?php _e('Slider','templatesquare'); ?></a></li>
	</ul> 

	<div class="tab_container">
		<form method="post">
		<?php 
			foreach ($options as $value) {
			if ($value['type'] == "open") { 
		?>
		 
		 <div id="<?php echo $value['name']; ?>" class="tab_content" >
		<table  border="1" cellpadding="0" cellspacing="12" style="text-align:left">
		<?php
				}
				if ($value['type'] == "close") { 
		?>
		</table></div>
		<?php
				}
				if ($value['type'] == "heading") { 
		?>
		<thead>
		<tr>
        	<td colspan="2"><h3><?php echo $value['name']; ?></h3><span class="setting-description"><?php echo $value['desc']; ?></span></td>
        </tr>
		</thead>
		<?php
				}
				
				if ($value['type'] == "description") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
					<span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}
				
				if ($value['type'] == "info") { 
		?>
		<tr valign="top"> 
		    <th scope="row" colspan="2"><span class="setting-description"><?php echo $value['desc']; ?></span></th>

		</tr>
		<?php
				}
				if ($value['type'] == "line") { 
		?>
		<tr valign="top"> 
		    <th colspan="2" ><div style="padding-top:10px;padding-bottom:10px; vertical-align:middle; padding-left:0px;"><div style="border-bottom: 1px solid #efefef;"></div></div></th>

		</tr>
		
		<?php
				}
				
				
				if ($value['type'] == "text") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
		        <input name="<?php echo $value['id']; ?>" size="60" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /><br />
 
						<span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}
				
				
				if ($value['type'] == "textarea") { 
				
		?>
		
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
			<textarea cols="50" rows="5"  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings($value['id']));; } else { echo $value['std']; } ?></textarea><br /><span class="setting-description"><?php echo $value['desc']; ?></span>

		    </td>
		</tr>
		<?php
				}
			if ($value['type'] == "checkbox") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
			<?php if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                            <br /><span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}
			if ($value['type'] == "checkbox-pages") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:<br /><span class="setting-description"><?php echo $value['desc']; ?></span></th>
		    <td>
			<?php 
			$pages_list = get_pages();

			
			?>
			
<table><?php $i = 0; foreach ($pages_list as $option) { $checked = ""; ?><?php if (get_settings( $value['id'])) { if (in_array($option->ID, get_settings( $value['id'] ))) $checked = "checked=\"checked\""; } elseif ($value['std'][$i] == "true") { $checked = "checked=\"checked\""; } ?><tr><td><input type="checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $value['id']; ?>-<?php echo $option->ID; ?>" value="<?php echo $option->ID; ?>" <?php echo $checked; ?> /> <label for="<?php echo $value['id']; ?>-<?php echo $option->ID; ?>"><?php echo is_array($value['desc'])?$value['desc'][$i]:$option->post_title; ?></label> </td></tr> <?php $i++; } ?></table>
		    </td>
		</tr>
		<?php
				}

				if ($value['type'] == "select") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
						<select style="width:140px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $key => $option) { ?><option<?php if ( get_settings( $value['id'] ) == $key) { echo ' selected="selected"'; } elseif ($key == $value['std']) { echo ' selected="selected"'; } ?> value="<?php echo $key; ?>"><?php echo $option; ?></option><?php } ?></select> <br /><span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}
				
				
				if ($value['type'] == "colorpicker") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
            <script language="javascript">
            	(function($){
					var initLayout = function() {		
						$('#colorSelector-<?php echo $value['id']; ?>').ColorPicker({
							color: '<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>',
							onShow: function (colpkr) {
								$(colpkr).fadeIn(500);
								return false;
							},
							onHide: function (colpkr) {
								$(colpkr).fadeOut(500);
								return false;
							},
							onChange: function (hsb, hex, rgb) {
								$('#colorSelector-<?php echo $value['id'] ?> div').css('backgroundColor', '#' + hex);
								$("#<?php echo $value['id']; ?>").attr('value', '#' + hex);								
							}
						});
					};	
					EYE.register(initLayout, 'init');
				})(jQuery)
            </script>
			<div id="colorContainer"><div id="colorSelector-<?php echo $value['id']; ?>"><div style="background-color: <?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>"></div></div></div>
            <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="hidden" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />  
			          
		    </td>
		</tr>
		<?php
				}

				if ($value['type'] == "select-categories") { 
				
					$pn_categories_obj = get_categories('hide_empty=0');
					$pn_categories = array();
						
					foreach ($pn_categories_obj as $pn_cat) {
						$pn_categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
					}
					$categories_tmp = array_unshift($pn_categories, "All Categories");
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
		        <select style="width:140px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
               <?php foreach ($pn_categories as $option) { ?>
               <option <?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
               <?php } ?>
           </select><br />
 <span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}	

			}
		?>
		</table>
	</div>
	
	<p class="submit">
	<input name="save" type="submit" class="button-primary" value="Save changes" /> 
	<input type="hidden" name="action" value="save" />
	</p>
	</form>
	
	<?php
	}
	add_action('admin_menu', 'mytheme_add_admin');

?>
