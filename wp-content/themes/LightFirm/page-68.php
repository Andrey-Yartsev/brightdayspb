<?php get_header(); ?>
<div class="main">
  <?php include 'head.php'; ?>
	<div id="content">
		<?php include(TEMPLATEPATH."/slider.php");?>
		
		<div id="maincontent">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<div class="entry">
          <?php kama_breadcrumbs(); ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(''); ?>
				</div>
				<div class="clear"></div>
			</div>
			<?php endwhile; else: ?>
			<?php endif; ?>	
		</div>
		<?php include(TEMPLATEPATH."/right1.php");?>	
		
	</div>
</div>
<div class="clear"></div>
<div class="propusk"></div>
<div class="propusk"></div>
<?php get_footer(); ?>