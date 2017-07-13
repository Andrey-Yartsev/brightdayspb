<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5RMVGS');</script>
<!-- End Google Tag Manager -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon">

<title><?php if (is_home () ) { bloginfo('name'); } elseif ( is_category() ) { single_cat_title(); echo ' - ' ; bloginfo('name'); }
 elseif (is_single() ) { single_post_title(); }
 elseif (is_page() ) { bloginfo('name'); echo ': '; single_post_title(); }
 else { wp_title('',true); } ?></title>

<link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/reset.css" rel="stylesheet" type="text/css" />

  <link href="/wp-content/themes/LightFirm/owl/assets/owl.carousel.css" rel="stylesheet" type="text/css"/>

  <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">

<script src="https://use.fontawesome.com/3e3fd9d0f8.js"></script>

  <script src="https://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/cufon-yui.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/cufon-replace.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/Century_Gothic_700.font.js" type="text/javascript"></script>

  <script src="/wp-content/themes/LightFirm/owl/jquery.fancybox.pack.js" type="text/javascript"></script>
  <script src="/wp-content/themes/LightFirm/owl/owl.carousel.min.js" type="text/javascript"></script>

  <link href="/wp-content/themes/LightFirm/pp/prettyPhoto.css" rel="stylesheet">
  <script src="/wp-content/themes/LightFirm/pp/prettyPhoto.js" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js" integrity="sha384-tIwI8+qJdZBtYYCKwRkjxBGQVZS3gGozr3CtI+5JF/oL1JmPEHzCEnIKbDbLTCer" crossorigin="anonymous"></script>

<?php wp_head(); ?>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RMVGS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="main">
	<div class="part1">
		<div class="inners">
			<div style="padding-top: 8px; float: left;">
				<?php $options = get_option( 'theme_settings' ); ?>
				<div class="first"><div class="icons1"><i class="fa fa-map-pin"></i></div><div class="iconstext">Адрес: <a href="/contacts" style="color: #ff5639; text-decoration: none;"><?php echo $options['adres-number']; ?></a></div></div>
				<div class="first"><div style="margin-left: 40px;"><div class="icons1"><i class="fa fa-clock-o"></i></div><div class="iconstext">График работы: <br><?php echo $options['work-number']; ?></div></div></div>
				<div class="first"><div style="margin-left: 30px;"><div class="icons1"><i class="fa fa-envelope"></i></div><div class="iconstext">Почта: <br><a href="mailto:<?php echo $options['mail-number']; ?>" style="color: #ff5639; text-decoration: none;"><?php echo $options['mail-number']; ?></a></div></div></div>
			</div>
			<div class="tel"><a href="tel:<?php echo $options['telefon-number2']; ?>"><?php echo $options['telefon-number']; ?></a></div>
		</div>
	</div>


		<div id="header">
			<div class="logotip">
				<a href="/" title="BrightDayspb.ru - изготовление и аренда декораций в СПБ">
					<!--<div class="about2"><?php echo $options['info-text-1']; ?></div>-->
					<div class="link"><span class="change3"><?php echo $options['info-text-2']; ?></span><span class="change1"><?php echo $options['info-text-3']; ?></span></div>
					<div class="about"><?php echo $options['info-text-4']; ?></div>
				</a>
			</div>

      <div class="contacts">
        <div class="schedule">
          График работы:
          <span>круглосуточно</span>
        </div>
        <div class="address">
          Санкт-Петербург,<br>
          Петровский пр. д.9
        </div>
        <div class="call">
          <div class="phone">+7 (981) 699-67-74</div>
          <a href="#" class="btn call-btn">Заказать звонок</a>
        </div>
      </div>

      <div class="top-menu">
				<nav class="nav">
					<ul class="menu">
						<?php wp_nav_menu('menu_class=sf-menu&theme_location=top'); ?>
					</ul>
				</nav>
			<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
</div>