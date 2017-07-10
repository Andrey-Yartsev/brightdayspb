<?php
/*
Template Name: Search Page
*/
?>
<?php get_header(); ?>
  <div class="clear"></div>
  <div class="main">
    <div id="content">
      <?php include(TEMPLATEPATH . "/slider.php"); ?>
      <div id="maincontent">
        <div class="entry">
          <h1>Поиск <?php the_search_query() ?></h1>
          <?php get_search_form(); ?>
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div>
              <p><b><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></b></p>
              <?php the_excerpt(); ?>
            </div>
          <?php endwhile;
          else: ?>
          <?php endif; ?>
        </div>
      </div>
      <?php include(TEMPLATEPATH . "/right2.php"); ?>
      <div class="clear"></div>
    </div>
  </div>
  <div class="clear"></div>
  <div class="propusk"></div>
  <div class="propusk"></div>
<?php get_footer(); ?>