<?php if(is_home()){ ?>
	<div class="box-title"><h1 class="pagetitle"><?php _e('Blog','templatesquare');?></h1><span class="cb"></span></div>
<?php } else { ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php $pagetitle = get_post_custom_values("page-title");?>
	<?php if($pagetitle == ""){ ?>
	<div class="box-title"><h1 class="page-title"><?php the_title(); ?></h1><span class="cb"></span></div>
	<?php } else { ?>
	<div class="box-title"><h1 class="page-title"><?php echo $pagetitle[0]; ?></h1><span class="cb"></span></div>
	<?php } ?>
	<?php endwhile; endif; ?>
	<?php wp_reset_query();?>
<?php } ?>


