<?php get_header(); ?>
<div class="main">
  <?php include 'head.php'; ?>
	<div id="content">
		<?php include(TEMPLATEPATH."/slider.php");?>
		
		<div id="maincontent">
			<div class="entry">
        <?php kama_breadcrumbs(); ?>
        <h1>Наши проекты</h1>
      </div>
			
			<?php $top_query = new WP_Query('showposts=5&cat=2'); ?>
			<?php if(have_posts()) : ?>

			<?php while($top_query->have_posts()) : $top_query->the_post(); $first_post = $post->ID; ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="miniature2">
			<a href="<?php the_permalink() ?>" rel="bookmark">
						<?php if(has_post_thumbnail()): ?>
		 					<div class="miniature"><?php the_post_thumbnail(array(240,140)); ?></div>
		 				<?php else: ?>
		 					<img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php getImage('1'); ?>&w=240&h=140&zc=1">
		 				<?php endif; ?>
			</a>
			</div>
			<p class="zagolovok"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
			<div class="entry"><?php zt_content_limit(440, ""); ?></div>
			<div class="clear"></div>
			<div class="propusk"></div>
			</div>

			<?php endwhile; ?>
			<?php else : ?>
			<?php endif; ?>
			<div class="clear"></div>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<div class="entry">

					<?php the_content(''); ?>
				</div>
				<div class="clear"></div>
			</div>
			<?php endwhile; else: ?>
			<?php endif; ?>	
		</div>
		<?php include(TEMPLATEPATH."/right2.php");?>	
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
<div class="propusk"></div>
<div class="propusk"></div>
<?php get_footer(); ?>