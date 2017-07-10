<div id="maincontent">
	<div style="margin-bottom: 30px;">
		<?php $top_query = new WP_Query('page_id=450'); ?>
		<?php if(have_posts()) : ?>
		<?php while($top_query->have_posts()) : $top_query->the_post(); $first_post = $post->ID; ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">			
		<div class="entry">
      <?php kama_breadcrumbs(); ?>
			<h1><?php the_title(); ?></h1>
			<?php the_content(''); ?>
		</div>
		</div>
		<?php endwhile; ?>
		<?php else : ?>
		<?php endif; ?>
		<div class="clear"></div>
	</div>

	<div style="margin-bottom: 30px;">
		<div class="how-h1">Наши услуги</div>
		<div class="clear"></div>
		<?php include(TEMPLATEPATH."/uslugi.php");?>
	<div class="clear"></div>	
	</div>
</div>