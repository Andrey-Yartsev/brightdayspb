<div id="maincontent">
  <div style="margin-bottom: 30px;">
    <?php $top_query = new WP_Query('page_id=450'); ?>
    <?php if (have_posts()) : ?>
      <?php while ($top_query->have_posts()) : $top_query->the_post();
        $first_post = $post->ID; ?>
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

  <div class="entry">
    <h1>Почему мы</h1>
    <div class="icons">
      <div class="icon icon1">
        <i></i>
        <div class="title">Опыт 10 лет</div>
        <div class="sub-title">Опыт оформления мероприятий более 10 лет</div>
      </div>
      <div class="icon icon2">
        <i></i>
        <div class="title">Мастерская</div>
        <div class="sub-title">Собственные мастерские и современное оборудование</div>
      </div>
      <div class="icon icon3">
        <i></i>
        <div class="title">Выгодные условия</div>
        <div class="sub-title">Выгодные условия сотрудничества для event агентств</div>
      </div>
      <div class="icon icon4">
        <i></i>
        <div class="title">Возможности</div>
        <div class="sub-title">Изготовим любые декорации на заказ</div>
      </div>
      <div class="icon icon5">
        <i></i>
        <div class="title">Опыт 10 лет</div>
        <div class="sub-title">Опыт оформления мероприятий более 10 лет</div>
      </div>
      <div class="icon icon6">
        <i></i>
        <div class="title">Опыт 10 лет</div>
        <div class="sub-title">Опыт оформления мероприятий более 10 лет</div>
      </div>
    </div>
    <div class="clear"></div>
  </div>

  <div class="entry">
    <h1>Наши работы</h1>
    <div class="owl-carousel works">
      <div>
        <i></i>
        <a href="/wp-content/themes/LightFirm/images/masks.jpg" rel="zoom"><img
            src="/wp-content/themes/LightFirm/images/masks.jpg"></a>
        <div class="title">Яркая театральная бутофория</div>
      </div>
      <div>
        <i></i>
        <a href="/wp-content/themes/LightFirm/images/masks.jpg" rel="zoom"><img
            src="/wp-content/themes/LightFirm/images/masks.jpg"></a>
        <div class="title">Яркая театральная бутофория</div>
      </div>
      <div>
        <i></i>
        <a href="/wp-content/themes/LightFirm/images/masks.jpg" rel="zoom"><img
            src="/wp-content/themes/LightFirm/images/masks.jpg"></a>
        <div class="title">Яркая театральная бутофория</div>
      </div>
      <div>
        <i></i>
        <a href="/wp-content/themes/LightFirm/images/masks.jpg" rel="zoom"><img
            src="/wp-content/themes/LightFirm/images/masks.jpg"></a>
        <div class="title">Яркая театральная бутофория</div>
      </div>
    </div>
    <div class="clear"></div>
  </div>

  <div class="entry center btns">
    <a href="" class="btn order-btn">Заказать оформление</a>
    <a href="" class="btn call-btn">Получить консультацию</a>
  </div>
  <!--
  <div class="entry">
    <h1>Отзывы клиентов</h1>
    <div class="owl-carousel reviews">
      <div>
        <i></i>
        <a href="/wp-content/themes/LightFirm/images/otziv.jpg" rel="zoom"><img
            src="/wp-content/themes/LightFirm/images/otziv.jpg"></a>
      </div>
      <div>
        <i></i>
        <a href="/wp-content/themes/LightFirm/images/otziv.jpg" rel="zoom"><img
            src="/wp-content/themes/LightFirm/images/otziv.jpg"></a>
      </div>
      <div>
        <i></i>
        <a href="/wp-content/themes/LightFirm/images/otziv.jpg" rel="zoom"><img
            src="/wp-content/themes/LightFirm/images/otziv.jpg"></a>
      </div>
      <div>
        <i></i>
        <a href="/wp-content/themes/LightFirm/images/otziv.jpg" rel="zoom"><img
            src="/wp-content/themes/LightFirm/images/otziv.jpg"></a>
      </div>
      <div>
        <i></i>
        <a href="/wp-content/themes/LightFirm/images/otziv.jpg" rel="zoom"><img
            src="/wp-content/themes/LightFirm/images/otziv.jpg"></a>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <br><br>
  -->

  <div style="margin-bottom: 30px;">
    <div class="how-h1">Наши услуги</div>
    <div class="clear"></div>
    <?php include(TEMPLATEPATH . "/uslugi.php"); ?>
    <div class="clear"></div>
  </div>
</div>